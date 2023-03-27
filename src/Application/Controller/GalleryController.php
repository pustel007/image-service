<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Application\Controller;

use Pustel007\ImageService\Application\Config;
use Pustel007\ImageService\Application\Request;
use Pustel007\ImageService\Application\Response;
use Pustel007\ImageService\Application\ViewRenderer;
use Pustel007\ImageService\Domain\ImageGallery;
use Pustel007\ImageService\Domain\ImageGalleryInterface;
use Pustel007\ImageService\Domain\ImageRepositoryInterface;
use Pustel007\ImageService\Domain\Model\Image;
use Pustel007\ImageService\Infrastructure\Repository\ImageRepository;

final class GalleryController
{
    private ImageRepositoryInterface $imageRepository;
    private ImageGalleryInterface $imageGallery;

    public function __construct()
    {
        $this->imageRepository = new ImageRepository(Config::IMAGES_PATH);
        $this->imageGallery = new ImageGallery($this->imageRepository);
    }
        
    public function show(Request $request): Response
    {
        $data['images'] = [];
        foreach ($this->imageGallery->getAllImages() as $image) {
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
