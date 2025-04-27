<?php

namespace App\DTOs;

class PropertiesFilterDTO
{
    public function __construct(
        public readonly ?string $search = null,
        public readonly int $page = 1,
        public readonly int $limit = 12,
        public readonly string $sortKey = 'CREATED_AT',
        public readonly string $sortOrder = 'DESC',
        public readonly ?string $province = null
    ) {}

    public static function fromArray(array $filter): self
    {
        return new self(
            search: $filter['search'] ?? null,
            page: $filter['page'] ?? 1,
            limit: $filter['limit'] ?? 12,
            sortKey: $filter['sortKey'] ?? 'CREATED_AT',
            sortOrder: $filter['sortOrder'] ?? 'DESC',
            province: $filter['province'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'search' => $this->search,
            'page' => $this->page,
            'limit' => $this->limit,
            'sortKey' => $this->sortKey,
            'sortOrder' => $this->sortOrder,
            'province' => $this->province,
        ];
    }
} 