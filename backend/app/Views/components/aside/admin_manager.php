<?php
// Page: components/aside/admin_manager
// Data contract:
// $active: string | null
?>
<?php
$session = session();
$user = $session->get('user') ?? null;
?>
<div class="mb-6 xl:mb-0 w-full xl:w-64 xl:min-w-64">
    <div class="bg-white shadow p-4 rounded-lg">
        <h4 class="font-semibold"><?= $user['first_name'] . ", " . $user['last_name'] ?></h4>
        <h5 class="mb-3 font-normal text-xs"><?= $user['type'] ?></h5>
        <nav class="space-y-1 text-sm">
            <a href="/admin/dashboard" class="block py-2 px-3 rounded <?php echo $active === 'dashboard' ? 'bg-gray-100 font-medium' : 'hover:bg-gray-50'; ?>">Dashboard</a>
            <a href="/admin/employees" class="block py-2 px-3 rounded <?php echo $active === 'employees' ? 'bg-gray-100 font-medium' : 'hover:bg-gray-50'; ?>">Employees / Payroll</a>
            <a href="/admin/inquiries" class="block py-2 px-3 rounded <?php echo $active === 'inquiries' ? 'bg-gray-100 font-medium' : 'hover:bg-gray-50'; ?>">Inquiries</a>
            <a href="/admin/services" class="block py-2 px-3 rounded <?php echo $active === 'services' ? 'bg-gray-100 font-medium' : 'hover:bg-gray-50'; ?>">Services</a>
            <a href="/admin/obituaries" class="block py-2 px-3 rounded <?php echo $active === 'obituaries' ? 'bg-gray-100 font-medium' : 'hover:bg-gray-50'; ?>">Obituary</a>
            <a href="/admin/accounts" class="block py-2 px-3 rounded <?php echo $active === 'accounts' ? 'bg-gray-100 font-medium' : 'hover:bg-gray-50'; ?>">Accounts</a>
            <a href="/admin/assignments" class="block py-2 px-3 rounded <?php echo $active === 'assignments' ? 'bg-gray-100 font-medium' : 'hover:bg-gray-50'; ?>">Work Assignment</a>
        </nav>
    </div>
</div>