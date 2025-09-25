<?php
// Page: admin/accounts
// Data contract:
// $accounts: string | object array
// $accountsCount: string | number
// $verifiedEmailAccountsCount: string | number
// $nonVerfiedEmailAccountsCount: string | number
?>
<!doctype html>
<html lang="en">
<?= view('components/head', ['title' => 'Admin — Accounts']) ?>

<body class="bg-gray-50 min-h-screen font-sans text-slate-900">
    <?= view('components/header') ?>

    <main class="mx-auto px-6 py-10 max-w-6xl">
        <div class="md:flex md:space-x-6">
            <?= view('components/aside/admin_manager', ['active' => 'accounts']) ?>

            <section class="flex-1">
                <h2 class="mb-6 font-semibold text-2xl">Accounts</h2>
                <?php if (is_string($accounts)) : ?>
                    <?= view('components/cards/card', ['title' => $accounts, 'value' => 0]); ?>
                <?php else : ?>
                    <div class="gap-4 grid grid-cols-1 md:grid-cols-3 mb-6" id="accountStats">
                        <?= view('components/cards/card_stat', ['title' => 'Total Accounts', 'value' => $accountsCount]) ?>
                        <?= view('components/cards/card_stat', ['title' => 'Verified Accounts', 'value' => $verifiedEmailAccountsCount]) ?>
                        <?= view('components/cards/card_stat', ['title' => 'Not Verified Accounts', 'value' => $nonVerfiedEmailAccountsCount]) ?>
                    </div>
                    <div class="flex justify-end gap-3 mb-4">
                        <?= view('components/modal/accounts/create') ?>
                    </div>
                    <?= view('components/control_panels/filter_search_sort/accounts') ?>
                    <?= view('components/table/accounts') ?>
                <?php endif; ?>
            </section>

        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>