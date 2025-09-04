# Lecture 1 — Views, Routing, Fragments, and CDNJS (Tailwind)

This checklist collects the practical notes and action items from Lecture 1: building a simple site with server-rendered views, routing, small fragments/components, and using CDN-hosted assets (Tailwind via CDN).

## Quick checklist

- [ ] Create a View (presentation layer) under `app/Views/` for each page.
- [ ] Create a Controller method in `app/Controllers/` to prepare data and render the view.
- [ ] Register routes in `app/Config/Routes.php` (static and dynamic routes).
- [ ] Use dynamic routes for parameterized content (e.g., `/services/(:segment)`).
- [ ] Fragment your UI into reusable partials/components under `app/Views/components/` (head, header, footer, cards).
- [ ] Prefer Tailwind utilities for styling; consider CDN vs compiled CSS tradeoffs.

## Views

- Purpose: render HTML. Keep logic minimal in views — controllers/services should supply data.
- File location: `app/Views/<your-page>.php` or `app/Views/components/<fragment>.php`.

## Controllers

- Purpose: gather data, validate input, call models/services, and return a view.
- Keep controllers thin: move business logic into services.

## Routes

- Static example:

	- `$routes->get('/mood-board', 'Home::moodBoard');`

- Dynamic example:

	- `$routes->get('/services/(:segment)', 'Home::service/$1');`

## Fragmentation (Components)

- Common fragments: `head.php`, `header.php`, `footer.php`, and small card/list components.
- Use `<?= view('components/header') ?>` to include fragments and pass data explicitly.

## Tailwind via CDN (notes)

- Quick include (CDN):

	```html
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
	```

## Accessibility & Performance

- Use semantic HTML, aria-* attributes for interactive fragments (menus, dialogs).
- Avoid heavy JS where CSS-only solutions suffice. Respect `prefers-reduced-motion` when adding animations.
- For performance, loading large CDN JS (Tailwind CDN, ScrollReveal) adds network cost. Consider self-hosting compiled assets for production.

## Small examples

- Include a fragment:

	```php
	<?= view('components/head', ['title' => 'Landing']) ?>
	<?= view('components/header') ?>
	```

- Minimal dynamic route controller method:

	```php
	public function service($slug)
	{
			$data['service'] = $this->serviceModel->findBySlug($slug);
			return view('user/service', $data);
	}
	```