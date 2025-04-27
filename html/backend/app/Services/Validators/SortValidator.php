<?php

namespace App\Services\Validators;

class SortValidator extends AbstractValidator
{
    private const ALLOWED_SORT_KEYS = ['TITLE', 'PRICE', 'DATE_LISTED', 'CREATED_AT'];
    private const ALLOWED_SORT_ORDERS = ['ASC', 'DESC'];

    /**
     * @inheritDoc
     */
    public function validate($value): bool
    {
        if (!is_array($value)) {
            $this->setError('Sort parameters must be an array');
            return false;
        }

        if (!isset($value['sortKey']) || !is_string($value['sortKey'])) {
            $this->setError('Sort key must be a string');
            return false;
        }

        if (!in_array($value['sortKey'], self::ALLOWED_SORT_KEYS)) {
            $this->setError('Invalid sort key. Allowed values: ' . implode(', ', self::ALLOWED_SORT_KEYS));
            return false;
        }

        if (!isset($value['sortOrder']) || !is_string($value['sortOrder'])) {
            $this->setError('Sort order must be a string');
            return false;
        }

        if (!in_array($value['sortOrder'], self::ALLOWED_SORT_ORDERS)) {
            $this->setError('Invalid sort order. Allowed values: ' . implode(', ', self::ALLOWED_SORT_ORDERS));
            return false;
        }

        return true;
    }
} 