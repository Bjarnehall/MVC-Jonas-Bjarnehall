<?php

use App\Adventure\AdventureGrades;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

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
}