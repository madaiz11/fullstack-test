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
