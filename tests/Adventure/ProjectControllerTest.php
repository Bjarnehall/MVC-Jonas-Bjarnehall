<?php

namespace App\Test\Controller\ProjectController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Adventure\AdventureInventory;
use App\Entity\Adventure;

class ProjectControllerTest extends WebTestCase
{
    /**
     * Test home page
     */
    public function testProjHome(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('.buttonStart a', 'PLAY GAME');
    }
    /**
    * Test about database
    */
    public function testProjAboutDatabase(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj/about/database');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('title', 'About database');
    }
    /**
     * Test about page
     */
    public function testProjAbout(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj/about');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('.about h2', 'Projekt examination MVC');
    }
    /**
     * Test game start page
     */
    public function testProjStart(): void
    {
        $adventureInventoryMock = $this->createMock(AdventureInventory::class);
        $adventures = [new Adventure(), new Adventure()];
        $adventureInventoryMock->method('getAllAdventures')->willReturn($adventures);

        $client = static::createClient();
        $container = $client->getContainer();
        $container->set(AdventureInventory::class, $adventureInventoryMock);

        $client->request('GET', '/proj/start');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        foreach ($adventures as $adventure) {
            $notes = $adventure->getNotes();
            if ($notes !== null) {
                $this->assertStringContainsString($notes, $client->getResponse()->getContent());
            }
        }
    }
    /**
     * Test room in game
     */
    public function testProjSecondRoom(): void
    {
        $adventureInventoryMock = $this->createMock(AdventureInventory::class);
        $adventures = [new Adventure(), new Adventure()];
        $adventureInventoryMock->method('getAllAdventures')->willReturn($adventures);

        $client = static::createClient();
        $container = $client->getContainer();
        $container->set(AdventureInventory::class, $adventureInventoryMock);

        $client->request('GET', '/proj/secondroom');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        foreach ($adventures as $adventure) {
            $notes = $adventure->getNotes();
            if ($notes !== null) {
                $this->assertStringContainsString($notes, $client->getResponse()->getContent());
            }
        }
    }
    /**
     * Test room in game
     */
    public function testProjThirdRoom(): void
    {
        $adventureInventoryMock = $this->createMock(AdventureInventory::class);
        $adventures = [new Adventure(), new Adventure()];
        $adventureInventoryMock->method('getAllAdventures')->willReturn($adventures);

        $client = static::createClient();
        $container = $client->getContainer();
        $container->set(AdventureInventory::class, $adventureInventoryMock);

        $client->request('GET', '/proj/thirdroom');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        foreach ($adventures as $adventure) {
            $notes = $adventure->getNotes();
            if ($notes !== null) {
                $this->assertStringContainsString($notes, $client->getResponse()->getContent());
            }
        }
    }
    /**
     * Test room in game
     */
    public function testProjOpenCabin(): void
    {
        $adventureInventoryMock = $this->createMock(AdventureInventory::class);
        $adventures = [new Adventure(), new Adventure()];
        $adventureInventoryMock->method('getAllAdventures')->willReturn($adventures);

        $client = static::createClient();
        $container = $client->getContainer();

        $container->set(AdventureInventory::class, $adventureInventoryMock);
        $client->request('GET', '/proj/opencabin');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        foreach ($adventures as $adventure) {
            $notes = $adventure->getNotes();
            if ($notes !== null) {
                $this->assertStringContainsString($notes, $client->getResponse()->getContent());
            }
        }
    }
    /**
     * Test room in game
     */
    public function testProjServerPassed(): void
    {
        $adventureInventoryMock = $this->createMock(AdventureInventory::class);
        $adventures = [new Adventure(), new Adventure()];
        $adventureInventoryMock->method('getAllAdventures')->willReturn($adventures);

        $client = static::createClient();
        $container = $client->getContainer();

        $container->set(AdventureInventory::class, $adventureInventoryMock);
        $client->request('GET', '/proj/server/passed');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        foreach ($adventures as $adventure) {
            $notes = $adventure->getNotes();
            if ($notes !== null) {
                $this->assertStringContainsString($notes, $client->getResponse()->getContent());
            }
        }
    }

    public function testProjServerDialogOne(): void
    {
        $adventureInventoryMock = $this->createMock(AdventureInventory::class);
        $adventures = [new Adventure(), new Adventure()];
        $adventureInventoryMock->method('getAllAdventures')->willReturn($adventures);

        $client = static::createClient();
        $container = $client->getContainer();

        $container->set(AdventureInventory::class, $adventureInventoryMock);
        $client->request('GET', '/proj/server/dialog_one');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        foreach ($adventures as $adventure) {
            $notes = $adventure->getNotes();
            if ($notes !== null) {
                $this->assertStringContainsString($notes, $client->getResponse()->getContent());
            }
        }
    }

    public function testProjServerDialogTwo(): void
    {
        $adventureInventoryMock = $this->createMock(AdventureInventory::class);
        $adventures = [new Adventure(), new Adventure()];
        $adventureInventoryMock->method('getAllAdventures')->willReturn($adventures);

        $client = static::createClient();
        $container = $client->getContainer();

        $container->set(AdventureInventory::class, $adventureInventoryMock);
        $client->request('GET', '/proj/server/dialog_two');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        foreach ($adventures as $adventure) {
            $notes = $adventure->getNotes();
            if ($notes !== null) {
                $this->assertStringContainsString($notes, $client->getResponse()->getContent());
            }
        }
    }

    public function testProjServerFinalTwo(): void
    {
        $adventureInventoryMock = $this->createMock(AdventureInventory::class);
        $adventures = [new Adventure(), new Adventure()];
        $adventureInventoryMock->method('getAllAdventures')->willReturn($adventures);

        $client = static::createClient();
        $container = $client->getContainer();

        $container->set(AdventureInventory::class, $adventureInventoryMock);
        $client->request('GET', '/proj/server/final_two');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        foreach ($adventures as $adventure) {
            $notes = $adventure->getNotes();
            if ($notes !== null) {
                $this->assertStringContainsString($notes, $client->getResponse()->getContent());
            }
        }
    }

    public function testProjServerFinal(): void
    {
        $adventureInventoryMock = $this->createMock(AdventureInventory::class);
        $adventures = [new Adventure(), new Adventure()];
        $adventureInventoryMock->method('getAllAdventures')->willReturn($adventures);

        $client = static::createClient();
        $container = $client->getContainer();

        $container->set(AdventureInventory::class, $adventureInventoryMock);
        $client->request('GET', '/proj/server/final');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        foreach ($adventures as $adventure) {
            $notes = $adventure->getNotes();
            if ($notes !== null) {
                $this->assertStringContainsString($notes, $client->getResponse()->getContent());
            }
        }
    }
}
