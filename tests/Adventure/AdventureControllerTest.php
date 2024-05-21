<?php

namespace App\Tests\Controller\AdventureController;

use App\Adventure\AdventureInventory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdventureControllerTest extends WebTestCase
{
/**
 * Test for doctrine setup index
 */
    public function testTitle(): void
    {
        $client = static::createClient();
        $client->request('GET', '/adventure');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('title');
        $this->assertSelectorTextContains('title', 'Hello AdventureController!');
    }
}