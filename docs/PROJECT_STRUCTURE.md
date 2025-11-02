# Project Structure Guide

This document explains the folder structure and organization of the Septan Developers website.

## Directory Structure

### Root Level Files
- `artisan` - Laravel command-line interface
- `composer.json` / `composer.lock` - PHP dependency management
- `package.json` - Node.js dependencies (if using Vite)
- `phpunit.xml` - PHPUnit test configuration
- `vite.config.js` - Vite build configuration
- `.htaccess` - Apache rewrite rules
- `README.md` - Project documentation

### `/app` - Application Core

Contains all application logic following Laravel's MVC pattern.

#### `/app/Http/Controllers`
- `Admin/` - Admin panel controllers
  - `DashboardController.php` - Admin dashboard
  - `ProjectController.php` - Project CRUD operations
  - `BlogController.php` - Blog CRUD operations
- `Auth/` - Authentication controllers
  - `AuthenticatedSessionController.php` - Login/logout
  - `RegisteredUserController.php` - User registration
- `BlogController.php` - Public blog display
- `ProjectController.php` - Public project display
- `Controller.php` - Base controller

#### `/app/Models`
- `Blog.php` - Blog article model
- `Project.php` - Project model
- `User.php` - User authentication model

#### `/app/Providers`
- `AppServiceProvider.php` - Application service provider

### `/config` - Configuration Files

Laravel configuration files. Key files:
- `app.php` - Application configuration
- `database.php` - Database connection settings
- `filesystems.php` - File storage configuration
- `auth.php` - Authentication configuration

### `/database` - Database

#### `/database/migrations`
Database schema definitions:
- `*_create_users_table.php` - User table
- `*_create_projects_table.php` - Project table
- `*_create_blogs_table.php` - Blog table

#### `/database/factories`
Model factories for testing and seeding.

#### `/database/seeders`
Database seeders for populating test data.

### `/public` - Public Directory

Web server document root. All public assets accessible via URL.

#### `/public/assets`
Static assets:
- `css/` - Stylesheets
- `js/` - JavaScript files
- `img/` - Images (logos, backgrounds, etc.)
- `fonts/` - Web fonts

#### `/public/storage`
Symbolic link to `storage/app/public` for uploaded files.

### `/resources` - Resources

#### `/resources/views` - Blade Templates
- `admin/` - Admin panel views
  - `dashboard.blade.php` - Admin dashboard
  - `projects/` - Project management views
  - `blogs/` - Blog management views
- `auth/` - Authentication views
  - `login.blade.php`
  - `register.blade.php`
- `blogs/` - Public blog views
  - `index.blade.php` - Blog listing
  - `show.blade.php` - Blog article page
- `projects/` - Public project views
  - `index.blade.php` - Project listing
  - `show.blade.php` - Project detail page
- `Home.blade.php` - Homepage
- `Service_*.blade.php` - Service pages
- `welcome.blade.php` - Default Laravel welcome page

#### `/resources/css` & `/resources/js`
Source CSS and JavaScript files (for Vite compilation).

### `/routes` - Routes

- `web.php` - Web routes (public and admin)
- `auth.php` - Authentication routes
- `console.php` - Artisan command routes

### `/storage` - Storage

Application storage directory.

#### `/storage/app`
- `private/` - Private file storage
- `public/` - Public file storage (accessible via web)
  - `projects/` - Uploaded project images
  - `projects/gallery/` - Project gallery images
  - `blogs/` - Uploaded blog images

#### `/storage/framework`
Laravel framework cache and session files.

#### `/storage/logs`
Application log files (`laravel.log`).

### `/tests` - Tests

- `Feature/` - Feature tests
- `Unit/` - Unit tests
- `TestCase.php` - Base test case

### `/vendor` - Dependencies

Composer-installed PHP packages. **Do not edit files here.**

### `/docs` - Documentation

Project documentation:
- `BACKEND_SETUP.md` - Backend setup instructions
- `XAMPP_SETUP.md` - XAMPP configuration guide
- `PROJECT_STRUCTURE.md` - This file

## File Naming Conventions

### Controllers
- PascalCase: `ProjectController.php`
- One controller per resource

### Models
- PascalCase, singular: `Project.php`, `Blog.php`
- One model per database table

### Views
- snake_case: `projects/index.blade.php`
- Organized by feature/resource

### Routes
- kebab-case: `/admin/projects/create`
- RESTful where possible

### Migrations
- Timestamp prefix: `2025_11_02_000000_create_projects_table.php`
- Descriptive names

## Best Practices

1. **Never edit `/vendor` directory** - Use Composer for dependencies
2. **Keep `/storage` writable** - Required for file uploads and logs
3. **Use migrations** - Never edit database schema directly
4. **Follow Laravel conventions** - Use standard folder structure
5. **Separate concerns** - Keep controllers thin, models fat
6. **Use Blade components** - For reusable UI elements
7. **Document complex logic** - Add comments where needed

## Asset Organization

### CSS Files
- Main styles: `public/assets/css/style.css`
- Admin styles: Inline in admin views (consider extracting)

### JavaScript Files
- Main script: `public/assets/js/main.js`
- Form handler: `public/assets/js/form-handler.js`

### Images
- Static images: `public/assets/img/`
- Uploaded images: `storage/app/public/` (via symlink)

## Uploaded Files Location

After running `php artisan storage:link`, uploaded files are accessible at:
- Projects: `/storage/projects/[filename]`
- Project Gallery: `/storage/projects/gallery/[filename]`
- Blogs: `/storage/blogs/[filename]`

Physical location: `storage/app/public/`

