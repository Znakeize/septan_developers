# Deploying Septan Developers to Vercel

This project has been configured for deployment on **Vercel**. However, because Vercel is a serverless environment with a read-only filesystem, you cannot use SQLite (`database.sqlite`). You must use a cloud database.

## 1. Prerequisites (Database)
You need a MySQL or PostgreSQL database hosted in the cloud. Vercel Does **NOT** host databases for PHP.
- **Option A (Recommended)**: Use a free tier MySQL database from [Aiven](https://aiven.io/) or [PlanetScale](https://planetscale.com/).
- **Option B**: Use [Neon](https://neon.tech/) (PostgreSQL) or [Supabase](https://supabase.com/).

Once you have your database credentials (`Host`, `Database Name`, `Username`, `Password`), you are ready.

## 2. Connect Git to Vercel
1. Push this project to GitHub/GitLab/Bitbucket.
2. Go to [Vercel dashboard](https://vercel.com/new).
3. Import the repository.

## 3. Configure Project Settings
In the Vercel Import screen, configure the following:

### Build Command (OVERRIDE THIS)
Expand "Build and Output Settings" and toggle **Build Command** to override it. Enter:
```bash
composer install --no-dev --prefer-dist && npm install && npm run build
```

### Environment Variables
Add the following variables. **Do NOT paste your .env file**. Use the UI to add them one by one.

| Variable Name | Value | Note |
|--------------|-------|------|
| `APP_KEY` | `base64:...` | Copy from your local `.env`. Essential! |
| `APP_ENV` | `production` | |
| `APP_DEBUG` | `true` | Set to `false` when stable. |
| `APP_URL` | `https://your-project.vercel.app` | Update after deployment. |
| `DB_CONNECTION`| `mysql` | (or `pgsql`) |
| `DB_HOST` | `your-db-host.com` | From your cloud DB provider. |
| `DB_PORT` | `3306` | |
| `DB_DATABASE` | `defaultdb` | Your DB name. |
| `DB_USERNAME` | `user` | |
| `DB_PASSWORD` | `password` | |

**Important**: 
- `CACHE_DRIVER` is set to `array` via `vercel.json` (no persistent cache).
- `SESSION_DRIVER` is set to `cookie` via `vercel.json`.

## 4. Deploy
Click **Deploy**.
Vercel will build the frontend (Vite) and backend (Composer), then deploy.

## 5. Migrate Database
After deployment, your database will be empty. You cannot run `php artisan migrate` directly on Vercel console easily.
**Option A (Best)**: Connect to your cloud database from your **local machine** and run migrations.
1. Update your local `.env` to point to the **Production Cloud DB**.
2. Run `php artisan migrate:fresh --seed`.
3. Revert your local `.env` back to `sqlite` or local mysql.

**Option B (Route)**: Create a temporary route in `routes/web.php` to run migrations (Insecure, remember to remove):
```php
Route::get('/migrate', function() {
    \Artisan::call('migrate:fresh --seed --force');
    return 'Migrated!';
});
```

## Troubleshooting
- **Assets 404**: Ensure `npm run build` ran successfully.
- **Database Error**: Check credentials. Vercel functions cannot write to `database.sqlite`, so using SQLite will fail.
