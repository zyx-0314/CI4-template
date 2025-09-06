<?php
// Ghost button (muted)
// $label, $href
?>
<a href="<?= esc($href ?? '#') ?>" class="inline-block text-gray-700 px-3 py-1 rounded hover:bg-gray-100">
  <?= esc($label ?? 'More') ?>
</a>
