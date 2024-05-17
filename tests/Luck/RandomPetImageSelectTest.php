<?php

namespace App\Lucky;

use App\Lucky\RandomPetImageSelector;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

class RandomPetImageSelectorTest extends TestCase
{
    public function testRandompetImage(): void
    {
        $filesystemMock = $this->createMock(Filesystem::class);

        $filesystemMock->method('exists')->willreturnMap([
            ['/path/to/images/pet1.jpg', true],
            ['/path/to/images/pet2.jpg', false],
            ['/path/to/images/pet3.jpg', true],
        ]);
        $petImages = ['pet1.jpg', 'pet2.jpg', 'pet3.jpg'];

        $randomPetImageSelector = new RandomPetImageSelector($filesystemMock, '/path/to/images/', $petImages);
        $this->assertContains($randomPetImageSelector->getRandomPetImage(), ['pet1.jpg', 'pet3.jpg']);
    }
}