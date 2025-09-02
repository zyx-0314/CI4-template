# 📄 Dev Manual

## 1. Project Overview

This project is an **instructional template** for CodeIgniter 4 with:

* Backend: CodeIgniter 4 (PHP 8.3)
* Frontend: CodeIgniter 4 native views + TailwindCSS via CDNJS
* Database: MySQL 8
* Infrastructure: Docker (local dev environment only)

👉 Use this as a **base template**. New projects will be cloned from this structure.

---

## 2. Requirements

* **Installed locally**:

  * Docker & Docker Compose v2
  * Git
  * VSCode (recommended with PHP + Docker extensions)

* **Optional tools**:

  * Postman or Insomnia (API testing)
  * MySQL Workbench or phpMyAdmin

---

## 3. Environment Setup

### Step 1: Clone Repository

Use VSCode’s **Source Control UI** to clone the repository.
Or via CLI:

```bash
git clone <repo-url>
cd ci4-instructional-template
```

### Step 2: Environment File

* Copy `.env.example` into `.env` inside `backend/ci4`.
* Ensure `.env` is **not ignored** in `.dockerignore`.
* Environment variables will be loaded into containers automatically.

### Step 3: Start Containers

```bash
docker compose up --build
```

* App: `http://localhost:8080`
* phpMyAdmin (if enabled): `http://localhost:8081`

---

## 4. Database

### Run Migrations

```bash
docker compose exec php php spark migrate
```

### Run Seeders

```bash
docker compose exec php php spark db:seed UserSeeder
```

---

## 5. TailwindCSS (CDNJS)

Tailwind is included directly in CI4 views using the CDN link:

```html
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
```

* Place the link in your base layout view (`app/Views/layouts/main.php`).
* No build tools required.

---

## 6. Running Tests

### PHPUnit

```bash
docker compose exec php vendor/bin/phpunit
```

### PHPStan (static analysis)

```bash
docker compose exec php vendor/bin/phpstan analyse
```

---

## 7. Common Tasks

* **New Migration**

```bash
docker compose exec php php spark make:migration CreatePostsTable
```

* **New Seeder**

```bash
docker compose exec php php spark db:seed PostSeeder
```

* **Run Server (inside container)**

```bash
docker compose exec php php spark serve
```

---

## 8. Troubleshooting

* **Ports in use** → Change port mapping in `docker-compose.yml`.
* **.env not loaded** → Ensure it’s present in repo & not in `.dockerignore`.
* **Permission errors** → Run `chmod -R 775 writable/`.
* **Container stuck** → Rebuild:

  ```bash
  docker compose down -v && docker compose up --build
  ```

---

## 9. Notes & Version

* Last update: YYYY-MM-DD
* Who: Author/Editor Name
* TL;DR: One-line summary of what was changed in this doc