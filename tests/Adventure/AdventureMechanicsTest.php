<?php

namespace App\Tests\Adventure\AdventureMechanics;

use PHPUnit\Framework\TestCase;
use App\Adventure\AdventureMechanics;

/**
 * Test for the AdventureMechanics.
 */
class AdventureMechanicsTest extends TestCase
{
    /**
     * Test the checkPassword method with correct password.
     */
    public function testCheckPasswordWithCorrectPassword(): void
    {
        $adventureMechanics = new AdventureMechanics();
        $this->assertTrue($adventureMechanics->checkPassword('22456789'));
    }
    /**
     * Test the checkPassword method with incorrect password.
     */
    public function testCheckPasswordWithIncorrectPassword(): void
    {
        $adventureMechanics = new AdventureMechanics();
        $this->assertFalse($adventureMechanics->checkPassword('wrongpassword'));
    }
}
