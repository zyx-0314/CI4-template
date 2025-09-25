<?php
// Component: components/cards/card_stats.php
// Data contract:
// $title: string
// $value: string|int
// $subtitle: string|null
// $class: string|null
?>

<div class="bg-white rounded-lg shadow p-4 <?php echo isset($class) ? esc($class) : ''; ?>">
    <p class="text-gray-500 text-sm"><?php echo esc($title ?? ''); ?></p>
    <p class="font-bold text-2xl"><?php echo esc($value ?? ''); ?></p>
    <?php if (! empty($subtitle)): ?>
        <p class="mt-1 text-gray-400 text-xs"><?php echo esc($subtitle); ?></p>
    <?php endif; ?>
</div>