<?php

namespace App\Controller;

use App\Lucky\Luck;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;

class Lucky extends AbstractController
{
    #[Route("/lucky", name: "lucky")]
    public function lucky(): Response
    {
        $luck = new Luck();
        $greeting = $luck->getGreeting();
        $dayOfWeekSwe = $luck->getTranslatedDayOfWeek();
        $wordForToday = $luck->getWordForToday();

        $filesystem = new Filesystem();
        $imagePath = $this->getParameter('kernel.project_dir') . '/public/img/';
        $petImages = ['pet1.jpg', 'pet2.jpg', 'pet3.jpg'];

        $availablePetImages = array_filter($petImages, function ($image) use ($filesystem, $imagePath) {
            return $filesystem->exists($imagePath . $image);
        });

        $randomPetImage = 'pet3.jpg';

        if (count($availablePetImages) > 0) {
            $randomPetImage = $availablePetImages[array_rand($availablePetImages)];
        }

        return $this->render('lucky.html.twig', [
            'greeting' => $greeting,
            'dayOfWeekSwe' => $dayOfWeekSwe,
            'wordForToday' => $wordForToday,
            'petImage' => $randomPetImage,
        ]);
    }
}
