<?php

namespace App\Services\Interfaces;

interface ServiceInterface
{
    /**
     * Get a single record by ID
     *
     * @param int|string $id
     * @return mixed
     */
    public function findById($id);

    /**
     * Get all records
     *
     * @return mixed
     */
    public function getAll();
} 