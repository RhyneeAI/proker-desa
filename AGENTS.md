# AGENTS.md

Laravel 12 (PHP ^8.2) + Blade + Tailwind CSS + Alpine.js, built with Vite. This is an Indonesian village website ("website desa"): all UI strings, URLs, and route names are in Indonesian (`berita`, `pengumuman`, `aparatur`, `fasilitas`, `galeri`, `umkm`, `potensi-desa`).

## Commands

- `composer run setup` — full bootstrap: composer install, copy `.env`, `key:generate`, `migrate --force`, `npm install`, `npm run build`.
- `composer run dev` — runs `php artisan serve` + `php artisan queue:listen --tries=1` + `npm run dev` concurrently. A queue worker is required because `QUEUE_CONNECTION=database`.
- `php artisan test` (or `composer test`) — test suite.
- `vendor/bin/pint` — code style (no `pint.json`; default Laravel preset).
- `npm run build` / `npm run dev` — frontend assets.

## Setup & environment gotchas

- Fresh checkout: run `composer run setup` **once**. Tests otherwise fail on every run with `MissingAppKeyException` (empty `APP_KEY`) or `ViteManifestNotFoundException` (no `public/build/manifest.json`) — these mask the real baseline failures below.
- `.env` is gitignored. `.env.example` is **stale** (`DB_CONNECTION=mariadb`); the real local DB settings (currently MariaDB/MySQL, DB `website_desa`) live only in the gitignored `.env`. Tests use in-memory sqlite (`phpunit.xml`), so they need no real DB. The old `proker_desa` DB is polluted with tables from another project (`abs_*`, `ops_*`, `pos_*`) — don't use it.
- Seed with `php artisan migrate --seed` (or `db:seed`). `AdminUserSeeder` creates `admin@desa.test` / `password`; `DatabaseSeeder` also creates sample content through factories.
- Uploads are stored via `->store('<dir>', 'public')` into `storage/app/public` and rendered with `Storage::url()` in views — run `php artisan storage:link` or images 404. Controllers must manually `Storage::disk('public')->delete(...)` the old file on update/destroy.

## Architecture

- Public pages: `app/Http/Controllers/{Home,News,Announcement,...}Controller`; admin CRUD: `app/Http/Controllers/Admin/Admin*Controller`. Validation lives in `app/Http/Requests/Store*Request` / `Update*Request`.
- Code style convention: always import classes with `use` statements at the top of the file — never reference fully-qualified names inline (e.g. `use App\Models\User;` then `User::...`, not `\App\Models\User::...`).
- Route-model binding is registered in `AppServiceProvider` via `Route::model()`: `aparatur`→`Official`, `berita`→`News`, `pengumuman`→`Announcement`, `fasilitas`→`Facility`, `galeri`→`Gallery`, `potensiDesa`→`PotensiDesa`. Admin controller method params therefore use the **Indonesian route-param name, not the model name** (e.g. `News $berita`). `umkm` and `potential` are **not** registered here — they bind implicitly by id (param name matches the lowercase model name).
- **"Potensi" naming trap**: there are two distinct models. Public `/potensi-desa` and admin `potensi` prefix use `Potential` (controller `PotentialController`, routes `potensi.*`, param `{potential}`); the admin `potensi-desa` prefix manages the separate `PotensiDesa` model (table `potensi_desa`, routes `potensi-desa.*`, param `{potensiDesa}`). Don't conflate them.
- Only `News` and `Announcement` have a `slug` column, generated via `App\Traits\HasUniqueSlug::generateUniqueSlug(Model::class, $title, $ignoreId)`. Other detail routes (`umkm`, `potensi`) bind by id.
- Layouts are Blade components: `resources/views/components/layouts/{public,admin}.blade.php` used as `<x-layouts.public>` / `<x-layouts.admin>` (public pages in `resources/views/public/`, admin pages in `resources/views/admin/`). `x-layouts.*` only resolves to `components/layouts/`, NOT to `resources/views/layouts/`. Both layouts compose partials: public from `resources/views/layouts/public/{header,navbar,main,footer}.blade.php`, admin from `resources/views/layouts/admin/{header,sidebar,navbar,main,footer}.blade.php`. `resources/views/layouts/` also holds Breeze's `app`/`guest`/`navigation`. `resources/views/components/` holds shared bits (`x-form-*` helpers, `x-interactive-map`, etc.).
- **Two front-end stacks, two Vite bundles**: public is Tailwind (`resources/css/app.css` + `resources/js/app.js`); admin is Tabler (Bootstrap 5) + jQuery (`resources/css/admin.css` + `resources/js/admin.js`). Admin pages `@vite` the admin bundle only; the `<x-layouts.admin>` shell expects Tabler/Bootstrap classes (`.card`, `.btn`, `.table card-table`, `ti ti-*` icons from `@tabler/icons-webfont`). The `x-form-input`/`x-form-select`/`x-form-textarea` helpers emit Bootstrap classes and are admin-only; the Breeze helpers (`x-input-label`, `x-primary-button`, …) are separate and still Tailwind. `$errors` is shared by middleware — it is NOT available in `php artisan tinker`-style direct view renders.
- Models use `SoftDeletes` + `HasFactory`, including `User`.
- **Roles & permissions** (spatie/laravel-permission): `User` uses `HasRoles`. Admin routes are gated per-module with `->middleware('can:manage X')` (e.g. `manage berita`, `manage titik air`, `manage pengguna`). `Gate::before` lets the `super-admin` role bypass every check. Roles/permissions are created by `RolesAndPermissionsSeeder` (`super-admin` = all, `admin` = content management except `manage pengguna`); the seeded `admin@desa.test` gets `super-admin`. User/role management UI lives at `/admin/pengguna` (can't change your own role).
- Peta desa / interactive map uses **MapLibre GL** (`maplibre-gl` in `package.json`, imported in `app.js`) via `resources/js/map.js`, exposing `window.initInteractiveMap(mapId, config)` consumed by the `x-interactive-map` component. Default basemap is **Carto Voyager raster tiles** (Google-Maps-like, no API key) with a raster-OSM fallback when tiles fail. The village boundary polygon is rendered from `public/js/village-boundary.geojson` (generated from `public/docs/Titik Cibulakan.xlsx`, 445 points around center `-6.825112, 107.094836`). So `npm install` is required for map pages to work. (Leaflet and OpenFreeMap vector were removed — OpenFreeMap returns 403 on its vector tiles.)
- **i18n**: `App\Http\Middleware\SetLocale` (web middleware) reads `session('locale')`, default `id`. Lang files `lang/{id,en}.json` cover the public UI chrome (navbar/hero/footer/CTA). The toggle hits `route('locale.switch', {locale})`. Content data (berita, umkm…) stays Indonesian.
- **Dark mode (public)**: `data-theme="dark"` on `<html>`, set by an inline script in `layouts/public/header.blade.php` (localStorage `theme` + `prefers-color-scheme`), toggled by the navbar button. Styling is a CSS override block at the top of `resources/css/app.css` (not Tailwind `dark:` variants) — keep new public surfaces in sync there.
- **Landing animations**: AOS (`aos` in package.json) initialized in `app.js`, `data-aos` on landing sections; respects `prefers-reduced-motion`. The landing page also has a gallery wallpaper carousel fed from `HomeController`'s `$galleries` (image fallback: deterministic picsum URL when the stored file doesn't exist).
- **Social media**: `App\View\Composers\PublicSiteComposer` shares `$contact` (first `Contact` row) with `layouts.public.{navbar,footer}`; footer renders FB/IG/YT/WA buttons only when the field is filled. Real links are admin-editable via the Kontak admin page.
- Tailwind: the Vite plugin is `@tailwindcss/vite` (v4) but `tailwindcss@3` + legacy `@tailwind base;` directives in `resources/css/app.css` are also present. The build works; don't touch the toolchain unless styles stop compiling.

## Auth & login quirks

- Login uses a single `identifier` field that auto-detects email vs username: if the value contains `@` it is matched against the `email` column, otherwise against `username`. Logic lives in `app/Http/Requests/Auth/LoginRequest.php`. The `users` table has a nullable, unique `username` column (`AdminUserSeeder` sets `admin`).
- Public registration was intentionally removed (no `RegisteredUserController`, no `register.blade.php`, no routes) — this is an admin-only village site. Don't "fix" that as a missing feature.
- All Breeze auth redirects target `admin.dashboard` (the dashboard route was renamed from `dashboard`), e.g. `AuthenticatedSessionController::store()`, `VerifyEmailController`, `ConfirmablePasswordController`, `navigation.blade.php`.
- The `confirm-password`, `verify-email`, and `email/verification-notification` routes were re-added to `routes/auth.php` (controllers exist; registration routes intentionally omitted).

## Testing

- `php artisan test` is **green** (24 passed). Auth flows (login by username/email, logout, password, email verification, password confirmation) are covered by `tests/Feature/Auth/`. `tests/Feature/ExampleTest` uses `RefreshDatabase` so GET `/` renders. `ProfileTest::test_user_can_delete_their_account` asserts `assertSoftDeleted` (User uses SoftDeletes).
- There are no feature tests for the custom content modules yet (news, umkm, etc.); new admin/public routes are only smoke-tested by hand so far.
