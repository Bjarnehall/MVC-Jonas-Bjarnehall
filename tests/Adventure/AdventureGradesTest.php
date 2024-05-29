<?php

use App\Adventure\AdventureGrades;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use App\Entity\Grades;

class AdventureGradesTest extends TestCase
{
    /** @var \PHPUnit\Framework\MockObject\MockObject|EntityManagerInterface */
    private $entityManagerMock;
     /** @var AdventureGrades */
    private $adventureGrades;

    protected function setUp(): void
    {
        parent::setUp();

        $this->entityManagerMock = $this->createMock(EntityManagerInterface::class);

        $this->adventureGrades = new AdventureGrades($this->entityManagerMock);
    }

    public function testGetPersons(): void
    {
        $expectedPersons = [
            ['name' => 'Johan Andersson', 'course' => 'DATABASE', 'grade' => 'MVG'],
            ['name' => 'Anita Karlsson', 'course' => 'DATABASE', 'grade' => 'VG'],
            ['name' => 'Sture Snesteg', 'course' => 'DATABASE', 'grade' => 'IG'],
        ];

        $this->assertEquals($expectedPersons, $this->adventureGrades->getPersons());
    }

    public function testAddGrades(): void
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $entityManager->expects($this->exactly(3))
            ->method('persist')
            ->with($this->isInstanceOf(Grades::class));

        $entityManager->expects($this->once())
            ->method('flush');

        $adventureGrades = new AdventureGrades($entityManager);

        $persons = [
            ['name' => 'Johan Andersson', 'course' => 'DATABASE', 'grade' => 'MVG'],
            ['name' => 'Anita Karlsson', 'course' => 'DATABASE', 'grade' => 'VG'],
            ['name' => 'Sture Snesteg', 'course' => 'DATABASE', 'grade' => 'IG'],
        ];

        $adventureGrades->addGrades($persons);
    }
    // public function addGrades(array $persons): void
    // {
    //     foreach ($persons as $person) {
    //         $name = $person['name'];
    //         $course = $person['course'];
    //         $grade = $person['grade'];

    //         if (!$name || !$course || !$grade) {
    //             continue;
    //         }

    //         $grades = new Grades();
    //         $grades->setName($name)
    //                ->setCourse($course)
    //                ->setGrade($grade);
    //         $this->entityManager->persist($grades);
    //     }

    //     $this->entityManager->flush();
    // }
}