<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Application;

final class Request
{
    private const SERVER = [
        'REQUEST_URI',
        'QUERY_STRING'
    ];

    private $server;
    private $query;
    private $path;

    public function __construct(array $server)
    {
        $this->server = $server;
        $this->query = $server['QUERY_STRING'];
        $this->path =  rtrim(strtr($server['REQUEST_URI'], $server['QUERY_STRING'], ''), '?');
    }

    public function server(string $key): string
    {
        if (in_array($key, self::SERVER)) {
            return $this->server[$key];
        }
    }

    public function getFilename(): string
    {
        return Query::extractFilename($this->path);
    }

    /** @return string[] */
    public function getModifiers(): array
    {
        return Query::extractModifiersNameAndArgs($this->query);
    }
}
