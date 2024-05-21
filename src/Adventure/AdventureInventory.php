<?php

namespace App\Adventure;

use App\Entity\Adventure;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class AdventureInventory
{
    private ManagerRegistry $doctrine;
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $doctrine, EntityManagerInterface $entityManager)
    {
        $this->doctrine = $doctrine;
        $this->entityManager = $entityManager;
    }
    /**
     * Get all Adventure
     *
     * @return Adventure[]
     */
    public function getAllAdventures()
    {
        $repository = $this->doctrine->getRepository(Adventure::class);
        return $repository->findAll();
    }
    /**
     * Reset clues from Adventure
     *
     * @return void
     */
    public function clearAdventures(): void
    {
        $repository = $this->doctrine->getRepository(Adventure::class);
        $adventures = $repository->findAll();

        foreach ($adventures as $adventure) {
            $this->entityManager->remove($adventure);
        }

        $this->entityManager->flush();
    }
    /**
    * Check if exist
    */
    public function adventureExists(int $codes, int $keys): bool
    {
        $repository = $this->doctrine->getRepository(Adventure::class);
        $existingAdventure = $repository->findOneBy(['codes' => $codes, 'keys' => $keys]);
        return $existingAdventure !== null;
    }
    /**
    * Adds a note to the inventory.
    */
    public function addNote(): bool
    {
        $codes = 22456789;
        $keys = 101;
        if ($this->adventureExists($codes, $keys)) {
            return false;
        }
        $entityManager = $this->doctrine->getManager();
        $adventure = new Adventure();
        $adventure->setNotes("papperslapp");
        $adventure->setCodes($codes);
        $adventure->setKeys($keys);
        $entityManager->persist($adventure);
        $entityManager->flush();
        return true;
    }
}
