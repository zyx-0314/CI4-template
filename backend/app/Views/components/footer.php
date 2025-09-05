<?php

/**
 * components/footer.php
 *
 * Data contract (optional):
 * - $logo: string - URL/path to logo image (default: base_url('logo/main.svg'))
 * - $companyName: string - Company name text (default: 'Sunset Funeral Homes')
 * - $contact: array|null - Optional contact info array: ['phone' => string, 'email' => string]
 *
 * Accessibility:
 * - Headings for each column provide landmarks for screen readers.
 */
?>
<footer class="bg-white mt-12 border-t" role="contentinfo">
  <div class="mx-auto px-6 py-8 max-w-5xl text-gray-600 text-sm">
    <div class="flex md:flex-row flex-col md:justify-between md:items-start gap-6">
      <div>
        <img src="<?= esc($logo ?? base_url('logo/main.svg')) ?>" alt="<?= esc($companyName ?? 'Sunset Funeral Homes') ?>" class="mb-2 h-11">
        <p><?= esc($companyName ?? 'Sunset Funeral Homes') ?> — <?= esc($companyTagline ?? 'Compassionate care, every step of the way') ?></p>
      </div>
      <div class="gap-6 grid grid-cols-1 sm:grid-cols-3">
        <div>
          <h4 class="mb-2 font-semibold">Services</h4>
          <ul>
            <li><a href="/services/traditional" class="hover:underline">Traditional Filipino</a></li>
            <li><a href="/services/cremation" class="hover:underline">Cremation</a></li>
            <li><a href="/services/green" class="hover:underline">Green burial</a></li>
          </ul>
        </div>
        <div>
          <h4 class="mb-2 font-semibold">Company</h4>
          <ul>
            <li><a href="/mood-board" class="hover:underline">Mood board</a></li>
            <li><a href="/roadmap" class="hover:underline">Road map</a></li>
          </ul>
        </div>
        <div>
          <h4 class="mb-2 font-semibold">Contact</h4>
          <p>Phone: <?= esc(($contact['phone'] ?? '(555) 123-4567')) ?></p>
          <p>Email: <a href="mailto:<?= esc($contact['email'] ?? 'info@sunsetfunerals.example') ?>" class="hover:underline"><?= esc($contact['email'] ?? 'info@sunsetfunerals.example') ?></a></p>
        </div>
      </div>
    </div>
    <div class="mt-6 text-gray-500">© <?= esc($companyName ?? 'Sunset Funeral Homes') ?> — CI4 Sample Project 1</div>
  </div>
</footer>