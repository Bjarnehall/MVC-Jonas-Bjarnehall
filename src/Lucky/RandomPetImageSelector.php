<?php

namespace App\Lucky;

use Symfony\Component\Filesystem\Filesystem;

class RandomPetImageSelector
{
    /**
     * @var Filesystem
     */
    private Filesystem $filesystem;
    /**
     * @var string
     */
    private string $imagePath;
    /**
     * @var string[]
     */
    private array $petImages;
    /**
     * Constructor.
     *
     * @param Filesystem $filesystem
     * @param string $imagePath path to the images.
     * @param string[] $petImages An array containing pet images.
     */
    public function __construct(Filesystem $filesystem, string $imagePath, array $petImages)
    {
        $this->filesystem = $filesystem;
        $this->imagePath = $imagePath;
        $this->petImages = $petImages;
    }

    public function getRandomPetImage(): string
    {
        $availablePetImages = array_filter($this->petImages, function ($image) {
            return $this->filesystem->exists($this->imagePath . $image);
        });

        $randomPetImage = 'pet3.jpg';

        if (count($availablePetImages) > 0) {
            $randomPetImage = $availablePetImages[array_rand($availablePetImages)];
        }

        return $randomPetImage;
    }
}
