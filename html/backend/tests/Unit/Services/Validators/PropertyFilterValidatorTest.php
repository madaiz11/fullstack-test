<?php

namespace Tests\Unit\Services\Validators;

use App\Services\Validators\PropertyFilterValidator;
use Tests\TestCase;

class PropertyFilterValidatorTest extends TestCase
{
    private PropertyFilterValidator $validator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validator = new PropertyFilterValidator();
    }

    public function test_validates_complete_valid_filter()
    {
        $filter = [
            'search' => 'test search',
            'page' => 1,
            'limit' => 12,
            'sortKey' => 'TITLE',
            'sortOrder' => 'ASC'
        ];

        $this->assertTrue($this->validator->validate($filter));
        $this->assertNull($this->validator->getError());
        $this->assertEmpty($this->validator->getAllErrors());
    }

    public function test_validates_minimal_valid_filter()
    {
        $filter = [
            'page' => 1,
            'limit' => 12
        ];

        $this->assertTrue($this->validator->validate($filter));
        $this->assertNull($this->validator->getError());
        $this->assertEmpty($this->validator->getAllErrors());
    }

    public function test_rejects_non_array_input()
    {
        $this->assertFalse($this->validator->validate('not an array'));
        $this->assertEquals('Filter must be an array', $this->validator->getError());
    }

    public function test_rejects_invalid_search()
    {
        $filter = [
            'search' => 'a', // Too short
            'page' => 1,
            'limit' => 12
        ];

        $this->assertFalse($this->validator->validate($filter));
        $this->assertNotNull($this->validator->getError());
        $this->assertArrayHasKey('search', $this->validator->getAllErrors());
    }

    public function test_rejects_invalid_pagination()
    {
        $filter = [
            'page' => 0, // Invalid page
            'limit' => 101 // Invalid limit
        ];

        $this->assertFalse($this->validator->validate($filter));
        $this->assertNotNull($this->validator->getError());
        $this->assertArrayHasKey('pagination', $this->validator->getAllErrors());
    }

    public function test_rejects_invalid_sorting()
    {
        $filter = [
            'page' => 1,
            'limit' => 12,
            'sortKey' => 'INVALID',
            'sortOrder' => 'INVALID'
        ];

        $this->assertFalse($this->validator->validate($filter));
        $this->assertNotNull($this->validator->getError());
        $this->assertArrayHasKey('sort', $this->validator->getAllErrors());
    }

    public function test_collects_multiple_validation_errors()
    {
        $filter = [
            'search' => 'a', // Too short
            'page' => 0, // Invalid page
            'sortKey' => 'INVALID' // Invalid sort key
        ];

        $this->assertFalse($this->validator->validate($filter));
        $errors = $this->validator->getAllErrors();
        
        $this->assertArrayHasKey('search', $errors);
        $this->assertArrayHasKey('pagination', $errors);
        $this->assertArrayHasKey('sort', $errors);
    }

    public function test_validates_with_default_values()
    {
        $filter = []; // Empty filter should use defaults

        $this->assertTrue($this->validator->validate($filter));
        $this->assertNull($this->validator->getError());
        $this->assertEmpty($this->validator->getAllErrors());
    }
} 