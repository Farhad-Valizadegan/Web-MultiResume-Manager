# ResumeFolio — Web Resume Management System

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)

ResumeFolio is a full-stack resume management platform built with Laravel. It
allows users to create and manage multiple professional resumes, share them
through unique public links, protect them with employer passwords, generate PDF
versions, and track viewing activity.

The application includes separate admin and user areas, role-based
authorization, secure authentication, and a responsive interface.

**Live application:** [https://resumefolio.de](https://resumefolio.de)

## Features

### User features

- Dashboard with resume and view statistics
- Create and manage multiple resumes
- Add and edit:
  - Basic information
  - Skills
  - Languages
  - Interests
  - Education
  - Work experience and internships
  - Projects
  - Certificates and courses
- Upload a profile image
- Generate a unique public resume link
- Protect a public resume with a hashed employer password
- Generate and download a resume as PDF
- Upload a custom PDF and configure available download options
- Activate or deactivate a resume
- Track total views and the most recent view time

### Admin features

- Dashboard with platform-wide statistics
- View totals for users, resumes, active resumes, inactive resumes, and views
- Create, edit, activate, deactivate, and delete users
- Assign admin and user roles
- View and manage resumes across the platform
- Open resume details and public resume links

### Public resume features

- Access through a unique public URL
- Optional password protection
- Responsive resume presentation
- Generated and uploaded PDF downloads, according to owner settings
- View tracking without exposing internal analytics to visitors

## Technology Stack

| Area | Technology |
| --- | --- |
| Backend | PHP 8.4, Laravel 12 |
| Authentication | Laravel Breeze 2 |
| Frontend | Blade, Tailwind CSS 4, Alpine.js 3 |
| Database | MySQL |
| PDF generation | Laravel DOMPDF 3 |
| Asset pipeline | Vite 8 |
| Testing | PHPUnit through Laravel's test runner |
| CI | GitHub Actions |
| Production | Linux, Nginx, PHP-FPM, HTTPS |

Versions verified for v1.0.0:

- Laravel Framework `12.64.0`
- Laravel Breeze `2.4.2`
- Laravel DOMPDF `3.1.2`
- Tailwind CSS and `@tailwindcss/vite` `4.3.3`
- Alpine.js `3.15.12`
- Vite `8.1.5`

## Requirements

- PHP `8.2` or later with the extensions required by Laravel
- Composer
- Node.js `22` or later and npm
- MySQL

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/Farhad-Valizadegan/web-resume-management-system.git
   cd web-resume-management-system
   ```

2. Install PHP and JavaScript dependencies:

   ```bash
   composer install
   npm install
   ```

3. Create the environment file and application key:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   On Windows PowerShell:

   ```powershell
   Copy-Item .env.example .env
   ```

4. Configure the database in `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=resume_management_system
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Prepare the database and public storage:

   ```bash
   php artisan migrate
   php artisan storage:link
   ```

6. Start the development servers:

   ```bash
   php artisan serve
   npm run dev
   ```

   Open `http://127.0.0.1:8000`.

## Production Build

Build the optimized frontend assets:

```bash
npm run build
php artisan optimize
```

The web server document root must point to Laravel's `public` directory. Keep
`APP_DEBUG=false` in production, configure HTTPS, and run Laravel background
tasks under an appropriate process manager when required.

## Windows and XAMPP

If another PHP installation is selected in the terminal, call XAMPP PHP
directly:

```powershell
C:\xampp\php\php.exe artisan migrate
C:\xampp\php\php.exe artisan test
C:\xampp\php\php.exe artisan serve
```

If PowerShell blocks `npm.ps1`, use:

```powershell
npm.cmd install
npm.cmd run dev
npm.cmd run build
```

An Apache virtual host should use the project's `public` directory:

```apache
<VirtualHost *:80>
    ServerName resume.test
    DocumentRoot "C:/path/to/web-resume-management-system/public"

    <Directory "C:/path/to/web-resume-management-system/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Add the local domain to the Windows hosts file:

```text
127.0.0.1 resume.test
```

## Authentication and Authorization

- Public registration is disabled.
- Administrators create and manage user accounts.
- Admin and user areas are protected by authentication and role middleware.
- Users may manage only their own resumes.
- Guest access is limited to active public resumes and their permitted files.

## Security

- Application and resume passwords are hashed and never stored as plain text.
- Laravel provides CSRF protection, input validation, session security, and
  escaped Blade output.
- Authorization policies and middleware protect user and admin resources.
- Environment secrets are kept outside version control.
- Production runs over HTTPS.

Never commit `.env`, credentials, private keys, generated secrets, or production
database exports.

## Testing

Run the automated test suite:

```bash
php artisan test
```

The v1.0.0 verification result is:

```text
112 tests passed
537 assertions
```

The suite covers authentication, profiles, roles, admin access, resume
management, public resume access, password protection, PDF behavior, validation,
and authorization rules.

Additional release checks:

```bash
composer validate
composer audit
npm audit
npm run build
```

For v1.0.0, Composer and npm reported no known security vulnerabilities, the
production build passed, and GitHub Actions completed successfully.

## Project Structure

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   ├── User/
│   │   └── PublicResumeController.php
│   └── Middleware/
├── Models/
└── Policies/

database/
├── factories/
├── migrations/
└── seeders/

resources/
├── css/
├── js/
└── views/
    ├── admin/
    ├── auth/
    ├── public/
    ├── user/
    └── layouts/

routes/
└── web.php

tests/
├── Feature/
└── Unit/
```

## Development Workflow

Changes are developed on focused branches and integrated through pull requests:

```text
branch → implement → test → commit → push → pull request → CI → review → merge
```

Dependency updates are managed with Dependabot, while GitHub Actions validates
the application before changes are merged.

## Release Status

Version `v1.0.0` is the first stable portfolio release. Its user, admin, public
resume, password-protection, PDF, analytics, security, CI, and production
deployment workflows are complete.

Known minor presentation items may be refined after v1.0.0:

- Improve wrapping for unusually long job titles
- Simplify duplicate resume-creation actions
- Use a friendlier last-viewed date format

## Roadmap

- Additional resume templates and design customization
- Improved PDF layouts
- Profile-photo cropping
- Email notifications
- Advanced analytics and reporting
- Multilingual resume support
- Broader end-to-end browser test coverage

## Author

**Farhad Valizadegan**

[GitHub profile](https://github.com/Farhad-Valizadegan)

## License

This project is licensed under the [MIT License](LICENSE).
