<?php

namespace App\Controller;

use App\Adventure\AdventureMechanics;
use App\Adventure\AdventureInventory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends AbstractController
{
    private $adventureMechanics;
    private $adventureInventory;

    public function __construct(AdventureMechanics $adventureMechanics, AdventureInventory $adventureInventory)
    {
        $this->adventureMechanics = $adventureMechanics;
        $this->adventureInventory = $adventureInventory;
    }
    /**
     * Game home page
     */
    #[Route("/proj", name: "project_home")]
    public function proj_home(): Response
    {
        return $this->render('project/home.html.twig');
    }
    /**
     * Game about page
     */
    #[Route("/proj/about", name: "project_about")]
    public function proj_about(): Response
    {
        return $this->render('project/about.html.twig');
    }
    /**
     * Game start room
     */
    #[Route("/proj/start", name: "project_start")]
    public function proj_start(): Response
    {
        $adventures = $this->adventureInventory->getAllAdventures();
        return $this->render('project/start.html.twig', [
            'adventures' => $adventures,
        ]);
    }
    /**
     * Game second room
     */
    #[Route("/proj/secondroom", name: "project_secondroom")]
    public function proj_second_room(): Response
    {
        $adventures = $this->adventureInventory->getAllAdventures();
        return $this->render('project/secondroom.html.twig', [
            'adventures' => $adventures,
        ]);
    }
    /**
     * Game third room
     */
    #[Route("/proj/thirdroom", name: "project_thirdroom")]
    public function proj_third_room(): Response
    {
        $adventures = $this->adventureInventory->getAllAdventures();
        return $this->render('project/thirdroom.html.twig', [
            'adventures' => $adventures,
        ]);
    }
    /**
     * Game end page
     */
    #[Route("/proj/end", name: "project_end")]
    public function proj_end(): Response
    {
        return $this->render('project/end.html.twig');
    }
    /**
     * Game serverroom
     */
    #[Route("/proj/server/passed", name: "project_server_passed")]
    public function proj_server_passed(): Response
    {
        $adventures = $this->adventureInventory->getAllAdventures();
        return $this->render('project/server.html.twig', [
            'adventures' => $adventures,
        ]);
    }
    /**
     * Game password check for serverroom
     */
    #[Route("/proj/server", name: "project_server")]
    public function proj_server(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            $password = $request->request->get('password');

            if ($this->adventureMechanics->checkPassword($password)) {
                return $this->redirectToRoute('project_server_passed');
            } else {
                return $this->redirectToRoute('project_start');
            }
        }
        $adventures = $this->adventureInventory->getAllAdventures();
        return $this->render('project/server_password.html.twig', [
            'adventures' => $adventures,
        ]);
    }
}
