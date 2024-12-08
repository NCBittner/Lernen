<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Architecture\Template;

use Psr\Log\LoggerInterface;
use Throwable;
use Twig\Environment;

/**
 * @author Erick Dyck <info@erickdyck.de>
 * @since  07.03.2023
 */
readonly class Renderer
{
    private const string TEMPLATE_ERROR_PAGE = 'system/error-page.twig';
    private const string TEMPLATE_UNKNOWN    = 'system/invalid-request.twig';

    public int $statusCode;

    /**
     * @see RendererFactory
     */
    public function __construct(
        private Environment $environment,
        private LoggerInterface $logger,
    ) {}

    public function render(string $name, array $context = []): string
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
            $template   = $this->environment->render($name, $context);
            $statusCode = 200;
        } catch (Throwable $t) {
            $statusCode = 500;

            $this->logger->error(
                sprintf('Failed to render template %s: %s', $name, $t->getMessage()),
                [
                    'exception'        => $t::class,
                    'exceptionCode'    => $t->getCode(),
                    'exceptionMessage' => $t->getMessage(),
                    'name'             => $name,
                ],
            );

            try {
                $template = $this->environment->render(self::TEMPLATE_ERROR_PAGE);
            } catch (Throwable $t) {
                $template = sprintf('Failed to load template for error page: %s', $t->getMessage());
            }
        }

        $this->statusCode = $statusCode;

        return $template;
    }
}
