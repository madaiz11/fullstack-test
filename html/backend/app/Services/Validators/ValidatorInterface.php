<?php

namespace App\Services\Validators;

interface ValidatorInterface
{
    /**
     * Validate the input data
     *
     * @param mixed $value
     * @return bool
     */
    public function validate($value): bool;

    /**
     * Get validation error message
     *
     * @return string|null
     */
    public function getError(): ?string;
} 