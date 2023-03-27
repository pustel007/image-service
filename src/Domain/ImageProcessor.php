<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Domain;

use Pustel007\ImageService\Domain\Model\Image;
use Pustel007\ImageService\Domain\Modifier\ModifierInterface;

final class ImageProcessor implements ImageProcessorInterface
{
    private ImageRepositoryInterface $imageRepository;

    private Image $image;

    /** @var ModifierInterface[] $modifiers */
    private array $modifiers;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->modifiers = [];
    }

    public function addModifier(ModifierInterface $modifier): self
    {
        $this->modifiers[] = $modifier;

        return $this;
    }

    public function processImage(string $filename): void
    {
        $this->image = $this->imageRepository->findByName($filename);

        foreach ($this->modifiers as $modifier) {
            $modifier->modify($this->image);
        }

        $this->imageRepository->save($this->image);
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }
}
