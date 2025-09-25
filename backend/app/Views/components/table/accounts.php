<?php
// Component: components/table/accounts.php
// Data contract:
// $accounts: object array (items can be arrays or objects/Entities)
?>
<?php
// read GET params
$page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$per_page = isset($_GET['per_page']) ? max(1, (int) $_GET['per_page']) : 10;

$dataToUse = $accounts ?? [];
// filter out soft-deleted or inactive based on account_status if present
$active = array_values(array_filter($dataToUse, function ($u) {
    if (is_array($u)) {
        return ($u['account_status'] ?? 'active') !== 'deleted';
    }
    if (is_object($u)) {
        if (isset($u->account_status)) return $u->account_status !== 'deleted';
        if (method_exists($u, 'getAccountStatus')) return $u->getAccountStatus() !== 'deleted';
    }
    return true;
}));
$total = count($active);
$total_pages = (int) max(1, ceil($total / $per_page));
if ($page > $total_pages) $page = $total_pages;

$start = ($page - 1) * $per_page;
$pageAccounts = array_slice($active, $start, $per_page);

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
                    <th class="p-3">Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Type</th>
                    <th class="p-3">Email Activated</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pageAccounts)) : ?>
                    <tr>
                        <td class="p-3" colspan="8">No accounts found</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($pageAccounts as $account): ?>
                        <tr class="border-t">
                            <?php
                            $name = $account->first_name . " " . ($account->middle_name ? $account->middle_name[0]  . ". " : "") . $account->last_name;
                            $account->name = $name;
                            ?>
                            <td class="p-3"><?php echo esc($account->name); ?></td>
                            <td class="p-3"><?php echo esc($account->email); ?></td>
                            <td class="p-3"><?php echo esc($account->type); ?></td>
                            <td class="p-3"><?php echo $account->email_activated === "1" ? 'Yes' : 'No'; ?></td>
                            <td class="flex gap-2 p-3">
                                <?= view('components/modal/accounts/delete', ['account' => $account]) ?>
                                <?= view('components/modal/accounts/update', ['account' => $account]) ?>
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