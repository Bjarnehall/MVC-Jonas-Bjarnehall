<?php

namespace App\Card;

use App\Card\Card;

use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    /**
     * Test the constructor, getSuit and getValue
     */
    public function testConstructor(): void
    {
        $card = new Card('Hearts', 'King');

        $this->assertEquals('Hearts', $card->getSuit());
        $this->assertEquals('King', $card->getValue());
    }
    /**
     * Test graphical representation
     */
    public function testgetGrapichalRepresentation(): void
    {
        $card = new Card('Hearts', '13');
        $result = $card->getGraphicalRepresentation();

        $expectedHtml = '<span class="card-value">K</span><span class="card-suit hearts">♥</span>';

        $this->assertEquals($expectedHtml, $result);
    }
}
