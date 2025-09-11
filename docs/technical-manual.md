# 📘 technical-manual.md

## 1. System overview

This repository provides a starter CodeIgniter 4 (CI4) backend using CI4 native views for UI. It includes a small set of controllers, models, views, and tests plus Docker compose support for local development.

- Stack summary:
  - Backend: PHP 8.x + CodeIgniter 4
  - Views: CI4 native views (Tailwind can be included via CDNJS)
  - Database: development assumes MySQL (see migrations); models use standard CI4 database conventions
  - Infra: Docker (dev), Nginx + PHP-FPM for production
  - Tests: PHPUnit (config at `backend/phpunit.xml.dist`)

- Key config observed:
  - `backend/app/Config/App.php` sets `baseURL` = `http://localhost:8090/`
  - Timezone = `UTC`, default locale = `en`, Content Security Policy disabled by default

---

## 2. Architecture

High level request flow used by the project:

- HTTP request → Router → Controller (thin) → Service (business logic) → Repository / Model → Database → Controller → View / JSON response

Notes:
- `BaseController` is minimal; controllers are expected to load services or helpers they require.
- Docker is provided for local development; production deployment should use PHP-FPM + Nginx.

---

## 3. Project structure

Top-level layout (relevant directories in this repo):

```
backend/
  app/
    Config/
    Controllers/   # Admin.php, Auth.php, Employee.php, Reservation.php, Users.php
    Models/        # UsersModel.php
    Entities/      # User.php
    Views/         # admin/, auth/, employee/, user/, components/
  public/          # index.php, assets, uploads
  tests/           # PHPUnit tests and examples
  composer.json
  Dockerfile
  phpunit.xml.dist
docs/
  technical-manual.md
  sop-manual.md
  commit-manual.md
```

Conventions used in this repo:
- Controllers should be thin: handle request/response and delegate work to services.
- Business logic belongs in Services; database access should be isolated in Repositories/Models.

---

## 4. Data model

Current Models and Used for:
- Users -> Houses Data of User in Client, Admin and Employee
- Services -> Houses Data of Services provided

---

## 5. API contracts and route discovery

List of current APIs:

### Create
- `/signup`: Create Client: Account
- `/login`: Create Auth Verification
- `/admin/services/create`: Create Service

### Read
- `/logout`: Request Removal of Auth Verification
- `/services`: View Services List
- `/services/(:segment)`: View Specific Service

### Update
- `/admin/services/update`: Update Service

### Delete
- `/admin/services/delete`: Delete Service

---

## 6. Frontend conventions

- Use CI4 native views located under `backend/app/Views/`.
- TailwindCSS can be included via CDNJS in base layout files. Keep JS unobtrusive and small; prefer server-side rendering for basic pages.
- Fragment Code

---

## 7. Security & authentication
<!-- Upcomming -->

---

## 8. Testing strategy

- will be doing manual testing documented at `test.md`
- currebtly has the following:
  - Authentication: Admin, User and Employee
  - Services(Admin): Create, Read(All), Update and Delete
  <!-- - Request: Create -->

---

## 9. Documentation practices

- Update this manual when adding features, changing contracts, or altering the schema.
- Add request/response examples and update the ERD section when migrations change.

---

## 10. Notes & version

- Last update: 2025-09-11
- Who: repo maintainer
- TL;DR: Filled in system overview, project layout, UsersModel-derived data contract, and a plan for extracting API endpoints.