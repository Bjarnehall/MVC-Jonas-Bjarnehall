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
        $books->setIsbn($request->request->getInt('isbn'));
        $books->setAuthor($request->request->get('author'));
        $books->setDescription($request->request->get('description'));

        // handle file upload
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

    #[Route('/library/books', name: 'show_library')]
    public function showBooks(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $booksRepository = $entityManager->getRepository(Books::class);
        $books = $booksRepository->findAll();

        foreach ($books as $book) {
            if ($book->getImg()) {
                $imgData = stream_get_contents($book->getImg());
                $book->imgBase64 = base64_encode($imgData);
            }
        }

        return $this->render('library/show.html.twig', [
            'books' => $books
        ]);
    }
    // #[Route('/library/create', 'library_create')]
    // public function createBooks(
    //     ManageRegistry $doctrine
    // ): Response {
    //     $entityManager = $doctrine->getManager();

    //     $books = new Books();
    //     $books->setTitle('Dune');
    //     $books->setIsbn(9780441013593);
    //     $books->setAuthor("Frank Herbert");
    //     $books->setImg();
    //     $books->setDescription("Set on the desert planet Arrakis, Dune is the story of Paul Atreides--who would become known as Muad'Dib--and of a great family's ambition to bring to fruition humankind's most ancient and unattainable dream.");

    //     $entityManager->persist($books);

    //     $entityManager->flush();

    //     return new Response('Saved new book with id' .$books->getId());
    // }
}
