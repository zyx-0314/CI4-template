# Lecture 2 — Step-by-step: Build the database layer (Migrations → Models → Entities → Seeders)

This file is a practical, step-by-step procedure you can follow when building the database-backed parts of the application. It is written for a Docker-based local environment using the `php` service in `compose.yaml`.

Checklist (high level)

- [ ] Create migrations (schema) using Spark or composer inside the `php` container.
- [ ] Create Models matching the tables and define `$allowedFields` and validation.
- [ ] Create Entities for typed model results.
- [ ] Create Seeders to bootstrap development data.
- [ ] Add a Clear/Truncate seeder for safe test resets.
- [ ] Apply schema changes with new migrations when the model evolves.
- [ ] Practice intentional schema modification (e.g., split `full_name` into `first_name` and `last_name`) via migrations.

---

1) Create Migrations (schema)

Why: migrations are the single source of truth for DB schema and allow reproducible changes across environments.

How (inside Docker): prefer using Spark commands inside the `php` container so generated files end up in the project workspace:

```cmd
docker compose  exec php php spark make:migration CreateFuneralRequestsTable
```

Edit the generated file under `backend/app/Database/Migrations/` and add fields with `$this->forge->addField([...])` and `$this->forge->createTable('funeral_requests')`.

Run migrations:

```cmd
docker compose  exec php composer migrate
```

Check status:

```cmd
docker compose  exec php composer migrate:status
```

Tips:
- Use the 14-digit timestamp prefix in file names (Spark does this automatically) so CodeIgniter detects them.
- Keep migrations small and additive. Prefer creating new migrations to modify schema rather than editing already-run migrations.

---

2) Create Models

Why: models are the interface between your app and the DB. They handle saving, finding, validation, and can return Entities.

How:

Create `app/Models/FuneralRequestModel.php` (example skeleton):

```php
namespace App\Models;
use CodeIgniter\Model;

class FuneralRequestModel extends Model
{
		protected $table = 'funeral_requests';
		protected $allowedFields = ['name','email','phone','service_type','preferred_date','preferred_time','address','notes','status'];
		protected $useTimestamps = true;
		protected $returnType = 'App\\Entities\\FuneralRequest';
}
```

Commands are simple file edits; you can scaffold with your editor and then run unit tests or try the model in Tinker-like scripts.

---

3) Create Entities

Why: Entities provide a typed, object-like representation of rows and help with casting and date handling.

Example `app/Entities/FuneralRequest.php`:

```php
namespace App\Entities;
use CodeIgniter\Entity\Entity;

class FuneralRequest extends Entity
{
		protected $dates = ['created_at', 'updated_at'];
}
```

This is optional but recommended if you want presentational helpers or casting behavior.

---

4) Create Seeders

Why: Seeders add sample data for development and tests. Use them to populate realistic data sets.

How (example): create `app/Database/Seeds/FuneralRequestsSeeder.php` that inserts multiple rows. Run it with:

```cmd
docker compose  exec php php spark db:seed FuneralRequestsSeeder
```

Notes:
- Keep seed files idempotent for convenience (e.g., check for existing rows or use unique values).

---

5) Add Clear / Truncate capability

Why: during development it's convenient to reset tables. Use a dedicated seeder that truncates tables rather than ad-hoc SQL.

How:

Create `app/Database/Seeds/ClearDatabaseSeeder.php` and in `run()` call `$db->table('funeral_requests')->truncate()` wrapped with `$db->disableForeignKeyChecks()`/`$db->enableForeignKeyChecks()`.

Run:

```cmd
docker compose  exec php composer truncate
```

Warning: only run truncate/clear in non-production environments.

---

6) Evolve schema: add new migrations when models change

Why: never edit migrations that have already been applied in shared (or production) environments. Instead create a new migration to apply changes.

Example — add an index or new column:

```cmd
docker compose  exec php php spark make:migration AddStatusIndexToFuneralRequests
```

Run migrations:

```cmd
docker compose  exec php composer migrate
```

Check status:

```cmd
docker compose  exec php composer migrate:status
```

Edit the new migration to call `$this->forge->addColumn()` or `$this->forge->addKey()` and run `php spark migrate`.

---


Appendix — Quick Docker commands + Composer script usage

Start the stack:

```cmd
docker compose  up -d mysql php nginx
```

Direct Spark commands inside the `php` container (recommended):

```cmd
docker compose  exec php php spark migrate:status
docker compose  exec php php spark migrate
docker compose  exec php php spark db:seed FuneralRequestsSeeder
docker compose  exec php php spark db:seed ClearDatabaseSeeder
```

Equivalent Composer script usage (if you added scripts to `backend/composer.json`). Running Composer inside the `php` container will execute the configured spark commands:

```cmd
docker compose  exec php composer migrate
docker compose  exec php composer migrate:status
docker compose  exec php composer seed
docker compose  exec php composer truncate
```
