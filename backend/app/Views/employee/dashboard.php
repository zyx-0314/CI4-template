<?php

/**
 * Employee dashboard (frontend-only demo)
 * Expects $user (array)
 */
?>

<!doctype html>
<html lang="en">
<?= view('components/head', ['title' => 'Employee Dashboard — Sunset Funeral Homes']) ?>

<body class="bg-gray-50 min-h-screen font-sans text-slate-900">
    <?= view('components/header'); ?>

    <main class="mx-auto p-6 max-w-7xl">
        <div class="gap-6 grid grid-cols-12">
            <!-- Aside / Navigation -->
            <aside class="col-span-12 md:col-span-3 bg-white shadow p-4 rounded-lg">
                <h3 class="mb-4 font-semibold text-gray-700 text-sm">Employee</h3>
                <nav class="space-y-2 text-sm">
                    <a href="/employee/dashboard" class="block bg-emerald-100 px-3 py-2 rounded text-emerald-700">Dashboard</a>
                    <a href="#pending" class="block hover:bg-gray-100 px-3 py-2 rounded">Pending work</a>
                    <a href="#salary" class="block hover:bg-gray-100 px-3 py-2 rounded">Salary</a>
                    <a href="#leave" class="block hover:bg-gray-100 px-3 py-2 rounded">Request leave</a>
                </nav>
            </aside>

            <!-- Main content -->
            <section class="space-y-6 col-span-12 md:col-span-9">
                <!-- Welcome + Cards -->
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="font-semibold text-2xl">Welcome, <?php echo esc($user['first_name'] ?? 'Employee'); ?></h1>
                        <p class="text-gray-500 text-sm">Here's a summary of your tasks and activity.</p>
                    </div>
                </div>

                <div class="gap-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                    <?= view('components/cards/card_stat', ['title' => 'Pending Tasks', 'value' => 3]) ?>
                    <?= view('components/cards/card_stat', ['title' => 'Leave Requests', 'value' => 1]) ?>
                    <?= view('components/cards/card_stat', ['title' => 'Today Activities', 'value' => 5]) ?>
                    <?= view('components/cards/card_stat', ['title' => 'Salary Due (month)', 'value' => '₱ 45,000']) ?>
                </div>

                <div class="gap-6 grid grid-cols-1 lg:grid-cols-2">
                    <!-- Calendar -->
                    <div class="bg-white shadow p-4 rounded-lg">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold text-sm">Calendar</h3>
                            <div class="text-gray-500 text-xs">(demo)</div>
                        </div>
                        <div id="calendar" class="w-full"></div>
                    </div>

                    <!-- Activities table -->
                    <div class="bg-white shadow p-4 rounded-lg">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold text-sm">Upcoming Activities</h3>
                            <a href="#" class="text-emerald-600 text-sm">View all</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="text-gray-500 text-xs text-left uppercase">
                                    <tr>
                                        <th class="px-2 py-1">Time</th>
                                        <th class="px-2 py-1">Activity</th>
                                        <th class="px-2 py-1">Status</th>
                                        <th class="px-2 py-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $activities = [
                                        ['time' => '08:00', 'title' => 'Pickup remains - St. Mary', 'status' => 'Pending'],
                                        ['time' => '10:30', 'title' => 'Funeral setup - Rivera', 'status' => 'In Progress'],
                                        ['time' => '13:00', 'title' => 'Document filing', 'status' => 'Pending'],
                                        ['time' => '15:00', 'title' => 'Drive to crematorium', 'status' => 'Assigned'],
                                    ];
                                    ?>
                                    <?php foreach ($activities as $a): ?>
                                        <tr class="border-t">
                                            <td class="px-2 py-2 text-gray-700 align-top"><?php echo esc($a['time']); ?></td>
                                            <td class="px-2 py-2 align-top"><?php echo esc($a['title']); ?></td>
                                            <td class="px-2 py-2 align-top"><span class="px-2 py-1 rounded text-xs <?php echo $a['status'] === 'Pending' ? 'bg-yellow-50 text-yellow-800' : ($a['status'] === 'In Progress' ? 'bg-emerald-50 text-emerald-800' : 'bg-gray-50 text-gray-700'); ?>"><?php echo esc($a['status']); ?></span></td>
                                            <td class="px-2 py-2 align-top"><a href="#" class="text-emerald-600">Open</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </main>

    <?= view('components/footer') ?>

    <script>
        // Simple calendar renderer (client-side demo)
        (function renderCalendar() {
            const el = document.getElementById('calendar');
            if (!el) return;
            const now = new Date();
            const year = now.getFullYear();
            const month = now.getMonth();

            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            let html = '<div class="gap-1 grid grid-cols-7 text-xs text-center">';
            const dow = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            dow.forEach(d => html += `<div class="py-2 font-medium">${d}</div>`);

            for (let i = 0; i < firstDay; i++) html += '<div></div>';

            for (let d = 1; d <= daysInMonth; d++) {
                html += `<div class="bg-white p-2 border rounded h-20 text-sm text-left">` +
                    `<div class="text-gray-500 text-xs">${d}</div>` +
                    `<div class="mt-2 text-gray-700 text-xs">` +
                    (d === now.getDate() ? '<span class="inline-block bg-emerald-100 px-2 py-0.5 rounded text-emerald-700 text-xs">Today</span>' : '') +
                    `</div></div>`;
            }
            html += '</div>';
            el.innerHTML = html;
        })();
    </script>
</body>

</html>