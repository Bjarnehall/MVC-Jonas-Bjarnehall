<?php

namespace App\Tests\Adventure\AdventureDevice;

use App\Adventure\AdventureDevice;
use PHPUnit\Framework\TestCase;

class AdventureDeviceTest extends TestCase
{
    public function testEncryptText(): void
    {
        $adventureDevice = new AdventureDevice();

        $input = "HelloWorld";
        $expectedOutput = "UryybJbeyq";

        $this->assertSame($expectedOutput, $adventureDevice->encryptText($input));
    }
}