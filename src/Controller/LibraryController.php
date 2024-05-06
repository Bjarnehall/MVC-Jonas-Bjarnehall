<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Books;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class LibraryController extends AbstractController
{
    #[Route('/library', name: 'app_library')]
    public function index(): Response
    {
        return $this->render('library/index.html.twig', [
            'controller_name' => 'LibraryController',
        ]);
    }

    #[Route('/library/add', name: 'add_library')]
    public function add(): Response
    {
        return $this->render('library/add.html.twig', [
            'controller_name' => 'LibraryController',
        ]);
    }

    /**
     * Create
     */
    #[Route('library/create', name: 'library_create', methods: ['POST'])]
    
    public function createBooks(
        Request $request,
        ManagerRegistry $doctrine
    ): Response {
        $entityManager = $doctrine->getManager();

        $books = new Books();

        $books->setTitle($request->request->get('title'));
        // $books->setIsbn($request->request->getInt('isbn'));
        $books->setIsbn($request->request->get('isbn'));
        $books->setAuthor($request->request->get('author'));
        $books->setDescription($request->request->get('description'));

        // file upload
        $file = $request->files->get('image');
        if ($file && $file->isValid()) {
            $blob = file_get_contents($file->getPathname());
            $books->setImg($blob);
        }

        $entityManager->persist($books);
        $entityManager->flush();

        // return new Response('Saved new book with id ' . $books->getId());
        return $this->render('library/index.html.twig', [
        'controller_name' => 'LibraryController',
        ]);
    }

    #[Route('/library/update_book/{id}', name: 'update_book')]
    public function update($id, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $booksRepository = $entityManager->getRepository(Books::class);

        $book = $booksRepository->find($id);

        return $this->render('library/update.html.twig', [
            'book' => $book,
            'controller_name' => 'LibraryController',
        ]);
    }


    // #[Route('/library/update/{id}/{value}', name: 'library_update', methods: ['POST'])]
    #[Route('/library/update/{id}', name: 'library_update', methods: ['POST'])]
    public function updateBook(
        $id,
        Request $request,
        ManagerRegistry $doctrine
    ): Response {
        $entityManager = $doctrine->getManager();
        $booksRepository = $entityManager->getRepository(Books::class);

        $books = $booksRepository->find($id);

        if (!$books) {
            throw $this->createNotFoundException('Boken finns inte');
        }

        $books->setTitle($request->request->get('title'));
        $books->setIsbn($request->request->get('isbn'));
        $books->setAuthor($request->request->get('author'));
        $books->setDescription($request->request->get('description'));

        // file upload
        $file = $request->files->get('image');
        if ($file && $file->isValid()) {
            $blob = file_get_contents($file->getPathname());
            $books->setImg($blob);
        }

        $entityManager->flush();

        return $this->redirectToRoute('show_library_by_id', ['id' => $id]);
    }

    #[Route('/library/books', name: 'show_library')]
    public function showBooks(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $booksRepository = $entityManager->getRepository(Books::class);
        $books = $booksRepository->findAll();
        // img
        foreach ($books as $book) {
            $imgData = $book->getImg();
            if ($imgData !== null) {
                $imgData = stream_get_contents($imgData);
                $book->setImgBase64(base64_encode($imgData));
            }
        }
        return $this->render('library/show.html.twig', [
            'books' => $books
        ]);
    }

    #[Route('/library/books/{id}', name: 'show_library_by_id')]
    public function showBooksById($id, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $booksRepository = $entityManager->getRepository(Books::class);
        $book = $booksRepository->find($id);
        
        if (!$book) {
            throw $this->createNotFoundException('Kan inte hitta boken');
        }
        
        // img
        $imgData = $book->getImg();
        if ($imgData !== null) {
            $imgData = stream_get_contents($imgData);
            $book->setImgBase64(base64_encode($imgData));
        }

        return $this->render('library/detail.html.twig', [
            'book' => $book
        ]);
    }

}
