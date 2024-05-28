<?php

namespace App\Test\Controller\ProjectController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Adventure\AdventureInventory;
use App\Entity\Adventure;

class AdventureControllerTest extends WebTestCase
{

    public function testAdventureAddCdSecond(): void
    {
        $adventureInventoryMock = $this->createMock(AdventureInventory::class);
        $adventures = [new Adventure(), new Adventure()];
        $adventureInventoryMock->method('getAllAdventures')->willReturn($adventures);

        $client = static::createClient();
        $container = $client->getContainer();

        $container->set(AdventureInventory::class, $adventureInventoryMock);
        $client->request('GET', '/adventure/addcdSecond_two');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        foreach ($adventures as $adventure) {
            $notes = $adventure->getNotes();
            if ($notes !== null) {
                $this->assertStringContainsString($notes, $client->getResponse()->getContent());
            }
        }
    }

    public function testAdventureAddCdS(): void
    {
        $adventureInventoryMock = $this->createMock(AdventureInventory::class);
        $adventures = [new Adventure(), new Adventure()];
        $adventureInventoryMock->method('getAllAdventures')->willReturn($adventures);

        $client = static::createClient();
        $container = $client->getContainer();

        $container->set(AdventureInventory::class, $adventureInventoryMock);
        $client->request('GET', '/adventure/addcdSecond');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        foreach ($adventures as $adventure) {
            $notes = $adventure->getNotes();
            if ($notes !== null) {
                $this->assertStringContainsString($notes, $client->getResponse()->getContent());
            }
        }
    }

    public function testAdventureAddCd(): void
    {
        $adventureInventoryMock = $this->createMock(AdventureInventory::class);
        $adventures = [new Adventure(), new Adventure()];
        $adventureInventoryMock->method('getAllAdventures')->willReturn($adventures);

        $client = static::createClient();
        $container = $client->getContainer();

        $container->set(AdventureInventory::class, $adventureInventoryMock);
        $client->request('GET', '/adventure/addcd');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        foreach ($adventures as $adventure) {
            $notes = $adventure->getNotes();
            if ($notes !== null) {
                $this->assertStringContainsString($notes, $client->getResponse()->getContent());
            }
        }
    }

    public function testAdventureAdd(): void
    {
        $adventureInventoryMock = $this->createMock(AdventureInventory::class);
        $adventures = [new Adventure(), new Adventure()];
        $adventureInventoryMock->method('getAllAdventures')->willReturn($adventures);

        $client = static::createClient();
        $container = $client->getContainer();

        $container->set(AdventureInventory::class, $adventureInventoryMock);
        $client->request('GET', '/adventure/add');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        foreach ($adventures as $adventure) {
            $notes = $adventure->getNotes();
            if ($notes !== null) {
                $this->assertStringContainsString($notes, $client->getResponse()->getContent());
            }
        }
    }

    public function testAdventure(): void
    {
        $adventureInventoryMock = $this->createMock(AdventureInventory::class);
        $adventures = [new Adventure(), new Adventure()];
        $adventureInventoryMock->method('getAllAdventures')->willReturn($adventures);

        $client = static::createClient();
        $container = $client->getContainer();

        $container->set(AdventureInventory::class, $adventureInventoryMock);
        $client->request('GET', '/adventure');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        foreach ($adventures as $adventure) {
            $notes = $adventure->getNotes();
            if ($notes !== null) {
                $this->assertStringContainsString($notes, $client->getResponse()->getContent());
            }
        }
    }
}