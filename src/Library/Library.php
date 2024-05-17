<?php

namespace App\Library;

use App\Entity\Books;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class Library
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
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
    private function setBookProperties(Request $request, Books $book): void
    {
        $book->setTitle($request->request->get('title'));
        $book->setIsbn($request->request->get('isbn'));
        $book->setAuthor($request->request->get('author'));
        $book->setDescription($request->request->get('description'));
    }

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
