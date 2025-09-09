<!-- <aside class="col-span-12 md:col-span-3 bg-white shadow p-4 rounded-lg">
    <h3 class="mb-4 font-semibold text-gray-700 text-sm">Employee</h3>
    <nav class="space-y-2 text-sm">
        <a href="/employee/dashboard" class="block bg-emerald-100 px-3 py-2 rounded text-emerald-700">Dashboard</a>
        <a href="#pending" class="block hover:bg-gray-100 px-3 py-2 rounded">Pending work</a>
        <a href="#salary" class="block hover:bg-gray-100 px-3 py-2 rounded">Salary</a>
        <a href="#leave" class="block hover:bg-gray-100 px-3 py-2 rounded">Request leave</a>
    </nav>
</aside> -->

<div class="mb-6 md:mb-0 w-full md:w-64">
    <div class="bg-white shadow p-4 rounded-lg">
        <h4 class="mb-3 font-semibold">Admin</h4>
        <nav class="space-y-1 text-sm">
            <?php $a = $active ?? ''; ?>
            <a href="/admin/dashboard" class="block py-2 px-3 rounded <?php echo $a === 'dashboard' ? 'bg-gray-100 font-medium' : 'hover:bg-gray-50'; ?>">Dashboard</a>
            <a href="/admin/employees" class="block py-2 px-3 rounded <?php echo $a === 'employees' ? 'bg-gray-100 font-medium' : 'hover:bg-gray-50'; ?>">Employees / Payroll</a>
            <a href="/admin/inquiries" class="block py-2 px-3 rounded <?php echo $a === 'inquiries' ? 'bg-gray-100 font-medium' : 'hover:bg-gray-50'; ?>">Inquiries</a>
            <a href="/admin/services" class="block py-2 px-3 rounded <?php echo $a === 'services' ? 'bg-gray-100 font-medium' : 'hover:bg-gray-50'; ?>">Services</a>
            <a href="/admin/obituaries" class="block py-2 px-3 rounded <?php echo $a === 'obituaries' ? 'bg-gray-100 font-medium' : 'hover:bg-gray-50'; ?>">Obituary &amp; Memorials</a>
            <a href="/admin/accounts" class="block py-2 px-3 rounded <?php echo $a === 'accounts' ? 'bg-gray-100 font-medium' : 'hover:bg-gray-50'; ?>">Accounts</a>
            <a href="/admin/assignments" class="block py-2 px-3 rounded <?php echo $a === 'assignments' ? 'bg-gray-100 font-medium' : 'hover:bg-gray-50'; ?>">Work Assignment</a>
        </nav>
    </div>
</div>