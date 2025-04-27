"use client";

import Link from "next/link";
import React from "react";
import { ProvinceSelector } from "../molecules/ProvinceSelector/ProvinceSelector";

interface MainLayoutProps {
  children: React.ReactNode;
}

export const MainLayout: React.FC<MainLayoutProps> = ({ children }) => {
  return (
    <div className="min-h-screen bg-gray-50">
      <header className="bg-white shadow-sm">
        <div className="container mx-auto px-4 py-4">
          <Link href="/" className="block">
            <h1 className="text-2xl font-bold text-gray-900">
              Property Listings
            </h1>
          </Link>
        </div>
      </header>

      <ProvinceSelector />

      <main className="container mx-auto px-4 py-8">{children}</main>

      <footer className="bg-white border-t">
        <div className="container mx-auto px-4 py-6">
          <p className="text-center text-gray-600">
            © {new Date().getFullYear()} Property Listings. All rights reserved.
          </p>
        </div>
      </footer>
    </div>
  );
};
