<?php

namespace Tests\Unit\Services\Validators;

use App\Services\Validators\PaginationValidator;
use Tests\TestCase;

class PaginationValidatorTest extends TestCase
{
    private PaginationValidator $validator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validator = new PaginationValidator();
    }

    public function test_validates_valid_pagination_parameters()
    {
        $this->assertTrue($this->validator->validate([
            'page' => 1,
            'limit' => 10
        ]));
        $this->assertNull($this->validator->getError());
    }

    public function test_rejects_non_array_input()
    {
        $this->assertFalse($this->validator->validate('not an array'));
        $this->assertEquals('Pagination parameters must be an array', $this->validator->getError());
    }

    public function test_rejects_invalid_page_type()
    {
        $this->assertFalse($this->validator->validate([
            'page' => '1',
            'limit' => 10
        ]));
        $this->assertEquals('Page must be an integer', $this->validator->getError());
    }

    public function test_rejects_invalid_limit_type()
    {
        $this->assertFalse($this->validator->validate([
            'page' => 1,
            'limit' => '10'
        ]));
        $this->assertEquals('Limit must be an integer', $this->validator->getError());
    }

    public function test_rejects_out_of_range_page()
    {
        $this->assertFalse($this->validator->validate([
            'page' => 0,
            'limit' => 10
        ]));
        $this->assertEquals('Page must be between 1 and 1000', $this->validator->getError());

        $this->assertFalse($this->validator->validate([
            'page' => 1001,
            'limit' => 10
        ]));
        $this->assertEquals('Page must be between 1 and 1000', $this->validator->getError());
    }

    public function test_rejects_out_of_range_limit()
    {
        $this->assertFalse($this->validator->validate([
            'page' => 1,
            'limit' => 0
        ]));
        $this->assertEquals('Limit must be between 1 and 100', $this->validator->getError());

        $this->assertFalse($this->validator->validate([
            'page' => 1,
            'limit' => 101
        ]));
        $this->assertEquals('Limit must be between 1 and 100', $this->validator->getError());
    }

    public function test_validates_boundary_cases()
    {
        // Test minimum values
        $this->assertTrue($this->validator->validate([
            'page' => 1,
            'limit' => 1
        ]));

        // Test maximum values
        $this->assertTrue($this->validator->validate([
            'page' => 1000,
            'limit' => 100
        ]));
    }
} 