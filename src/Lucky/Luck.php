<?php

namespace App\Lucky;

use Symfony\Component\Filesystem\Filesystem;
use DateTime;

class Luck
{
    private DateTime $dateTime;
    /**
     * Constructor.
     *
     * @param DateTime|null $dateTime DateTime object representing the date and time.
     */
    public function __construct(?DateTime $dateTime = null)
    {
        $this->dateTime = $dateTime ?: new DateTime();
    }
    /**
     * Get the greeting based on the time of day.
     *
     * @return string The greeting message.
     */
    public function getGreeting(): string
    {
        $timeH = $this->getTimeHour();
        $greeting = "God kväll!";

        if ($timeH < 12) {
            $greeting = "God morgon!";
        } elseif ($timeH < 18) {
            $greeting = "God middag!";
        }

        return $greeting;
    }
    /**
     * Get the translated name of the current day of the week.
     *
     * @return string The translated day of the week.
     */
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

        $dayOfWeek = $this->getDayOfWeek();
        return $weekDayTranslation[$dayOfWeek];
    }
    /**
     * Get the quote for current day of the week.
     *
     * @return string The quote for today.
     */
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

        $dayOfWeek = $this->getDayOfWeek();
        return $wordOfDay[$dayOfWeek];
    }
    /**
     * Get the name of the current day of the week.
     *
     * @return string The name of the day of the week.
     */
    private function getDayOfWeek(): string
    {
        return $this->dateTime->format('l');
    }
    /**
     * Get the current hour of the day.
     *
     * @return int The hour of the day (0-23).
     */
    private function getTimeHour(): int
    {
        return (int)$this->dateTime->format('G');
    }
}
