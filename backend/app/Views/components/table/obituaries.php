<?php
// Component: components/table/obituaries.php
// Data contract:
// $obituaries: array
?>
<?php
$dataToUse = $obituaries ?? [];

// Only active ones if there's an 'is_active' field; otherwise show all
$active = is_array($dataToUse) ? $dataToUse : (is_object($dataToUse) ? (array)$dataToUse : []);

$page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$per_page = isset($_GET['per_page']) ? max(1, (int) $_GET['per_page']) : 5;

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
        <table class="w-full min-w-[900px] text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-3">Name</th>
                    <th class="p-3">Viewing</th>
                    <th class="p-3">Burial</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pageItems)) : ?>
                    <tr>
                        <td class="p-3" colspan="10">No obituary requests found</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($pageItems as $idx => $item): ?>
                        <tr class="border-t">
                            <?php
                            $id = is_array($item) ? ($item['id'] ?? null) : ($item->id ?? null);
                            $first_name = is_array($item) ? ($item['first_name'] ?? '') : ($item->first_name ?? '');
                            $middle_name = is_array($item) ? ($item['middle_name'] ?? '') : ($item->middle_name ?? '');
                            $last_name = is_array($item) ? ($item['last_name'] ?? '') : ($item->last_name ?? '');
                            $viewing = is_array($item) ? ($item['viewing_date_time'] ?? '') : ($item->viewing_date_time ?? '');
                            $burial = is_array($item) ? ($item['burial_date_time'] ?? '') : ($item->burial_date_time ?? '');
                            $status = is_array($item) ? ($item['status'] ?? '') : ($item->status ?? '');
                            ?>
                            <td class="p-3"><?php echo htmlspecialchars(trim($first_name . ' ' . $middle_name . ' ' . $last_name)); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars((string) $viewing); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars((string) $burial); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars((string) $status); ?></td>
                            <td class="flex gap-2 p-3">
                                <div class="flex justify-end mb-4">
                                    <a class="bg-gray-600/70 hover:bg-gray-600/60 px-3 py-2 rounded text-white duration-200 cursor-pointer" href="<?php echo site_url('obituary/' . urlencode($id)); ?>">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                                <?= view('components/modal/obituaries/update', ['ob' => $item]) ?>
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