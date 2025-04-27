import { render, screen } from "@testing-library/react";
import userEvent from "@testing-library/user-event";
import { describe, expect, it, vi } from "vitest";
import { SearchBox } from "./SearchBox";

describe("SearchBox Component", () => {
  it("renders with default placeholder", () => {
    render(<SearchBox onSearch={() => {}} />);
    expect(
      screen.getByPlaceholderText("Search properties...")
    ).toBeInTheDocument();
  });

  it("renders with custom placeholder", () => {
    render(<SearchBox onSearch={() => {}} placeholder="Custom placeholder" />);
    expect(
      screen.getByPlaceholderText("Custom placeholder")
    ).toBeInTheDocument();
  });

  it("renders search button", () => {
    render(<SearchBox onSearch={() => {}} />);
    expect(screen.getByRole("button", { name: /search/i })).toBeInTheDocument();
  });

  it("updates input value on user typing", async () => {
    render(<SearchBox onSearch={() => {}} />);
    const input = screen.getByPlaceholderText("Search properties...");

    await userEvent.type(input, "test query");
    expect(input).toHaveValue("test query");
  });

  it("calls onSearch with input value when form is submitted", async () => {
    const handleSearch = vi.fn();
    render(<SearchBox onSearch={handleSearch} />);

    const input = screen.getByPlaceholderText("Search properties...");
    const searchButton = screen.getByRole("button", { name: /search/i });

    await userEvent.type(input, "test query");
    await userEvent.click(searchButton);

    expect(handleSearch).toHaveBeenCalledWith("test query");
  });

  it("calls onSearch when Enter key is pressed", async () => {
    const handleSearch = vi.fn();
    render(<SearchBox onSearch={handleSearch} />);

    const input = screen.getByPlaceholderText("Search properties...");

    await userEvent.type(input, "test query{enter}");

    expect(handleSearch).toHaveBeenCalledWith("test query");
  });
});
