<?php

namespace App\Services\Interfaces;

use App\DTOs\PropertiesFilterDTO;
use Illuminate\Database\Eloquent\Builder;

interface PropertyServiceInterface extends ServiceInterface
{
    /**
     * Get filtered properties with pagination
     *
     * @param PropertiesFilterDTO $filter
     * @return array
     */
    public function getFilteredProperties(PropertiesFilterDTO $filter): array;

    /**
     * Get property query builder with applied filters
     *
     * @param PropertiesFilterDTO $filter
     * @return Builder
     */
    public function getFilteredQuery(PropertiesFilterDTO $filter): Builder;
} 