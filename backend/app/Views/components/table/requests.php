<?php
// Component: components/table/requests.php
// Data contract:
// $requests: object array
// $accountList: object array
?>
<?php
// read GET params for pagination
$page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$per_page = isset($_GET['per_page']) ? max(1, (int) $_GET['per_page']) : 5;

$dataToUse = $requests ?? [];
// filter only active requests (expect arrays or objects)
$active = array_values(array_filter($dataToUse, function ($r) {
    if (is_array($r)) {
        return (int) ($r['is_active'] ?? 0) === 1;
    }
    if (is_object($r)) {
        if (isset($r->is_active)) return (int) $r->is_active === 1;
        if (method_exists($r, 'getIsActive')) return (int) $r->getIsActive() === 1;
        if (method_exists($r, 'isActive')) return (int) $r->isActive() === 1;
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
        <table class="w-full min-w-[800px] text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-3">Service</th>
                    <th class="p-3">Name</th>
                    <th class="p-3">Start</th>
                    <th class="p-3">End</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pageItems)) : ?>
                    <tr>
                        <td class="p-3" colspan="10">No requests found</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($pageItems as $idx => $item): ?>
                        <tr class="border-t">
                            <?php
                            // normalize values from array or object
                            $id = is_array($item) ? ($item['id'] ?? null) : ($item->id ?? null);
                            $service_name = is_array($item) ? ($item['service_name'] ?? '') : ($item->service_name ?? '');
                            $user_id = is_array($item) ? ($item['user_id'] ?? '') : ($item->user_id ?? '');
                            $first_name = is_array($item) ? ($item['first_name'] ?? '') : ($item->first_name ?? '');
                            $last_name = is_array($item) ? ($item['last_name'] ?? '') : ($item->last_name ?? '');
                            $date_start = is_array($item) ? ($item['date_start'] ?? '') : ($item->date_start ?? '');
                            $date_end = is_array($item) ? ($item['date_end'] ?? '') : ($item->date_end ?? '');
                            $status = is_array($item) ? ($item['status'] ?? '') : ($item->status ?? '');
                            ?>
                            <td class="p-3"><?php echo htmlspecialchars((string) $service_name); ?></td>
                            <td class="flex flex items-center p-3">
                                <i class="fa-regular fa-circle-check pr-4 <?php echo $user_id ? "text-green-500" : "text-gray-500/60 text-xs"; ?>"></i>
                                <span>
                                    <?php echo htmlspecialchars(trim($first_name . ' ' . $last_name)); ?>
                                </span>
                            </td>
                            <td class="p-3"><?php echo htmlspecialchars((string) $date_start); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars((string) $date_end); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars((string) $status); ?></td>
                            <td class="flex gap-2 p-3">
                                <?= view('components/modal/inquiries/update', ['requestObj' => $item, 'accountList' => $accountList]) ?>
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