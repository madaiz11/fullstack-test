<?php

namespace App\Services\Validators;

class SearchValidator extends AbstractValidator
{
    /**
     * @inheritDoc
     */
    public function validate($value): bool
    {
        if (!is_string($value)) {
            $this->setError('Search term must be a string');
            return false;
        }

        $trimmed = trim($value);
        if (strlen($trimmed) < 2) {
            $this->setError('Search term must be at least 2 characters long');
            return false;
        }

        if (strlen($trimmed) > 100) {
            $this->setError('Search term must not exceed 100 characters');
            return false;
        }

        return true;
    }
} 