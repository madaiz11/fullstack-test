# Property Listing Frontend

A Next.js-based frontend application for displaying and managing property listings.

## Overview

This project is built with [Next.js](https://nextjs.org) and bootstrapped using [`create-next-app`](https://nextjs.org/docs/app/api-reference/cli/create-next-app). It provides a modern, responsive interface for browsing and searching property listings.

## Features

- Property listing display with detailed information
- Pagination (25 properties per page)
- Search functionality
  - Filter by title
  - Filter by location
- Sorting options
  - Price (ascending/descending)
  - Date listed (newest/oldest)
- Dynamic province-based routing (e.g., `/bangkok/`)
- 404 error page for non-existent provinces

## Dependencies

### Core Dependencies

- Next.js (v15.3.1)
- React (v19.0.0)
- React DOM (v19.0.0)
- GraphQL (v16.11.0)
- Apollo Client (v3.13.0-rc.0)
- Apollo Next.js Integration (v0.12.2)
- Geist Font (v1.3.1)

### Development Dependencies

- TypeScript (v5)
- ESLint (v9)
- Tailwind CSS (v4)
- Testing Libraries:
  - Vitest (v3.1.2)
  - Testing Library React (v16.3.0)
  - Testing Library Jest DOM (v6.6.3)
  - Testing Library User Event (v14.6.1)
  - JSDOM (v26.1.0)
- Type Definitions:
  - @types/node (v20)
  - @types/react (v19)
  - @types/react-dom (v19)

## Getting Started

### Prerequisites

- Node.js (v18.0.0 or higher)
- Package Manager (one of the following):
  - npm (v9.0.0 or higher)
  - yarn (v1.22.0 or higher)
  - pnpm (v8.0.0 or higher)
  - bun (v1.0.0 or higher)
- Git (for cloning the repository)
- A modern web browser (Chrome, Firefox, Safari, or Edge)
- Backend API running (see backend README for setup)
- Environment Variables:
  ```env
  NEXT_PUBLIC_API_URL=http://localhost:8000/graphql
  ```

### System Requirements

- Memory: 4GB RAM minimum, 8GB recommended
- Disk Space: At least 1GB of free space
- OS:
  - Windows 10/11
  - macOS 10.15 or later
  - Linux (Ubuntu 20.04 or equivalent)

### IDE Recommendations

- Visual Studio Code with extensions:
  - ESLint
  - Prettier
  - TypeScript and JavaScript Language Features
  - Tailwind CSS IntelliSense

### Installation

1. Clone the repository
2. Install dependencies:
   ```bash
   npm install
   # or
   yarn install
   # or
   pnpm install
   # or
   bun install
   ```

### Development

Run the development server:

```bash
npm run dev
# or
yarn dev
# or
pnpm dev
# or
bun dev
```

The application will be available at [http://localhost:3000](http://localhost:3000).

### Testing

```bash
# Run tests
npm run test

# Run tests in watch mode
npm run test:watch

# Run tests with coverage
npm run test:coverage
```

## Project Structure

- `app/page.tsx` - Main page component
- Uses [`next/font`](https://nextjs.org/docs/app/building-your-application/optimizing/fonts) for optimized font loading ([Geist](https://vercel.com/font))

## Development Resources

- [Next.js Documentation](https://nextjs.org/docs) - Features and API reference
- [Learn Next.js](https://nextjs.org/learn) - Interactive tutorial
- [Next.js GitHub Repository](https://github.com/vercel/next.js)

## Deployment

This project can be deployed using the [Vercel Platform](https://vercel.com/new?utm_medium=default-template&filter=next.js&utm_source=create-next-app&utm_campaign=create-next-app-readme), created by the team behind Next.js.

For detailed deployment instructions, refer to the [Next.js deployment documentation](https://nextjs.org/docs/app/building-your-application/deploying).

## Acceptance Criteria

1. **Technology Stack**

   - Built with React (Next.js)

2. **Property Display**

   - Show all relevant property information from properties.json
   - Implement pagination (25 properties per page)
   - Clear navigation links between pages

3. **Search and Filtering**

   - Search box for filtering properties
   - Title matching functionality
   - Location matching functionality

4. **Sorting Options**

   - Price sorting (ascending/descending)
   - Date listed sorting (newest/oldest)

5. **Routing**
   - Dynamic province-based routing (e.g., /bangkok/)
   - 404 error page for non-existent provinces
