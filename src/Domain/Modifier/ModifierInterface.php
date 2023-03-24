<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Domain\Modifier;

use Pustel007\ImageService\Domain\Model\Image;

interface ModifierInterface
{
    public function modify(Image $image): Image;
}
