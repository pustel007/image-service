<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Domain\Modifier;

use Pustel007\ImageService\Domain\Model\Image;

final class BlurModifier extends AbstractModifier implements ModifierInterface
{
    public const FACTOR_MAX = 100;

    private const MODIFIER_NAME = 'blur';

    private int $factor;

    public function __construct(
        string $factor
    ) {
        parent::__construct();

        $this->factor = min(
            max(0, (int) $factor),
            self::FACTOR_MAX
        );
    }

    public function modify(Image $image): Image
    {
        $managerImage = $this->imageManager->make($image->getContent());

        $managerImage->blur(
            $this->factor,
        );

        $image->setContent($managerImage->response());

        $image->addNameSuffix(
            self::MODIFIER_NAME . '.' .
            $this->factor
        );

        return $image;
    }
}
