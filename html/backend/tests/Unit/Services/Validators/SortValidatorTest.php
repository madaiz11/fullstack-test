<?php

namespace Tests\Unit\Services\Validators;

use App\Services\Validators\SortValidator;
use Tests\TestCase;

class SortValidatorTest extends TestCase
{
    private SortValidator $validator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validator = new SortValidator();
    }

    public function test_validates_valid_sort_parameters()
    {
        $this->assertTrue($this->validator->validate([
            'sortKey' => 'TITLE',
            'sortOrder' => 'ASC'
        ]));
        $this->assertNull($this->validator->getError());

        $this->assertTrue($this->validator->validate([
            'sortKey' => 'PRICE',
            'sortOrder' => 'DESC'
        ]));
        $this->assertNull($this->validator->getError());
    }

    public function test_rejects_non_array_input()
    {
        $this->assertFalse($this->validator->validate('not an array'));
        $this->assertEquals('Sort parameters must be an array', $this->validator->getError());
    }

    public function test_rejects_invalid_sort_key_type()
    {
        $this->assertFalse($this->validator->validate([
            'sortKey' => 123,
            'sortOrder' => 'ASC'
        ]));
        $this->assertEquals('Sort key must be a string', $this->validator->getError());
    }

    public function test_rejects_invalid_sort_order_type()
    {
        $this->assertFalse($this->validator->validate([
            'sortKey' => 'TITLE',
            'sortOrder' => 123
        ]));
        $this->assertEquals('Sort order must be a string', $this->validator->getError());
    }

    public function test_rejects_invalid_sort_key()
    {
        $this->assertFalse($this->validator->validate([
            'sortKey' => 'INVALID_KEY',
            'sortOrder' => 'ASC'
        ]));
        $this->assertEquals(
            'Invalid sort key. Allowed values: TITLE, PRICE, DATE_LISTED, CREATED_AT',
            $this->validator->getError()
        );
    }

    public function test_rejects_invalid_sort_order()
    {
        $this->assertFalse($this->validator->validate([
            'sortKey' => 'TITLE',
            'sortOrder' => 'INVALID_ORDER'
        ]));
        $this->assertEquals(
            'Invalid sort order. Allowed values: ASC, DESC',
            $this->validator->getError()
        );
    }

    public function test_validates_all_valid_sort_keys()
    {
        $validSortKeys = ['TITLE', 'PRICE', 'DATE_LISTED', 'CREATED_AT'];
        foreach ($validSortKeys as $sortKey) {
            $this->assertTrue($this->validator->validate([
                'sortKey' => $sortKey,
                'sortOrder' => 'ASC'
            ]));
            $this->assertNull($this->validator->getError());
        }
    }

    public function test_validates_all_valid_sort_orders()
    {
        $validSortOrders = ['ASC', 'DESC'];
        foreach ($validSortOrders as $sortOrder) {
            $this->assertTrue($this->validator->validate([
                'sortKey' => 'TITLE',
                'sortOrder' => $sortOrder
            ]));
            $this->assertNull($this->validator->getError());
        }
    }
} 