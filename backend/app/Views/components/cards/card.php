<?php
// Component: cards/card.php
// Data contract:
// $title: string
// $excerpt: string
// $image: string|null
// $href: string|null
?>
<article class="border rounded-lg overflow-hidden shadow-sm bg-white">
  <?php if (!empty($image)): ?>
    <img src="<?= esc($image) ?>" alt="<?= esc($title ?? '') ?>" class="w-full h-40 object-cover">
  <?php endif; ?>
  <div class="p-4">
    <?php if (!empty($title)): ?>
      <h3 class="font-semibold text-lg mb-2"><?= esc($title) ?></h3>
    <?php endif; ?>
    <?php if (!empty($excerpt)): ?>
      <p class="text-sm text-gray-600 mb-4"><?= esc($excerpt) ?></p>
    <?php endif; ?>
    <?php if (!empty($href)): ?>
      <a href="<?= esc($href) ?>" class="inline-block text-sm text-blue-600 font-medium">Read more</a>
    <?php endif; ?>
  </div>
</article>
