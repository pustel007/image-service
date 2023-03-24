<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Domain\Modifier;

use Pustel007\ImageService\Domain\Model\Image;

final class ResizeModifier extends AbstractModifier implements ModifierInterface
{
    private const MODIFIER_NAME = 'resize';

    private int $width;
    private int $height;

    public function __construct(
        string $width,
        string $height
    ) {
        parent::__construct();

        $this->width = max(0, (int) $width);
        $this->height = max(0, (int) $height);
    }

    public function modify(Image $image): Image
    {
        $managerImage = $this->imageManager->make($image->getContent());

        $managerImage->resize(
            $this->width,
            $this->height
        );

        $image->setContent($managerImage->response());

        $image->addNameSuffix(
            self::MODIFIER_NAME . '.' .
            $this->width . '.' .
            $this->height
        );

        return $image;
    }
}
