<?php

namespace App\Services;

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
    public function getFilteredProperties(array $filter): array
    {
        $page = $filter['page'] ?? 1;
        $limit = $filter['limit'] ?? 12;
        
        $query = $this->getFilteredQuery($filter);

        // Execute pagination
        $total = $query->count();
        $items = $query->skip(($page - 1) * $limit)
                      ->take($limit)
                      ->get();

        $lastPage = ceil($total / $limit);

        return [
            'data' => $items,
            'paginatorInfo' => [
                'count' => $items->count(),
                'currentPage' => $page,
                'firstItem' => $items->first() ? ($page - 1) * $limit + 1 : null,
                'hasMorePages' => $page < $lastPage,
                'lastItem' => $items->count() > 0 ? ($page - 1) * $limit + $items->count() : null,
                'lastPage' => $lastPage,
                'perPage' => $limit,
                'total' => $total
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    public function getFilteredQuery(array $filter): Builder
    {
        $query = Property::query();

        // Apply search filter if provided
        if (isset($filter['search']) && !empty($filter['search'])) {
            $searchTerm = "%" . trim(strtolower($filter['search'])) . "%";
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm)
                    ->orWhereHas('location', function ($l) use ($searchTerm) {
                        $l->where('full_name', 'like', $searchTerm);
                    });
            });
        }

        // Apply sorting
        $sortKey = $filter['sortKey'] ?? 'CREATED_AT';
        $sortOrder = $filter['sortOrder'] ?? 'DESC';
        
        $columnMap = [
            'TITLE' => 'title',
            'PRICE' => 'price',
            'DATE_LISTED' => 'date_listed',
            'CREATED_AT' => 'created_at'
        ];

        $column = $columnMap[$sortKey] ?? 'created_at';
        $direction = $sortOrder === 'ASC' ? 'asc' : 'desc';
        
        $query->orderBy($column, $direction);

        return $query;
    }
} 