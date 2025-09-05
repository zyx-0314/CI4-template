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
?>

<header class="bg-white shadow">
  <div class="flex justify-between items-center mx-auto py-6 max-w-5xl">
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
      <a href="/" class="text-gray-700">Home</a>
  <a href="/roadmap" class="text-gray-700">Road map</a>
  <a href="/login" class="text-gray-700">Login</a>
      <a href="/services" class="inline-block bg-emerald-400 hover:bg-emerald-500 px-4 py-2 rounded text-white" role="button">Request Assistance</a>
  </div>
    </nav>
  </div>
</header>
