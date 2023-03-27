<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Application\Controller;

use Pustel007\ImageService\Application\Config;
use Pustel007\ImageService\Application\Request;
use Pustel007\ImageService\Application\Response;
use Pustel007\ImageService\Infrastructure\Repository\ImageRepository;
use Pustel007\ImageService\Domain\ImageProcessor;
use Pustel007\ImageService\Domain\ImageProcessorInterface;
use Pustel007\ImageService\Domain\ImageRepositoryInterface;
use Pustel007\ImageService\Domain\Modifier\Builder as ModifierBuilder;

final class ImageController
{
    private ImageRepositoryInterface $imageRepository;
    private ImageProcessorInterface $imageProcessor;

    public function __construct()
    {
        $this->imageRepository = new ImageRepository(Config::IMAGES_PATH);
        $this->imageProcessor = new ImageProcessor($this->imageRepository);
    }

    public function modify(Request $request): Response
    {
        foreach ($request->getModifiers() as $modifierName => $modifierArgs) {
            $modifier = ModifierBuilder::build($modifierName, $modifierArgs);
            $this->imageProcessor->addModifier($modifier);
        }

        $this->imageProcessor->processImage($request->getFilename());

        return new Response(
            Response::TYPE_REDIRECT,
            null,
            [
                Response::DATA_INDEX_REDIRECTPATH
                    => '/' . Config::IMAGES_PATH . $this->imageProcessor->getImage()->getName()
            ]
        );
    }
}
