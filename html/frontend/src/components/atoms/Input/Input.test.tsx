import { render, screen } from "@testing-library/react";
import userEvent from "@testing-library/user-event";
import { describe, expect, it } from "vitest";
import { Input } from "./Input";

describe("Input Component", () => {
  it("renders basic input without label or error", () => {
    render(<Input placeholder="Enter text" />);
    const input = screen.getByPlaceholderText("Enter text");
    expect(input).toBeInTheDocument();
    expect(input).toHaveClass("rounded-md", "border", "border-gray-300");
  });

  it("renders with label", () => {
    render(<Input label="Username" placeholder="Enter username" />);
    expect(screen.getByText("Username")).toBeInTheDocument();
    expect(screen.getByPlaceholderText("Enter username")).toBeInTheDocument();
  });

  it("renders with error message", () => {
    render(<Input error="This field is required" placeholder="Enter text" />);
    expect(screen.getByText("This field is required")).toBeInTheDocument();
    const input = screen.getByPlaceholderText("Enter text");
    expect(input).toHaveClass("border-red-500");
  });

  it("handles user input", async () => {
    render(<Input placeholder="Enter text" />);
    const input = screen.getByPlaceholderText("Enter text");

    await userEvent.type(input, "Hello, World!");
    expect(input).toHaveValue("Hello, World!");
  });

  it("accepts and applies additional className", () => {
    render(<Input className="custom-class" placeholder="Enter text" />);
    const input = screen.getByPlaceholderText("Enter text");
    expect(input).toHaveClass("custom-class");
  });

  it("handles disabled state", () => {
    render(<Input disabled placeholder="Enter text" />);
    const input = screen.getByPlaceholderText("Enter text");
    expect(input).toBeDisabled();
  });

  it("handles required attribute", () => {
    render(<Input required placeholder="Enter text" />);
    const input = screen.getByPlaceholderText("Enter text");
    expect(input).toBeRequired();
  });
});
