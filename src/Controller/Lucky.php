<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;

class Lucky extends AbstractController
{
    #[Route("/lucky", name: "lucky")]
    public function lucky(): Response
    {
        $timeH = date("G");
        $greeting = "God kväll!";

        if ($timeH < 12) {
            $greeting = "God morgon!";
        } elseif ($timeH < 18) {
            $greeting = "God middag!";
        }

        $weekDayTranslation = [
            'Monday' => 'måndag',
            'Tuesday' => 'tisdag',
            'Wednesday' => 'onsdag',
            'Thursday' => 'torsdag',
            'Friday' => 'fredag',
            'Saturday' => 'lördag',
            'Sunday' => 'söndag',
        ];

        $wordOfDay = [
            'Monday' => 'Illidan Stormrage: “Imprisoned for ten thousand years. Banished from my own homeland. And now, you dare enter my realm. You are not prepared!”',
            'Tuesday' => 'Sylvanas Windrunner: “We are the Forsaken. We will slaughter anyone who stands in our way.”',
            'Wednesday' => 'Jaina Proudmoore: “Theres always hope.”',
            'Thursday' => 'Lady Vashj: “I did not make it this far to be stopped! The future I have planned will not be jeopardized!”',
            'Friday' => 'Anduin Wrynn: "I only hope my friends will remember me as I was. Not what you made me to be."',
            'Saturday' => 'Uther Lightbringer: "We cannot change the past, and we may never find forgiveness in the future, but inaction damns us all."',
            'Sunday' => 'Anduin Wrynn: "No one, not even a king, is more important than the Alliance."',
        ];

        $dayOfWeek = date('l');
        $dayOfWeekSwe = $weekDayTranslation[$dayOfWeek];
        $wordForToday = $wordOfDay[$dayOfWeek];

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
