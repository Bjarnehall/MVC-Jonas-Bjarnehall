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


class CardGameTest extends TestCase
{
        public function testApiDeckReturnsJsonResponse(): void
    {
        $deckTaskMock = $this->createMock(DeckTask::class);
        $sessionMock = $this->createMock(SessionInterface::class);

        $cardGame = new CardGame($deckTaskMock, $sessionMock);
        $response = $cardGame->apiDeck();
        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}
