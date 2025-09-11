# Manual Test Plan

This document lists manual test cases to exercise the main user flows and documents expected results and evidence capture. Save completed run reports under `docs/test-results/` (e.g. `docs/test-results/ISSUE-123-2025-09-11.md`).

Base notes / assumptions

- Dev base URL: `http://localhost:8090/` (from `backend/app/Config/App.php`).
- Assume the database has been migrated and seeded. If your seed names differ, replace `<SeederName>` below.
- Example seed credentials (adjust if your seeds use different emails):
  - Manager (admin): email `admin@example.com`, password `password123`
  - Employee: email `employee@example.com`, password `password123`
  - Client: email `client@example.com`, password `password123`

If you don't have seeds, run migrations and seeds from the `backend` folder (replace seeder name as needed):

```cmd
docker compose exec php composer migrate
docker compose exec php composer seed:all
```

Test checklist

- [ ] Login (manager/admin)
- [ ] Login (employee)
- [ ] Login (client)
- [ ] Logout
- [ ] Create service (admin)
- [ ] Verify service appears in client list and admin table
- [ ] Update service to "unavailable" (admin)
- [ ] Trigger delete (soft-delete) and verify removal from client list
- [ ] Select product and checkout (reservation flow)

Test cases

1) Login (manager/admin)

- Goal: Verify admin can authenticate using seeded credentials and access `/admin/dashboard`.

Steps:
- Open browser to `http://localhost:8090/login` and sign in with seeded admin credentials.

Expected:
- HTTP 200 or redirect to `/admin/dashboard`.
- Admin UI loads and allows access to services management at `/admin/services`.

2) Login (employee)

- Goal: Verify employee user can sign in and access `employee/dashboard`.

Steps:
- Browser: `/login` with seeded employee credentials.

Expected:
- HTTP 200 or redirect to `/employee/dashboard`.
- Employee dashboard loads.

3) Login (client)

- Goal: Verify normal client user can sign in and view public pages.

Steps:
- Browser: `/login` with client credentials or visit public pages that do not require auth.

Expected:
- `/` returns page with account now visible at the top right (HTTP 200).

4) Logout

- Goal: Verify that users (admin, employee, client) can log out and are redirected to the login page; session is cleared.

Steps:
- While logged in, click the Logout button/link in the UI or visit `/logout` endpoint directly.

Expected:
- HTTP 302 redirect to home page.
- Session/cookie is cleared; protected pages require re-authentication.
- UI no longer shows account info.

5) Create service (admin)

- Goal: Create a new service from the admin UI and verify the backend returns success and created id.

Steps (UI):
- Login as admin, open `/admin/services`, click Add / Create service modal, fill fields (title, cost, description, inclusions, is_available), submit.

Expected:
- HTTP 201 Created
- Confirm service row appears in table.

6) View service list in client and admin

- Goal: Verify created service is visible in client list and admin table.

Steps:
- Open `services` (client) and confirm service title appears.
- Open `admin/services` (admin) and confirm service row appears in table.

Expected:
- Admin table shows row with title and correct cost.
- Client page lists service when `is_available` = 1.

7) Update service to unavailable (admin)

- Goal: Toggle a service to be unavailable and verify it is hidden from client listing.

Steps (UI):
- On admin services table, click Update for the created service, uncheck "Is available", Save.

Expected:
- Client `/services` page no longer shows the service when `is_available` = 0.
- Confirm service row available column is No.

7) Delete trigger (soft-delete)

- Goal: Soft-delete the created service and verify it is not active and not shown on client pages; admin may show archived state.

Steps (UI):
- In admin, click Delete for the service and confirm via modal.

Expected:
- HTTP 200
- JSON body: { "success": true, "message": "Service deleted", "data": { "id": <created_id> } }
- DB fields should reflect `is_active = 0` and `deleted_at` set.
- Client `/services` page should not show the service.
- Confirm service row is not present.

8) Select product and checkout (reservation flow)

- Goal: Client selects a service and completes reservation/checkout flow (reservation form).

Steps (UI):
- On client `/services`, click a service to view its show page (`/services/{id}`), click Reserve/Checkout, fill reservation form (name, contact, date/time) and submit.

Expected:
- HTTP 200 or HTTP 201 depending on implementation
- JSON or redirect with confirmation message