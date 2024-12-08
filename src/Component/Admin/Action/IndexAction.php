<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Component\Admin\Action;

use FilesystemIterator;
use NCBittner\Lernen\Architecture\Template\Renderer;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use UnexpectedValueException;

readonly class IndexAction
{
    public function __construct(
        private Renderer $renderer,
    ) {}

    /**
     * @throws UnexpectedValueException
     */
    public function execute(): string
    {
        $directory = new RecursiveDirectoryIterator(TPL_DIR, FilesystemIterator::SKIP_DOTS);
        $iterator  = new RecursiveIteratorIterator($directory);

        $templates = [];

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'twig') {
                $templates[] = $file->getPathname();
            }
        }

        usort(
            $templates,
            function (string $a, string $b): int {
                $dirA = dirname($a);
                $dirB = dirname($b);

                // Files are in same directory
                if ($dirA === $dirB) {
                    return $a <=> $b;
                }

                // File A is in root - sort forward
                if ($dirA === TPL_DIR) {
                    return 1;
                }

                // File B is in root - sort back
                if ($dirB === TPL_DIR) {
                    return -1;
                }

                return $dirA <=> $dirB;
            },
        );

        return $this->renderer->render(
            'system/admin-index',
            [
                'templates' => array_map(
                    static function (string $dir): array {
                        $template = str_replace(TPL_DIR, '', $dir);

                        return [
                            'deletable' => str_starts_with($template, '/blog/'),
                            'name'      => $template,
                            'url'       => str_replace(['/', '.twig'], ['__', ''], ltrim($template, '/')),
                        ];
                    },
                    $templates,
                ),
            ],
        );
    }
}
