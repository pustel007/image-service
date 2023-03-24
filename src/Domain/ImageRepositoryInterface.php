<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Domain;

use Pustel007\ImageService\Domain\Model\Image;

interface ImageRepositoryInterface
{
    /** @return Image[] */
    public function findAll(): array;

    public function findByName(string $name): Image;

    public function save(Image $image): void;
}
