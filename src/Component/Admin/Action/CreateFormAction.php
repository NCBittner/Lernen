<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Component\Admin\Action;

use NCBittner\Lernen\Architecture\Template\Renderer;

readonly class CreateFormAction
{
    private const string PLACEHOLDER_FILE = TPL_DIR . '/system/admin-template-placeholder.twig';

    public function __construct(
        private Renderer $renderer,
    ) {}

    public function execute(): string
    {
        if (file_exists(self::PLACEHOLDER_FILE)) {
            $placeholder = file_get_contents(self::PLACEHOLDER_FILE);
        } else {
            $placeholder = '';
        }

        return $this->renderer->render('system/admin-template-create', ['placeholder' => $placeholder]);
    }
}
