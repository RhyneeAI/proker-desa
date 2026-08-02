# AGENTS.md

Laravel 12 (PHP ^8.2) + Blade + Tailwind CSS + Alpine.js, built with Vite. This is an Indonesian village website ("website desa"): all UI strings, URLs, and route names are in Indonesian (`berita`, `pengumuman`, `aparatur`, `fasilitas`, `galeri`).

## Commands

- `composer run setup` — full bootstrap: composer install, copy `.env`, `key:generate`, `migrate --force`, `npm install`, `npm run build`.
- `composer run dev` — runs `php artisan serve` + `php artisan queue:listen --tries=1` + `npm run dev` concurrently. A queue worker is required because `QUEUE_CONNECTION=database`.
- `php artisan test` (or `composer test`) — test suite.
- `vendor/bin/pint` — code style (no `pint.json`; default Laravel preset).
- `npm run build` / `npm run dev` — frontend assets.

## Setup & environment gotchas

- `.env` is gitignored. `.env.example` is **stale** (`DB_CONNECTION=mariadb`, `DB_DATABASE=template_lrv`); current local dev uses MySQL with DB `data_desa`. Tests use in-memory sqlite (`phpunit.xml`), so they need no real DB.
- Seed with `php artisan migrate --seed` (or `db:seed`). `AdminUserSeeder` creates `admin@desa.test` / `password`; `DatabaseSeeder` also creates sample content through factories.
- Uploads are stored via `->store('<dir>', 'public')` into `storage/app/public` and rendered with `Storage::url()` in views — run `php artisan storage:link` or images 404. Controllers must manually `Storage::disk('public')->delete(...)` the old file on update/destroy.

## Architecture

- Public pages: `app/Http/Controllers/{Home,News,Announcement,...}Controller`; admin CRUD: `app/Http/Controllers/Admin/Admin*Controller`. Validation lives in `app/Http/Requests/Store*Request` / `Update*Request`.
- Route-model binding is registered in `AppServiceProvider` via `Route::model()`: `aparatur`→`Official`, `berita`→`News`, `pengumuman`→`Announcement`, `fasilitas`→`Facility`, `galeri`→`Gallery`. Admin controller method params therefore use the **Indonesian route-param name, not the model name** (e.g. `News $berita`).
- Every model with a `slug` column generates it via `App\Traits\HasUniqueSlug::generateUniqueSlug(Model::class, $title, $ignoreId)`.
- Models use `SoftDeletes` + `HasFactory`, including `User`.
- Layouts: `resources/views/layouts/{public,admin,app,guest}.blade.php`; shared markup is in `resources/views/components/` (`x-public-navbar`, `x-admin-sidebar`, etc.).
- Tailwind: the Vite plugin is `@tailwindcss/vite` (v4) but `tailwindcss@3` + legacy `@tailwind base;` directives in `resources/css/app.css` are also present. The build works; don't touch the toolchain unless styles stop compiling.

## Known baseline: test suite is red

`php artisan test` currently fails (12 failed / 13 passed) for three known reasons — don't chase these as new regressions:

1. Auth flows (login/register/verification) throw `Route [dashboard] not defined`. The dashboard route was renamed to `admin.dashboard` in `routes/web.php`, but `AuthenticatedSessionController::store()` and `resources/views/layouts/navigation.blade.php` still call `route('dashboard')`.
2. `tests/Feature/ExampleTest.php` (GET `/`) → 500 `no such table: village_profiles`: it has no `RefreshDatabase`, but the home page queries the DB.
3. `ProfileTest::test_user_can_delete_their_account` fails because `User` uses `SoftDeletes` (`$user->fresh()` is not null after delete).

There are no feature tests for the custom content modules yet; new admin/public routes are tested only via the failing Breeze defaults.
