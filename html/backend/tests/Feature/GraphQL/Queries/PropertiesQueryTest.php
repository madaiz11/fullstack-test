<?php

namespace Tests\Feature\GraphQL\Queries;

use App\Models\Location;
use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class PropertiesQueryTest extends TestCase
{
    use RefreshDatabase, MakesGraphQLRequests;

    private string $propertiesQuery = '
        query GetProperties($filter: PropertyFilterInput) {
            properties(filter: $filter) {
                data {
                    id
                    title
                    price
                    location {
                        full_name
                    }
                }
                paginatorInfo {
                    count
                    currentPage
                    total
                    lastPage
                }
            }
        }
    ';

    public function test_can_query_properties_with_pagination()
    {
        Property::factory()->count(15)->create();

        $response = $this->postGraphQL([
            'query' => $this->propertiesQuery,
            'variables' => [
                'filter' => [
                    'page' => 2,
                    'limit' => 10
                ]
            ]
        ]);

        $response->assertJson([
            'data' => [
                'properties' => [
                    'data' => [],
                    'paginatorInfo' => [
                        'count' => 5,
                        'currentPage' => 2,
                        'total' => 15,
                        'lastPage' => 2
                    ]
                ]
            ]
        ]);
    }

    public function test_can_query_properties_with_search()
    {
        $location = Location::factory()->create(['full_name' => 'Test Location']);
        Property::factory()->create([
            'title' => 'Beach House',
            'location_id' => $location->id
        ]);
        Property::factory()->create(['title' => 'Mountain Villa']);

        $response = $this->postGraphQL([
            'query' => $this->propertiesQuery,
            'variables' => [
                'filter' => [
                    'search' => 'beach'
                ]
            ]
        ]);

        $response->assertJson([
            'data' => [
                'properties' => [
                    'data' => [
                        [
                            'title' => 'Beach House'
                        ]
                    ],
                    'paginatorInfo' => [
                        'count' => 1,
                        'total' => 1
                    ]
                ]
            ]
        ]);
    }

    public function test_can_query_properties_with_sorting()
    {
        Property::factory()->create(['price' => 1000000]);
        Property::factory()->create(['price' => 2000000]);
        Property::factory()->create(['price' => 500000]);

        $response = $this->postGraphQL([
            'query' => $this->propertiesQuery,
            'variables' => [
                'filter' => [
                    'sortKey' => 'PRICE',
                    'sortOrder' => 'DESC'
                ]
            ]
        ]);

        $responseData = $response->json('data.properties.data');
        $prices = array_column($responseData, 'price');

        $this->assertEquals([2000000, 1000000, 500000], $prices);
    }

    public function test_can_query_properties_with_location()
    {
        $location = Location::factory()->create(['full_name' => 'Bangkok']);
        Property::factory()->create([
            'title' => 'City Apartment',
            'location_id' => $location->id
        ]);

        $response = $this->postGraphQL([
            'query' => $this->propertiesQuery,
            'variables' => [
                'filter' => [
                    'search' => 'bangkok'
                ]
            ]
        ]);

        $response->assertJson([
            'data' => [
                'properties' => [
                    'data' => [
                        [
                            'location' => [
                                'full_name' => 'Bangkok'
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function test_returns_empty_result_for_no_matches()
    {
        Property::factory()->count(5)->create();

        $response = $this->postGraphQL([
            'query' => $this->propertiesQuery,
            'variables' => [
                'filter' => [
                    'search' => 'nonexistent'
                ]
            ]
        ]);

        $response->assertJson([
            'data' => [
                'properties' => [
                    'data' => [],
                    'paginatorInfo' => [
                        'count' => 0,
                        'total' => 0
                    ]
                ]
            ]
        ]);
    }
} 