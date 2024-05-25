<?php

namespace App\Test\Controller\ProjectController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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

    // public function testProjectStart(): void
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/proj/start');

    //     $this->assertResponseIsSuccessful();
    //     $this->assertSelectorTextContains('.Hint h2', 'Hint');
    //     $this->assertSelectorTextContains('.Hint p', 'Hover over the character In the hat!');
    // }
    public function testProjectStart(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj/start');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('.gameBoxHome');
        $this->assertSelectorExists('.buttonServerEnter a[href="/proj/server"]');
        $this->assertSelectorExists('.buttonRedDoor a[href="/proj/secondroom"]');
        $this->assertSelectorExists('.clueQuoteOne p');
        $this->assertSelectorExists('.Hint h2');
        $this->assertSelectorExists('.Hint p');
        $this->assertSelectorExists('.inventory h3');
        $this->assertSelectorTextContains('.inventory li', 'Seems empty');
    }
}