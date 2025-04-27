<?php

namespace Tests\Unit\Services\Validators;

use App\Services\Validators\ProvinceValidator;
use PHPUnit\Framework\TestCase;

class ProvinceValidatorTest extends TestCase
{
    private ProvinceValidator $validator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validator = new ProvinceValidator();
    }

    public function testValidProvinceNameShouldPass()
    {
        $this->assertTrue($this->validator->validate('Bangkok'));
        $this->assertNull($this->validator->getError());
    }

    public function testNonStringValueShouldFail()
    {
        $this->assertFalse($this->validator->validate(123));
        $this->assertEquals('Province must be a string', $this->validator->getError());
    }

    public function testEmptyStringShouldFail()
    {
        $this->assertFalse($this->validator->validate(''));
        $this->assertEquals('Province cannot be empty', $this->validator->getError());

        $this->assertFalse($this->validator->validate('   '));
        $this->assertEquals('Province cannot be empty', $this->validator->getError());
    }

    public function testTooLongProvinceShouldFail()
    {
        $longProvince = str_repeat('a', 101);
        $this->assertFalse($this->validator->validate($longProvince));
        $this->assertEquals('Province must not exceed 100 characters', $this->validator->getError());
    }

    public function testMaxLengthProvinceShouldPass()
    {
        $maxLengthProvince = str_repeat('a', 100);
        $this->assertTrue($this->validator->validate($maxLengthProvince));
        $this->assertNull($this->validator->getError());
    }
} 