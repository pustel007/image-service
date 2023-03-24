<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Application;

class Config
{
    public const ROUTES = [
        [
            'name' => 'image_modify',
            'regex' => '/\/\w+\.(jpg|jpeg|gif|png|webp)\//',
            'controller' => 'ImageController',
            'action' => 'modify',
        ],
        [
            'name' => 'gallery_show',
            'regex' => '/\/gallery/',
            'controller' => 'GalleryController',
            'action' => 'show',
        ]
    ];

    public const IMAGES_PATH = 'images/';
}
