<?php

declare(strict_types=1);

namespace ncbittner\lernen;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * @author Erick Dyck <info@erickdyck.de>
 * @since  07.03.2023
 */
class TemplateRenderer
{
    private const TEMPLATE_ERROR_PAGE = 'error-page.twig';
    private const TEMPLATE_UNKNOWN    = 'invalid-request.twig';

    public readonly int $statusCode;

    public function __construct(
        private Environment $environment,
    ) {
    }

    public function render(string $name): string
    {
        if (empty($name)) {
            $name = self::TEMPLATE_UNKNOWN;
        } else {
            if (str_ends_with($name, '.twig') === false) {
                $name .= '.twig';
            }

            if ($this->environment->getLoader()->exists($name) === false) {
                $name = self::TEMPLATE_UNKNOWN;
            }
        }

        try {
            $template   = $this->environment->render($name);
            $statusCode = 200;
        } catch (LoaderError|RuntimeError|SyntaxError $e) {
            $statusCode = 500;

            try {
                $template = $this->environment->render(
                    self::TEMPLATE_ERROR_PAGE,
                    [
                        'exception' => [
                            'code'    => $e->getCode(),
                            'message' => $e->getMessage(),
                        ],
                    ]
                );
            } catch (LoaderError|RuntimeError|SyntaxError $e) {
                $template = sprintf('Failed to load template for error page: %s', $e->getMessage());
            }
        }

        $this->statusCode = $statusCode;

        return $template;
    }
}
