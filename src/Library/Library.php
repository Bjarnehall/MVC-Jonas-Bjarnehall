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
            $book = new books();
        }

        $book->setTitle($request->request->get('title'));
        $book->setIsbn($request->request->get('isbn'));
        $book->setAuthor($request->request->get('author'));
        $book->setDescription($request->request->get('description'));

        $file = $request->files->get('image');
        if ($file instanceof UploadedFile && $file->isValid()) {
            $blob = file_get_contents($file->getPathname());
            $book->setImg($blob);
        }

        $entityManager->persist($book);
        $entityManager->flush();

        return $book;
    }
}
