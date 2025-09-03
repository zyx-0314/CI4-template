# 📄 Commit Manual

## Commit Types

* **feat** → Add a new feature or functionality.
* **fix** → Correct a bug, error, or unintended behavior.
* **docs** → Documentation updates (manuals, notes, diagrams, README, etc.).
* **refactor** → Use this when you rename, restructure, simplify, or remove duplicate code, improve readability, or make non-behavioral performance improvements. 

---

## Branch Categories

Branches follow the pattern:

```
<category>/<short-description>
```

* **frontend/** → React, Vue, Tailwind, or UI-related work.

  * Example: `frontend/login-form-validation`
  * Example: `frontend/mobile-first-layout`

* **backend/** → CodeIgniter 4 backend code (controllers, services, repositories, API).

  * Example: `backend/user-auth-service`
  * Example: `backend/jwt-token-refresh`

* **databases/** → Migrations, seeds, schema updates, or DB-specific fixes.

  * Example: `databases/add-posts-table`
  * Example: `databases/pg-uuid-migration`

* **documents/** → Project manuals, SOPs, technical notes, instructional docs.

  * Example: `documents/update-dev-manual`
  * Example: `documents/add-copilot-instructions`

---

## Commit Examples

### **feat**

**Short only:**

```
feat(backend): implement user login with JWT
```

**With body:**

```
feat(frontend): add Zustand store for session handling

Introduced a Zustand store to manage user sessions and JWT tokens
on the client. This simplifies state management and removes the
need for prop drilling across components.
```

---

### **fix**

**Short only:**

```
fix(backend): correct validation error handling in UsersController
```

**With body:**

```
fix(frontend): resolve mobile navbar overlap on small screens

Adjusted Tailwind classes to fix z-index and flex layout issues.
The navbar now properly collapses into a hamburger menu and
no longer hides the main content on iPhone SE screens.
```

---

### **docs**

**Short only:**

```
docs(documents): update commit-manual.md with branching rules
```

**With body:**

```
docs(documents): add rollback steps to sop-manual.md

Expanded the SOP manual to include rollback instructions
after a failed migration. This helps ensure database
consistency during staging releases.
```

---

### **refactor**

**Short only:**

```
refactor(backend): rename UserRepository to AccountRepository
```

**With body:**

```
refactor(backend): extract validation logic from UsersController

Moved request validation into a new `UserValidator` service to
decouple controller responsibilities and improve testability. No
behavioral changes intended; updated unit tests accordingly.
```

---

✅ **Rule of Thumb:**

* **Header** → concise summary (`<type>(<scope>): <short description>`).
* **Body** → *why + what changed* (wrap at \~72 chars per line).
* **Scope** → optional, but use (`frontend`, `backend`, `databases`, `documents`).
