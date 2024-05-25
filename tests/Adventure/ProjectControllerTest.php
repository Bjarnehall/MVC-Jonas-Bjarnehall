<?php

namespace App\Test\Controller\ProjectController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Adventure\AdventureInventory;
use App\Entity\Adventure;

class ProjectControllerTest extends WebTestCase
{
    public function testProjHome(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('.buttonStart a', 'PLAY GAME');
    }

    public function testProjAbout(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj/about');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('.about h2', 'Projekt examination MVC');
    }

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

public function testProjEnd(): void
{
    // Get the client for making requests
    $client = static::createClient();
    
    // Get the EntityManager service
    $entityManager = $client->getContainer()->get('doctrine')->getManager();
    
    // Retrieve the AdventureRepository
    $adventureRepository = $entityManager->getRepository(Adventure::class);
    
    // Create a sample Adventure
    $sampleAdventure = new Adventure();
    $sampleAdventure->setCodes('Reboot Server CD');
    $sampleAdventure->setKeys(103);
    $entityManager->persist($sampleAdventure);
    $entityManager->flush();
    
    // Make a request to the controller action
    $client->request('GET', '/proj/end');
    
    // Check if the adventure is found
    $foundAdventure = $adventureRepository->findOneBy(['codes' => 'Reboot Server CD', 'keys' => 103]);
    
    // Assert the response
    if ($foundAdventure) {
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('.end-content');
    } else {
        $this->assertResponseRedirects('/proj/server_final');
        $crawler = $client->followRedirect();
        $this->assertSelectorTextContains('.alert.alert-danger', 'Reboot Server CD not found.');
    }
}

}