<?php
// Component: components/table/services.php
// Data contract:
// $services: object array
?>
<?php
// read GET params
$page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$per_page = isset($_GET['per_page']) ? max(1, (int) $_GET['per_page']) : 5;

$dataToUse = $services;
// filter only active services (expect objects when passed from controller)
$active = array_values(array_filter($dataToUse, function ($s) {
    if (is_array($s)) {
        return (int) ($s['is_active'] ?? 0) === 1;
    }
    if (is_object($s)) {
        // use public property if available, otherwise try getter
        if (isset($s->is_active)) return (int) $s->is_active === 1;
        if (method_exists($s, 'getIsActive')) return (int) $s->getIsActive() === 1;
        if (method_exists($s, 'isActive')) return (int) $s->isActive() === 1;
    }
    return false;
}));
$total = count($active);
$total_pages = (int) max(1, ceil($total / $per_page));
if ($page > $total_pages) $page = $total_pages;

$start = ($page - 1) * $per_page;
$pageItems = array_slice($active, $start, $per_page);

function querySetter(array $overrides = [])
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
                    <?php foreach ($pageItems as $service): ?>
                        <tr class="border-t">
                            <td class="p-3"><?php echo $service->title; ?></td>
                            <td class="p-3">₱<?php echo number_format((float) $service->cost, 2); ?></td>
                            <td class="p-3"><?php echo ((int) $service->is_available === 1) ? 'Yes' : 'No'; ?></td>
                            <td class="flex gap-2 p-3">
                                <div class="flex justify-end mb-4">
                                    <a class="bg-gray-600/70 hover:bg-gray-600/60 px-3 py-2 rounded text-white duration-200 cursor-pointer" href="<?php echo site_url('services/' . urlencode($service->id)); ?>">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                                <?= view('components/modal/services/delete', ['service' => $service]) ?>
                                <?= view('components/modal/services/update', ['service' => $service]) ?>
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
                    <a class="px-3 py-1 border rounded <?php echo ($page <= 1) ? 'opacity-50 pointer-events-none' : ''; ?>" href="?<?php echo querySetter(['page' => $page - 1 < 1 ? 1 : $page - 1, 'per_page' => $per_page]); ?>">Prev</a>
                    <?php for ($p = $startP; $p <= $endP; $p++): ?>
                        <a class="px-3 py-1 border rounded <?php echo ($p == $page) ? 'btn-sage text-white' : ''; ?>" href="?<?php echo querySetter(['page' => $p, 'per_page' => $per_page]); ?>"><?php echo $p; ?></a>
                    <?php endfor; ?>
                    <a class="px-3 py-1 border rounded <?php echo ($page >= $total_pages) ? 'opacity-50 pointer-events-none' : ''; ?>" href="?<?php echo querySetter(['page' => $page + 1 > $total_pages ? $total_pages : $page + 1, 'per_page' => $per_page]); ?>">Next</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>