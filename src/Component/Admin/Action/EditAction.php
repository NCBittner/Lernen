<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Component\Admin\Action;

class EditAction
{
    public function execute(string $template, string $content): bool
    {
        $filepath = sprintf('%s/%s.twig', TPL_DIR, str_replace('__', '/', $template));

        if (file_exists($filepath)) {
            file_put_contents($filepath, $content);

            return true;
        }

        return false;
    }
}
