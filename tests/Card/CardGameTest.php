<?php

namespace App\Tests\Controller\CardGame;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Controller\CardGame;
use App\Card\DeckTask;
use App\Card\DeckOfCards;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Card\Card;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CardGameTest extends WebTestCase
{
    public function testApiDeckReturnsJsonResponse(): void
    {
        $deckTaskMock = $this->createMock(DeckTask::class);
        $sessionMock = $this->createMock(SessionInterface::class);
        $cardGame = new CardGame($deckTaskMock);
        $response = $cardGame->apiDeck();
        $this->assertInstanceOf(JsonResponse::class, $response);
    }
    public function testCardsRoute(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'MVC Blekinge tekniska högskola');
    }
}
