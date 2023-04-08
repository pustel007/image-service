<?php

namespace Pustel007\ImageService\Domain\Model;

final class Image
{
    private string $name;
    private string $content;

    public function __construct(string $name, string $content)
    {
        $this->name = $name;
        $this->content = $content;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function addNameSuffix(string $suffix): self
    {
        $nameParts = explode('.', $this->getName());

        $extension = array_pop($nameParts);
        array_push($nameParts, $suffix);
        array_push($nameParts, $extension);

        $this->setName(implode('.', $nameParts));

        return $this;
    }
}
