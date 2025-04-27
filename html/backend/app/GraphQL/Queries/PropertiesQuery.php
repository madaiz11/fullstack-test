<?php

namespace App\GraphQL\Queries;

use App\DTOs\PropertiesFilterDTO;
use App\Services\Interfaces\PropertyServiceInterface;
use App\Services\Validators\PropertyFilterValidator;
use GraphQL\Error\Error;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class PropertiesQuery
{
    private PropertyFilterValidator $validator;
    private PropertyServiceInterface $propertyService;

    public function __construct(
        PropertyFilterValidator $validator,
        PropertyServiceInterface $propertyService
    ) {
        $this->validator = $validator;
        $this->propertyService = $propertyService;
    }

    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue
     * @param  array  $args
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo
     * @return array
     * @throws \GraphQL\Error\Error
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $filterArray = $args['filter'] ?? [];

        // Validate filter
        if (!$this->validator->validate($filterArray)) {
            throw new Error('Invalid filter parameters: ' . $this->validator->getError());
        }

        // Map to DTO
        $filter = PropertiesFilterDTO::fromArray($filterArray);

        return $this->propertyService->getFilteredProperties($filter);
    }
} 