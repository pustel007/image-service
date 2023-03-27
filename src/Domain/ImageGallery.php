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

    /** @return Image[] */
    public function getAllImages(): array
    {
        $this->images = $this->imageRepository->findAll();

        return $this->images;
    }
}
