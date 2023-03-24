<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Application\Controller;

use Pustel007\ImageService\Application\Config;
use Pustel007\ImageService\Application\Request;
use Pustel007\ImageService\Application\Response;
use Pustel007\ImageService\Infrastructure\Repository\ImageRepository;
use Pustel007\ImageService\Domain\ImageProcessor;
use Pustel007\ImageService\Domain\Modifier\Builder as ModifierBuilder;

final class ImageController
{
    public function modify(Request $request): Response
    {
        $imageRepository = new ImageRepository(Config::IMAGES_PATH);

        $imageProcessor = new ImageProcessor($imageRepository);
        $imageProcessor->loadImage($request->getFilename());

        foreach ($request->getModifiers() as $modifierName => $modifierArgs) {
            $modifier = ModifierBuilder::build($modifierName, $modifierArgs);
            $imageProcessor->addModifier($modifier);
        }

        $imageProcessor->processImage();
        $imageProcessor->storeImage();

        return new Response(
            Response::TYPE_REDIRECT,
            null,
            [Response::DATA_INDEX_REDIRECTPATH => '/' . Config::IMAGES_PATH . $imageProcessor->getImage()->getName()]
        );
    }
}
