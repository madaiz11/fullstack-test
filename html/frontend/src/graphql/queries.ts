import { gql } from "@apollo/client";

/**
 * Get all properties
 * @Input PropertyFilterInput
 * @Output PropertyPaginatorResult
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
  }
`;
