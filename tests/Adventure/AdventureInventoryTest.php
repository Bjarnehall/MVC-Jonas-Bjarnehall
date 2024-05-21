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
    /**
     * Test getAdventures
     */
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
    /**
     * Test clearAdventures
     */
    public function testClearAdventures(): void
    {
        $repositoryMock = $this->createMock(ObjectRepository::class);
        $adventures = [new Adventure(), new Adventure()];
        $repositoryMock->method('findAll')->willReturn($adventures);

        $doctrineMock = $this->createMock(ManagerRegistry::class);
        $doctrineMock->method('getRepository')->willReturn($repositoryMock);

        $entityManagerMock = $this->createMock(EntityManagerInterface::class);

        foreach ($adventures as $adventure) {
            $entityManagerMock->expects($this->atLeastOnce())
                              ->method('remove')
                              ->with($adventure);
        }

        $entityManagerMock->expects($this->once())
                          ->method('flush');
        $inventory = new AdventureInventory($doctrineMock, $entityManagerMock);
        $inventory->clearAdventures();
    }
}
