<?php

namespace App\Services\Interfaces;

interface PropertyServiceInterface extends ServiceInterface
{
    /**
     * Get filtered properties with pagination
     *
     * @param array $filter
     * @return array
     */
    public function getFilteredProperties(array $filter): array;

    /**
     * Get property query builder with applied filters
     *
     * @param array $filter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getFilteredQuery(array $filter): \Illuminate\Database\Eloquent\Builder;
} 