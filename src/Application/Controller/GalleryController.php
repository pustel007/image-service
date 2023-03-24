<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Application\Controller;

use Pustel007\ImageService\Application\Config;
use Pustel007\ImageService\Application\Request;
use Pustel007\ImageService\Application\Response;
use Pustel007\ImageService\Application\ViewRenderer;
use Pustel007\ImageService\Domain\ImageGallery;
use Pustel007\ImageService\Domain\Model\Image;
use Pustel007\ImageService\Infrastructure\Repository\ImageRepository;

final class GalleryController
{
    public function show(Request $request): Response
    {
        $imageRepository = new ImageRepository(Config::IMAGES_PATH);

        $imageGallery = new ImageGallery($imageRepository);
        $imageGallery->loadAllImages();

        $data['images'] = [];
        foreach ($imageGallery->getImages() as $image) {
            /** @var Image $image */
            $data['images'][] = [
                'filename' => $image->getName()
            ];
        }

        $data['path'] = Config::IMAGES_PATH;

        return new Response(
            Response::TYPE_RENDER_HTML,
            ViewRenderer::TEMPLATE_IMAGE_GALLERY,
            $data
        );
    }
}
