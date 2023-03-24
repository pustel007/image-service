<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Domain;

interface ImageGalleryInterface
{
    public function __construct(ImageRepositoryInterface $imageRepository);

    public function loadAllImages(): void;

    public function getImages(): array;
}
