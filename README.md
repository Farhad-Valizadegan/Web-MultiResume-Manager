# Web Resume Management System

A Laravel-based resume management system that allows users to create, manage, protect, and share professional resumes through secure public links. The system includes separate admin and user dashboards, password-protected public resume access, PDF download options, and resume view analytics.

This project was developed as a web development portfolio project using Laravel, Blade, Tailwind CSS, MySQL, and Laravel Breeze authentication.

---

## Project Overview

The Web Resume Management System is designed for users who want to manage multiple resumes for different job applications. Each resume can have its own public link and employer access password. Employers can view the shared resume without creating an account, while resume owners can track how many times their resumes have been viewed.

The system includes two main roles:

* **Admin**: manages users and all resumes in the system.
* **User**: creates, edits, protects, and shares resumes.

---

## Main Features

### User Features

* User dashboard with resume statistics.
* Create multiple resumes.
* Edit resume information.
* Add and manage:

  * Basic resume information
  * Skills
  * Languages
  * Hobbies and interests
  * Education
  * Work experience and internships
  * Projects
  * Certificates and courses
* Set or change employer access password.
* Generate public resume links.
* Upload a custom resume PDF.
* Choose download options:

  * Generated resume PDF only
  * Uploaded resume PDF only
  * Both generated and uploaded PDF
* Track resume view count.
* See last viewed date and time.

### Admin Features

* Admin dashboard with system analytics.
* View total users, resumes, active resumes, inactive resumes, and total resume views.
* Manage users:

  * Create users
  * Edit users
  * Deactivate users
  * Delete users
* Manage all resumes:

  * View all user resumes
  * Open public resume links
  * View resume details
  * Delete resumes
* View resume analytics across the platform.

### Public Resume Features

* Public resume access through a unique link.
* Password-protected resume access for employers.
* Clean public resume display.
* No view counter visible to employers.
* Download generated or uploaded PDF depending on user settings.
* Resume view count increases when the public resume is accessed.

---

## Technologies Used

* **PHP**
* **Laravel**
* **Laravel Breeze**
* **Blade Templates**
* **Tailwind CSS**
* **MySQL**
* **Vite**
* **Composer**
* **NPM**
* **XAMPP**
* **Git and GitHub**

---

## Project Structure

Important folders and files:

```text
app/
├── Http/Controllers/
│   ├── Admin/
│   ├── User/
│   └── PublicResumeController.php
├── Models/

database/
├── migrations/

resources/
├── views/
│   ├── admin/
│   ├── auth/
│   ├── public/
│   ├── user/
│   └── layouts/

routes/
└── web.php

public/
└── images/
```

---

## Installation and Setup

### 1. Clone the Repository

```bash
git clone https://github.com/Farhad-Valizadegan/web-resume-management-system.git
cd web-resume-management-system
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JavaScript Dependencies

```bash
npm install
```

### 4. Create Environment File

Copy the example environment file:

```bash
cp .env.example .env
```

On Windows PowerShell:

```powershell
copy .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Configure Database

Update the `.env` file with your local database information:

```env
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### 7. Run Migrations

```bash
php artisan migrate
```

### 8. Create Storage Link

```bash
php artisan storage:link
```

### 9. Build Frontend Assets

For development:

```bash
npm run dev
```

For production build:

```bash
npm run build
```

### 10. Run the Application

```bash
php artisan serve
```

Then open:

```text
http://127.0.0.1:8000
```

If using a local virtual host, open:

```text
http://resume.test
```

---

## Local Virtual Host Example

For XAMPP, the Apache virtual host can point to the Laravel `public` folder:

```apache
<VirtualHost *:80>
    ServerName resume.test
    DocumentRoot "C:/xampp/htdocs/PROJECTs/Web-Development/resume-management-system/public"

    <Directory "C:/xampp/htdocs/PROJECTs/Web-Development/resume-management-system/public">
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog "logs/resume.test-error.log"
    CustomLog "logs/resume.test-access.log" common
</VirtualHost>
```

The Windows `hosts` file should include:

```text
127.0.0.1 resume.test
```

---

## Security Notes

The `.env` file is not included in this repository for security reasons. It contains sensitive local configuration such as database credentials and application keys.

The following files and folders are ignored by Git:

```text
.env
/vendor
/node_modules
/public/storage
/storage/*.key
```

This means that after cloning the project, each developer must create their own `.env` file and install dependencies locally.

---

## Screenshots

Screenshots can be added later in a dedicated folder:

```text
public/screenshots/
```

Suggested screenshots:

* Login page
* User dashboard
* My resumes page
* Create resume page
* Edit resume page
* Public resume password page
* Public resume view
* Admin dashboard
* Admin users page
* Admin resumes page

Example Markdown format:

```markdown
![User Dashboard](public/screenshots/user-dashboard.png)
```

---

## Current Status

The project currently includes the main user, admin, and public resume workflows. It is functional locally and has been pushed to a private GitHub repository.

---

## Future Improvements

Possible future improvements:

* Improve generated PDF design.
* Add resume templates.
* Add profile photo cropping.
* Add email notifications.
* Add advanced resume analytics.
* Add search and filtering for admin pages.
* Add pagination for users and resumes.
* Add automated tests.
* Add deployment configuration.
* Add multilingual support.

---

## Author

**Farhad Valizadegan**

This project was developed as a personal web development portfolio project.
