<?php

namespace App\Card;

use App\Card\Card;
use App\Card\DeckOfCards;
use App\Card\CardHand;
use Symfony\Component\HttpFoundation\Session\SessionInterface; 
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
/**
 * Class GameTest
 * 
 * This class contains tests for the Game class.
 */
{
    /**
     * Test the initialization of a game instance.
     */
    public function testInitializeGame(): void
    {
        $sessionMock = $this->createMock(SessionInterface::class);

        $sessionMock->expects($this->exactly(3))
                    ->method('set')
                    ->withConsecutive(
                        [$this->equalTo('shuffledDeck'), $this->isType('string')],
                        [$this->equalTo('player'), $this->isType('string')],
                        [$this->equalTo('bank'), $this->isType('string')]
                    );

        $game = new Game($sessionMock);
        $game->initializeGame();
    }
}