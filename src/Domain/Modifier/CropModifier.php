<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Domain\Modifier;

use Pustel007\ImageService\Domain\Model\Image;

final class CropModifier extends AbstractModifier implements ModifierInterface
{
    private const MODIFIER_NAME = 'crop';

    private int $width;
    private int $height;
    private int $offsetX;
    private int $offsetY;

    public function __construct(
        string $width,
        string $height,
        ?string $offsetX = null,
        ?string $offsetY = null
    ) {
        parent::__construct();

        $this->width = max(0, (int) $width);
        $this->height = max(0, (int) $height);
        $this->offsetX = max(0, (int) $offsetX);
        $this->offsetY = max(0, (int) $offsetY);
    }

    public function modify(Image $image): Image
    {
        $managerImage = $this->imageManager->make($image->getContent());

        $managerImage->crop(
            min($this->width, $managerImage->width()),
            min($this->height, $managerImage->height()),
            min($this->offsetX, $managerImage->width()),
            min($this->offsetY, $managerImage->height())
        );

        $image->setContent($managerImage->response());

        $image->addNameSuffix(
            self::MODIFIER_NAME . '.' .
            $this->width . '.' .
            $this->height . '.' .
            $this->offsetX . '.' .
            $this->offsetY
        );

        return $image;
    }
}
