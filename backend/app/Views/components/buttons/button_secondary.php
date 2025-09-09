<?php
// Secondary (outline) button
// $label, $href
?>
<a href="<?= esc($href ?? '#') ?>" class="inline-block border border-white text-white px-4 py-2 rounded hover:bg-white hover:text-blue-600 transition">
  <?= esc($label ?? 'Secondary') ?>
</a>
