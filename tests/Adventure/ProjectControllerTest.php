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

}