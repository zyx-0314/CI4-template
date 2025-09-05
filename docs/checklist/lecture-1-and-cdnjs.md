# Lecture 1 — Step-by-step: Routes, Controllers, Views, and Tailwind via CDN

This document is a short, practical step-by-step guide to build the first pieces of the application: routing, controllers, views, previewing in the browser, small activities (mood board & roadmap), dynamic routes, fragmentation (components), and adding Tailwind via CDNJS.

Checklist (ordered)

- [ ] 1. Routes
- [ ] 2. Controller
- [ ] 3. Views
- [ ] 4. Preview in the browser
- [ ] 5. Activity: create Mood Board page
- [ ] 6. Activity: create Roadmap page
- [ ] 7. Dynamic routes
- [ ] 8. Fragmentation (head, header, footer, cards)
- [ ] 9. Add Tailwind via CDNJS

---

1) Routes

Purpose: map URLs to controller methods. Routes are declared in `app/Config/Routes.php`.

Step-by-step:

- Open `app/Config/Routes.php` and add static routes for the pages you need:

```php
$routes->get('/', 'User::index');
$routes->get('/mood-board', 'User::moodBoard');
$routes->get('/roadmap', 'User::roadmap');
```

- Save and reload the app after adding routes.

Notes:
- Use named groups or prefixes for APIs or admin sections when the app grows.

---

2) Controller

Purpose: prepare data and return views.

Step-by-step:

- Create or update `app/Controllers/User.php` with methods used in routes:

```php
namespace App\Controllers;
use App\Controllers\BaseController;

class User extends BaseController
{
    public function index(): string
    {
        return view('user/landing');
    }

    public function moodBoard(): string
    {
        return view('user/mood_board');
    }

    public function roadmap(): string
    {
        return view('user/roadmap');
    }
}
```

---

3) Views

Purpose: render HTML using the data provided by controllers.

Step-by-step:

- Create `app/Views/user/landing.php`, `app/Views/user/mood_board.php`, and `app/Views/user/roadmap.php`.
- Keep presentation-only logic in views; heavy logic belongs in controllers or services.
- Example include pattern at top of each view:

```php
<?= view('components/head', ['title' => $title ?? 'Site']) ?>
<?= view('components/header') ?>
<main class="mx-auto max-w-5xl px-6 py-8">
  <h1 class="text-3xl font-bold"><?= esc($title ?? 'Landing') ?></h1>
  <!-- page content -->
</main>
<?= view('components/footer') ?>
```

---

4) Preview in the browser

How to preview locally using Docker Compose (your project maps nginx to port 8080):

```cmd
docker compose -f "compose.yaml" up -d nginx php mysql
```

Open: http://localhost:8080/  (or your Docker host IP)

Tips:
- Use `docker compose -f "compose.yaml" logs -f nginx` to watch for errors.
- If routes return 404, confirm `app/Config/Routes.php` is saved and the container has the latest files mounted.

---

<!-- [ ] Actvity 1.1 -->
5) Activity — create Mood Board page

Goal: create a simple mood-board view that shows images, color swatches, and a short copy.

Files to create/update:
- `app/Views/mood_board.php` — main content
- `app/Views/components/cards/mood_card.php` — small reusable card component (optional)

Implementation notes:
- Use Tailwind utilities for layout (grid, gap, rounded images).
- Keep images in `public/images/mood/` and reference via `<?= esc(base_url('images/mood/your.png')) ?>`.

---

<!-- [ ] Actvity 1.2 -->
6) Activity — create Roadmap page

Goal: create a roadmap with timeline rows or cards.

Files to create/update:
- `app/Views/roadmap.php`
- `app/Views/components/roadmap_item.php` (optional)

Implementation notes:
- Use semantic lists or definition lists for timeline items.
- Consider a small grid of quarters or milestones.

---

7) Dynamic routes

Purpose: serve parameterized pages like service detail pages.

Example route and controller method:

```php
// in routes
$routes->get('services/(:segment)', 'User::services/$1');

// in controllers
public function services(?string $style = null): string
{
	$data = ['style' => $style];
	return view('user/service', $data);
}
```

Notes:
- Validate the parameter and return 404 if the resource is not found.

---

8) Fragmentation (components)

Purpose: keep head, header, footer, and small UI parts as reusable fragments under `app/Views/components/`.

Common fragments:

- `components/head.php` — meta tags, fonts, and CDN includes.
- `components/header.php` — logo, navigation.
- `components/footer.php` — footer links and copyright.
- `components/cards/*` — small UI cards (mood card, db health card, etc).

Include fragments with:

```php
<?= view('components/header') ?>
```

---

9) Add Tailwind via CDNJS

Quick add: place this in `components/head.php` before your page styles:

```html
<script src="https://cdn.tailwindcss.com"></script>
```

Optional: configure the CDN-based Tailwind with a small inline `tailwind.config` script if you need theme extensions. For production, prefer compiled CSS.

---

Small examples and tips

- Minimal route + controller + view flow:

```php
// routes
$routes->get('/mood-board', 'Home::moodBoard');

// controller (Home::moodBoard)
return view('mood_board', ['title' => 'Mood board']);

// view
<?= view('components/head', ['title' => 'Mood board']) ?>
```