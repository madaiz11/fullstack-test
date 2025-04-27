<?php

namespace App\Services\Validators;

abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * @var string|null
     */
    protected ?string $error = null;

    /**
     * @inheritDoc
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * Set validation error message
     *
     * @param string $message
     * @return void
     */
    protected function setError(string $message): void
    {
        $this->error = $message;
    }
} 