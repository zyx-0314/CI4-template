<?php
// Primary button
// $label: string
// $href: string
?>
<a href="<?= esc($href ?? '#') ?>" class="inline-block bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
  <?= esc($label ?? 'Action') ?>
</a>
