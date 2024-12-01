<?php

declare(strict_types=1);

namespace ncbittner\lernen\Architecture\Template;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

final class RendererFactory
{
    public function __invoke(): Renderer
    {
        $loader      = new FilesystemLoader(ROOT_DIR . '/template');
        $environment = new Environment($loader);

        return new Renderer($environment);
    }
}
