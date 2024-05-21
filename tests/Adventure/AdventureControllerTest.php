<?php

namespace App\Tests\Controller\AdventureController;

use App\Adventure\AdventureInventory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdventureControllerTest extends WebTestCase
{
    private $adventureInventoryMock;

    protected function setUp(): void
    {
        $this->adventureInventoryMock = $this->createMock(AdventureInventory::class);
    }
/**
 * Test for doctrine setup index
 */
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/adventure');
        $this->assertResponseIsSuccessful();

        $this->assertSelectorExists('.example-wrapper');
        $this->assertSelectorTextContains('.example-wrapper', 'This friendly message is coming from:');
    }
}