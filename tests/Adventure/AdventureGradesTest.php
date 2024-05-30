<?php

use App\Adventure\AdventureGrades;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use App\Entity\Grades;
use Doctrine\Persistence\ObjectRepository;
use Doctrine\Persistence\ManagerRegistry;

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

    public function testGetGradesData(): void
    {
        $grade1 = new Grades();
        $grade1->setName('Johan Andersson')->setCourse('DATABASE')->setGrade('MVG');

        $grade2 = new Grades();
        $grade2->setName('Anita Karlsson')->setCourse('DATABASE')->setGrade('VG');

        $grade3 = new Grades();
        $grade3->setName('Sture Snesteg')->setCourse('DATABASE')->setGrade('IG');

        $expectedGrades = [$grade1, $grade2, $grade3];

        $repositoryMock = $this->createMock(\Doctrine\ORM\EntityRepository::class);
        $repositoryMock->method('findAll')->willReturn($expectedGrades);

        $entityManagerMock = $this->createMock(EntityManagerInterface::class);
        $entityManagerMock->method('getRepository')->willReturn($repositoryMock);

        $adventureGrades = new AdventureGrades($entityManagerMock);

        $result = $adventureGrades->getGradesData();
        $expectedResult = [
            ['name' => 'Johan Andersson', 'course' => 'DATABASE', 'grade' => 'MVG'],
            ['name' => 'Anita Karlsson', 'course' => 'DATABASE', 'grade' => 'VG'],
            ['name' => 'Sture Snesteg', 'course' => 'DATABASE', 'grade' => 'IG'],
        ];

        $this->assertSame($expectedResult, $result);
    }

    public function testDeleteAllGrades(): void
    {
        $grade1 = new Grades();
        $grade1->setName('Johan Andersson')->setCourse('DATABASE')->setGrade('MVG');

        $grade2 = new Grades();
        $grade2->setName('Anita Karlsson')->setCourse('DATABASE')->setGrade('VG');

        $grade3 = new Grades();
        $grade3->setName('Sture Snesteg')->setCourse('DATABASE')->setGrade('IG');

        $allGrades = [$grade1, $grade2, $grade3];

        $repositoryMock = $this->createMock(\Doctrine\ORM\EntityRepository::class);
        $repositoryMock->method('findAll')->willReturn($allGrades);

        $entityManagerMock = $this->createMock(EntityManagerInterface::class);
        $entityManagerMock->method('getRepository')->willReturn($repositoryMock);

        $entityManagerMock->expects($this->exactly(count($allGrades)))
            ->method('remove')
            ->withConsecutive([$grade1], [$grade2]);

        $entityManagerMock->expects($this->once())->method('flush');
        $adventureGrades = new AdventureGrades($entityManagerMock);
        $adventureGrades->deleteAllGrades();
    }
}
