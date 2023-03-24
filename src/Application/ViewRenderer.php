<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Application;

final class ViewRenderer
{
    public const TEMPLATE_IMAGE_GALLERY = 'gallery';

    public function renderGallery(array $data): string
    {
        $rendered = '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">';

        $rendered .= '<p>Example:</p>';
        $rendered .= '<ul>';
        $rendered .= '<li>one.jpg/?mod=crop.100.200.100.100&mod=resize.300.300&mod=blur.15</li>';
        $rendered .= '</ul>';

        $rendered .= '<table border="1" cellpadding="10">';

        foreach ($data['images'] as $image) {
            $rendered .= '<tr>'
                . '<td><img src="' . $data['path'] . $image['filename'] . '"/></td>'
                . '<td>' . $image['filename'] . '</td>'
                . '</tr>';
        }

        $rendered .= '</table>';

        $rendered .= '<p>Images from <a href="https://unsplash.com">Unsplash</a></p>';

        return $rendered;
    }
}
