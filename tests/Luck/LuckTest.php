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

    public function testGetTranslatedDayOfWeek(): void
    {
        $luck = new Luck();
        $expectedTranslations = [
              'Monday' => 'måndag',
              'Tuesday' => 'tisdag',
              'Wednesday' => 'onsdag',
              'Thursday' => 'torsdag',
              'Friday' => 'fredag',
              'Saturday' => 'lördag',
              'Sunday' => 'söndag',
        ];

        $currentDayOfWeek = date('l');
        $expectedTranslation = $expectedTranslations[$currentDayOfWeek];

        $this->assertEquals($expectedTranslation, $luck->getTranslatedDayOfWeek());
    }

    public function testGetWordForToday(): void
    {
        $luck = new Luck();

        $expectedWords = [
            'Monday' => 'Illidan Stormrage: “Imprisoned for ten thousand years. Banished from my own homeland. And now, you dare enter my realm. You are not prepared!”',
            'Tuesday' => 'Sylvanas Windrunner: “We are the Forsaken. We will slaughter anyone who stands in our way.”',
            'Wednesday' => 'Jaina Proudmoore: “Theres always hope.”',
            'Thursday' => 'Lady Vashj: “I did not make it this far to be stopped! The future I have planned will not be jeopardized!”',
            'Friday' => 'Anduin Wrynn: "I only hope my friends will remember me as I was. Not what you made me to be."',
            'Saturday' => 'Uther Lightbringer: "We cannot change the past, and we may never find forgiveness in the future, but inaction damns us all."',
            'Sunday' => 'Anduin Wrynn: "No one, not even a king, is more important than the Alliance."',
        ];

        $currentDayOfWeek = date('l');
        $expectedWord = $expectedWords[$currentDayOfWeek];

        $this->assertEquals($expectedWord, $luck->getWordForToday());
    }
}
