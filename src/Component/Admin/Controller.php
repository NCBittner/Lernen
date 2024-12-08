<?php

declare(strict_types=1);

namespace NCBittner\Lernen\Component\Admin;

use NCBittner\Lernen\Component\Admin\Action\CreateAction;
use NCBittner\Lernen\Component\Admin\Action\CreateFormAction;
use NCBittner\Lernen\Component\Admin\Action\DeleteAction;
use NCBittner\Lernen\Component\Admin\Action\EditAction;
use NCBittner\Lernen\Component\Admin\Action\EditFormAction;
use NCBittner\Lernen\Component\Admin\Action\IndexAction;
use RuntimeException;
use UnexpectedValueException;

readonly class Controller
{
    public function __construct(
        private CreateAction $createAction,
        private CreateFormAction $createFormAction,
        private DeleteAction $deleteAction,
        private EditAction $editAction,
        private EditFormAction $editFormAction,
        private IndexAction $indexAction,
    ) {}

    /**
     * @throws RuntimeException
     */
    public function create(string $template, string $content): bool
    {
        return $this->createAction->execute($template, $content);
    }

    public function createForm(): string
    {
        return $this->createFormAction->execute();
    }

    public function delete(string $template): bool
    {
        return $this->deleteAction->execute($template);
    }

    public function edit(string $template, string $content): bool
    {
        return $this->editAction->execute($template, $content);
    }

    public function editForm(string $template): string
    {
        return $this->editFormAction->execute($template);
    }

    /**
     * @throws UnexpectedValueException
     */
    public function index(): string
    {
        return $this->indexAction->execute();
    }
}
