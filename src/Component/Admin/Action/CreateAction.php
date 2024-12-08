<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Component\Admin\Action;

use RuntimeException;

class CreateAction
{
    /**
     * @throws RuntimeException
     */
    public function execute(string $template, string $content): bool
    {
        // Sanitize template name
        $value = preg_replace('/[^a-z0-9-\/]+/i', '-', $template);
        $value = strtolower($value);
        $value = preg_replace(['/-+/', '/\/+/'], ['-', '/'], $value);
        $value = trim($value, '-/');

        // Check if template already exists
        $filepath = sprintf('%s/%s.twig', TPL_DIR, $value);

        if ($value && file_exists($filepath) === false) {
            // Check if directory does exist
            $dir = dirname($filepath);

            if (is_dir($dir) === false) {
                if (mkdir($dir, 0777, true) === false && is_dir($dir) === false) {
                    throw new RuntimeException(sprintf('Directory "%s" was not created!', $dir));
                }
            }

            // Write template file
            file_put_contents($filepath, $content);

            return true;
        }

        return false;
    }
}
