<?php

namespace App\Controller;

use App\Adventure\AdventureMechanics;
use App\Adventure\AdventureInventory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Adventure;
use App\Adventure\AdventureGrades;
use App\Entity\Grades;

class ProjectController extends AbstractController
{
    private AdventureMechanics $adventureMechanics;
    private AdventureInventory $adventureInventory;

    public function __construct(
        AdventureMechanics $adventureMechanics,
        AdventureInventory $adventureInventory
    )
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
     * Game about database page
     */
    #[Route("/proj/about/database", name: "project_about_database")]
    public function proj_about_database(): Response
    {
        return $this->render('project/about_database.html.twig');
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
     * Game third room open cabin
     */
    #[Route("/proj/opencabin", name: "project_opencabin")]
    public function proj_open_cabin(): Response
    {
        $adventures = $this->adventureInventory->getAllAdventures();
        return $this->render('project/cabin.html.twig', [
            'adventures' => $adventures,
        ]);
    }
    /**
     * Game end page
     */
    #[Route("/proj/end", name: "project_end")]
    public function proj_end(EntityManagerInterface $entityManager, AdventureGrades $adventureGrades): Response
    {
        $adventureRepository = $entityManager->getRepository(Adventure::class);
        $adventure = $adventureRepository->findOneBy(['codes' => 'Reboot Server CD', 'keys' => 103]);

        if ($adventure) {
            $persons = [
                ['name' => 'Johan Andersson', 'course' => 'DATABASE', 'grade' => 'MVG'],
                ['name' => 'Anita Karlsson', 'course' => 'DATABASE', 'grade' => 'VG'],
                ['name' => 'Sture Snesteg', 'course' => 'DATABASE', 'grade' => 'IG'],
            ];

            $adventureGrades->addGrades($persons);
            $gradesData = $adventureGrades->getGradesData();

            return $this->render('project/end.html.twig', [
                'grades' => $gradesData,
            ]);
        } else {
            $this->addFlash('error', 'Reboot Server CD not found.');
            return $this->redirectToRoute('project_server_final');
        }
    }

    #[Route("/proj/end_two", name: "project_end_two")]
    public function proj_end_two(EntityManagerInterface $entityManager, AdventureGrades $adventureGrades): Response
    {
        $adventureRepository = $entityManager->getRepository(Adventure::class);
        $adventure = $adventureRepository->findOneBy(['codes' => 'Reboot Server CD', 'keys' => 103]);

        if ($adventure) {
            $persons = [
                ['name' => 'Johan Andersson', 'course' => 'DATABASE', 'grade' => 'MVG'],
                ['name' => 'Anita Karlsson', 'course' => 'DATABASE', 'grade' => 'VG'],
                ['name' => 'Sture Snesteg', 'course' => 'DATABASE', 'grade' => 'IG'],
            ];

            $adventureGrades->addGrades($persons);
            $gradesData = $adventureGrades->getGradesData();

            return $this->render('project/end_two.html.twig', [
                'grades' => $gradesData,
            ]);
        } else {
            $this->addFlash('error', 'Reboot Server CD not found.');
            return $this->redirectToRoute('project_server_final');
        }
    }

    #[Route("/proj/server/passed", name: "project_server_passed")]
    public function proj_server_passed(): Response
    {
        $adventures = $this->adventureInventory->getAllAdventures();
        return $this->render('project/server.html.twig', [
            'adventures' => $adventures,
        ]);
    }

    #[Route("/proj/server/dialog_one", name: "project_server_dialog_one")]
    public function proj_server_dialog_one(): Response
    {
        $adventures = $this->adventureInventory->getAllAdventures();
        return $this->render('project/serverdialog.html.twig', [
            'adventures' => $adventures,
        ]);
    }

    #[Route("/proj/server/dialog_two", name: "project_server_dialog_two")]
    public function proj_server_dialog_two(): Response
    {
        $adventures = $this->adventureInventory->getAllAdventures();
        return $this->render('project/serverdialog_two.html.twig', [
            'adventures' => $adventures,
        ]);
    }

    #[Route("/proj/server/final_two", name: "project_server_final_two")]
    public function proj_server_final_two(): Response
    {
        $adventures = $this->adventureInventory->getAllAdventures();
        return $this->render('project/serverfinal_two.html.twig', [
            'adventures' => $adventures,
        ]);
    }

    #[Route("/proj/server/final", name: "project_server_final")]
    public function proj_server_final(): Response
    {
        $adventures = $this->adventureInventory->getAllAdventures();
        return $this->render('project/serverfinal.html.twig', [
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
    /**
     * Route for device
     */
    // #[Route("/proj/device", name: "project_device")]
    // public function proj_device(Request $request): Response
    // {
    //     if ($request->getMethod() === 'POST') {
    //         $inputString = $request->request->get('inputString');

    //         if ($inputString !== null && $inputString !== '') {

    //             $success = $this->adventureInventory->saveRot13String($inputString);

    //             if ($success) {
    //                 return $this->redirectToRoute('project_opencabin');
    //             }
    //         }
    //     }
    //     $adventures = $this->adventureInventory->getAllAdventures();
    //     return $this->render('project/cabin_device.html.twig', [
    //         'adventures' => $adventures,
    //     ]);
    // }


    #[Route("/proj/device", name: "project_device")]
    public function proj_device(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            $success = $this->adventureMechanics->handleInputString($request);

            if ($success) {
                return $this->redirectToRoute('project_opencabin');
            }
        }

        $adventures = $this->adventureInventory->getAllAdventures();
        return $this->render('project/cabin_device.html.twig', [
            'adventures' => $adventures,
        ]);
    }
}
