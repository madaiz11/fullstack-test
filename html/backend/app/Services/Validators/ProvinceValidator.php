<?php

namespace App\Services\Validators;

class ProvinceValidator extends AbstractValidator
{
    /**
     * @inheritDoc
     */
    public function validate($value): bool
    {
        if (!is_string($value)) {
            $this->setError('Province must be a string');
            return false;
        }

        if (empty(trim($value))) {
            $this->setError('Province cannot be empty');
            return false;
        }

        if (strlen($value) > 100) {
            $this->setError('Province must not exceed 100 characters');
            return false;
        }

        return true;
    }
} 