<?php
// Component: components/cards/card.php
// Data contract:
// $title: string
// $excerpt: string
// $image: string|null
// $href: string|null
?>
<article class="bg-white shadow-sm border rounded-lg overflow-hidden">
  <?php if (!empty($image)): ?>
    <img src="<?= esc($image) ?>" alt="<?= esc($title ?? '') ?>" class="w-full h-40 object-cover">
  <?php endif; ?>
  <div class="p-4">
    <?php if (!empty($title)): ?>
      <h3 class="mb-2 font-semibold text-lg"><?= esc($title) ?></h3>
    <?php endif; ?>
    <?php if (!empty($excerpt)): ?>
      <p class="mb-4 text-gray-600 text-sm"><?= esc($excerpt) ?></p>
    <?php endif; ?>
    <?php if (!empty($href)): ?>
      <a href="<?= esc($href) ?>" class="inline-block font-medium text-blue-600 text-sm">Read more</a>
    <?php endif; ?>
  </div>
</article>