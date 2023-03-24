<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Domain\Modifier;

final class Builder
{
    public static function build(string $modifierName, array $modifierArgs): ModifierInterface
    {
        switch ($modifierName) {
            case 'crop':
                return new CropModifier(...$modifierArgs);
                break;
            case 'resize':
                return new ResizeModifier(...$modifierArgs);
                break;
            case 'blur':
                return new BlurModifier(...$modifierArgs);
                break;
        }

        throw new \OutOfRangeException('Unsupported modifier');
    }
}
