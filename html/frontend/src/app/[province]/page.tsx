"use client";

import { useQuery } from "@apollo/client";
import { notFound } from "next/navigation";
import { useState } from "react";
import { Button } from "../../components/atoms/Button/Button";
import { MainLayout } from "../../components/layouts/MainLayout";
import { VALID_PROVINCES } from "../../components/molecules/ProvinceSelector/ProvinceSelector";
import { SearchBox } from "../../components/molecules/SearchBox/SearchBox";
import { PropertyList } from "../../components/organisms/PropertyList/PropertyList";
import { GET_PROPERTIES } from "../../graphql/queries";
import { PropertySortKey, SortOrder } from "../../types/property";

interface ProvincePageProps {
  params: {
    province: string;
  };
}

export default function ProvincePage({ params }: ProvincePageProps) {
  const province = params.province.toLowerCase();
  const provinceData = VALID_PROVINCES.find((p) => p.id === province);

  // If province is not in our valid list, show 404
  if (!provinceData) {
    notFound();
  }

  const [filter, setFilter] = useState({
    page: 1,
    limit: 25,
    sortKey: PropertySortKey.CREATED_AT,
    sortOrder: SortOrder.DESC,
    search: "",
    province: provinceData.name,
  });

  const { loading, error, data } = useQuery(GET_PROPERTIES, {
    variables: {
      filter,
    },
  });

  const handleSearch = (query: string) => {
    setFilter((prev) => ({
      ...prev,
      search: query,
      page: 1,
    }));
  };

  const handleSort = (sortKey: PropertySortKey) => {
    setFilter((prev) => ({
      ...prev,
      sortKey,
      sortOrder:
        prev.sortKey === sortKey && prev.sortOrder === SortOrder.ASC
          ? SortOrder.DESC
          : SortOrder.ASC,
    }));
  };

  const handlePageChange = (page: number) => {
    setFilter((prev) => ({
      ...prev,
      page,
    }));
  };

  return (
    <MainLayout>
      <div className="space-y-6">
        <h2 className="text-2xl font-semibold capitalize mb-6">
          Properties in {provinceData.name}
        </h2>

        <div className="mb-8">
          <SearchBox onSearch={handleSearch} />
        </div>

        <div className="flex gap-4 mb-6">
          <Button
            onClick={() => handleSort(PropertySortKey.PRICE)}
            variant={
              filter.sortKey === PropertySortKey.PRICE ? "primary" : "outline"
            }
          >
            Price{" "}
            {filter.sortKey === PropertySortKey.PRICE &&
              (filter.sortOrder === SortOrder.ASC ? "↑" : "↓")}
          </Button>
          <Button
            onClick={() => handleSort(PropertySortKey.DATE_LISTED)}
            variant={
              filter.sortKey === PropertySortKey.DATE_LISTED
                ? "primary"
                : "outline"
            }
          >
            Date Listed{" "}
            {filter.sortKey === PropertySortKey.DATE_LISTED &&
              (filter.sortOrder === SortOrder.ASC ? "↑" : "↓")}
          </Button>
        </div>

        {error ? (
          <div className="text-red-600">Error loading properties</div>
        ) : loading ? (
          <div>Loading...</div>
        ) : (
          <PropertyList
            properties={data.properties.data}
            paginatorInfo={data.properties.paginatorInfo}
            onPageChange={handlePageChange}
          />
        )}
      </div>
    </MainLayout>
  );
}
