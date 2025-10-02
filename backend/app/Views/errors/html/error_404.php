<?php
// Page: error_404
?>
<?php
$session = session();
$user = $session->get('user') ?? null;
?>
<!doctype html>
<html lang="en">
<?= view('components/head', ['title' => lang('Errors.pageNotFound')]) ?>

<body class="bg-gray-50 min-h-screen font-sans text-slate-900">
    <?= view('components/header') ?>

    <main class="mx-auto px-6 py-10 max-w-6xl">
        <div class="md:flex md:space-x-6">

            <?php if ($user !== null && $user['type'] === 'manager') : ?>
                <?= view('components/aside/admin_manager', ['active' => '']) ?>
            <?php elseif ($user !== null && $user['type'] !== 'client') : ?>
                <?= view('components/aside/employee', ['active' => '']) ?>
            <?php endif; ?>

            <section class="flex-1">
                <div class="bg-white mx-auto p-6 border border-gray-200 rounded max-w-3xl text-center">
                    <h1 class="font-light text-slate-800 text-4xl">404</h1>

                    <p class="mt-4 text-slate-600">
                        <?php if (ENVIRONMENT !== 'production') : ?>
                            <?= nl2br(esc($message)) ?>
                        <?php else : ?>
                            <?= lang('Errors.sorryCannotFind') ?>
                        <?php endif; ?>
                    </p>
                </div>
            </section>

        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>