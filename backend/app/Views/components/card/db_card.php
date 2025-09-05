<?php
/**
 * components/card/db_card.php
 *
 * Data contract (optional):
 * - $dbGroup: string - database group name from Config/Database (default: 'default')
 * - $title: string - short title shown under the count (default: 'Database tables')
 * - $logo: string - URL/path to the logo image (default: base_url('logo/main.svg'))
 *
 * Output shape (used by view):
 * - connected: bool|null
 * - tablesCount: int|null
 * - error: string|null
 *
 * Accessibility:
 * - The status text is inside an aria-live region so screen readers are notified of connection changes.
 */

$dbGroup = $dbGroup ?? 'default';
$title   = $title   ?? 'Database tables';
$logo    = $logo    ?? base_url('logo/main.svg');

// Use the DbHealthService to fetch DB status
// Obtain service via CodeIgniter service locator / DI factory so implementations
// can be swapped easily in testing or via a container.
$service = service('dbHealth');
$result = $service->getHealth($dbGroup);

$connected = $result['connected'] ?? null;
$tablesCount = $result['tablesCount'] ?? null;
$error = $result['error'] ?? null;

?>
<!-- DB card component: lengthwise horizontal card -->
<div class="bg-white shadow-lg rounded-lg w-full max-w-3xl overflow-hidden" role="group" aria-labelledby="dbcard-title">
  <div class="flex items-center space-x-6 px-6 py-6">
    <!-- Logo column -->
    <div class="flex flex-shrink-0 justify-center items-center bg-gray-50 rounded-md w-24 h-24">
      <img src="<?= esc($logo) ?>" alt="logo" class="w-auto h-12" />
    </div>

    <!-- Number and status column (center) -->
    <div class="flex-1 text-center">
      <div id="dbcard-count" class="font-extrabold text-gray-800 text-5xl" aria-hidden="false"><?= $tablesCount !== null ? esc($tablesCount) : '&#8212;' ?></div>
      <div id="dbcard-title" class="mt-2 text-gray-500 text-sm"><?= esc($title) ?></div>
      <div id="dbcard-status" class="mt-1 text-xs" aria-live="polite">
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
      <?php if (! empty($error)): ?>
        <p class="mt-3 text-red-600 text-xs" role="alert">Error: <?= esc($error) ?></p>
      <?php endif; ?>
    </div>
  </div>
</div>
