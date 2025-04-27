import { render, screen } from "@testing-library/react";
import { describe, expect, it, vi } from "vitest";
import { ProvinceSelector, VALID_PROVINCES } from "./ProvinceSelector";

// Mock next/navigation
vi.mock("next/navigation", () => ({
  usePathname: vi.fn(),
}));

// Mock next/link
vi.mock("next/link", () => ({
  default: ({ children, href, className }: any) => (
    <a href={href} className={className}>
      {children}
    </a>
  ),
}));

import { usePathname } from "next/navigation";

describe("ProvinceSelector Component", () => {
  it("renders all provinces link", () => {
    vi.mocked(usePathname).mockReturnValue("/");
    render(<ProvinceSelector />);
    expect(screen.getByText("All Provinces")).toBeInTheDocument();
  });

  it("renders all province options", () => {
    vi.mocked(usePathname).mockReturnValue("/");
    render(<ProvinceSelector />);

    VALID_PROVINCES.forEach((province) => {
      expect(screen.getByText(province.name)).toBeInTheDocument();
    });
  });

  it("highlights current province selection", () => {
    vi.mocked(usePathname).mockReturnValue("/bangkok");
    render(<ProvinceSelector />);

    const bangkokLink = screen.getByText("Bangkok");
    expect(bangkokLink.className).toContain("bg-blue-100");
    expect(bangkokLink.className).toContain("text-blue-700");
  });

  it("shows non-selected provinces without highlight", () => {
    vi.mocked(usePathname).mockReturnValue("/bangkok");
    render(<ProvinceSelector />);

    const nonthaburiLink = screen.getByText("Nonthaburi");
    expect(nonthaburiLink.className).toContain("text-gray-600");
    expect(nonthaburiLink.className).not.toContain("bg-blue-100");
  });

  it("highlights All Provinces when on home page", () => {
    vi.mocked(usePathname).mockReturnValue("/");
    render(<ProvinceSelector />);

    const allProvincesLink = screen.getByText("All Provinces");
    expect(allProvincesLink.className).toContain("bg-blue-100");
    expect(allProvincesLink.className).toContain("text-blue-700");
  });
});
