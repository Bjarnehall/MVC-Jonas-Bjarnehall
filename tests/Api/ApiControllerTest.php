<?php

namespace App\Tests\Controller\Api;

use App\Controller\Api;
use PHPUnit\Framework\TestCase;

class ApiControllerTest extends TestCase
{
    public function testDailyQuote(): void
    {
        $controller = new Api();

        $response = $controller->dailyQuote();

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);

        $responseData = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('quote', $responseData);
        $this->assertArrayHasKey('date', $responseData);
        $this->assertArrayHasKey('timestamp', $responseData);

        $this->assertMatchesRegularExpression('/^\d{4}-\d{2}-\d{2}$/', $responseData['date']);

        $this->assertMatchesRegularExpression('/^\d{2}:\d{2}:\d{2}$/', $responseData['timestamp']);
    }
}
