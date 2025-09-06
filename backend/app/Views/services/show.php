<!doctype html>
<html lang="en">
<?= view('components/head', ['title' => esc($title) . ' — Services']) ?>

<body class="bg-gray-50 text-gray-900">
    <?= view('components/header') ?>
    <div class="mx-auto px-6 py-12 max-w-5xl">
        <a href="/services" class="text-gray-600 text-sm">← Back to services</a>
        <div class="bg-white shadow mt-4 p-6 rounded-lg">
            <h1 class="font-bold text-2xl"><?php echo esc($title); ?></h1>
            <p class="mt-3 text-gray-700"><?php echo esc($description); ?></p>

            <div class="mt-4">
                <h4 class="font-medium">What's included</h4>
                <ul class="mt-2 ml-5 text-gray-700 list-disc">
                    <?php foreach (explode(',', $inclusions) as $inc): ?>
                        <li><?php echo esc(trim($inc)); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="mt-6">
                <strong>Price:</strong> $<?php echo esc($cost); ?>
            </div>

            <div class="mt-6">
                <a href="/services" class="inline-block px-4 py-2 border rounded text-sm">Back to services</a>
                <a href="/" class="inline-block bg-indigo-600 ml-2 px-4 py-2 rounded text-white text-sm">Back to home</a>
            </div>
        </div>
    </div>
    <?= view('components/footer') ?>
</body>

</html>