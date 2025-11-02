# Septan Developers Website

A modern Laravel-based website for Septan Developers - Expert construction design, consultation, and engineering services.

## Features

- ✅ Project Management (Add, Edit, Delete)
- ✅ Blog Article Management (Add, Edit, Delete)
- ✅ User Authentication (Login, Sign Up)
- ✅ Admin Dashboard with Statistics
- ✅ Dynamic Project & Blog Display
- ✅ Image Upload & Gallery Management
- ✅ SEO-Friendly URLs (Slug-based)

## Technology Stack

- **Backend**: Laravel 11.x
- **Frontend**: HTML, CSS, JavaScript
- **Database**: MySQL
- **Server**: PHP 8.2+

## Project Structure

```
septan_developers/
├── app/                          # Application core
│   ├── Http/
│   │   └── Controllers/          # Application controllers
│   │       ├── Admin/           # Admin panel controllers
│   │       ├── Auth/             # Authentication controllers
│   │       ├── BlogController.php
│   │       └── ProjectController.php
│   └── Models/                   # Eloquent models
│       ├── Blog.php
│       ├── Project.php
│       └── User.php
├── config/                        # Configuration files
├── database/
│   └── migrations/               # Database migrations
├── docs/                         # Documentation
│   ├── BACKEND_SETUP.md         # Backend setup guide
│   └── XAMPP_SETUP.md           # XAMPP configuration guide
├── public/                       # Public assets
│   ├── assets/                   # CSS, JS, Images
│   └── storage/                  # Storage symlink
├── resources/
│   └── views/                    # Blade templates
│       ├── admin/                # Admin panel views
│       ├── auth/                # Authentication views
│       ├── blogs/               # Blog views
│       ├── projects/             # Project views
│       └── Home.blade.php       # Homepage
├── routes/
│   ├── auth.php                 # Authentication routes
│   └── web.php                  # Web routes
├── storage/                      # Storage directory
│   └── app/
│       └── public/              # Uploaded files
│           ├── projects/         # Project images
│           └── blogs/            # Blog images
└── vendor/                       # Composer dependencies
```

## Quick Start

### Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL
- XAMPP (Windows) or Apache/Nginx

### Installation

1. **Clone the repository** (or navigate to project directory)

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Update `.env` with your database credentials.

4. **Run Migrations**
   ```bash
   php artisan migrate
   ```

5. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```

6. **Create Admin User**
   ```bash
   php artisan tinker
   ```
   Then:
   ```php
   App\Models\User::create([
       'name' => 'Admin',
       'email' => 'admin@example.com',
       'password' => Hash::make('your-password'),
   ]);
   ```

### Running the Application

#### Option 1: Laravel Development Server
```bash
php artisan serve
```
Access at: `http://localhost:8000`

#### Option 2: XAMPP/Apache
- Place project in `htdocs` directory
- Access via: `http://localhost/Project/septan_developers/public/`
- See `docs/XAMPP_SETUP.md` for detailed configuration

## Admin Panel

- **Login**: `/login`
- **Dashboard**: `/admin`
- **Projects**: `/admin/projects`
- **Blogs**: `/admin/blogs`

**Default Admin Credentials** (if created via setup):
- Email: `admin@septan.com`
- Password: `admin123`

⚠️ **Important**: Change the default password after first login!

## Routes

### Public Routes
- `/` - Homepage
- `/projects` - Projects listing
- `/projects/{slug}` - Individual project page
- `/blogs` - Blog listing
- `/blogs/{slug}` - Individual blog article

### Admin Routes (Protected)
- `/admin` - Admin dashboard
- `/admin/projects` - Project management
- `/admin/blogs` - Blog management

### Authentication Routes
- `/login` - Login page
- `/register` - Registration page
- `/logout` - Logout (POST)

## File Uploads

Uploaded files are stored in:
- `storage/app/public/projects/` - Project main images
- `storage/app/public/projects/gallery/` - Project gallery images
- `storage/app/public/blogs/` - Blog featured images

Files are accessible via `/storage/` URL after running `php artisan storage:link`.

## Documentation

- **Backend Setup**: See `docs/BACKEND_SETUP.md`
- **XAMPP Configuration**: See `docs/XAMPP_SETUP.md`

## Development

### Running Tests
```bash
php artisan test
```

### Clearing Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## License

Copyright © 2025 Septan Developers. All rights reserved.

## Support

For issues or questions, contact the development team.
