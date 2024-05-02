<?php

namespace App\Lucky;

use PHPUnit\Framework\TestCase;

use App\Lucky\Luck;
use DateTime;

class LuckTest extends TestCase
{


    public function testGetGreetingMorning(): void
    {
        $mockedTime = new DateTime("2024-01-01 08:00:00");
        $luck = new Luck($mockedTime);

        $greeting = $luck->getGreeting();

        $this->assertSame('God morgon!', $greeting);
    }

    public function testGetGreetingAfternoon(): void
    {
        $mockedTime = new DateTime("2024-01-01 14:00:00");
        $luck = new Luck($mockedTime);

        $greeting = $luck->getGreeting();

        $this->assertSame('God middag!', $greeting);
    }

    public function testGetGreetingEvening(): void
    {
        $mockedTime = new DateTime("2024-01-01 21:00:00");
        $luck = new Luck($mockedTime);

        $greeting = $luck->getGreeting();

        $this->assertSame('God kväll!', $greeting);
    }


    // private function setMockedTime(int $timestamp): void
    // {
    //     $dateTime = new DateTime();
    //     $dateTime->setTimestamp($timestamp);

    //     $stub = $this->getMockbuilder(DateTime::class)
    //                  ->getMock();
    //     $stub->method('getTimestamp')
    //          ->willReturn($dateTime->getTimestamp());
    // }

    // private function setNow(DateTime $dateTime): void
    // {
    //     $stub = $this->getMockBuilder(DateTime::class)
    //                  ->getMock();
    //     $stub->method('getTimestamp')
    //          ->willReturn($dateTime->getTimestamp());
    //     Luck::setNow($stub);
    // }

}