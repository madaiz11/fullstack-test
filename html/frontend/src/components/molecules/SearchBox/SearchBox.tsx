import React from "react";
import { Button } from "../../atoms/Button/Button";
import { Input } from "../../atoms/Input/Input";

interface SearchBoxProps {
  onSearch: (query: string) => void;
  placeholder?: string;
}

export const SearchBox: React.FC<SearchBoxProps> = ({
  onSearch,
  placeholder = "Search properties...",
}) => {
  const [query, setQuery] = React.useState("");

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    onSearch(query);
  };

  return (
    <form onSubmit={handleSubmit} className="flex gap-2">
      <Input
        value={query}
        onChange={(e) => setQuery(e.target.value)}
        placeholder={placeholder}
        className="flex-1"
      />
      <Button type="submit" variant="primary">
        Search
      </Button>
    </form>
  );
};
