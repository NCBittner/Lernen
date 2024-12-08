<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Component\User\Action;

use Odan\Session\SessionInterface;
use Odan\Session\SessionManagerInterface;
use RuntimeException;
use SensitiveParameter;

readonly class LoginAction
{
    private const string DOTENV_FILE = ROOT_DIR . '/.env';

    public function __construct(
        private SessionInterface $session,
        private SessionManagerInterface $sessionManager,
    ) {}

    public function execute(#[SensitiveParameter] string $inputPassword): bool
    {
        if ($this->sessionManager->isStarted() === false) {
            throw new RuntimeException('Session is not started!');
        }

        if (file_exists(self::DOTENV_FILE)) {
            $env      = parse_ini_file(self::DOTENV_FILE);
            $password = $env['APP_PASSWORD'] ?? throw new RuntimeException('APP_PASSWORD is not set!');

            if (password_verify($inputPassword, $password)) {
                $this->session->set('logged_in', true);

                return true;
            }

            return false;
        }

        file_put_contents(
            self::DOTENV_FILE,
            sprintf('APP_PASSWORD=%s', password_hash($inputPassword, PASSWORD_DEFAULT)),
        );

        return true;
    }
}
