<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use DateTime;
use DateTimeZone;

class Api extends AbstractController
{
    #[Route('/api', name: 'api_overview')]
    public function apiOverview(): Response
    {
        return $this->render('api/routes.html.twig');
    }

    #[Route('/api/quote', name: 'api_quote')]
    public function dailyQuote(): Response
    {
        $quotes = [
            "Åh lakrits båtar! Få man ta.",
            "Vad är det för fel på den du har? Den är slut!",
            "Utan snus i två dagar försmäktar vi på denna ö."
        ];

        $quote = $quotes[array_rand($quotes)];

        $date = new DateTime('now', new DateTimeZone('Europe/Stockholm'));

        $responseData = [
            'quote' => $quote,
            'date' => $date->format('Y-m-d'),
            'timestamp' => $date->format('H:i:s'),
        ];

        return new JsonResponse($responseData);
    }
}
