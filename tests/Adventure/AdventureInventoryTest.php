<?php

namespace App\Tests\Adventure\AdventureInventory;

use PHPUnit\Framework\TestCase;
use App\Adventure\AdventureInventory;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Adventure;

/**
 * Test for the AdventureMechanics.
 */
class AdventureInventoryTest extends TestCase
{
    public function testGetAllAdventures()
    {
        $doctrineMock = $this->getMockBuilder(\Doctrine\Persistence\ManagerRegistry::class)
                             ->getMock();

        $entityManagerMock = $this->getMockBuilder(\Doctrine\ORM\EntityManagerInterface::class)
                                  ->getMock();

        $repositoryMock = $this->getMockBuilder(\Doctrine\Persistence\ObjectRepository::class)
                               ->getMock();

        $expectedAdventures = [
            new Adventure(),
            new Adventure(),
        ];
        $repositoryMock->expects($this->once())
                       ->method('findAll')
                       ->willReturn($expectedAdventures);

        $doctrineMock->expects($this->once())
                     ->method('getRepository')
                     ->with(Adventure::class)
                     ->willReturn($repositoryMock);

        $inventory = new AdventureInventory($doctrineMock, $entityManagerMock);

        $result = $inventory->getAllAdventures();

        $this->assertEquals($expectedAdventures, $result);
    }
}