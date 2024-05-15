<?php

namespace App\Library;

use App\Library\Library;
use App\Entity\Books;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

class LibraryTest extends TestCase
{
    public function testCreateOrUpdateBook(): void
    {
        $managerRegistry = $this->createMock(ManagerRegistry::class);

        $entityManager = $this->createMock(ObjectManager::class);

        $entityManager->expects($this->once())->method('persist');
        $entityManager->expects($this->once())->method('flush');

        $managerRegistry->method('getManager')->willReturn($entityManager);

        $request = new Request([], [
            'title' => 'Sample Title',
            'isbn' => '1234567890',
            'author' => 'John Doe',
            'description' => 'Sample Description'
        ]);

        $request->files->set('image', []);

        $library = new Library($managerRegistry);

        $book = $library->createOrUpdateBook($request);

        $this->assertInstanceOf(Books::class, $book);
        $this->assertEquals('Sample Title', $book->getTitle());
        $this->assertEquals('1234567890', $book->getIsbn());
        $this->assertEquals('John Doe', $book->getAuthor());
        $this->assertEquals('Sample Description', $book->getDescription());
    }
}
