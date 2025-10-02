<?php
/**
 * Timeline obituary design
 */
?>
<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => 'Timeline - ' . ($obituary['first_name'] ?? '')]) ?>

<body class="bg-gray-50">
    <?= view('components/header') ?>

    <main class="max-w-5xl mx-auto py-12 px-6">
        <div class="bg-white rounded-lg shadow p-8">
            <h1 class="text-3xl font-bold text-gray-900"><?= esc($obituary['first_name'] . ' ' . $obituary['last_name']) ?></h1>
            <p class="text-gray-600 mt-2"><?= date('F j, Y', strtotime($obituary['date_of_birth'] ?? '1970-01-01')) ?> — <?= date('F j, Y', strtotime($obituary['date_of_death'] ?? '1970-01-01')) ?></p>

            <div class="mt-8">
                <h2 class="font-semibold text-gray-800 mb-4">Life Timeline</h2>
                <div class="border-l-2 border-gray-200 pl-6">
                    <?php foreach ($obituary['treasured_memories'] ?? [] as $m): ?>
                        <div class="mb-6">
                            <div class="font-semibold text-gray-800"><?= esc($m['title'] ?? '') ?></div>
                            <div class="text-gray-600 text-sm"><?= esc($m['descriptions'] ?? '') ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mt-6">
                <a href="<?= base_url('/obituary/request') ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Request this design</a>
                <a href="<?= base_url('/obituary') ?>" class="ml-3 text-indigo-600">Back</a>
            </div>
        </div>
    </main>

    <?= view('components/footer') ?>
</body>
</html>
