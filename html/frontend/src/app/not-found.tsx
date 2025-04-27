"use client";

import Link from "next/link";
import { VALID_PROVINCES } from "../components/molecules/ProvinceSelector/ProvinceSelector";

export default function NotFound() {
  return (
    <div className="min-h-screen flex items-center justify-center bg-gray-50">
      <div className="max-w-md w-full p-6 bg-white rounded-lg shadow-md">
        <h1 className="text-3xl font-bold text-gray-900 mb-4">
          404 - Province Not Found
        </h1>
        <p className="text-gray-600 mb-6">
          The province you're looking for doesn't exist. Please choose from one
          of our available provinces:
        </p>
        <div className="space-y-2 mb-8">
          {VALID_PROVINCES.map((province) => (
            <Link
              key={province.id}
              href={`/${province.id}`}
              className="block text-blue-600 hover:text-blue-800 hover:underline"
            >
              {province.name}
            </Link>
          ))}
        </div>
        <Link
          href="/"
          className="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors"
        >
          View All Properties
        </Link>
      </div>
    </div>
  );
}
