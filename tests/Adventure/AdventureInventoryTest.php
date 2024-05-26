<?php

namespace App\Tests\Adventure\AdventureInventory;

use PHPUnit\Framework\TestCase;
use App\Adventure\AdventureInventory;
use App\Adventure\AdventureMechanics;
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
    /**
     * Test check if
     */
    public function testAdventureExists(): void
    {
        $codes = "zhzvagebyyrg";
        $keys = 101;

        $repositoryMock = $this->createMock(ObjectRepository::class);

        $repositoryMock->expects($this->once())
            ->method('findOneBy')
            ->with(['codes' => $codes, 'keys' => $keys])
            ->willReturn(new Adventure());

        $doctrineMock = $this->createMock(ManagerRegistry::class);

        $doctrineMock->expects($this->once())
            ->method('getRepository')
            ->with(Adventure::class)
            ->willReturn($repositoryMock);

        $entityManagerMock = $this->createMock(EntityManagerInterface::class);
        $inventory = new AdventureInventory($doctrineMock, $entityManagerMock);

        $this->assertTrue($inventory->adventureExists($codes, $keys));
    }

    public function testAdventureDoesNotExist(): void
    {
        $codes = "zhzvagebyyrg";
        $keys = 101;

        $repositoryMock = $this->createMock(ObjectRepository::class);

        $repositoryMock->expects($this->once())
            ->method('findOneBy')
            ->with(['codes' => $codes, 'keys' => $keys])
            ->willReturn(null);

        $doctrineMock = $this->createMock(ManagerRegistry::class);

        $doctrineMock->expects($this->once())
            ->method('getRepository')
            ->with(Adventure::class)
                     ->willReturn($repositoryMock);

        $entityManagerMock = $this->createMock(EntityManagerInterface::class);
        $inventory = new AdventureInventory($doctrineMock, $entityManagerMock);

        $this->assertFalse($inventory->adventureExists($codes, $keys));
    }

    public function testSaveRot13StringWhenNotExists(): void
    {
        $inputString = "Helloworld";
        $rot13String = str_rot13($inputString);
        $codes = $rot13String;
        $keys = 102;

        $doctrineMock = $this->createMock(ManagerRegistry::class);
        $entityManagerMock = $this->createMock(EntityManagerInterface::class);
        $doctrineMock->method('getManager')->willReturn($entityManagerMock);

        $adventureInventory = $this->getMockBuilder(AdventureInventory::class)
            ->onlyMethods(['adventureExists'])
            ->setConstructorArgs([$doctrineMock, $entityManagerMock])
            ->getMock();

        $adventureInventory->method('adventureExists')->with($codes, $keys)->willReturn(false);

        $entityManagerMock->expects($this->once())->method('persist')->with($this->callback(function ($adventure) use ($codes, $keys) {
            return $adventure instanceof Adventure
                && $adventure->getNotes() === "Decrypted message"
                && $adventure->getCodes() === $codes
                && $adventure->getKeys() === $keys;
        }));
        $entityManagerMock->expects($this->once())->method('flush');

        $result = $adventureInventory->saveRot13String($inputString);
        $this->assertTrue($result);
    }

    public function testSaveRot13StringWhenExists(): void
    {
        $inputString = "Helloworld";
        $rot13String = str_rot13($inputString);
        $codes = $rot13String;
        $keys = 102;

        $doctrineMock = $this->createMock(ManagerRegistry::class);
        $entityManagerMock = $this->createMock(EntityManagerInterface::class);
        $doctrineMock->method('getManager')->willReturn($entityManagerMock);

        $adventureInventory = $this->getMockBuilder(AdventureInventory::class)
            ->onlyMethods(['adventureExists'])
            ->setConstructorArgs([$doctrineMock, $entityManagerMock])
            ->getMock();

        $adventureInventory->method('adventureExists')->with($codes, $keys)->willReturn(true);

        $entityManagerMock->expects($this->never())->method('persist');
        $entityManagerMock->expects($this->never())->method('flush');

        $result = $adventureInventory->saveRot13String($inputString);
        $this->assertFalse($result);
    }
}
