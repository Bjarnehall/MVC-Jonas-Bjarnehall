<?php

namespace App\Tests\Adventure\AdventureMechanics;

use PHPUnit\Framework\TestCase;
use App\Adventure\AdventureMechanics;
use App\Adventure\AdventureInventory;

/**
 * Test for the AdventureMechanics.
 */
// class AdventureMechanicsTest extends TestCase
// {
//     /**
//      * Test the checkPassword method with correct password.
//      */
//     public function testCheckPasswordWithCorrectPassword(): void
//     {
//         $adventureMechanics = new AdventureMechanics();
//         $this->assertTrue($adventureMechanics->checkPassword('mumintrollet'));
//     }
//     /**
//      * Test the checkPassword method with incorrect password.
//      */
//     public function testCheckPasswordWithIncorrectPassword(): void
//     {
//         $adventureMechanics = new AdventureMechanics();
//         $this->assertFalse($adventureMechanics->checkPassword('wrongpassword'));
//     }
// }
class AdventureMechanicsTest extends TestCase
{
    /**
     * Test the checkPassword method with correct password.
     */
    public function testCheckPasswordWithCorrectPassword(): void
    {
        // Mock AdventureInventory dependency
        $adventureInventory = $this->createMock(AdventureInventory::class);

        // Instantiate AdventureMechanics with the mocked dependency
        $adventureMechanics = new AdventureMechanics($adventureInventory);

        // Assert
        $this->assertTrue($adventureMechanics->checkPassword('mumintrollet'));
    }

    /**
     * Test the checkPassword method with incorrect password.
     */
    public function testCheckPasswordWithIncorrectPassword(): void
    {
        // Mock AdventureInventory dependency
        $adventureInventory = $this->createMock(AdventureInventory::class);

        // Instantiate AdventureMechanics with the mocked dependency
        $adventureMechanics = new AdventureMechanics($adventureInventory);

        // Assert
        $this->assertFalse($adventureMechanics->checkPassword('wrongpassword'));
    }
}