<?php

namespace App\Adventure;

class AdventureDevice
{
        public function encryptText($text)
    {
        // Apply Rot13 encryption to the text
        return str_rot13($text);
    }
}