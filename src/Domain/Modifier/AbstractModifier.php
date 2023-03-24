<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Domain\Modifier;

use Intervention\Image\ImageManager;

abstract class AbstractModifier implements ModifierInterface
{
    protected ImageManager $imageManager;

    protected function __construct()
    {
        $this->imageManager = new ImageManager(['driver' => 'imagick']);
    }
}
