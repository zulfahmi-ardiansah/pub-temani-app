# Temani (Teras Masyarakat Madani)

Temani is a Laravel-based community complaint management application that connects residents' reports with departmental handling, progress tracking, and printable records.

![Language](https://img.shields.io/badge/language-PHP-777BB4?style=flat-square&logo=php&logoColor=white)
![Version](https://img.shields.io/badge/version-1.0-blue?style=flat-square)

The version badge reflects the application's `Temani v.1.0` footer in [the layout](resources/views/layout/default.blade.php), not a tagged release.

## Overview

**Temani** stands for **Teras Masyarakat Madani**. I built this web application for a university assignment, inspired by Qlue and JAKI from the Jakarta Government's public-service ecosystem. It is an academic project, not an official government service or an affiliated implementation of either application.

Temani brings the initial complaint and its subsequent handling into one record. A resident describes a local problem, selects a service category, supplies its location and incident time, and attaches a photograph. Departmental staff then take the report, document their progress, and record its completion. Residents can return to their submitted complaints to see their status and the recorded updates instead of relying only on the original submission.

The supplied development database illustrates categories for security, health, public works and infrastructure, and social concerns, with departments based in Tangerang Selatan. These are configurable records rather than a fixed set of services: administrators can maintain categories and associate departments with them.

The application has three account roles and an Indonesian-language interface:

| Role | Intended workflow | Main pages |
| --- | --- | --- |
| Resident (`USER`) | Register, submit complaints, and follow their own reports. | Beranda, Buat Aduan, Lihat Aduan. |
| Staff (`EMPLOYEE`) | Take complaints matching their department's category, record progress, and complete handling. | Penanganan Aduan, Riwayat Aduan. |
| Administrator (`ADMIN`) | Maintain service categories, departments, staff accounts, and resident records; inspect complaint history. | Data Dasar, Riwayat Aduan. |

Registration creates a resident account. Employee accounts and department assignments are maintained through the master-data workflow. These roles describe the implemented navigation and processing behavior, not a guarantee of complete server-side authorization; authorization must be reviewed before deployment.

## Demo video

Watch the [Temani demonstration on YouTube](https://www.youtube.com/watch?v=sVT58-FZV1M) for a walkthrough of the university project.

## Features

### Resident accounts and personal complaint tracking

- **Self-registration:** residents supply their name, email, address, and password to create a `USER` account. Registration rejects an email that is already registered.
- **Session-based sign-in:** successful authentication opens the home page. Accounts can sign out and change their password by supplying the current password and confirming the replacement.
- **Personal complaint list:** the home page lists reports created by the signed-in account, newest first, with pagination. Each entry links to its details and shows its category, last-updated date, and status.
- **Complaint follow-up:** residents can reopen a submitted report to inspect its details and the progress notes recorded during handling.

### Complaint submission and location capture

- **Configurable category selection:** categories are presented with their names, descriptions, and uploaded icons to help residents choose the relevant service.
- **Incident details:** the submission form collects a title, description, written location, incident date and time, and a photograph. Its browser fields limit the title to 100 characters and the description and written location to 255 characters each.
- **Current-location capture:** a button requests the browser's geolocation permission, records latitude and longitude, and displays an OpenStreetMap preview. It captures the device's current position rather than providing a searchable address or arbitrary map-pin picker.
- **Submission ownership:** the application associates the report with the signed-in account, records its creation time, and initializes it with the waiting status.

Coordinates are not required by the controller's validation, but the browser form marks its read-only location confirmation field as required. Browser-based submission may therefore require successful location capture. Geolocation depends on browser permission and a supported secure context, and the embedded map requires access to OpenStreetMap.

### Departmental handling and progress records

- **Category-based work queue:** for an account assigned to a department, the handling page lists waiting complaints whose category matches that department's configured category.
- **Taking a complaint:** when a staff member takes a report, the application records the handling department and staff account and changes the status to in progress. This is a staff-initiated action, not automatic assignment on submission.
- **Progress updates:** staff can append a text note and an optional image. Notes are stored as separate records and displayed in chronological order on the complaint detail page.
- **Completion:** the completion action adds a final progress record and changes the report's status to completed.
- **Complaint history:** accounts associated with a department receive that department's history; accounts without a department receive the broader history view. History is paginated and sorted by the report's last-updated time, newest first.

### Administrative master data

- **Categories:** create, edit, list, and delete category records, including their name, description, and optional icon upload.
- **Departments:** create, edit, list, and delete departments, maintain their description and icon, and associate each department with a complaint category.
- **Employee accounts:** create and edit staff details such as name, email, position, department, address, and password; employee records can also be deleted. Saving through this workflow assigns the `EMPLOYEE` role.
- **Resident records:** browse a paginated list of `USER` accounts and delete resident records. Resident editing or administrator-account creation is not provided by this controller workflow.

### Complaint details and PDF output

- **Combined complaint record:** the detail view brings the original submission together with its handling information and recorded progress.
- **Location and evidence review:** reports with coordinates show an OpenStreetMap embed and a link to open the point in Google Maps. The original photograph is displayed with the report, and progress photographs can be opened in an image dialog.
- **Individual PDF report:** the print action uses Laravel Dompdf to stream `report.pdf`, which can be viewed, saved, or printed from a compatible browser.
- **Report contents:** the PDF includes the status, reporter, creation and last-updated timestamps, category, title, description, written location, incident date and time, and original photograph. It also includes the handling department when assigned and a progress table when updates exist.
- **Completed-report duration:** completed PDFs display a duration in rounded days, calculated from the report's creation and last-updated timestamps. This is not a separately measured staff-work duration or service-level metric.

### Complaint lifecycle

| Stage | Stored status | Interface label | Recorded action |
| --- | --- | --- | --- |
| Submitted | `1` | Menunggu | A resident submits a report; it waits for staff to take it. |
| In progress | `2` | Dalam Proses | Staff take the report; the department and worker are recorded. Progress notes can then be added. |
| Completed | `3` | Selesai | Staff add the completion update and mark the report as completed. |

Views also recognize status `0` as **Ditolak** (rejected), but the current report controller does not implement a rejection action. The documented workflow is submission, staff acceptance, progress updates, and completion; it does not include a resident-to-staff chat, automatic notifications, or a reopen action.

## Getting started

### Prerequisites

- PHP and Composer. [composer.json](composer.json) declares PHP `^7.3|^8.0` and Laravel `^8.75`; actual compatibility also depends on [composer.lock](composer.lock). This is a legacy dependency stack, so do not assume it works with every newer PHP release.
- PHP extensions required by the locked dependencies, including PDO MySQL for the database. Run `composer check-platform-reqs` after installation to check the local environment.
- A local MySQL-compatible database server and its command-line client. The included dump was generated with MariaDB 10.4.19; no database-version support matrix is provided.
- Write access to `storage/`, `bootstrap/cache/`, and `public/storage/files/` for logs, cached views, and uploads.
- Node.js and npm only if rebuilding the Laravel Mix assets. No Node.js version is pinned in [package.json](package.json).

Run the following commands from the repository root, where `artisan` and `composer.json` are located.

### Installation

1. Install the PHP dependencies:

   ```powershell
   composer install
   composer check-platform-reqs
   ```

2. If `.env` does not already exist, copy [.env.example](.env.example). Preserve an existing configuration.

   PowerShell:

   ```powershell
   Copy-Item .env.example .env
   ```

   Bash:

   ```bash
   cp .env.example .env
   ```

3. Edit `.env` for your local database. The username and password below are sample values, not supplied credentials:

   ```dotenv
   APP_NAME=Temani
   APP_ENV=local
   APP_DEBUG=true
   APP_URL=http://127.0.0.1:8000

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=temani_app
   DB_USERNAME=your_local_database_user
   DB_PASSWORD=your_local_database_password
   ```

   Generate a key for a new local installation:

   ```powershell
   php artisan key:generate
   ```

4. Initialize a dedicated local database using [temani_app.sql](temani_app.sql). **The dump contains `DROP TABLE IF EXISTS` statements and populated account and complaint records. Import it only into an empty, disposable database, never an existing or production database.**

   Connect with an account allowed to create a database, replacing the sample username:

   ```powershell
   mysql -h 127.0.0.1 -P 3306 -u your_local_database_user -p
   ```

   At the SQL prompt, create and select the database, then import the dump. Start the client from the repository root so the relative `SOURCE` path resolves:

   ```sql
   CREATE DATABASE temani_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   USE temani_app;
   SOURCE temani_app.sql;
   EXIT;
   ```

   The domain tables (`adm_users`, `adm_categories`, `adm_departements`, `rep_headers`, and `rep_comments`) are in the dump, not in [the migrations](database/migrations). `php artisan migrate` alone is not sufficient. The supplied [DatabaseSeeder](database/seeders/DatabaseSeeder.php) does not initialize these tables either.

5. Start the development server:

   ```powershell
   php artisan serve --host=127.0.0.1 --port=8000
   ```

   Open <http://127.0.0.1:8000/login>. The root URL redirects to this page. The bundled interface loads assets from `public/assets/`; an npm build is not required for this initial path.

## Usage

1. Open <http://127.0.0.1:8000/register> and create a local resident account with your own password.
2. Sign in at `/login`; successful authentication redirects to `/home`.
3. Open `/report/create`, choose a category, and supply a title, description, location, date, time, and image. Use **Berikan Lokasi Saat Ini** to capture your current coordinates and satisfy the browser form's location confirmation field; the controller itself does not require coordinates.
4. Submit the complaint. On success, the application returns to `/home` and displays the complaint in your list.
5. Open the complaint details at `/report/view/{id}` using its actual ID. `/report/print/{id}` streams the corresponding `report.pdf`.

Staff accounts use `/report/list` to take complaints, record updates, and complete work. The controller stores status values `1` (new), `2` (in progress), and `3` (completed). `/report/history` provides complaint history. Department and employee setup is available through the administrator's **Data Dasar** menu; resident registration does not create administrator or employee accounts.

## Data and local safety

- Database records and uploaded files must be backed up together. Uploads are written directly beneath `public/storage/files/`, not through Laravel's configured storage disk. Do not replace the existing `public/storage/` directory with a storage symlink for this setup.
- Uploaded files are publicly served. Avoid submitting sensitive personal data or confidential attachments to a shared instance.
- The SQL dump contains account records, password hashes, and complaint content. Treat it as development data and do not reuse imported accounts for a deployment.
- The defaults use file-based cache and sessions with synchronous queues. Redis, a queue worker, SMTP credentials, and cloud-storage credentials are not needed for the documented local workflow.
- This README describes local development, not production deployment. Review authorization, upload handling, dependency support, and sample-data removal before exposing the application. Keep `.env` private, disable debug mode outside local development, and serve only the `public/` directory.

## Development and testing

Optional asset compilation, from the repository root:

```powershell
npm install
npm run dev
```

`npm run watch` rebuilds assets while editing; `npm run prod` creates production-mode bundles. [webpack.mix.js](webpack.mix.js) compiles `resources/js/app.js` and `resources/css/app.css` into `public/js/` and `public/css/`.

The [PHPUnit configuration](phpunit.xml) defines separate Unit and Feature suites:

```powershell
php artisan test --testsuite=Unit
```

**Before running feature tests**, create `.env.testing` with a separate disposable database and its own application key, import the dump there, and ensure it never points to a shared database. The configuration does not override the database connection. Feature tests depend on fixture accounts; report tests create persistent database records and uploaded files without automatic rollback. Some report fixture paths use Windows backslashes and may need adjustment on other platforms.

After that isolated setup:

```powershell
php artisan test --testsuite=Feature
```

See [validation tests](tests/Unit/ValidationTest.php), [login tests](tests/Feature/LoginTest.php), and [report tests](tests/Feature/ReportTest.php). No dedicated CI test workflows or coverage reporting are included, so no test-status or coverage badges are shown.

### Verification status

Setup and usage instructions were checked against repository source, but database import and browser workflows were not executed. A local `php artisan --version` check on PHP 8.5.2 emitted a Laravel logger deprecation warning and timed out; startup and test compatibility on that runtime remain unverified.

## Key files

| Path | Responsibility |
| --- | --- |
| [routes/web.php](routes/web.php) | Authentication, master-data, and complaint routes. |
| [app/Http/Controllers](app/Http/Controllers) | Authentication, complaint processing, PDF output, and file uploads. |
| [app/Models](app/Models) | Domain models and relationships. |
| [resources/views](resources/views) | Blade pages and the Indonesian interface. |
| [temani_app.sql](temani_app.sql) | Initial domain schema and populated development data. |
| [.env.example](.env.example) | Local configuration defaults. |

## Troubleshooting

- **Missing `adm_*` or `rep_*` tables:** check that `.env` selects the dedicated database into which the SQL dump was imported. Default Laravel migrations do not create these tables. Do not reimport the dump into a database containing work you need to keep.
- **Database connection errors:** verify the server is running and `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` match your local setup. Run `php artisan config:clear` if an old configuration was cached.
- **Missing application key:** run `php artisan key:generate` for a new installation. Do not rotate an existing environment's key just to troubleshoot it.
- **Upload or view-cache failures:** check write permissions for `public/storage/files/`, `storage/`, and `bootstrap/cache/`.
- **Old images are missing:** the SQL dump stores file paths, not file contents. Restoring the database alone does not restore attachments; the corresponding uploaded files must also exist.
