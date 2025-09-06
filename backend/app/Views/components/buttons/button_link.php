<?php
// Simple link button
// $label, $href
?>
<a href="<?= esc($href ?? '#') ?>" class="text-blue-600 underline inline-block"><?php echo esc($label ?? 'Learn more') ?></a>
