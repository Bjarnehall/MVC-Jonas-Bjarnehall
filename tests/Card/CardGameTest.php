<?php

namespace App\Tests\Controller\CardGame;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Controller\CardGame;
use App\Card\DeckTask;
use Symfony\Component\HttpFoundation\JsonResponse;

class CardGameTest extends TestCase
{
    public function testApiDeckReturnsJsonResponse(): void
    {
        $deckTaskMock = $this->createMock(DeckTask::class);
        $cardGame = new CardGame($deckTaskMock);
        $response = $cardGame->apiDeck();
        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}
