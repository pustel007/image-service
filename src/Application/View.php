<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Application;

final class View
{
    private ViewRenderer $viewRenderer;

    public function __construct(ViewRenderer $viewRenderer)
    {
        $this->viewRenderer = $viewRenderer;
    }

    public function handle(Response $response): void
    {
        switch ($response->getType()) {
            case Response::TYPE_REDIRECT:
                $this->redirect($response->getRedirectPath());
                break;
            case Response::TYPE_RENDER_HTML:
                $this->renderHtml($response->getTemplate(), $response->getData());
                break;
        }

        throw new \Exception('Unsupported response type');
    }

    private function redirect(string $path): void
    {
        header('Location: ' . $path);
    }

    private function renderHtml(string $template, ?array $data): void
    {
        header('Content-type: text/html');

        try {
            echo $this->viewRenderer->{'render' . ucfirst($template)}($data);
        } catch (\Throwable $e) {
            throw new \Exception(sprintf('Unsupported template: %s', $template));
        }
    }
}
