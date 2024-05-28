<?php

namespace App\Tests\Adventure\AdventureMechanics;

use PHPUnit\Framework\TestCase;
use App\Adventure\AdventureMechanics;
use App\Adventure\AdventureInventory;

/**
 * Test for the AdventureMechanics.
 */
class AdventureMechanicsTest extends TestCase
{
    /**
     * Test checkPassword
     */
    public function testCheckPasswordWithCorrectPassword(): void
    {
        $adventureInventory = $this->createMock(AdventureInventory::class);
        $adventureMechanics = new AdventureMechanics($adventureInventory);

        $this->assertTrue($adventureMechanics->checkPassword('mumintrollet'));
    }

    /**
     * Test checkPassword incorrect password
     */
    public function testCheckPasswordWithIncorrectPassword(): void
    {
        $adventureInventory = $this->createMock(AdventureInventory::class);
        $adventureMechanics = new AdventureMechanics($adventureInventory);

        $this->assertFalse($adventureMechanics->checkPassword('wrongpassword'));
    }
}