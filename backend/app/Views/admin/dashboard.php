<!doctype html>
<html lang="en">
<?= view('components/head', ['title' => 'Admin Dashboard']) ?>

<body class="bg-gray-50 min-h-screen font-sans text-slate-900">

    <?= view('components/header') ?>

    <main class="mx-auto px-6 py-10 max-w-6xl">
        <div class="md:flex md:space-x-6">
            <?= view('components/aside/admin_manager') ?>
            <section class="flex-1">
                <h2 class="mb-6 font-semibold text-2xl">Admin Dashboard</h2>

                <div class="gap-4 grid grid-cols-1 sm:grid-cols-3">
                    <?= view('components/cards/card_stat', ['title' => 'Total Inquiries', 'value' => 0]) ?>
                    <?= view('components/cards/card_stat', ['title' => 'Total Services', 'value' => 0]) ?>
                    <?= view('components/cards/card_stat', ['title' => 'Upcoming / Scheduled', 'value' => 0, 'subtitle' => 'Preferred date >= today']) ?>
                </div>

                <div class="gap-4 grid grid-cols-1 md:grid-cols-2 mt-6">
                    <div class="bg-white shadow p-4 rounded-lg">
                        <h3 class="font-semibold">Services management</h3>
                        <p class="mt-2 text-gray-600 text-sm">Open the services management page to edit available funeral services or add new ones.</p>
                        <div class="mt-3">
                            <a href="/admin/services" class="bg-blue-600 px-3 py-2 rounded text-white">Manage services</a>
                        </div>
                    </div>

                    <div class="bg-white shadow p-4 rounded-lg">
                        <h3 class="font-semibold">Recent notes</h3>
                        <p class="mt-2 text-gray-600 text-sm">No recent system notes. You can add a recent activity feed here (logins, failed jobs, recent inquiries).</p>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>