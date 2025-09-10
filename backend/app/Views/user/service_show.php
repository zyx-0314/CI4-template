<?php
// View: backend/app/Views/user/service_show.php
// Expects: $service associative array
$service = $service ?? null;
?>
<!doctype html>
<html lang="en">

<?= view('components/head') ?>

<body class="bg-gray-50 font-sans text-slate-900">
    <?= view('components/header', ['active' => 'Services']) ?>

    <main class="mx-auto px-4 sm:px-6 lg:px-8 py-12 max-w-7xl">
        <?php if (!$service): ?>
            <div class="text-slate-600 text-center">Service not found.</div>
        <?php else: ?>
            <div class="gap-8 grid grid-cols-1 lg:grid-cols-3">
                <!-- Main column -->
                <div class="lg:col-span-2">
                    <!-- Sticky Title -->
                    <div class="top-4 z-10 sticky bg-transparent py-2">
                        <h1 class="font-semibold text-slate-900 text-2xl"><?= esc($service['title']) ?></h1>
                        <div class="text-slate-600 text-sm">Cost: <span class="font-medium">$<?= number_format((float)($service['cost'] ?? 0), 2) ?></span></div>
                    </div>

                    <!-- Hero image -->
                    <div class="bg-white shadow-sm mt-4 rounded-lg overflow-hidden">
                        <?php if (!empty($service['image'])): ?>
                            <img src="<?= esc($service['image']) ?>" alt="<?= esc($service['title']) ?>" class="w-full h-96 object-cover">
                        <?php else: ?>
                            <div class="flex justify-center items-center bg-slate-100 w-full h-96">
                                <img src="/logo/main.svg" alt="no image" class="h-16">
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Description -->
                    <section class="bg-white shadow-sm mt-6 p-6 rounded-lg">
                        <h2 class="mb-3 font-medium text-lg">Description</h2>
                        <div class="text-slate-700 leading-relaxed"><?= nl2br(esc($service['description'] ?? '')) ?></div>
                    </section>

                    <!-- Inclusions -->
                    <?php if (!empty($service['inclusions'])): ?>
                        <section class="mt-6">
                            <h2 class="mb-3 font-medium text-lg">Inclusions</h2>
                            <div class="gap-4 grid grid-cols-1 sm:grid-cols-2">
                                <?php foreach (explode(',', $service['inclusions']) as $inc): ?>
                                    <?php $inc = trim($inc);
                                    if ($inc === '') continue; ?>
                                    <?= view('components/cards/card', ['title' => $inc, 'excerpt' => '', 'image' => null, 'href' => null]) ?>
                                <?php endforeach; ?>
                            </div>
                        </section>
                    <?php endif; ?>
                </div>

                <!-- Aside / Reservation panel -->
                <aside class="lg:col-span-1">
                    <div class="top-6 sticky space-y-4">
                        <div class="bg-white shadow-sm p-4 rounded-lg">
                            <div class="flex justify-between items-center">
                                <div class="text-slate-600 text-sm">Price</div>
                                <div class="font-semibold text-lg">$<?= number_format((float)($service['cost'] ?? 0), 2) ?></div>
                            </div>
                            <div class="mt-4">
                                <?php if (!empty($service['is_available'])): ?>
                                    <a href="/reservation" class="inline-flex justify-center items-center px-4 py-2 rounded-md w-full text-white btn-sage">Reserve service</a>
                                <?php else: ?>
                                    <button class="bg-slate-200 px-4 py-2 rounded-md w-full text-slate-600" disabled>Not available</button>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="bg-white shadow-sm p-4 rounded-lg">
                            <h3 class="mb-2 font-medium text-sm">Need help?</h3>
                            <p class="text-slate-700 text-sm">Call our support or send a message to reserve manually.</p>
                            <div class="mt-3">
                                <a href="tel:+1234567890" class="text-indigo-600 text-sm">+1 (234) 567-890</a>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        <?php endif; ?>
    </main>

    <?= view('components/footer') ?>
</body>

</html>