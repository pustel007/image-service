<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Domain\Modifier;

final class Builder
{
    public static function build(string $modifierName, array $modifierArgs): ModifierInterface
    {
        return match($modifierName) {
            'crop' => new CropModifier(...$modifierArgs),
            'resize' => new ResizeModifier(...$modifierArgs),
            'blur' => new BlurModifier(...$modifierArgs),
            default => throw new \OutOfRangeException('Unsupported modifier')
        };
    }
}
