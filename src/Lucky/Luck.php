<?php

namespace App\Lucky;

use Symfony\Component\Filesystem\Filesystem;
use DateTime;

class Luck
{
    private DateTime $dateTime;

    public function __construct(?DateTime $dateTime = null)
    {
        $this->dateTime = $dateTime ?: new DateTime();
    }

    public function getGreeting(): string
    {
        $timeH = $this->dateTime->format('G');
        // $timeH = date("G");
        $greeting = "God kväll!";

        if ($timeH < 12) {
            $greeting = "God morgon!";
        } elseif ($timeH < 18) {
            $greeting = "God middag!";
        }

        return $greeting;
    }

    public function getTranslatedDayOfWeek(): string
    {
        $weekDayTranslation = [
            'Monday' => 'måndag',
            'Tuesday' => 'tisdag',
            'Wednesday' => 'onsdag',
            'Thursday' => 'torsdag',
            'Friday' => 'fredag',
            'Saturday' => 'lördag',
            'Sunday' => 'söndag',
        ];

        $dayOfWeek = date('l');
        return $weekDayTranslation[$dayOfWeek];
    }

    public function getWordForToday(): string
    {
        $wordOfDay = [
            'Monday' => 'Illidan Stormrage: “Imprisoned for ten thousand years. Banished from my own homeland. And now, you dare enter my realm. You are not prepared!”',
            'Tuesday' => 'Sylvanas Windrunner: “We are the Forsaken. We will slaughter anyone who stands in our way.”',
            'Wednesday' => 'Jaina Proudmoore: “Theres always hope.”',
            'Thursday' => 'Lady Vashj: “I did not make it this far to be stopped! The future I have planned will not be jeopardized!”',
            'Friday' => 'Anduin Wrynn: "I only hope my friends will remember me as I was. Not what you made me to be."',
            'Saturday' => 'Uther Lightbringer: "We cannot change the past, and we may never find forgiveness in the future, but inaction damns us all."',
            'Sunday' => 'Anduin Wrynn: "No one, not even a king, is more important than the Alliance."',
        ];

        $dayOfWeek = date('l');
        return $wordOfDay[$dayOfWeek];
    }
}
