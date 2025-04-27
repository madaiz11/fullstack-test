<?php

namespace App\Services\Validators;

class PaginationValidator extends AbstractValidator
{
    private const MIN_PAGE = 1;
    private const MAX_PAGE = 1000;
    private const MIN_LIMIT = 1;
    private const MAX_LIMIT = 100;

    /**
     * @inheritDoc
     */
    public function validate($value): bool
    {
        if (!is_array($value)) {
            $this->setError('Pagination parameters must be an array');
            return false;
        }

        if (!isset($value['page']) || !is_int($value['page'])) {
            $this->setError('Page must be an integer');
            return false;
        }

        if ($value['page'] < self::MIN_PAGE || $value['page'] > self::MAX_PAGE) {
            $this->setError(sprintf('Page must be between %d and %d', self::MIN_PAGE, self::MAX_PAGE));
            return false;
        }

        if (!isset($value['limit']) || !is_int($value['limit'])) {
            $this->setError('Limit must be an integer');
            return false;
        }

        if ($value['limit'] < self::MIN_LIMIT || $value['limit'] > self::MAX_LIMIT) {
            $this->setError(sprintf('Limit must be between %d and %d', self::MIN_LIMIT, self::MAX_LIMIT));
            return false;
        }

        return true;
    }
} 