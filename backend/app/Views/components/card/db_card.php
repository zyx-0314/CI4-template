<?php
/**
 * components/db_card.php
 *
 * Usage:
 * <?= view('components/db_card', ['dbGroup' => 'default', 'title' => 'DB Health']) ?>
 *
 * Optional params:
 * - dbGroup: database group name from Config/Database (default: 'default')
 * - title: short title shown under the number
 * - logo: path to logo image (default: /public/logo/main.svg)
 */

$dbGroup = $dbGroup ?? 'default';
$title   = $title   ?? 'Database tables';
$logo    = $logo    ?? base_url('logo/main.svg');

// Use the DbHealthService to fetch DB status
use App\Services\DbHealthService;

$service = new DbHealthService();
$result = $service->getHealth($dbGroup);

$connected = $result['connected'];
$tablesCount = $result['tablesCount'];
$error = $result['error'];

?>
<!-- DB card component: lengthwise horizontal card -->
<div class="bg-white shadow-lg rounded-lg w-full max-w-3xl overflow-hidden">
  <div class="flex items-center space-x-6 px-6 py-6">
    <!-- Logo column -->
    <div class="flex flex-shrink-0 justify-center items-center bg-gray-50 rounded-md w-24 h-24">
      <img src="<?= esc($logo) ?>" alt="logo" class="w-auto h-12" />
    </div>

    <!-- Number and status column (center) -->
    <div class="flex-1 text-center">
      <div class="font-extrabold text-gray-800 text-5xl"><?= $tablesCount !== null ? esc($tablesCount) : '&#8212;' ?></div>
      <div class="mt-2 text-gray-500 text-sm"><?= esc($title) ?></div>
      <div class="mt-1 text-xs">
        <?php if ($connected): ?>
          <span class="inline-block bg-emerald-100 px-2 py-1 rounded text-emerald-700 text-xs">Connected</span>
        <?php else: ?>
          <span class="inline-block bg-red-100 px-2 py-1 rounded text-red-700 text-xs">Disconnected</span>
        <?php endif; ?>
      </div>
    </div>

    <!-- Explanation / details column -->
    <div class="w-80">
      <p class="text-gray-600 text-sm">This card shows a quick health check of the configured database connection and the current number of tables. Use this component for status dashboards and admin pages.</p>
      <?php if ($error): ?>
        <p class="mt-3 text-red-600 text-xs">Error: <?= esc($error) ?></p>
      <?php endif; ?>
    </div>
  </div>
</div>
