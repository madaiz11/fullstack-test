import Link from "next/link";
import React from "react";
import { Property } from "../../../types/property";

type PropertyCardProps = Property;

export const PropertyCard: React.FC<PropertyCardProps> = ({
  id,
  title,
  price,
  location,
  date_listed,
  propertyType,
  size_w,
  size_h,
}) => {
  return (
    <Link href={`/${location.province.toLowerCase()}/${id}`}>
      <div className="rounded-lg border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200">
        <div className="p-4">
          <div className="flex justify-between items-start mb-2">
            <h3 className="text-lg font-semibold text-gray-900">{title}</h3>
            <span className="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">
              {propertyType.name}
            </span>
          </div>
          <p className="text-gray-600 mb-2">
            {location.district}, {location.province}
          </p>
          <p className="text-gray-600 mb-2">
            Size: {size_w}x{size_h} m²
          </p>
          <p className="text-xl font-bold text-blue-600">
            ฿{price.toLocaleString()}
          </p>
          <p className="text-sm text-gray-500 mt-2">
            Listed on: {new Date(date_listed).toLocaleDateString()}
          </p>
        </div>
      </div>
    </Link>
  );
};
