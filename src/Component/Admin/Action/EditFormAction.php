<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Component\Admin\Action;

use NCBittner\Lernen\Architecture\Template\Renderer;

readonly class EditFormAction
{
    public function __construct(
        private Renderer $renderer,
    ) {}

    public function execute(string $template): string
    {
        $filepath = sprintf('%s/%s.twig', TPL_DIR, str_replace('__', '/', $template));

        if (file_exists($filepath) && str_ends_with($filepath, '.twig')) {
            return $this->renderer->render(
                'system/admin-template-edit',
                [
                    'content' => file_get_contents($filepath),
                    'name'    => str_replace(TPL_DIR, '', $filepath),
                    'url'     => $template,
                ],
            );
        }

        return $this->renderer->render('system/admin-template-not-found');
    }
}
