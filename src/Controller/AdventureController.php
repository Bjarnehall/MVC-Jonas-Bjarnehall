<?php

namespace App\Controller;

use App\Adventure\AdventureInventory;
use App\Adventure\AdventureGrades;
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
        $codes = "zhzvagebyyrg";
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
     * Pick up a CD for Adventure.
     */
    #[Route('/adventure/addcd', name: 'adventure_add_cd')]
    public function adventureAddCd(): Response
    {
        $codes = "Reboot Server CD";
        $keys = 103;
        if ($this->adventureInventory->adventureExists($codes, $keys)) {
            return $this->redirectToRoute('project_server_passed');
        }
        $added = $this->adventureInventory->addCd();
        if ($added) {
            $adventures = $this->adventureInventory->getAllAdventures();
            return $this->render('project/server.html.twig', [
                'adventures' => $adventures,
            ]);
        } else {
            return $this->redirectToRoute('project_server_passed');
        }
    }
    /**
     * Pick up a CD for Adventure.
     */
    #[Route('/adventure/addcdSecond', name: 'adventure_add_cdSecond')]
    public function adventureAddCdSecond(): Response
    {
        $codes = "Reboot Server CD";
        $keys = 103;
        if ($this->adventureInventory->adventureExists($codes, $keys)) {
            return $this->redirectToRoute('project_server_dialog_one');
        }
        $added = $this->adventureInventory->addCd();
        if ($added) {
            $adventures = $this->adventureInventory->getAllAdventures();
            return $this->render('project/serverdialog.html.twig', [
                'adventures' => $adventures,
            ]);
        } else {
            return $this->redirectToRoute('project_server_dialog_one');
        }
    }
    /**
     * Pick up a CD for Adventure alternative path.
     */
    #[Route('/adventure/addcdSecond_two', name: 'adventure_add_cdSecond_two')]
    public function adventureAddCdSecond_two(): Response
    {
        $codes = "Reboot Server CD";
        $keys = 103;
        if ($this->adventureInventory->adventureExists($codes, $keys)) {
            return $this->redirectToRoute('project_server_dialog_two');
        }
        $added = $this->adventureInventory->addCd();
        if ($added) {
            $adventures = $this->adventureInventory->getAllAdventures();
            return $this->render('project/serverdialog_two.html.twig', [
                'adventures' => $adventures,
            ]);
        } else {
            return $this->redirectToRoute('project_server_dialog_two');
        }
    }
    /**
     * Clears the clues for Adventure.
     */
    #[Route('/adventure/clear', name: 'project_clear')]
    public function proj_clear(AdventureGrades $adventureGrades): Response
    {
        $adventureGrades->deleteAllGrades();
        $this->adventureInventory->clearAdventures();

        $adventures = $this->adventureInventory->getAllAdventures();

        return $this->render('project/home.html.twig', [
            'adventures' => $adventures,
        ]);
    }

}
