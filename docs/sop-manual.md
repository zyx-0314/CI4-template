# 📄 SOP Manual

## GitHub Workflow

### Step 1: Create an Issue

* Go to **GitHub → Issues → New Issue**.
* Write a **clear, focused title** (only one task per issue).

  * Example: *“Add JWT authentication service”*
* Add a short description: *what is needed, why it matters*.
* Assign labels if applicable (`frontend`, `backend`, `databases`, `documents`).

---

### Step 2: Create a Branch

* From the Issue page, click **“Create a branch for this issue”** (GitHub UI).
* Name branch using the category + short description:

  * `backend/jwt-auth-service`
  * `frontend/login-form-validation`

---

### Step 3: Write the Code

* Work only on the task defined in the Issue.
* Keep changes small and related.
* Follow [core-engineering-principles.md](./core-engineering-principles.md).

---

### Step 4: Identify What to Add in the Commit Tag

Before committing, ask:

1. Is this a **new feature**? → use `feat`
2. Is this a **bug fix**? → use `fix`
3. Is this a **documentation update**? → use `docs`

---

### Step 5: Commit Using the UI or CLI

* In VSCode or GitHub Desktop: stage changes → commit.
* Format:

  ```
  <type>(<scope>): <short summary>

  <body explaining what and why>
  ```
* Examples:

  * `feat(backend): add JWT auth middleware`
  * `fix(databases): correct migration timestamp`
  * `docs(documents): update sop-manual.md with GitHub workflow`

---

### Step 6: Double-Check Branch

* Run `git branch` (CLI) or check bottom-left in VSCode.
* Confirm you’re on the branch linked to the Issue.
* Do **not** commit to `main` directly.

---

### Step 7: Stage & Push

* Stage files (UI or CLI: `git add .`).
* Push branch to GitHub:

  * `git push origin backend/jwt-auth-service`
* Verify branch appears in remote repository.

---

### Step 8: Create a Pull Request (PR)

* On GitHub, open **Pull Requests → New PR**.
* Select your branch → merge into `main`.
* **PR title** = same format as commit message.
* In description:

  * Link issue → e.g., `Closes #12`
  * Add what changed + why
  * Add tests or docs updated

---

### Step 9: Review & Approve

* Reviewer checks:

  * ✅ CI/CD green (tests, lint, coverage)
  * ✅ PR scope matches Issue
  * ✅ Code follows principles (KISS, SOLID, etc.)
  * ✅ Docs updated if needed
* If approved → **Merge Pull Request** (Squash or Rebase).
* Delete branch after merge (optional but recommended).

Perfect — I see your **`sop-manual.md`** is already built around the **GitHub Workflow** (steps 1–9). To keep uniformity, you’ll just **append new SOP sections** in the same style (with `##` headers and `### Step X` sub-steps).

Based on what you outlined earlier, here’s what you’d append:

---

## File & Folder SOP

### Step 1: Create Files with Consistent Naming

* Use **PascalCase** for PHP classes (`UserService.php`).
* Use **snake\_case** for DB columns (`created_at`, `user_id`).
* Use **kebab-case** for markdown/doc files (`dev-manual.md`).

### Step 2: Place Files in Correct Folders

* Controllers → `app/Controllers/`
* Services → `app/Services/`
* Repositories → `app/Repositories/`
* Views → `app/Views/`
* Docs → `docs/`

### Step 3: Keep Folders Tidy

* No unused or experimental files.
* Remove obsolete files during PR cleanup.

---

## Development SOP

### Step 1: Start with an Issue

* Every task must begin with a **GitHub Issue**.

### Step 2: Follow the Workflow

* Issue → Branch → Code → Test → Iterate → Docs → PR → Review.

### Step 3: Testing Checklist

* Unit tests (`phpunit`) must pass.
* Static analysis (`phpstan`) must pass.
* API tests (`pstman or insomnia`) must pass for backend changes.

---

## Stand-Up SOP (Every 2 Weeks)

### Step 1: Prepare Completed Work

* List Issues closed.
* List merged PRs.

### Step 2: Commit Review

* Highlight meaningful commits and explain decisions.

### Step 3: Demo & Testing

* Show running features (`docker compose up`).
* Run sample tests (phpunit or Postman).

### Step 4: Grading

* Assesment Scores: 
✅ Done <70%
- Can proceed
⚠️ Partial <50% - >70%
- Can proceed but need to report again as part of the second stand-up
❌ Pending >50%
- Require to do stand-up during discussion day

10 mins to present, if not completed then expected as `Pending`

---

## Fragments & View Components (SOP)

This section documents the standard for view fragments (partials/components) used across the project. It is intentionally short and prescriptive so teams can follow a single convention.

### Purpose

- Keep small, reusable UI fragments in `app/Views/components/` so views remain DRY and consistent.
- Fragments cover small UI pieces: header, footer, cards, tables, carousels, menus, and tiny widgets.

### Naming and layout

- Root folder: `app/Views/components/`.
- File naming: use `component.php` (no dots or extra separators). Examples:
  - `app/Views/components/header.php`
  - `app/Views/components/footer.php`
- Variations grouped in subfolders by type:
  - `app/Views/components/cards/card.php`
  - `app/Views/components/cards/card_featured.php`
  - `app/Views/components/carousel/simple.php`

### How to include

- Use CodeIgniter's view helper. Basic include:

  ```php
  <?= view('components/header') ?>
  ```

- Pass data explicitly:

  ```php
  <?= view('components/cards/card', ['item' => $item]) ?>
  ```

- Subfolder include example:

  ```php
  <?= view('components/cards/card_featured', $data) ?>
  ```

### Style & responsibilities

- Fragments are presentation-focused. Keep business logic in Controllers/Services.
- Acceptable logic: small conditionals, loops, and escaping. Keep complexity out of views.
- Document the data contract for each component (required keys and types). Example contract for a card:

  ```php
  // $data = ['item' => ['title' => string, 'excerpt' => string, 'image' => string|null]]
  ```

- Use the project's CSS utility system (Tailwind) for consistent spacing and typography.

### Accessibility & JS

- Prefer CSS-first interactions. When JS is needed (dropdowns, carousels):
  - Implement unobtrusive JS in a shared file (e.g., `public/js/components.js`).
  - Ensure keyboard support and proper ARIA roles.
  - Components should remain functional (readable) without JS where feasible.

Example (accessible dropdown pattern):

```html
<button aria-haspopup="true" aria-expanded="false" id="servicesBtn">Services</button>
<ul role="menu" aria-labelledby="servicesBtn" id="servicesMenu" hidden>
  <li role="menuitem"><a href="/services/traditional">Traditional Filipino</a></li>
  <li role="menuitem"><a href="/services/cremation">Cremation</a></li>
</ul>
```

Small JS should toggle `aria-expanded` and the `hidden` attribute, and handle Escape and Arrow keys.

### Migration checklist

- Scan views for legacy or inconsistent includes and update to `view('components/<name>')`.
- Move repeated patterns into `components/<type>/` subfolders and document the component contract.
- Add one example component per type (header, card, table) and include usage examples in `readme.md` or `docs/components.md`.

---