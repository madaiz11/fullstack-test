import { render, screen } from "@testing-library/react";
import { describe, expect, it } from "vitest";
import { PropertyCard } from "./PropertyCard";

const mockProperty = {
  id: "1",
  title: "Beautiful House",
  description: "A lovely family home",
  price: 1500000,
  location: {
    province: "Bangkok",
    district: "Watthana",
    sub_district: "Khlong Toei Nuea",
    zipcode: "10110",
  },
  date_listed: "2024-03-20",
  status: "available",
  propertyType: {
    name: "House",
  },
  size_w: 10,
  size_h: 15,
};

describe("PropertyCard Component", () => {
  it("renders property title correctly", () => {
    render(<PropertyCard {...mockProperty} />);
    expect(screen.getByText("Beautiful House")).toBeInTheDocument();
  });

  it("renders property type badge", () => {
    render(<PropertyCard {...mockProperty} />);
    expect(screen.getByText("House")).toBeInTheDocument();
  });

  it("renders location information", () => {
    render(<PropertyCard {...mockProperty} />);
    expect(screen.getByText("Watthana, Bangkok")).toBeInTheDocument();
  });

  it("renders size information", () => {
    render(<PropertyCard {...mockProperty} />);
    expect(screen.getByText("Size: 10x15 m²")).toBeInTheDocument();
  });

  it("renders formatted price", () => {
    render(<PropertyCard {...mockProperty} />);
    expect(screen.getByText("฿1,500,000")).toBeInTheDocument();
  });

  it("renders formatted date", () => {
    render(<PropertyCard {...mockProperty} />);
    const date = new Date("2024-03-20").toLocaleDateString();
    expect(screen.getByText(`Listed on: ${date}`)).toBeInTheDocument();
  });
});
