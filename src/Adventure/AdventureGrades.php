<?php

namespace App\Adventure;

use App\Entity\Grades;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class AdventureGrades
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
    * @return array<array{name: string, course: string, grade: string}>
    */
    public function getPersons(): array
    {
        return [
            ['name' => 'Johan Andersson', 'course' => 'DATABASE', 'grade' => 'MVG'],
            ['name' => 'Anita Karlsson', 'course' => 'DATABASE', 'grade' => 'VG'],
            ['name' => 'Sture Snesteg', 'course' => 'DATABASE', 'grade' => 'IG'],
        ];
    }
    /**
     * @param array<array{name: string, course: string, grade: string}> $persons
     */
    public function addGrades(array $persons): void
    {
        foreach ($persons as $person) {
            $name = $person['name'];
            $course = $person['course'];
            $grade = $person['grade'];

            if (!$name || !$course || !$grade) {
                continue;
            }

            $grades = new Grades();
            $grades->setName($name)
                   ->setCourse($course)
                   ->setGrade($grade);
            $this->entityManager->persist($grades);
        }

        $this->entityManager->flush();
    }
    /**
     * @return array<array{name: string, course: string, grade: string}>
     */
    public function getGradesData(): array
    {
        $gradesRepository = $this->entityManager->getRepository(Grades::class);
        $grades = $gradesRepository->findAll();

        $gradesData = [];
        foreach ($grades as $grade) {
            $gradesData[] = [
                'name' => $grade->getName(),
                'course' => $grade->getCourse(),
                'grade' => $grade->getGrade(),
            ];
        }

        return $gradesData;
    }

    public function deleteAllGrades(): void
    {
        $gradesRepository = $this->entityManager->getRepository(Grades::class);
        $allGrades = $gradesRepository->findAll();

        foreach ($allGrades as $grade) {
            $this->entityManager->remove($grade);
        }

        $this->entityManager->flush();
    }
}