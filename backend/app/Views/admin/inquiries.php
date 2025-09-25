<?php
// Page: admin/inquiries
// Data contract:
// $requests: string | object array
// $requestsCount: string | number
// $upcomingRequestsCount: string | number
// $pendingRequestsCount: string | number
// $accountList: object array
?>
<!doctype html>
<html lang="en">
<?= view('components/head', ['title' => 'Admin — Inquiries']) ?>

<body class="bg-gray-50 min-h-screen font-sans text-slate-900">
    <?= view('components/header') ?>


    <main class="xl:mx-auto px-2 xl:px-6 py-10 max-w-6xl">
        <div class="xl:flex xl:space-x-6">
            <?= view('components/aside/admin_manager', ['active' => 'inquiries']) ?>

            <section class="flex-1">
                <h2 class="mb-6 font-semibold text-2xl">Inquiries</h2>
                <?php if (is_string($requests)) : ?>
                    <?= view('components/cards/card', ['title' => $requests, 'value' => 0]); ?>
                <?php else : ?>
                    <div class="gap-4 grid grid-cols-1 xl:grid-cols-3 mb-6" id="requestsStats">
                        <?= view('components/cards/card_stat', ['title' => 'Total Active', 'value' => $requestsCount]) ?>
                        <?= view('components/cards/card_stat', ['title' => 'Upcoming', 'value' => $upcomingRequestsCount]) ?>
                        <?= view('components/cards/card_stat', ['title' => 'Pending', 'value' => $pendingRequestsCount]) ?>
                    </div>
                    <?= view('components/control_panels/filter_search_sort/requests') ?>
                    <?= view('components/table/requests', ['requests' => $requests, 'accountList' => $accountList]) ?>
                <?php endif; ?>
            </section>

        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>