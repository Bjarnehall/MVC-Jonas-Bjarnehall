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

        $this->assertSelectorTextContains('body', 'project/home.html.twig');
    }
}