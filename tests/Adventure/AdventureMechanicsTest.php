<?php

namespace App\Tests\Adventure\AdventureMechanics;

use PHPUnit\Framework\TestCase;
use App\Adventure\AdventureMechanics;
use App\Adventure\AdventureInventory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Test for the AdventureMechanics.
 */
class AdventureMechanicsTest extends TestCase
{
    /**
     * Test constructor
     */
    public function testConstructor(): void
    {
        $mockAdventureInventory = $this->createMock(AdventureInventory::class);
        $adventureMechanics = new AdventureMechanics($mockAdventureInventory);

        $reflection = new \ReflectionClass($adventureMechanics);
        $property = $reflection->getProperty('adventureInventory');
        $property->setAccessible(true);

        $this->assertSame($mockAdventureInventory, $property->getValue($adventureMechanics));
    }
    /**
     * Test checkPassword
     */
    public function testCheckCorrectPassword(): void
    {
        $adventureInventory = $this->createMock(AdventureInventory::class);
        $adventureMechanics = new AdventureMechanics($adventureInventory);

        $this->assertTrue($adventureMechanics->checkPassword('mumintrollet'));
    }

    /**
     * Test checkPassword incorrect password
     */
    public function testCheckIncorrectPassword(): void
    {
        $adventureInventory = $this->createMock(AdventureInventory::class);
        $adventureMechanics = new AdventureMechanics($adventureInventory);

        $this->assertFalse($adventureMechanics->checkPassword('ickemumintroll'));
    }
}