<?php

namespace App\Dice;

class Dice
{
    /**
     * The value of the dice roll.
     *
     * @var int
     */
    protected ?int $value = null;

    public function __construct()
    {
        $this->value = null;
    }

    public function roll(): int
    {
        $this->value = random_int(1, 6);
        return $this->value;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function getAsString(): string
    {
        return "[{$this->value}]";
    }
}
