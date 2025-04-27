export interface Location {
  province: string;
  zipcode: string;
  district: string;
  sub_district: string;
}

export interface PropertyType {
  name: string;
}

export interface Property {
  id: string;
  title: string;
  description: string;
  price: number;
  size_w: number;
  size_h: number;
  date_listed: string;
  status: string;
  location: Location;
  propertyType: PropertyType;
}

export interface PaginatorInfo {
  count: number;
  currentPage: number;
  firstItem: number | null;
  hasMorePages: boolean;
  lastItem: number | null;
  lastPage: number;
  perPage: number;
  total: number;
}

export interface PropertyPaginatorResult {
  data: Property[];
  paginatorInfo: PaginatorInfo;
}

export enum PropertySortKey {
  TITLE = "TITLE",
  PRICE = "PRICE",
  DATE_LISTED = "DATE_LISTED",
  CREATED_AT = "CREATED_AT",
}

export enum SortOrder {
  ASC = "ASC",
  DESC = "DESC",
}

export interface PropertyFilterInput {
  search?: string;
  page?: number;
  limit?: number;
  sortKey?: PropertySortKey;
  sortOrder?: SortOrder;
}
