<?php

namespace App\Adventure;

use App\Adventure\AdventureInventory;
use Symfony\Component\HttpFoundation\Request;

class AdventureMechanics
{
    private string $correctPassword = 'mumintrollet';
    private AdventureInventory $adventureInventory;
    /**
     * Construktor
     */
    public function __construct(AdventureInventory $adventureInventory)
    {
        $this->adventureInventory = $adventureInventory;
    }
    /**
     * Device mechanics for input string
     */
    public function handleInputString(Request $request): bool
    {
        $inputString = $request->request->get('inputString');

        if ($inputString !== null && $inputString !== '') {
            return $this->adventureInventory->saveRot13String($inputString);
        }

        return false;
    }
    /**
     * Function for checking password
     */
    public function checkPassword(string $password): bool
    {
        return $password === $this->correctPassword;
    }
}
