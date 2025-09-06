<!doctype html>
<html lang="en">
<?= view('components/head', ['title' => 'Services — Sunset Funeral Homes']) ?>

<body class="bg-gray-50 text-gray-900">
    <?= view('components/header') ?>
    <div class="mx-auto px-6 py-12 max-w-5xl">
        <header class="mb-6">
            <h1 class="font-bold text-2xl">Our Services</h1>
            <p class="text-gray-600">Choose a service style to view details.</p>
        </header>

        <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
            <?php foreach ($services as $s): ?>
                <article class="bg-white shadow p-6 rounded-lg">
                    <h3 class="font-semibold text-lg"><?php echo esc($s['title']); ?></h3>
                    <p class="mt-2 text-gray-600 text-sm"><?php echo esc($s['summary']); ?></p>
                    <div class="flex justify-between items-center mt-4">
                        <?php if (!empty($s['id'])): ?>
                            <a href="<?php echo site_url('services/' . $s['id']); ?>" class="text-indigo-600 text-sm">View details</a>
                        <?php else: ?>
                            <a href="/services/<?php echo esc($s['slug']); ?>" class="text-indigo-600 text-sm">View details</a>
                        <?php endif; ?>
                        <div class="text-gray-700 text-sm">From ₱<?php echo esc($s['cost']); ?></div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

    </div>
    <?= view('components/footer') ?>
</body>

</html>