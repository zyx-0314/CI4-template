<!doctype html>
<html lang="en">
<?= view('components/head', ['title' => 'Admin — Services']) ?>
<?= view('components/header') ?>


<main class="mx-auto px-6 py-10 max-w-6xl">
    <div class="md:flex md:space-x-6">
        <?= view('components/aside/admin_manager') ?>

        <section class="flex-1">
            <h2 class="mb-6 font-semibold text-2xl">Services</h2>
            <div class="gap-4 grid grid-cols-1 md:grid-cols-3 mb-6" id="serviceStats">
                <?= view('components/cards/card_stat', ['title' => 'Total Active', 'value' => 0]) ?>
                <?= view('components/cards/card_stat', ['title' => 'Available & active', 'value' => 0]) ?>
                <?= view('components/cards/card_stat', ['title' => 'Not available but active', 'value' => 0]) ?>
            </div>
            <div class="flex justify-end gap-3 mb-4">
                <div class="flex justify-end mb-4">
                    <a class="px-3 py-2 btn-border hover:btn-border-dark rounded text-white duration-200 cursor-pointer" href="<?php echo site_url('services/'); ?>">
                        Services List
                    </a>
                </div>
                <?= view('components/modal/services/create') ?>
            </div>
            <?= view('components/table/services') ?>
        </section>

    </div>
</main>

<?= view('components/footer') ?>
</body>

</html>