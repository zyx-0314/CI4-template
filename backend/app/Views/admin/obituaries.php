<?php
// Page: admin/obituaries
// Data contract:
// $obituaries: string | array
// $obituariesCount: number
// $pendingObituariesCount: number
?>
<!doctype html>
<html lang="en">
<?= view('components/head', ['title' => 'Admin — Obituaries']) ?>

<body class="bg-gray-50 min-h-screen font-sans text-slate-900">
    <?= view('components/header') ?>

    <main class="xl:mx-auto px-2 xl:px-6 py-10 max-w-6xl">
        <div class="xl:flex xl:space-x-6">
            <?= view('components/aside/admin_manager', ['active' => 'obituaries']) ?>

            <section class="flex-1">
                <h2 class="mb-6 font-semibold text-2xl">Obituary Requests</h2>
                <?php if (is_string($obituaries)) : ?>
                    <?= view('components/cards/card', ['title' => $obituaries, 'value' => 0]); ?>
                <?php else : ?>
                    <div class="gap-4 grid grid-cols-1 xl:grid-cols-3 mb-6" id="obituariesStats">
                        <?= view('components/cards/card_stat', ['title' => 'Total', 'value' => $obituariesCount]) ?>
                        <?= view('components/cards/card_stat', ['title' => 'Pending', 'value' => $pendingObituariesCount]) ?>
                        <?= view('components/cards/card_stat', ['title' => 'Confirmed', 'value' => $obituariesCount - ($pendingObituariesCount ?? 0)]) ?>
                    </div>
                    <?= view('components/control_panels/filter_search_sort/obituaries') ?>
                    <?= view('components/table/obituaries', ['obituaries' => $obituaries]) ?>
                <?php endif; ?>
            </section>

        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>