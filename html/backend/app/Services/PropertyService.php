<?php

namespace App\Services;

use App\DTOs\PropertiesFilterDTO;
use App\Models\Property;
use App\Services\Interfaces\PropertyServiceInterface;
use Illuminate\Database\Eloquent\Builder;

class PropertyService implements PropertyServiceInterface
{
    /**
     * @inheritDoc
     */
    public function findById($id)
    {
        return Property::findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function getAll()
    {
        return Property::all();
    }

    /**
     * @inheritDoc
     */
    public function getFilteredProperties(PropertiesFilterDTO $filter): array
    {
        $query = $this->getFilteredQuery($filter);

        // Execute pagination
        $total = $query->count();
        $items = $query->skip(($filter->page - 1) * $filter->limit)
                      ->take($filter->limit)
                      ->get();

        $lastPage = ceil($total / $filter->limit);

        return [
            'data' => $items,
            'paginatorInfo' => [
                'count' => $items->count(),
                'currentPage' => $filter->page,
                'firstItem' => $items->first() ? ($filter->page - 1) * $filter->limit + 1 : null,
                'hasMorePages' => $filter->page < $lastPage,
                'lastItem' => $items->count() > 0 ? ($filter->page - 1) * $filter->limit + $items->count() : null,
                'lastPage' => $lastPage,
                'perPage' => $filter->limit,
                'total' => $total
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    public function getFilteredQuery(PropertiesFilterDTO $filter): Builder
    {
        $query = Property::query();

        // Apply search filter if provided
        if ($filter->search) {
            $searchTerm = "%" . trim(strtolower($filter->search)) . "%";
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm)
                    ->orWhereHas('location', function ($l) use ($searchTerm) {
                        $l->where('full_name', 'like', $searchTerm);
                    });
            });
        }

        if ($filter->province) {
            $query->whereHas('location', function ($l) use ($filter) {
                $l->where('province', $filter->province);
            });
        }

        // Apply sorting
        $columnMap = [
            'TITLE' => 'title',
            'PRICE' => 'price',
            'DATE_LISTED' => 'date_listed',
            'CREATED_AT' => 'created_at'
        ];

        $column = $columnMap[$filter->sortKey] ?? 'created_at';
        $direction = $filter->sortOrder === 'ASC' ? 'asc' : 'desc';
        
        $query->orderBy($column, $direction);

        return $query;
    }
} 