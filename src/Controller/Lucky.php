<?php

namespace App\Controller;

use App\Lucky\Luck;
use App\Lucky\RandomPetImageSelector;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;

class Lucky extends AbstractController
{
    private RandomPetImageSelector $randomPetImageSelector;

    public function __construct(RandomPetImageSelector $randomPetImageSelector)
    {
        $this->randomPetImageSelector = $randomPetImageSelector;
    }
    #[Route("/lucky", name: "lucky")]
    public function lucky(): Response
    {
        $luck = new Luck();
        $greeting = $luck->getGreeting();
        $dayOfWeekSwe = $luck->getTranslatedDayOfWeek();
        $wordForToday = $luck->getWordForToday();

        $randomPetImage = $this->randomPetImageSelector->getRandomPetImage();

        return $this->render('lucky.html.twig', [
            'greeting' => $greeting,
            'dayOfWeekSwe' => $dayOfWeekSwe,
            'wordForToday' => $wordForToday,
            'petImage' => $randomPetImage,
        ]);
    }
}
