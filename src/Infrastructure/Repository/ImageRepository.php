<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Infrastructure\Repository;

use Pustel007\ImageService\Domain\ImageRepositoryInterface;
use Pustel007\ImageService\Domain\Model\Image;

class ImageRepository implements ImageRepositoryInterface
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = rtrim($path, '/') . '/';
    }

    /** @return Image[] */
    public function findAll(): array
    {
        $images = [];

        try {
            $handle = opendir($this->path);

            if ($handle) {
                while (($filename = readdir($handle)) !== false) {
                    if ($filename != "." && $filename != "..") {
                        $images[] = new Image(
                            $filename,
                            file_get_contents($this->path . $filename)
                        );
                    }
                }
            }

            closedir($handle);
        } catch (\Throwable $e) {
            throw $e;
        }

        return $images;
    }

    public function findByName(string $filename): Image
    {
        try {
            return new Image(
                $filename,
                file_get_contents($this->path . $filename)
            );
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function save(Image $image): void
    {
        try {
            file_put_contents($this->path . $image->getName(), $image->getContent());
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
