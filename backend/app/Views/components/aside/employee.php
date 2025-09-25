<?php
// Page: components/aside/employee
// Data contract:
// $active: string | null
?>
<?php
$session = session();
$user = $session->get('user') ?? null;
?>
<div class="mb-6 md:mb-0 w-full md:w-64">
    <div class="bg-white shadow p-4 rounded-lg">
        <h4 class="font-semibold"><?= $user['first_name'] . ", " . $user['last_name'] ?></h4>
        <h5 class="mb-3 font-normal text-xs"><?= $user['type'] ?></h5>
        <nav class="space-y-1 text-sm">
            <a href="/employee/dashboard" class="block py-2 px-3 rounded <?php echo $active === 'dashboard' ? 'bg-gray-100 font-medium' : 'hover:bg-gray-50'; ?>">Dashboard</a>
            <a href="/employee/employees" class="block py-2 px-3 rounded <?php echo $active === 'employees' ? 'bg-gray-100 font-medium' : 'hover:bg-gray-50'; ?>">Payroll</a>
            <a href="/employee/inquiries" class="block py-2 px-3 rounded <?php echo $active === 'inquiries' ? 'bg-gray-100 font-medium' : 'hover:bg-gray-50'; ?>">Inquiries</a>
            <a href="/employee/assignments" class="block py-2 px-3 rounded <?php echo $active === 'assignments' ? 'bg-gray-100 font-medium' : 'hover:bg-gray-50'; ?>">Work Assignment</a>
        </nav>
    </div>
</div>