<?php
// Component: components/cta.php
// Data contract:
// $heading: string
// $sub: string|null
// $primary: object
// $secondary: object
?>
<section class="bg-sage my-8 py-12 rounded-lg text-white">
  <div class="mx-auto px-4 text-center container">
    <?php if (!empty($heading)): ?>
      <h2 class="mb-2 font-bold text-2xl"><?= esc($heading) ?></h2>
    <?php endif; ?>
    <?php if (!empty($sub)): ?>
      <p class="mb-4 text-blue-100"><?= esc($sub) ?></p>
    <?php endif; ?>
    <div class="flex justify-center gap-4">
      <?php if (!empty($primary)): ?>
        <?= view('components/buttons/button_primary', ['label' => $primary['label'], 'href' => $primary['href']]) ?>
      <?php endif; ?>
      <?php if (!empty($secondary)): ?>
        <?= view('components/buttons/button_secondary', ['label' => $secondary['label'], 'href' => $secondary['href']]) ?>
      <?php endif; ?>
    </div>
  </div>
</section>