<?php
// Page: components/button/button_border
// Data contract:
// $disable: boolean | null
// $href: string | null
// $label: string | null
// $dark: string | null
?>
<?php
if ($disable ?? false) :
?>
  <a href="<?= esc($href ?? '#') ?>" class="inline-block opacity-50 shadow px-4 py-2 rounded text-white duration-200 btn-disabled">
    <?= esc($label ?? 'Action') ?>
  </a>
<?php
elseif ($dark ?? false) :
?>
  <a href="<?= esc($href ?? '#') ?>" class="inline-block shadow px-4 py-1.5 btn-border-dark rounded text-white transition duration-200">
    <?= esc($label ?? 'Secondary') ?>
  </a>
<?php
else:
?>
  <a href="<?= esc($href ?? '#') ?>" class="inline-block shadow px-4 py-1.5 btn-border dark:btn-border-dark rounded text-white transition duration-200">
    <?= esc($label ?? 'Secondary') ?>
  </a>
<?php
endif;
?>