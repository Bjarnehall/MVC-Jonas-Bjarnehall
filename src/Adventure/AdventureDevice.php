<?php

namespace App\Adventure;

class AdventureDevice
{
    public function encryptText(string $text): string
    {
        return str_rot13($text);
    }
}
