<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Application;

final class Response
{
    public const TYPE_REDIRECT = 1;
    public const TYPE_RENDER_HTML = 2;

    public const DATA_INDEX_REDIRECTPATH = '_PATH_';

    private const TYPES = [
        self::TYPE_REDIRECT,
        self::TYPE_RENDER_HTML
    ];

    private int $type;
    private ?string $template;
    private ?array $data;

    public function __construct(int $type, ?string $template = null, ?array $data = null)
    {
        $this->setType($type);
        $this->template = $template;
        $this->data = $data;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function getRedirectPath(): ?string
    {
        return $this->data[self::DATA_INDEX_REDIRECTPATH] ?: null;
    }

    private function setType(int $type)
    {
        if (in_array($type, self::TYPES)) {
            $this->type = $type;
        } else {
            throw new \Exception('Unsupported response type');
        }
    }
}
