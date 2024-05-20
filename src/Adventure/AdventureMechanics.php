<?php

namespace App\Adventure;

class AdventureMechanics
{
    private $correctPassword = '22456789';

    public function checkPassword(string $password): bool
    {
        return $password === $this->correctPassword;
    }
}
