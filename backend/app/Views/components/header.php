<?php
// Component: header
// Data contract:
// $title: string (site or page title)
// $nav: array of ['label' => string, 'href' => string, 'active' => bool]
// Usage: <?= view('components/header', ['title' => 'My Site', 'nav' => $nav]) 
?>
<header class="bg-white shadow px-4">
  <div class="flex justify-between items-center mx-auto py-6 max-w-5xl">
    <div class="flex items-center space-x-4">
      <a href="/" class="flex items-center space-x-3" aria-label="Sunset Funeral Homes">
        <img src="logo/main.svg" alt="Sunset Funeral Homes" class="h-11">
        <div class="hidden sm:block">
          <h1 class="font-semibold text-xl">Sunset Funeral Homes</h1>
          <p class="text-gray-500 text-sm">Compassionate care, every step of the way</p>
        </div>
      </a>
    </div>
    <nav class="flex items-center space-x-4 text-sm" aria-label="Primary navigation">
      <?php foreach ($nav ?? [] as $item): ?>
        <a href="<?= esc($item['href'] ?? '#') ?>" class="<?= !empty($item['active']) ? 'text-blue-600 font-semibold' : 'text-gray-700' ?>">
          <?= esc($item['label'] ?? '') ?>
        </a>
      <?php endforeach; ?>
      <a href="<?= esc($cta['href'] ?? '#') ?>" class="inline-block px-4 py-2 rounded header-cta">
        <?= esc($cta['label'] ?? '') ?>
      </a>
    </nav>
  </div>
  </nav>
  </div>
</header>