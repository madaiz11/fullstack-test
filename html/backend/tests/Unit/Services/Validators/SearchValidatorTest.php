<?php

namespace Tests\Unit\Services\Validators;

use App\Services\Validators\SearchValidator;
use Tests\TestCase;

class SearchValidatorTest extends TestCase
{
    private SearchValidator $validator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validator = new SearchValidator();
    }

    public function test_validates_valid_search_term()
    {
        $this->assertTrue($this->validator->validate('valid search'));
        $this->assertNull($this->validator->getError());
    }

    public function test_rejects_non_string_input()
    {
        $this->assertFalse($this->validator->validate(123));
        $this->assertEquals('Search term must be a string', $this->validator->getError());
    }

    public function test_rejects_too_short_search_term()
    {
        $this->assertFalse($this->validator->validate('a'));
        $this->assertEquals('Search term must be at least 2 characters long', $this->validator->getError());
    }

    public function test_rejects_too_long_search_term()
    {
        $longString = str_repeat('a', 101);
        $this->assertFalse($this->validator->validate($longString));
        $this->assertEquals('Search term must not exceed 100 characters', $this->validator->getError());
    }

    public function test_validates_boundary_cases()
    {
        // Test minimum length (2 characters)
        $this->assertTrue($this->validator->validate('ab'));
        
        // Test maximum length (100 characters)
        $this->assertTrue($this->validator->validate(str_repeat('a', 100)));
    }
} 