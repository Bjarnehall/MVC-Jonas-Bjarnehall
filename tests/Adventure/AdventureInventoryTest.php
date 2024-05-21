<?php

namespace App\Tests\Adventure\AdventureInventory;

use PHPUnit\Framework\TestCase;
use App\Adventure\AdventureInventory;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use App\Entity\Adventure;

/**
 * Test for the AdventureMechanics.
 */
class AdventureInventoryTest extends TestCase
{
    public function testGetAllAdventures(): void
    {
        $repositoryMock = $this->createMock(ObjectRepository::class);
        $expectedAdventures = [new Adventure(), new Adventure()];
        $repositoryMock->method('findAll')->willReturn($expectedAdventures);

        $doctrineMock = $this->createMock(ManagerRegistry::class);
        $doctrineMock->method('getRepository')->willReturn($repositoryMock);

        $entityManagerMock = $this->createMock(EntityManagerInterface::class);

        $inventory = new AdventureInventory($doctrineMock, $entityManagerMock);

        $result = $inventory->getAllAdventures();

        $this->assertSame($expectedAdventures, $result);
    }
}