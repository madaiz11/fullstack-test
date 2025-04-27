<?php

namespace App\GraphQL\Queries;

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
        $filter = $args['filter'] ?? [];

        // Validate filter
        if (!$this->validator->validate($filter)) {
            throw new Error('Invalid filter parameters: ' . $this->validator->getError());
        }

        return $this->propertyService->getFilteredProperties($filter);
    }
} 