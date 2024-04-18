<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    
    /**
     * Display all session variables.
     *
     * @param SessionInterface
     * @return Response
     */
    #[Route("/session", name: "session")]
    public function showSessionVariables(SessionInterface $session): Response
    {
        $sessionVariables = $session->all();

        return $this->render('session.html.twig', [
            'sessionVariables' => $sessionVariables,
        ]);
    }
}