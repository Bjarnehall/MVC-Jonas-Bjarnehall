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

public function testProjStart()
{
    // Create a mock for the AdventureInventory class
    $adventureInventoryMock = $this->createMock(AdventureInventory::class);
    $adventures = [new Adventure(), new Adventure()]; // Sample adventures
    
    // Stub the getAllAdventures method to return sample adventures
    $adventureInventoryMock->method('getAllAdventures')->willReturn($adventures);
    
    // Get the client for making requests
    $client = static::createClient();
    
    // Retrieve the service container
    $container = $client->getContainer();
    
    // Set the mock instance of AdventureInventory into the container
    $container->set(AdventureInventory::class, $adventureInventoryMock);
    
    // Make a request to the controller action
    $client->request('GET', '/proj/start');
    
    // Assert the response status code is 200 (OK)
    $this->assertEquals(200, $client->getResponse()->getStatusCode());
    
    // Assert that the returned HTML contains expected content
    foreach ($adventures as $adventure) {
        $notes = $adventure->getNotes();
        if ($notes !== null) {
            $this->assertStringContainsString($notes, $client->getResponse()->getContent());
        }
    }

}
}