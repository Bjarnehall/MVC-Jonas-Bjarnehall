<?php

namespace App\Adventure;

class AdventureMechanics
{
    private string $correctPassword = 'mumintrollet';

    public function checkPassword(string $password): bool
    {
        return $password === $this->correctPassword;
    }
}
