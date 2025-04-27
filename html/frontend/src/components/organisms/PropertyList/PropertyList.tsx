"use client";

import React from "react";
import { PaginatorInfo, Property } from "../../../types/property";
import { Button } from "../../atoms/Button/Button";
import { PropertyCard } from "../../molecules/PropertyCard/PropertyCard";

interface PropertyListProps {
  properties: Property[];
  paginatorInfo: PaginatorInfo;
  onPageChange: (page: number) => void;
}

export const PropertyList: React.FC<PropertyListProps> = ({
  properties,
  paginatorInfo,
  onPageChange,
}) => {
  if (!properties.length) {
    return (
      <div className="text-center py-12 bg-white rounded-lg shadow-sm">
        <div className="mb-4">
          <svg
            className="mx-auto h-12 w-12 text-gray-400"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            aria-hidden="true"
          >
            <path
              strokeLinecap="round"
              strokeLinejoin="round"
              strokeWidth={2}
              d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"
            />
          </svg>
        </div>
        <h3 className="mt-2 text-sm font-medium text-gray-900">
          No properties found
        </h3>
        <p className="mt-1 text-sm text-gray-500">
          Try adjusting your search or filter criteria to find what you're
          looking for.
        </p>
      </div>
    );
  }

  return (
    <div className="space-y-6">
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {properties.map((property) => (
          <PropertyCard key={property.id} {...property} />
        ))}
      </div>

      <div className="flex justify-center gap-2 mt-8">
        <Button
          onClick={() => onPageChange(paginatorInfo.currentPage - 1)}
          disabled={paginatorInfo.currentPage === 1}
          variant="outline"
        >
          Previous
        </Button>

        <div className="flex gap-2">
          {Array.from({ length: paginatorInfo.lastPage }, (_, i) => i + 1).map(
            (page) => (
              <Button
                key={page}
                onClick={() => onPageChange(page)}
                variant={
                  paginatorInfo.currentPage === page ? "primary" : "outline"
                }
              >
                {page}
              </Button>
            )
          )}
        </div>

        <Button
          onClick={() => onPageChange(paginatorInfo.currentPage + 1)}
          disabled={!paginatorInfo.hasMorePages}
          variant="outline"
        >
          Next
        </Button>
      </div>
    </div>
  );
};
