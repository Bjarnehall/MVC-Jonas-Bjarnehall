<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Books;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class LibraryController extends AbstractController
{
    /**
     * Home page for library
     */
    #[Route('/library', name: 'app_library')]
    public function index(): Response
    {
        return $this->render('library/index.html.twig', [
            'controller_name' => 'LibraryController',
        ]);
    }
    /**
     * Page for adding new item to library
     */
    #[Route('/library/add', name: 'add_library')]
    public function add(): Response
    {
        return $this->render('library/add.html.twig', [
            'controller_name' => 'LibraryController',
        ]);
    }
    /**
     * Route for creating item from added item in add_library to database
     */
    #[Route('library/create', name: 'library_create', methods: ['POST'])]

    public function createBooks(
        Request $request,
        ManagerRegistry $doctrine
    ): Response {
        $entityManager = $doctrine->getManager();

        $books = new Books();

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

        $entityManager->persist($books);
        $entityManager->flush();

        return $this->render('library/index.html.twig', [
        'controller_name' => 'LibraryController',
        ]);
    }
    /**
     * Page for editing existing item
     */
    #[Route('/library/update_book/{id}', name: 'update_book')]
    public function update(int $id, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $booksRepository = $entityManager->getRepository(Books::class);

        $book = $booksRepository->find($id);

        return $this->render('library/update.html.twig', [
            'book' => $book,
            'controller_name' => 'LibraryController',
        ]);
    }
    /**
     * Route for posting changes from update_book to database
     */
    #[Route('/library/update/{id}', name: 'library_update', methods: ['POST'])]
    public function updateBook(
        int $id,
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


        $file = $request->files->get('image');
        if ($file && $file->isValid()) {
            $blob = file_get_contents($file->getPathname());
            $books->setImg($blob);
        }

        $entityManager->flush();

        return $this->redirectToRoute('show_library_by_id', ['id' => $id]);
    }
    /**
     * Page for viewing all items in specific database
     */
    #[Route('/library/books', name: 'show_library')]
    public function showBooks(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $booksRepository = $entityManager->getRepository(Books::class);
        $books = $booksRepository->findAll();

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
    /**
     * Page for viewing details of specific book in database
     */
    #[Route('/library/books/{id}', name: 'show_library_by_id')]
    public function showBooksById(int $id, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $booksRepository = $entityManager->getRepository(Books::class);
        $book = $booksRepository->find($id);

        if (!$book) {
            throw $this->createNotFoundException('Kan inte hitta boken');
        }

        $imgData = $book->getImg();
        if ($imgData !== null) {
            $imgData = stream_get_contents($imgData);
            $book->setImgBase64(base64_encode($imgData));
        }

        return $this->render('library/detail.html.twig', [
            'book' => $book
        ]);
    }
    /**
     * Handles post to delete item in database from the page show_library_by_id
     */
    #[Route('/library/delete/{id}', name: 'delete_library_by_id', methods: ['POST'])]
    public function deleteBooksById(int $id, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $booksRepository = $entityManager->getRepository(Books::class);

        $book = $booksRepository->find($id);

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('show_library');
    }
    /**
     * Returns a json of the items in specific database
     */
    #[Route('/api/library/books', name: 'api_library_books')]
    public function apiShowBooks(ManagerRegistry $doctrine): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $booksRepository = $entityManager->getRepository(Books::class);
        $books = $booksRepository->findAll();

        $booksData = [];
        foreach ($books as $book) {
            $booksData[] = [
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'isbn' => $book->getIsbn(),
                'author' => $book->getAuthor(),
                'description' => $book->getDescription(),
            ];
        }

        return new JsonResponse($booksData);
    }
    /**
     * Returns json of a specific item in the specific database
     */
    #[Route('/api/library/book/{isbn}', name: 'api_library_book_by_isbn')]
    public function apiShowBookByIsbn(string $isbn, ManagerRegistry $doctrine): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $booksRepository = $entityManager->getRepository(Books::class);
        $book = $booksRepository->findOneBy(['isbn' => $isbn]);

        if (!$book) {
            return new JsonResponse(['error' => 'Book not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $bookData = [
            'id' => $book->getId(),
            'title' => $book->getTitle(),
            'isbn' => $book->getIsbn(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
        ];

        return new JsonResponse($bookData);
    }
}
