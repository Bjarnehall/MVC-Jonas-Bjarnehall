<?php

namespace App\Controller;

use App\Adventure\AdventureInventory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdventureController extends AbstractController
{
    private AdventureInventory $adventureInventory;

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
    /**
     * Pick up a clue for Adventure.
     */
    #[Route('/adventure/add', name: 'adventure_add')]
    public function adventureAdd(): Response
    {
        $codes = 22456789;
        $keys = 101;
        if ($this->adventureInventory->adventureExists($codes, $keys)) {
            return $this->redirectToRoute('project_secondroom');
        }
        $added = $this->adventureInventory->addNote();
        if ($added) {
            $adventures = $this->adventureInventory->getAllAdventures();
            return $this->render('project/secondroom.html.twig', [
                'adventures' => $adventures,
            ]);
        } else {
            return $this->redirectToRoute('project_secondroom');
        }
    }
    /**
     * Clears the clues for Adventure.
     */
    #[Route('/adventure/clear', name: 'project_clear')]
    public function proj_clear(): Response
    {
        $this->adventureInventory->clearAdventures();
        $adventures = $this->adventureInventory->getAllAdventures();

        return $this->render('project/home.html.twig', [
            'adventures' => $adventures,
        ]);
    }

}
