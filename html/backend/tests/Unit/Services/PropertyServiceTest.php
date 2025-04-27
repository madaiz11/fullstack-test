<?php

namespace Tests\Unit\Services;

use App\DTOs\PropertiesFilterDTO;
use App\Models\Property;
use App\Models\Location;
use App\Services\PropertyService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyServiceTest extends TestCase
{
    use RefreshDatabase;

    private PropertyService $propertyService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->propertyService = new PropertyService();
    }

    public function test_find_by_id_returns_correct_property()
    {
        $property = Property::factory()->create();

        $result = $this->propertyService->findById($property->id);

        $this->assertEquals($property->id, $result->id);
        $this->assertEquals($property->title, $result->title);
    }

    public function test_get_all_returns_all_properties()
    {
        $properties = Property::factory()->count(3)->create();

        $result = $this->propertyService->getAll();

        $this->assertCount(3, $result);
        $this->assertEquals($properties->pluck('id')->sort()->values(), $result->pluck('id')->sort()->values());
    }

    public function test_get_filtered_properties_with_search()
    {
        // Create test data
        $location = Location::factory()->create(['full_name' => 'Test Location']);
        $matchingProperty = Property::factory()->create([
            'title' => 'Beach House',
            'location_id' => $location->id
        ]);
        Property::factory()->create(['title' => 'Mountain Cabin']);

        $filter = new PropertiesFilterDTO(
            search: 'beach',
            page: 1,
            limit: 12
        );

        $result = $this->propertyService->getFilteredProperties($filter);

        $this->assertCount(1, $result['data']);
        $this->assertEquals($matchingProperty->id, $result['data'][0]->id);
    }

    public function test_get_filtered_properties_with_location_search()
    {
        $location = Location::factory()->create(['full_name' => 'Bangkok']);
        $matchingProperty = Property::factory()->create([
            'location_id' => $location->id
        ]);
        Property::factory()->create();

        $filter = new PropertiesFilterDTO(
            search: 'bangkok',
            page: 1,
            limit: 12
        );

        $result = $this->propertyService->getFilteredProperties($filter);

        $this->assertCount(1, $result['data']);
        $this->assertEquals($matchingProperty->id, $result['data'][0]->id);
    }

    public function test_get_filtered_properties_with_sorting()
    {
        Property::factory()->create(['price' => 1000000]);
        Property::factory()->create(['price' => 2000000]);
        Property::factory()->create(['price' => 500000]);

        $filter = new PropertiesFilterDTO(
            sortKey: 'PRICE',
            sortOrder: 'DESC',
            page: 1,
            limit: 12
        );

        $result = $this->propertyService->getFilteredProperties($filter);

        $this->assertCount(3, $result['data']);
        $this->assertEquals(2000000, $result['data'][0]->price);
        $this->assertEquals(1000000, $result['data'][1]->price);
        $this->assertEquals(500000, $result['data'][2]->price);
    }

    public function test_get_filtered_properties_with_pagination()
    {
        Property::factory()->count(15)->create();

        $filter = new PropertiesFilterDTO(
            page: 2,
            limit: 10
        );

        $result = $this->propertyService->getFilteredProperties($filter);

        $this->assertCount(5, $result['data']);
        $this->assertEquals(2, $result['paginatorInfo']['currentPage']);
        $this->assertEquals(15, $result['paginatorInfo']['total']);
        $this->assertEquals(2, $result['paginatorInfo']['lastPage']);
    }

    public function test_get_filtered_query_applies_correct_filters()
    {
        Property::factory()->count(5)->create();

        $filter = new PropertiesFilterDTO(
            search: 'test',
            sortKey: 'PRICE',
            sortOrder: 'ASC'
        );

        $query = $this->propertyService->getFilteredQuery($filter);

        // Assert the query has the correct where and order by clauses
        $this->assertStringContainsString('select * from `property`', $query->toSql());
        $this->assertStringContainsString('order by `price` asc', $query->toSql());
    }
} 