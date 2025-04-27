import { gql } from "@apollo/client";

/**
 * Get all properties
 * @Input PropertyFilterInput
 * @Output PropertyPaginatorResult
 *
 * # Add these input types at the top level
input PropertyFilterInput {
    search: String
    page: Int = 1
    limit: Int = 12
    sortKey: PropertySortKey = CREATED_AT
    sortOrder: SortOrder = DESC
}

enum PropertySortKey {
    TITLE
    PRICE
    DATE_LISTED
    CREATED_AT
}

enum SortOrder {
    ASC
    DESC
}
 * 

# Add the paginator result type
type PropertyPaginatorResult {
    data: [Property!]!
    paginatorInfo: PaginatorInfo!
}

type PaginatorInfo {
    count: Int!
    currentPage: Int!
    firstItem: Int
    hasMorePages: Boolean!
    lastItem: Int
    lastPage: Int!
    perPage: Int!
    total: Int!
}

 */
export const GET_PROPERTIES = gql`
  query GetProperties($filter: PropertyFilterInput) {
    properties(filter: $filter) {
      data {
        id
        title
        description
        price
        size_w
        size_h
        date_listed
        status
        location {
          province
          zipcode
          district
          sub_district
        }
        propertyType {
          name
        }
      }
      paginatorInfo {
        currentPage
        lastPage
        total
        hasMorePages
      }
    }
  }
`;

export const GET_PROPERTY = gql`
  query GetProperty($id: ID!) {
    property(id: $id) {
      id
      title
      price
      location
      province
      imageUrl
      dateListed
      description
    }
  }
`;
