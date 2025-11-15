# RBAC Implementation Research

This document outlines the research and comparison of different solutions for implementing Role-Based Access Control (RBAC) in a Laravel 12 application with Vue 3 and Sanctum.

## Options Considered

1.  **`spatie/laravel-permission`**: A widely-used package for managing roles and permissions.
2.  **`Laratrust`**: Another popular package for roles, permissions, and teams.
3.  **Custom Implementation**: A simple approach involving adding a `role` column to the `users` table.

## Research Notes

*   **`spatie/laravel-permission`**:
    *   **Features**: Roles, permissions, direct permissions, middleware, Blade directives, multiple guards.
    *   **Pros**: Very popular, well-documented, flexible, and powerful.
    *   **Cons**: Might be overkill for simple role management.

*   **`Laratrust`**:
    *   **Features**: Roles, permissions, teams, ownership, middleware, Blade directives.
    *   **Pros**: Similar to `spatie/laravel-permission`, but with added team management features.
    *   **Cons**: Team management might not be necessary for this project.

*   **Custom Implementation**:
    *   **Features**: Only what is needed.
    *   **Pros**: Simple, lightweight, no external dependencies.
    *   **Cons**: Less flexible, requires more manual coding, might become difficult to maintain as the application grows.


## Recommendation

For this project, I recommend using the **`spatie/laravel-permission`** package.

### Justification

*   **Ease of Setup**: The package is easy to install and configure.
*   **Features**: It provides a robust set of features for managing roles and permissions, which will be useful as the application grows.
*   **Maintainability**: Using a well-maintained package like this will be easier to maintain in the long run than a custom solution.
*   **Scalability**: While a simple `role` column is sufficient for the current requirements, `spatie/laravel-permission` offers a clear path for adding more granular permissions in the future without a major refactor.
*   **Community Support**: Being a popular package, it has a large community and extensive documentation, making it easy to find help and resources.

While a custom implementation is simpler for the immediate need, the benefits of using `spatie/laravel-permission` in terms of scalability and maintainability make it the better choice for a project that is expected to evolve.


## Implementation Steps

Here is a high-level plan for implementing RBAC using `spatie/laravel-permission`:

### 1. Installation and Setup
- **Install Package**: Add the package via Composer:
  ```bash
  composer require spatie/laravel-permission
  ```
- **Publish and Run Migrations**: Publish the configuration file and run the database migrations to create the necessary tables for roles and permissions.
  ```bash
  php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
  php artisan migrate
  ```

### 2. User Model Configuration
- **Add HasRoles Trait**: Add the `Spatie\Permission\Traits\HasRoles` trait to the [`app/Models/User.php`](app/Models/User.php) model.

### 3. Create Roles
- **Database Seeder**: Create a seeder to populate the `roles` table with the required roles: `customer`, `staff`, and `admin`.
  ```php
  // In a new seeder, e.g., RolesAndPermissionsSeeder.php
  use Spatie\Permission\Models\Role;

  Role::create(['name' => 'admin']);
  Role::create(['name' => 'staff']);
  Role::create(['name' => 'customer']);
  ```
- **Run Seeder**: Run the seeder to create the roles in the database.

### 4. Assign Roles to Users
- **User Registration**: Modify the user registration logic in [`app/Http/Controllers/Auth/RegisteredUserController.php`](app/Http/Controllers/Auth/RegisteredUserController.php) to assign the `customer` role to new users by default.
- **Admin Panel (Future)**: For assigning `admin` and `staff` roles, this would typically be done in a user management section of an admin panel. For now, it can be done manually or via a seeder for testing.

### 5. Protect Routes with Middleware
- **Apply Middleware**: Use the provided middleware in the route definitions (`routes/web.php` and `routes/api.php`) to protect routes based on roles.
  ```php
  // Example for a web route accessible only by admins
  Route::middleware(['auth', 'role:admin'])->group(function () {
      // Admin-only routes here
  });

  // Example for an API route for staff
  Route::middleware(['auth:sanctum', 'role:staff'])->group(function () {
      // Staff-only API routes here
  });
  ```

### 6. Check Roles in Backend Logic
- **Controller/Service Checks**: Use the methods provided by the package to check for roles within controllers or other parts of the application logic.
  ```php
  // Example in a controller method
  if (auth()->user()->hasRole('admin')) {
      // Perform an action only an admin can do
  }
  ```
