<?php

namespace App\Services\Validators;

class PropertyFilterValidator extends AbstractValidator
{
    private array $validators;
    private array $errors = [];

    public function __construct()
    {
        $this->validators = [
            'search' => new SearchValidator(),
            'pagination' => new PaginationValidator(),
            'sort' => new SortValidator(),
            'province' => new ProvinceValidator(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function validate($value): bool
    {
        if (!is_array($value)) {
            $this->setError('Filter must be an array');
            return false;
        }

        $this->errors = [];
        $isValid = true;

        // Validate search if provided
        if (isset($value['search']) && !empty($value['search'])) {
            if (!$this->validators['search']->validate($value['search'])) {
                $this->errors['search'] = $this->validators['search']->getError();
                $isValid = false;
            }
        }

        // Validate pagination
        $paginationData = [
            'page' => $value['page'] ?? 1,
            'limit' => $value['limit'] ?? 12
        ];
        if (!$this->validators['pagination']->validate($paginationData)) {
            $this->errors['pagination'] = $this->validators['pagination']->getError();
            $isValid = false;
        }

        // Validate sorting
        $sortData = [
            'sortKey' => $value['sortKey'] ?? 'CREATED_AT',
            'sortOrder' => $value['sortOrder'] ?? 'DESC'
        ];
        if (!$this->validators['sort']->validate($sortData)) {
            $this->errors['sort'] = $this->validators['sort']->getError();
            $isValid = false;
        }

        if (isset($value['province'])) {
            $provinceValidator = $this->validators['province'];
            if (!$provinceValidator->validate($value['province'])) {
                $this->errors['province'] = $provinceValidator->getError();
                $isValid = false;
            }
        }

        if (!$isValid) {
            $this->setError(json_encode($this->errors));
        }

        return $isValid;
    }

    /**
     * Get all validation errors
     *
     * @return array
     */
    public function getAllErrors(): array
    {
        return $this->errors;
    }
} 