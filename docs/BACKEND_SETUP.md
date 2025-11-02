# Backend Setup Guide

This document explains the backend features that have been added to your Laravel application.

## Features Implemented

### 1. **Project Management**
   - ✅ Add Project (with file uploads)
   - ✅ Edit Project
   - ✅ Delete Project
   - ✅ Project List Page (Admin)
   - ✅ Project List Page (Frontend)
   - ✅ Individual Project Pages

### 2. **Blog Management**
   - ✅ Add Blog Article (with file uploads)
   - ✅ Edit Blog Article
   - ✅ Delete Blog Article
   - ✅ Blog List Page (Admin)
   - ✅ Blog List Page (Frontend)
   - ✅ Individual Blog Pages

### 3. **Authentication**
   - ✅ Login Page
   - ✅ Sign Up / Register Page
   - ✅ Logout Functionality
   - ✅ Protected Admin Routes

### 4. **Admin Dashboard**
   - ✅ Dashboard with Statistics
   - ✅ Quick Actions
   - ✅ Recent Activity Feed

## Setup Instructions

### 1. Run Migrations
```bash
php artisan migrate
```

This will create the following tables:
- `projects` - Stores project data with images, gallery, and metadata
- `blogs` - Stores blog articles with featured images, tags, and content
- `users` - Already exists, updated to include blog relationship

### 2. Create Storage Link
```bash
php artisan storage:link
```

This creates a symbolic link from `public/storage` to `storage/app/public` so uploaded images can be accessed publicly.

### 3. Set File Permissions (Linux/Mac)
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 4. Create Your First Admin User
You can register a new user by visiting:
```
http://your-domain.com/register
```

Or create a user via tinker:
```bash
php artisan tinker
```
Then run:
```php
App\Models\User::create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => Hash::make('your-password'),
]);
```

### 5. Access Admin Panel
After logging in, access the admin panel at:
```
http://your-domain.com/admin
```

## Database Structure

### Projects Table
- `id` - Primary key
- `title` - Project title
- `slug` - URL-friendly identifier (auto-generated)
- `description` - Project description
- `location` - Project location
- `year` - Project year
- `type` - Project type (e.g., "Eco-Friendly Resort")
- `category` - residential, commercial, or renovation
- `main_image` - Main project image path
- `gallery_images` - JSON array of gallery image paths
- `client_name` - Optional client name
- `project_area` - Optional project area in sq ft
- `start_date` - Optional start date
- `completion_date` - Optional completion date
- `is_published` - Boolean for publishing status
- `is_featured` - Boolean for featured status
- `timestamps` - created_at, updated_at

### Blogs Table
- `id` - Primary key
- `user_id` - Foreign key to users table
- `title` - Article title
- `slug` - URL-friendly identifier (auto-generated)
- `category` - Article category
- `excerpt` - Short summary (max 500 chars)
- `content` - Full article content
- `featured_image` - Featured image path
- `tags` - JSON array of tags
- `published_date` - Publication date
- `reading_time` - Estimated reading time in minutes (auto-calculated)
- `views` - View counter
- `is_published` - Boolean for publishing status
- `timestamps` - created_at, updated_at

## File Uploads

### Storage Locations
- **Project Images**: `storage/app/public/projects/`
- **Project Gallery**: `storage/app/public/projects/gallery/`
- **Blog Images**: `storage/app/public/blogs/`

### Image Requirements
- Maximum file size: 5MB per image
- Accepted formats: All image types
- Recommended sizes:
  - Project main image: 1200x800px
  - Blog featured image: 1200x630px

## Routes

### Public Routes
- `/` - Home page
- `/projects` - Project list page
- `/projects/{slug}` - Individual project page
- `/blogs` - Blog list page
- `/blogs/{slug}` - Individual blog article page

### Authentication Routes
- `/login` - Login page
- `/register` - Registration page
- `/logout` - Logout (POST)

### Admin Routes (Protected by auth middleware)
- `/admin` - Admin dashboard
- `/admin/projects` - Project management
- `/admin/projects/create` - Create project
- `/admin/projects/{id}/edit` - Edit project
- `/admin/blogs` - Blog management
- `/admin/blogs/create` - Create blog article
- `/admin/blogs/{id}/edit` - Edit blog article

## Features

### Auto-Generated Slugs
Both projects and blogs automatically generate URL-friendly slugs from their titles. If a duplicate slug exists, a number is appended.

### Auto-Calculated Reading Time
Blog articles automatically calculate reading time based on word count (200 words per minute average).

### Image Management
- Main images can be updated without affecting existing data
- Gallery images can be added incrementally
- Individual gallery images can be removed via AJAX
- Images are automatically deleted when projects/blogs are deleted

### Publishing Control
Both projects and blogs have a publish/draft toggle. Only published items appear on the frontend.

### Related Content
- Project pages show related projects from the same category
- Blog pages show related articles from the same category

## Notes

1. **Environment Configuration**: Make sure your `.env` file has the correct database configuration.

2. **Storage Disk**: The application uses the `public` disk for file storage. Ensure it's properly configured in `config/filesystems.php`.

3. **Slug Uniqueness**: The system automatically ensures unique slugs. If you manually set a slug that already exists, it will be modified.

4. **User Relationship**: Blog articles are automatically associated with the currently logged-in user when created.

5. **Views Counter**: Blog views are automatically incremented when a blog article is viewed on the frontend.

## Troubleshooting

### Images Not Displaying
- Ensure you've run `php artisan storage:link`
- Check file permissions on the `storage/app/public` directory
- Verify the `.env` file has `APP_URL` set correctly

### Migration Errors
- If you get errors about existing columns, you may need to reset your database:
  ```bash
  php artisan migrate:fresh
  ```
  ⚠️ **Warning**: This will delete all existing data!

### 404 Errors on Project/Blog Pages
- Ensure slugs are properly generated (check database)
- Verify routes are registered (check `routes/web.php`)
- Clear route cache: `php artisan route:clear`

## Support

For issues or questions, refer to the Laravel documentation or contact your development team.

