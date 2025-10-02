<?php
// Component: components/header.php
// $brandTitle: string
// $brandTagline: string|null
// $logo: object
?>
<?php
$nav = [
  ['label' => 'Home', 'href' => '/'],
  ['label' => 'Services', 'href' => '/services'],
  ['label' => 'Obituary', 'href' => '/obituary'],
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

    <!-- Desktop Navigation -->
    <nav class="hidden md:flex items-center space-x-4 text-sm" aria-label="Primary navigation">
      <?php $session = session(); ?>
      <?php foreach ($nav ?? [] as $item):
        $label = $item['label'] ?? '';
        $isLogin = strtolower($label) === 'login';
        $isObituary = strtolower($label) === 'obituary';

        $show = true;
        if ($isLogin && $session->has('user')) {
          $show = false;
        }
        if ($isObituary && !$session->has('user')) {
          $show = false;
        }

        if ($show): ?>
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

    <!-- Mobile Navigation -->
    <div class="md:hidden flex items-center space-x-4">
      <!-- CTA Button for Mobile -->
      <?= $cta ?? false ? view('components/buttons/button_primary', ['label' => $cta['label'], 'href' => '#']) : '' ?>

      <!-- Burger Menu Button -->
      <button
        id="mobile-menu-button"
        type="button"
        class="inline-flex justify-center items-center hover:bg-gray-100 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-inset text-gray-400 hover:text-gray-500"
        aria-controls="mobile-menu"
        aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <!-- Menu icon -->
        <svg class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <!-- Close icon (hidden by default) -->
        <svg class="hidden w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
  </div>

  <!-- Mobile Navigation Drawer -->
  <div id="mobile-menu" class="hidden md:hidden z-50 fixed inset-0">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-gray-600/75" id="mobile-menu-backdrop"></div>

    <!-- Drawer Panel -->
    <div class="right-0 fixed inset-y-0 bg-white shadow-xl w-full max-w-xs transition-transform translate-x-full duration-300 ease-in-out transform">
      <div class="flex justify-between items-center p-4 border-b">
        <h2 class="font-medium text-gray-900 text-lg">Menu</h2>
        <button
          type="button"
          class="inline-flex justify-center items-center hover:bg-gray-100 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-inset text-gray-400 hover:text-gray-500"
          id="mobile-menu-close">
          <span class="sr-only">Close menu</span>
          <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <nav class="space-y-4 px-4 py-6" role="menu" aria-orientation="vertical" aria-labelledby="mobile-menu-button">
        <?php foreach ($nav ?? [] as $item):
          $label = $item['label'] ?? '';
          $isLogin = strtolower($label) === 'login';
          $isObituary = strtolower($label) === 'obituary';

          $show = true;
          if ($isLogin && $session->has('user')) {
            $show = false;
          }
          if ($isObituary && !$session->has('user')) {
            $show = false;
          }

          if ($show): ?>
            <a
              href="<?= esc($item['href'] ?? '#') ?>"
              class="<?= !empty($active ?? false && $active == $item['label']) ? 'text-sage-dark font-bold' : 'text-gray-700' ?> block px-3 py-2 text-base font-medium hover:bg-gray-50 rounded-md"
              role="menuitem">
              <?= esc($item['label'] ?? '') ?>
            </a>
        <?php endif;
        endforeach; ?>

        <?php if ($session->has('user')): ?>
          <div class="mt-6 pt-4 border-t">
            <div class="flex items-center space-x-3 px-3 py-2">
              <div class="flex justify-center items-center bg-gray-200 rounded-full w-8 h-8 text-gray-700">👤</div>
              <div class="font-medium text-gray-900 text-sm">User Menu</div>
            </div>
            <div class="space-y-1 mt-3">
              <a href="#" class="block hover:bg-gray-50 px-3 py-2 rounded-md font-medium text-gray-700 text-base" role="menuitem">Settings</a>
              <a href="/settings/profile" class="block hover:bg-gray-50 px-3 py-2 rounded-md font-medium text-gray-700 text-base" role="menuitem">Profile</a>
              <?php
              if (strtolower($type ?? 'client') !== 'client'):
                $dash = strtolower($type) === 'manager' ? '/admin/dashboard' : '/employee/dashboard';
              ?>
                <a href="<?= esc($dash) ?>" class="block hover:bg-gray-50 px-3 py-2 rounded-md font-medium text-gray-700 text-base" role="menuitem">Dashboard</a>
              <?php endif; ?>
              <form method="get" action="/logout" class="mt-2">
                <button type="submit" class="block hover:bg-gray-50 px-3 py-2 rounded-md w-full font-medium text-gray-700 text-base text-left" role="menuitem">Logout</button>
              </form>
            </div>
          </div>
        <?php endif; ?>
      </nav>
    </div>
  </div>
</header>

<script>
  (function() {
    'use strict';

    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const mobileMenuBackdrop = document.getElementById('mobile-menu-backdrop');
    const drawerPanel = mobileMenu.querySelector('.fixed.inset-y-0');

    if (!mobileMenuButton || !mobileMenu || !mobileMenuClose || !mobileMenuBackdrop || !drawerPanel) {
      return;
    }

    function openMobileMenu() {
      mobileMenu.classList.remove('hidden');
      mobileMenuButton.setAttribute('aria-expanded', 'true');

      // Show menu icons
      mobileMenuButton.querySelector('.block').classList.add('hidden');
      mobileMenuButton.querySelector('.hidden').classList.remove('hidden');

      // Animate drawer in
      setTimeout(() => {
        drawerPanel.classList.remove('translate-x-full');
        drawerPanel.classList.add('translate-x-0');
      }, 10);

      // Trap focus
      mobileMenuClose.focus();

      // Prevent body scroll
      document.body.style.overflow = 'hidden';
    }

    function closeMobileMenu() {
      // Animate drawer out
      drawerPanel.classList.remove('translate-x-0');
      drawerPanel.classList.add('translate-x-full');

      setTimeout(() => {
        mobileMenu.classList.add('hidden');
        mobileMenuButton.setAttribute('aria-expanded', 'false');

        // Show hamburger icon
        mobileMenuButton.querySelector('.hidden').classList.add('hidden');
        mobileMenuButton.querySelector('.block').classList.remove('hidden');

        // Restore body scroll
        document.body.style.overflow = '';

        // Return focus to button
        mobileMenuButton.focus();
      }, 300);
    }

    // Event listeners
    mobileMenuButton.addEventListener('click', openMobileMenu);
    mobileMenuClose.addEventListener('click', closeMobileMenu);
    mobileMenuBackdrop.addEventListener('click', closeMobileMenu);

    // Keyboard support
    mobileMenu.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeMobileMenu();
      }
    });

    // Close menu when clicking on navigation links
    const mobileNavLinks = mobileMenu.querySelectorAll('a[role="menuitem"]');
    mobileNavLinks.forEach(link => {
      link.addEventListener('click', closeMobileMenu);
    });
  })();
</script>