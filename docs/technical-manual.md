# 📘 technical-manual.md (Expected Contents & Format)

## 1. System Overview

* High-level purpose of the project.
* Stack summary (backend, frontend, database, infra).
* Key design decisions (e.g., using CI4 native views + Tailwind via CDNJS).

---

## 2. Architecture

* **Diagram** (boxes + arrows) of:

  * User (browser)
  * CI4 controllers/views
  * Database (MySQL)
  * Docker (dev-only infra)
* Clear description of request flow (HTTP → CI4 Controller → Service → Repository → DB → Response).

---

## 3. Project Structure

* Folder layout with purpose:

  ```
  backend/ci4/      # main CodeIgniter app
  ├── app/Controllers
  ├── app/Models
  ├── app/Views
  ├── app/Services
  ├── app/Repositories
  ├── database/migrations
  ├── database/seeders
  frontend/         # (not used here, only CI4 native views)
  infrastructure/   # Docker files & configs
  docs/             # manuals
  ```
* Conventions: controllers thin, services hold logic, repositories isolate DB.

---

## 4. Data Model

* ER diagram or table definitions.
* Entities: `User`, `Post`, `Comment`, etc.
* Relationships (1\:N, N\:N).
* Example MySQL schema snippet.

---

## 5. API Contracts

* Endpoints list (REST).

  * Example:

    * `POST /v1/auth/login` → Request: {email, password}, Response: {token}
    * `GET /v1/users` → returns list of users
* JSON response envelope standard:

  ```json
  { "data": {...}, "meta": {...} }
  ```
* Error format:

  ```json
  { "error": { "code": "VALIDATION_ERROR", "message": "...", "details": [] } }
  ```

---

## 6. Frontend Conventions

* Using **CI4 native views**.
* TailwindCSS via CDNJS snippet.
* Base layout view includes:

  * Navigation bar
  * Footer
  * Content slot (`<?= $this->renderSection('content') ?>`)

---

## 7. Security & Auth

* Authentication method (JWT or session).
* Role model (e.g., `admin`, `user`).
* CSRF protection toggle (if used in forms).
* Rate limiting (future note).

---

## 8. Testing Strategy

* Unit tests: services.
* Integration tests: repositories.
* API tests: Manual verification using Postman or Insomnia.
* Coverage target (≥70%).

---

## 9. Variants & Extensions

* Baseline = CI4 + MySQL.
* Future extensions: PostgreSQL, MongoDB, Firebase.
* Differences documented here (e.g., MySQL uses `AUTO_INCREMENT`, PG uses `SERIAL` or `UUID`).

---

## 10. Deployment Notes

* Reminder: Docker is **for dev only**.
* For production: deploy via PHP-FPM + Nginx or Apache.
* DB migrations must be run before app start.

---

## 11. Documentation Practices

* Every new feature → update this manual.
* Add request/response examples.
* Add ERD changes when schema evolves.

---

## 12. Notes & Version

* Last update: YYYY-MM-DD
* Who: Author/Editor Name
* TL;DR: One-line summary of what was changed in this doc