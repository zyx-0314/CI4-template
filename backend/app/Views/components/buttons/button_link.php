<?php
// Page: components/button/button_link
// Data contract:
// $href: string | null
// $label: string | null
?>
<a href="<?= esc($href ?? '#') ?>" class="inline-block text-blue-600 underline"><?php echo esc($label ?? 'Learn more') ?></a>