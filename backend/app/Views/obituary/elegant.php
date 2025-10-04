<?php

/**
 * Elegant obituary design
 */

$events = ['viewing' => ['date_time' => 'viewing_date_time', 'place' => 'viewing_place', 'label' => 'Viewing'], 'funeral' => ['date_time' => 'funeral_date_time', 'place' => 'funeral_place', 'label' => 'Funeral'], 'burial' => ['date_time' => 'burial_date_time', 'place' => 'burial_place', 'label' => 'Burial']];
?>
<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => 'Elegant - ' . ($obituary['first_name'] ?? '')]) ?>

<body class="bg-rose-50 antialiased">
    <?= view('components/header') ?>

    <main class="mx-auto px-6 py-12 max-w-5xl">
        <div class="relative">
            <!-- floral corner accents (decorative only) -->
            <svg class="top-0 left-0 absolute opacity-70 w-48 h-48 text-gray-300 pointer-events-none" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <g fill="none" stroke="currentColor" stroke-width="1">
                    <path d="M10 80 C 40 10, 140 10, 190 80" />
                    <path d="M20 100 C 50 140, 120 160, 180 140" />
                </g>
            </svg>
            <svg class="top-0 right-0 absolute opacity-70 w-48 h-48 text-gray-300 rotate-180 pointer-events-none transform" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <g fill="none" stroke="currentColor" stroke-width="1">
                    <path d="M10 80 C 40 10, 140 10, 190 80" />
                    <path d="M20 100 C 50 140, 120 160, 180 140" />
                </g>
            </svg>

            <article class="bg-white shadow mx-4 p-10 rounded-xl text-center">
                <div class="-mt-20">
                    <img src="<?= esc($obituary['profile_image'] ?? '/logo/avatar-placeholder.png') ?>" alt="Profile" class="shadow-lg mx-auto border-8 border-white rounded-full w-44 h-44 object-cover">
                </div>

                <p class="mt-6 font-semibold text-gray-500 text-sm uppercase tracking-widest">In loving memory of</p>

                <h1 class="mt-2 text-gray-900 text-4xl" style="font-family: 'Brush Script MT', 'Lucida Handwriting', cursive; font-weight:700;">
                    <?= esc(trim(($obituary['first_name'] ?? '') . ' ' . ($obituary['middle_name'] ? $obituary['middle_name'] . ' ' : '') . ($obituary['last_name'] ?? ''))) ?>
                </h1>

                <p class="my-4 font-semibold text-gray-800">
                    <?= !empty($obituary['date_of_birth']) ? date('j F Y', strtotime($obituary['date_of_birth'])) : '—' ?> — <?= !empty($obituary['date_of_death']) ? date('j F Y', strtotime($obituary['date_of_death'])) : '—' ?>
                </p>

                <?= view('components/separator') ?>

                <div class="bg-white mx-auto mt-4 py-6 max-w-2xl text-left">
                    <h2 class="font-semibold text-gray-800 text-xl text-center">About</h2>
                    <p class="mt-3 text-gray-700 text-center leading-relaxed"><?= nl2br(esc($obituary['description'] ?? 'No description available.')) ?></p>
                </div>

                <?= view('components/separator') ?>

                <section class="bg-white mx-auto mt-4 py-6 max-w-2xl">
                    <h3 class="font-medium text-lg">Family</h3>
                    <?php if (!empty($obituary['family'])): ?>
                        <ul class="space-y-2 mt-3 text-gray-700">
                            <?php foreach ($obituary['family'] as $f): ?>
                                <li class="flex justify-evenly items-center">
                                    <span class="text-gray-800 text-sm"><?= esc(trim(($f['first_name'] ?? '') . ' ' . ($f['middle_initial'] ?? '') . ' ' . ($f['last_name'] ?? ''))) ?></span>
                                    <span class="text-gray-500 text-xs uppercase tracking-wider"><?= esc(ucfirst($f['relation'] ?? '')) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="mt-2 text-gray-600">No family information provided.</p>
                    <?php endif; ?>
                </section>

                <?= view('components/separator') ?>

                <section class="bg-white p-4 border border-gray-100 rounded">
                    <h3 class="font-medium text-lg">Services & Events</h3>
                    <section class="flex gap-3 space-y-4 w-full">
                        <?php foreach ($events as $key => $event): ?>
                            <?= view('components/cards/funeral_service_card', ['event' => $event]) ?>
                        <?php endforeach; ?>
                    </section>
                </section>

                <?= view('components/separator') ?>

                <?php if (!empty($obituary['treasured_memories'])): ?>
                    <section class="bg-white p-4 border border-gray-100 rounded">
                        <h3 class="font-medium text-lg">Treasured Memories</h3>
                        <div class="gap-3 grid grid-cols-2 md:grid-cols-3 mt-3">
                            <?php foreach ($obituary['treasured_memories'] as $m): ?>
                                <figure class="bg-gray-50 border rounded overflow-hidden">
                                    <div class="bg-gray-100 h-28 overflow-hidden">
                                        <img src="<?= esc($m['img'] ?? '') ?>" alt="<?= esc($m['title'] ?? 'Memory') ?>" class="w-full h-full object-cover">
                                    </div>
                                    <figcaption class="p-2 text-gray-700 text-xs">
                                        <div class="font-medium text-sm"><?= esc($m['title'] ?? '') ?></div>
                                        <div class="text-gray-500 text-xs"><?= esc($m['descriptions'] ?? '') ?></div>
                                    </figcaption>
                                </figure>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>
            </article>

            <section class="bg-white shadow mx-4 mt-6 p-10 rounded-xl text-center">
                <h3 class="font-medium text-lg">Messages & Shared Memories</h3>
                <?php if (!empty($obituary['shared_messages'])): ?>
                    <div class="space-y-3 mt-3">
                        <?php foreach ($obituary['shared_messages'] as $s): ?>
                            <blockquote class="bg-gray-50 p-3 pl-3 border-gray-200 border-l-2 rounded text-gray-700">
                                <div class="text-gray-500 text-xs">
                                    <strong><?= esc(!empty($s['anonymous']) ? 'Anonymous' : ($s['name'] ?? 'Guest')) ?></strong>
                                    <span class="ml-2"><?= !empty($s['created_at']) ? date('F j, Y', strtotime($s['created_at'])) : '' ?></span>
                                </div>
                                <p class="mt-2 text-sm"><?= nl2br(esc($s['message'] ?? '')) ?></p>
                            </blockquote>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="mt-2 text-gray-600">No messages yet. Be the first to share a memory.</p>
                <?php endif; ?>
            </section>

            <?= view('components/cards/share_memory_input_card', ['class' => 'bg-white shadow mx-4 mt-6 p-10 rounded-xl text-center']) ?>

            <section class="bg-white shadow mx-4 mt-6 p-10 rounded-xl text-center">
                <h4 class="font-medium">Share & Support</h4>
                <div class="flex flex-col gap-2 mt-3">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" class="px-3 py-2 border border-gray-200 rounded text-sm text-center">Share on Facebook</a>
                    <a href="mailto:?subject=Memorial for <?= rawurlencode(trim(($obituary['first_name'] ?? '') . ' ' . ($obituary['last_name'] ?? ''))) ?>&body=View: <?= rawurlencode(current_url()) ?>" class="px-3 py-2 border border-gray-200 rounded text-sm text-center">Share via Email</a>
                    <a href="<?= base_url('/obituary/request') ?>" class="bg-gray-900 px-3 py-2 rounded text-white text-sm text-center">Request this design</a>
                </div>
            </section>
        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>