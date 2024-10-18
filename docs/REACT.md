
# React


## 1. Create project

```bash
# While the source directory is empty, keep the Docker container running with this command:
command: ["tail", "-f", "/dev/null"]

# Note: Add the "node_modules" and "next" volumes after the project installation.
npx create-next-app@latest .
# TypeScript: Yes
# ESLint: Yes
# Tailwind CSS: Yes
# src: No
# App Router: Yes
# Customize import alias: No

# Specify ports in package.json
"scripts": {
    "dev": "next dev -p 8080",
    "build": "next build",
    "start": "next start -p 8080",
    "lint": "next lint"
}
```

Adding packages
```bash
# Install Bootstrap
npm i bootstrap

# app/layout.tsx
import "bootstrap/dist/css/bootstrap.min.css";
```

## 2. Create page
```bash
# Create new directory in "/app" with the page's name, and a "page.tsx" file inside.
app/categories/page.tsx

# You can access the page on:
http://localhost:8050/categories
```
```javascript
/* page.tsx */
export default function Page() {
    return (
      <>
        <h1>Categories</h1>
      </>
    );
}

/**
 * Format dates:
 * npm install date-fns
 */

import { parseISO, format } from 'date-fns';

export default function Date({ dateString }) {
    const date = parseISO(dateString);
    return <time dateTime={dateString}>{format(date, 'LLLL d, yyyy')}</time>;
}
```
