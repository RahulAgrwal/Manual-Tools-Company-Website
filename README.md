# PHP Project

This is a simple PHP project that can be run using PHP's built-in development server with a custom router file.

## Prerequisites
- PHP 7.4+ must be installed on your system.
- A web browser to access the application.

## Run the Project

1. Open your terminal and navigate to the project directory:

   ```bash
   cd path/to/project
   ```

2. Start the PHP built-in server with `router.php`:

   ```bash
   php -S localhost:8080 router.php
   ```

3. Open your browser and go to:

   ```
   http://localhost:8080
   ```

The application should now be running locally.

## router.php

The `router.php` file can be used to handle routing logic.  
For example:

```php
<?php
// router.php

// Serve static files directly
if (file_exists(__DIR__ . '/' . $_SERVER['REQUEST_URI'])) {
    return false;
}

// Otherwise, load index.php
require __DIR__ . '/index.php';
```
  
## Project Structure

```
.
├── index.php     # Entry point
├── router.php    # Router for PHP built-in server
├── src/          # Source code
├── assets/       # Static files (CSS, JS, Images)
└── README.md     # Documentation
```

## Notes
- Use `CTRL + C` in the terminal to stop the server.
- You can change the port if needed (default here is `8080`).
