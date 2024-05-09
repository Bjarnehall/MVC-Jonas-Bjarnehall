<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LibraryTestController extends AbstractController
{
    #[Route('/library_welcome', name: 'library_welcome')]
    public function welcomeLibrary(): Response
    {
        return $this->render('library/library.html.twig');
    }
}
