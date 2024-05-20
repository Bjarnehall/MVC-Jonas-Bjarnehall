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
    /**
     * Helper method to create an instance of the CardGame controller.
     *
     * @return CardGame An instance of the CardGame controller.
     */
    private function createCardGameController(): CardGame
    {
        $deckTaskMock = $this->createMock(DeckTask::class);
        return new CardGame($deckTaskMock);
    }
    /**
     * Test case to verify that the apiDeck method returns a JsonResponse.
     */
    public function testApiDeckReturnsJsonResponse(): void
    {
        $cardGame = $this->createCardGameController();
        $response = $cardGame->apiDeck();

        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}
