import Link from "next/link";
import { usePathname } from "next/navigation";
import React from "react";

// TODO: Add provinces from backend
export const VALID_PROVINCES = [
  { id: "bangkok", name: "Bangkok" },
  { id: "nonthaburi", name: "Nonthaburi" },
  { id: "pathum-thani", name: "Pathum Thani" },
  { id: "samut-prakan", name: "Samut Prakan" },
  { id: "chonburi", name: "Chonburi" },
] as const;

export const ProvinceSelector: React.FC = () => {
  const pathname = usePathname();

  return (
    <nav className="bg-white shadow-sm mb-6">
      <div className="container mx-auto px-4 py-2">
        <div className="flex gap-4 overflow-x-auto pb-2">
          <Link
            href="/"
            className={`px-4 py-2 rounded-full whitespace-nowrap ${
              pathname === "/"
                ? "bg-blue-100 text-blue-700"
                : "text-gray-600 hover:text-gray-900"
            }`}
          >
            All Provinces
          </Link>
          {VALID_PROVINCES.map((province) => (
            <Link
              key={province.id}
              href={`/${province.id}`}
              className={`px-4 py-2 rounded-full whitespace-nowrap ${
                pathname === `/${province.id}`
                  ? "bg-blue-100 text-blue-700"
                  : "text-gray-600 hover:text-gray-900"
              }`}
            >
              {province.name}
            </Link>
          ))}
        </div>
      </div>
    </nav>
  );
};
