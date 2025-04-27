<?php

namespace Tests\Unit\GraphQL\Queries;

use App\GraphQL\Queries\PropertiesQuery;
use App\Services\Interfaces\PropertyServiceInterface;
use App\Services\Validators\PropertyFilterValidator;
use GraphQL\Error\Error;
use GraphQL\Type\Definition\ResolveInfo;
use Mockery;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Tests\TestCase;

class PropertiesQueryTest extends TestCase
{
    private PropertyServiceInterface $propertyService;
    private PropertyFilterValidator $validator;
    private PropertiesQuery $query;
    private ResolveInfo $resolveInfo;
    private GraphQLContext $context;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->propertyService = Mockery::mock(PropertyServiceInterface::class);
        $this->validator = Mockery::mock(PropertyFilterValidator::class);
        $this->resolveInfo = Mockery::mock(ResolveInfo::class);
        $this->context = Mockery::mock(GraphQLContext::class);
        
        $this->query = new PropertiesQuery($this->validator, $this->propertyService);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_invoke_with_valid_filter()
    {
        $filter = [
            'search' => 'test',
            'page' => 1,
            'limit' => 12
        ];

        $expectedResult = [
            'data' => [],
            'paginatorInfo' => [
                'count' => 0,
                'currentPage' => 1,
                'lastPage' => 1,
                'total' => 0
            ]
        ];

        $this->validator->shouldReceive('validate')
            ->once()
            ->with($filter)
            ->andReturn(true);

        $this->propertyService->shouldReceive('getFilteredProperties')
            ->once()
            ->with($filter)
            ->andReturn($expectedResult);

        $result = ($this->query)(null, ['filter' => $filter], $this->context, $this->resolveInfo);

        $this->assertEquals($expectedResult, $result);
    }

    public function test_invoke_with_invalid_filter()
    {
        $filter = [
            'search' => '', // Invalid search term
            'page' => 0,    // Invalid page number
            'limit' => 1000 // Invalid limit
        ];

        $this->validator->shouldReceive('validate')
            ->once()
            ->with($filter)
            ->andReturn(false);

        $this->validator->shouldReceive('getError')
            ->once()
            ->andReturn('Invalid filter parameters');

        $this->expectException(Error::class);
        $this->expectExceptionMessage('Invalid filter parameters: Invalid filter parameters');

        ($this->query)(null, ['filter' => $filter], $this->context, $this->resolveInfo);
    }

    public function test_invoke_with_empty_filter()
    {
        $expectedResult = [
            'data' => [],
            'paginatorInfo' => [
                'count' => 0,
                'currentPage' => 1,
                'lastPage' => 1,
                'total' => 0
            ]
        ];

        $this->validator->shouldReceive('validate')
            ->once()
            ->with([])
            ->andReturn(true);

        $this->propertyService->shouldReceive('getFilteredProperties')
            ->once()
            ->with([])
            ->andReturn($expectedResult);

        $result = ($this->query)(null, [], $this->context, $this->resolveInfo);

        $this->assertEquals($expectedResult, $result);
    }

    public function test_invoke_with_default_values()
    {
        $filter = [
            'page' => 1,
            'limit' => 12,
            'sortKey' => 'CREATED_AT',
            'sortOrder' => 'DESC'
        ];

        $expectedResult = [
            'data' => [],
            'paginatorInfo' => [
                'count' => 0,
                'currentPage' => 1,
                'lastPage' => 1,
                'total' => 0
            ]
        ];

        $this->validator->shouldReceive('validate')
            ->once()
            ->with($filter)
            ->andReturn(true);

        $this->propertyService->shouldReceive('getFilteredProperties')
            ->once()
            ->with($filter)
            ->andReturn($expectedResult);

        $result = ($this->query)(null, ['filter' => $filter], $this->context, $this->resolveInfo);

        $this->assertEquals($expectedResult, $result);
    }
} 