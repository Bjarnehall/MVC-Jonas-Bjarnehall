<?php

namespace App\Controller;

use App\Adventure\AdventureInventory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Adventure;
use Doctrine\Persistence\ManagerRegistry;

class AdventureController extends AbstractController
{
    private $adventureInventory;

    public function __construct(AdventureInventory $adventureInventory)
    {
        $this->adventureInventory = $adventureInventory;
    }

    #[Route('/adventure', name: 'app_adventure')]
    public function index(): Response
    {
        return $this->render('adventure/index.html.twig', [
            'controller_name' => 'AdventureController',
        ]);
    }

    #[Route('/Adventure/add', name: 'adventure_add')]
    public function adventureAdd(): Response
    {
        $added = $this->adventureInventory->addNote();

        if (!$added) {
            return $this->redirectToRoute('project_secondroom');
        }

        $adventures = $this->adventureInventory->getAllAdventures();

        return $this->render('project/secondroom.html.twig', [
            'adventures' => $adventures,
        ]);
    }

    #[Route('/proj/clear', name: 'project_clear')]
    public function proj_clear(): Response
    {
        $this->adventureInventory->clearAdventures();
        $adventures = $this->adventureInventory->getAllAdventures();

        return $this->render('project/home.html.twig', [
            'adventures' => $adventures,
        ]);
    }

}
