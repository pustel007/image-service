<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Domain;

use Pustel007\ImageService\Domain\Model\Image;
use Pustel007\ImageService\Domain\Modifier\ModifierInterface;

interface ImageProcessorInterface
{
    public function __construct(ImageRepositoryInterface $imageRepository);

    public function addModifier(ModifierInterface $modifier): self;
    
    public function processImage(string $imageName): void;
    
    public function getImage(): ?Image;
}
