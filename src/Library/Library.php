<?php

namespace App\Library;

use App\Entity\Books;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class Library
{
    private ManagerRegistry $doctrine;
    /**
     * Constructor.
     *
     * @param ManagerRegistry $doctrine The Doctrine ManagerRegistry.
     */
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    /**
     * Creates or updates a book
     *
     * @param Request     $request
     * @param Books|null  $book
     * 
     * @return Books
     */
    public function createOrUpdateBook(Request $request, ?Books $book = null): Books
    {
        $entityManager = $this->doctrine->getManager();

        if (!$book) {
            $book = new Books();
        }

        $this->setBookProperties($request, $book);

        $this->handleFileUpload($request, $book);

        $entityManager->persist($book);
        $entityManager->flush();

        return $book;
    }
    /**
     * Sets the properties of the book.
     *
     * @param Request $request
     * @param Books   $book
     * 
     * @return void
     */
    private function setBookProperties(Request $request, Books $book): void
    {
        $book->setTitle($request->request->get('title'));
        $book->setIsbn($request->request->get('isbn'));
        $book->setAuthor($request->request->get('author'));
        $book->setDescription($request->request->get('description'));
    }
    /**
     * Handles file upload and sets the image property of the book.
     *
     * @param Request $request
     * @param Books   $book
     * 
     * @return void
     */
    private function handleFileUpload(Request $request, Books $book): void
    {
        $file = $request->files->get('image');
        if ($file instanceof UploadedFile && $file->isValid()) {
            $filePath = $file->move(sys_get_temp_dir(), $file->getClientOriginalName())->getPathname();
            $blob = file_get_contents($filePath);
            $book->setImg($blob);
        }
    }
}
