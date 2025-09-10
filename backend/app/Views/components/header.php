<?php

/**
 * components/header.php
 *
 * Data contract (optional):
 * - $brandTitle: string - Title displayed next to the logo (default: "Sunset Funeral Homes")
 * - $brandTagline: string - Small tagline under the title (default: "Compassionate care, every step of the way")
 * - $logo: string - URL/path to the logo image (default: base_url('logo/main.svg'))
 *
 * Notes:
 * - Minimal presentation view. Keep logic small and pass only simple strings.
 */

$nav = [
  ['label' => 'Home', 'href' => '/'],
  ['label' => 'Services', 'href' => '/services'],
  ['label' => 'Login', 'href' => '/login'],
];
$cta = ['label' => 'Request Assistance', 'href' => '/services'];
?>

<header class="bg-white shadow px-4">
  <div class="flex justify-between items-center mx-auto py-5 max-w-6xl">
    <div class="flex items-center space-x-4">
      <a href="/" class="flex items-center space-x-3" aria-label="<?= esc($brandTitle ?? 'Sunset Funeral Homes') ?> home">
        <img src="<?= esc($logo ?? base_url('logo/main.svg')) ?>" alt="<?= esc($brandTitle ?? 'Sunset Funeral Homes') ?>" class="h-11">
        <div class="hidden sm:block">
          <h1 class="font-semibold text-xl"><?= esc($brandTitle ?? 'Sunset Funeral Homes') ?></h1>
          <p class="text-gray-500 text-sm"><?= esc($brandTagline ?? 'Compassionate care, every step of the way') ?></p>
        </div>
      </a>
    </div>
    <nav class="flex items-center space-x-4 text-sm" aria-label="Primary navigation">
      <?php $session = session(); ?>
      <?php foreach ($nav ?? [] as $item):
        if ((!$session->has('user') && $item['label'] === "Login") || $item['label'] !== "Login"): ?>
          <a href="<?= esc($item['href'] ?? '#') ?>" class="<?= !empty($active ?? false && $active == $item['label']) ? 'text-sage-dark font-bold' : 'text-gray-700' ?>">
            <?= esc($item['label'] ?? '') ?>
          </a>
      <?php endif;
      endforeach; ?>

      <?= $cta ?? false ? view('components/buttons/button_primary', ['label' => $cta['label'], 'href' => '#']) : '' ?>

      <?php if ($session->has('user')): ?>
        <details class="relative">
          <summary class="flex items-center space-x-2 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-emerald-500 cursor-pointer">
            <span class="sr-only">Open user menu</span>
            <div class="flex justify-center items-center bg-gray-200 rounded-full w-8 h-8 text-gray-700">👤</div>
          </summary>
          <div class="right-0 z-50 absolute bg-white shadow mt-2 py-1 border rounded w-48">
            <a href="#" class="block hover:bg-gray-100 px-4 py-2 text-gray-700 text-sm">Settings</a>
            <a href="/settings/profile" class="block hover:bg-gray-100 px-4 py-2 text-gray-700 text-sm">Profile</a>
            <?php
            $u = $session->get('user') ?? null;
            $type = is_array($u) ? ($u['type'] ?? 'client') : (method_exists($u, 'toArray') ? ($u->toArray()['type'] ?? 'client') : 'client');
            if (strtolower($type) !== 'client'):
              $dash = strtolower($type) === 'manager' ? '/admin/dashboard' : '/employee/dashboard';
            ?>
              <a href="<?= esc($dash) ?>" class="block hover:bg-gray-100 px-4 py-2 text-gray-700 text-sm">Dashboard</a>
            <?php endif; ?>
            <form method="get" action="/logout">
              <button type="submit" class="hover:bg-gray-100 px-4 py-2 w-full text-gray-700 text-sm text-left">Logout</button>
            </form>
          </div>
        </details>
      <?php endif; ?>

    </nav>
  </div>
  </nav>
  </div>
</header>