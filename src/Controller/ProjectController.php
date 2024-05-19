<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProjectController extends AbstractController
{
    #[Route("/proj", name: "project_home")]
    public function proj_home(): Response
    {
        return $this->render('project/home.html.twig');
    }

    #[Route("/proj/about", name: "project_about")]
    public function proj_about(): Response
    {
        return $this->render('project/about.html.twig');
    }

    #[Route("/proj/start", name: "project_start")]
    public function proj_start(): Response
    {
        return $this->render('project/start.html.twig');
    }

    #[Route("/proj/secondroom", name: "project_secondroom")]
    public function proj_second_room(): Response
    {
        return $this->render('project/secondroom.html.twig');
    }

    #[Route("/proj/server", name: "project_server")]
    public function proj_server(): Response
    {
        return $this->render('project/server.html.twig');
    }

    #[Route("/proj/end", name: "project_end")]
    public function proj_end(): Response
    {
        return $this->render('project/end.html.twig');
    }

}