<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Component\Admin\Action;

class DeleteAction
{
    public function execute(string $template): bool
    {
        $value    = str_replace('__', '/', $template);
        $filepath = sprintf('%s/%s.twig', TPL_DIR, $value);

        if (file_exists($filepath) && str_starts_with($value, 'blog/')) {
            unlink($filepath);

            return true;
        }

        return false;
    }
}
