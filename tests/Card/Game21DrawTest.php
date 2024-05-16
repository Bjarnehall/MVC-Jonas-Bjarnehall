<?php

use App\Card\Game21Draw;
use App\Card\DeckOfCards;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Game21DrawTest extends TestCase
{
    public function testGetDeckFromSession(): void
    {
        $session = $this->createMock(SessionInterface::class);

        $deck = new DeckOfCards();

        $deckSerialized = serialize($deck);

        $game21Draw = new Game21Draw();

        $reflection = new \ReflectionClass($game21Draw);
        $method = $reflection->getMethod('getDeckFromSession');
        $method->setAccessible(true);

        $retrievedDeck = $method->invoke($game21Draw, $session, $deckSerialized);

        $this->assertInstanceOf(DeckOfCards::class, $retrievedDeck);
    }
}
