<?php

namespace Tests\Unit\DTOs;

use App\DTOs\PropertiesFilterDTO;
use PHPUnit\Framework\TestCase;

class PropertiesFilterDTOTest extends TestCase
{
    public function test_constructor_with_default_values()
    {
        $dto = new PropertiesFilterDTO();

        $this->assertNull($dto->search);
        $this->assertEquals(1, $dto->page);
        $this->assertEquals(12, $dto->limit);
        $this->assertEquals('CREATED_AT', $dto->sortKey);
        $this->assertEquals('DESC', $dto->sortOrder);
        $this->assertNull($dto->province);
    }

    public function test_constructor_with_custom_values()
    {
        $dto = new PropertiesFilterDTO(
            search: 'test search',
            page: 2,
            limit: 20,
            sortKey: 'PRICE',
            sortOrder: 'ASC',
            province: 'Bangkok'
        );

        $this->assertEquals('test search', $dto->search);
        $this->assertEquals(2, $dto->page);
        $this->assertEquals(20, $dto->limit);
        $this->assertEquals('PRICE', $dto->sortKey);
        $this->assertEquals('ASC', $dto->sortOrder);
        $this->assertEquals('Bangkok', $dto->province);
    }

    public function test_from_array_with_empty_array()
    {
        $dto = PropertiesFilterDTO::fromArray([]);

        $this->assertNull($dto->search);
        $this->assertEquals(1, $dto->page);
        $this->assertEquals(12, $dto->limit);
        $this->assertEquals('CREATED_AT', $dto->sortKey);
        $this->assertEquals('DESC', $dto->sortOrder);
        $this->assertNull($dto->province);
    }

    public function test_from_array_with_partial_data()
    {
        $dto = PropertiesFilterDTO::fromArray([
            'search' => 'test search',
            'page' => 2
        ]);

        $this->assertEquals('test search', $dto->search);
        $this->assertEquals(2, $dto->page);
        $this->assertEquals(12, $dto->limit); // default value
        $this->assertEquals('CREATED_AT', $dto->sortKey); // default value
        $this->assertEquals('DESC', $dto->sortOrder); // default value
        $this->assertNull($dto->province); // default value
    }

    public function test_from_array_with_complete_data()
    {
        $data = [
            'search' => 'test search',
            'page' => 2,
            'limit' => 20,
            'sortKey' => 'PRICE',
            'sortOrder' => 'ASC',
            'province' => 'Bangkok'
        ];

        $dto = PropertiesFilterDTO::fromArray($data);

        $this->assertEquals($data['search'], $dto->search);
        $this->assertEquals($data['page'], $dto->page);
        $this->assertEquals($data['limit'], $dto->limit);
        $this->assertEquals($data['sortKey'], $dto->sortKey);
        $this->assertEquals($data['sortOrder'], $dto->sortOrder);
        $this->assertEquals($data['province'], $dto->province);
    }

    public function test_to_array()
    {
        $data = [
            'search' => 'test search',
            'page' => 2,
            'limit' => 20,
            'sortKey' => 'PRICE',
            'sortOrder' => 'ASC',
            'province' => 'Bangkok'
        ];

        $dto = PropertiesFilterDTO::fromArray($data);
        $array = $dto->toArray();

        $this->assertEquals($data, $array);
    }

    public function test_properties_are_readonly()
    {
        $dto = new PropertiesFilterDTO();
        
        $this->expectException(\Error::class);
        $dto->page = 2;
    }
} 