<?php

namespace App\Adventure;

use App\Entity\Adventure;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class AdventureInventory
{
    private $doctrine;
    private $entityManager;

    public function __construct(ManagerRegistry $doctrine, EntityManagerInterface $entityManager)
    {
        $this->doctrine = $doctrine;
        $this->entityManager = $entityManager;
    }

    public function getAllAdventures()
    {
        $repository = $this->doctrine->getRepository(Adventure::class);
        return $repository->findAll();
    }

    public function clearAdventures()
    {
        $repository = $this->doctrine->getRepository(Adventure::class);
        $adventures = $repository->findAll();

        foreach ($adventures as $adventure) {
            $this->entityManager->remove($adventure);
        }

        $this->entityManager->flush();
    }
    /**
    * Adds a note to the inventory.
    *
    * This method adds a note to the adventure entity. It checks if the specified item already exists. 
    * If exists then returns false.
    *
    * @return bool Returns true if the note was added, otherwise false.
     */
    public function addNote(): bool
    {
        $entityManager = $this->doctrine->getManager();
        $repository = $this->doctrine->getRepository(Adventure::class);
        $existingAdventure = $repository->findOneBy(['codes' => 22456789, 'keys' => 101]);

        if ($existingAdventure !== null) {
            return false;
        }

        $adventure = new Adventure();
        $adventure->setNotes("papperslapp");
        $adventure->setCodes(22456789);
        $adventure->setKeys(101);

        $entityManager->persist($adventure);
        $entityManager->flush();

        return true;
    }
}
