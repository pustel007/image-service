<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Domain;

class ImageGallery implements ImageGalleryInterface
{
    private ImageRepositoryInterface $imageRepository;

    /** @var Images[] $images */
    private array $images;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->images = [];
    }

    public function loadAllImages(): void
    {
        $this->images = $this->imageRepository->findAll();
    }

    /** @return Image[] */
    public function getImages(): array
    {
        return $this->images;
    }
}
