<?php
// Server-rendered services table using a local dummy dataset while API is unavailable.
// Usage: include this view from an admin page. Supports GET params: page, per_page

// --- Dummy dataset (from provided JS converted to PHP arrays) ---
$DUMMY_SERVICES = [
    ['id' => 1, 'title' => 'Basic Funeral Package', 'description' => 'Simple service with chapel of rest', 'cost' => 15000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Chapel,Hearse,Flowers'],
    ['id' => 2, 'title' => 'Standard Funeral Package', 'description' => 'Includes viewing and basic catering', 'cost' => 30000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Chapel,Hearse,Catering'],
    ['id' => 3, 'title' => 'Premium Funeral Package', 'description' => 'Full service with extended amenities', 'cost' => 60000, 'is_available' => 0, 'is_active' => 1, 'inclusions' => 'Chapel,Limo,Catering,Program'],
    ['id' => 4, 'title' => 'Cremation Service', 'description' => 'Cremation-only service', 'cost' => 12000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Cremation Certificate'],
    ['id' => 5, 'title' => 'Memorial Only', 'description' => 'Memorial service without remains', 'cost' => 8000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Venue,Sound System'],
    ['id' => 6, 'title' => 'Archived Package (inactive)', 'description' => 'Old package no longer available', 'cost' => 5000, 'is_available' => 0, 'is_active' => 0, 'inclusions' => ''],
    ['id' => 7, 'title' => 'Express Service', 'description' => 'Quick handling and burial', 'cost' => 7000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Hearse'],
    ['id' => 8, 'title' => 'Deluxe with Reception', 'description' => 'Includes reception after service', 'cost' => 45000, 'is_available' => 1, 'is_active' => 1, 'inclusions' => 'Reception,Catering,Program'],
];

// read GET params
$page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$per_page = isset($_GET['per_page']) ? max(1, (int) $_GET['per_page']) : 5;

// filter only active services
$active = array_values(array_filter($DUMMY_SERVICES, function ($s) {
    return (int) ($s['is_active'] ?? 0) === 1;
}));
$total = count($active);
$total_pages = (int) max(1, ceil($total / $per_page));
if ($page > $total_pages) $page = $total_pages;

$start = ($page - 1) * $per_page;
$pageItems = array_slice($active, $start, $per_page);

function h($s)
{
    return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8');
}

// helper to build query strings while keeping other GET params
function qs(array $overrides = [])
{
    $q = array_merge($_GET, $overrides);
    return http_build_query($q);
}
?>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="p-4 overflow-x-auto">
        <table class="w-full min-w-[640px] text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Title</th>
                    <th class="p-3">Cost</th>
                    <th class="p-3">Available</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pageItems)) : ?>
                    <tr>
                        <td class="p-3" colspan="5">No services found</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($pageItems as $it): ?>
                        <tr class="border-t">
                            <td class="p-3"><?php echo h($it['id']); ?></td>
                            <td class="p-3"><?php echo h($it['title']); ?></td>
                            <td class="p-3">₱<?php echo number_format((float) ($it['cost'] ?? 0), 2); ?></td>
                            <td class="p-3"><?php echo ((int) ($it['is_available'] ?? 0) === 1) ? 'Yes' : 'No'; ?></td>
                            <td class="flex gap-2 p-3">
                                <div class="flex justify-end mb-4">
                                    <a class="bg-gray-600/70 hover:bg-gray-600/60 px-3 py-2 rounded text-white duration-200 cursor-pointer" href="<?php echo site_url('services/' . urlencode($it['id'])); ?>">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                                <?= view('components/modal/services/delete', ['service' => $it]) ?>
                                <?= view('components/modal/services/update', ['service' => $it]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="bg-gray-50 p-4 border-t">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <form method="get" style="display:flex;align-items:center;gap:.5rem;">
                    <label for="per_page" class="text-gray-700 text-sm">Show</label>
                    <select id="per_page" name="per_page" class="p-1 border rounded text-sm" onchange="this.form.submit()">
                        <option value="5" <?php echo $per_page == 5 ? 'selected' : ''; ?>>5</option>
                        <option value="10" <?php echo $per_page == 10 ? 'selected' : ''; ?>>10</option>
                        <option value="20" <?php echo $per_page == 20 ? 'selected' : ''; ?>>20</option>
                    </select>
                    <input type="hidden" name="page" value="1" />
                    <span class="text-gray-700 text-sm">per page</span>
                </form>
            </div>
            <div class="flex justify-end items-center space-x-2">
                <?php if ($total_pages > 1): ?>
                    <?php $startP = max(1, $page - 3);
                    $endP = min($total_pages, $page + 3); ?>
                    <a class="px-3 py-1 border rounded <?php echo ($page <= 1) ? 'opacity-50 pointer-events-none' : ''; ?>" href="?<?php echo qs(['page' => $page - 1 < 1 ? 1 : $page - 1, 'per_page' => $per_page]); ?>">Prev</a>
                    <?php for ($p = $startP; $p <= $endP; $p++): ?>
                        <a class="px-3 py-1 border rounded <?php echo ($p == $page) ? 'btn-sage text-white' : ''; ?>" href="?<?php echo qs(['page' => $p, 'per_page' => $per_page]); ?>"><?php echo $p; ?></a>
                    <?php endfor; ?>
                    <a class="px-3 py-1 border rounded <?php echo ($page >= $total_pages) ? 'opacity-50 pointer-events-none' : ''; ?>" href="?<?php echo qs(['page' => $page + 1 > $total_pages ? $total_pages : $page + 1, 'per_page' => $per_page]); ?>">Next</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>