<?php

/**
 * Classic obituary design
 * Expects $obituary array from controller
 */

$age = '';
if (!empty($obituary['date_of_birth'])) {
    try {
        $dob = new \DateTime($obituary['date_of_birth']);
        $end = !empty($obituary['date_of_death']) ? new \DateTime($obituary['date_of_death']) : new \DateTime();
        $diff = $dob->diff($end);
        $age = $diff->y;
    } catch (\Exception $e) {
        $age = '';
    }
};

$events = ['viewing' => ['date_time' => 'viewing_date_time', 'place' => 'viewing_place', 'label' => 'Viewing'], 'funeral' => ['date_time' => 'funeral_date_time', 'place' => 'funeral_place', 'label' => 'Funeral'], 'burial' => ['date_time' => 'burial_date_time', 'place' => 'burial_place', 'label' => 'Burial']];
?>
<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => 'Classic - ' . ($obituary['first_name'] ?? '') . ' ' . ($obituary['last_name'] ?? '')]) ?>

<body class="text-gray-800 antialiased" style="background: linear-gradient(180deg,#f7f4ef 0%, #f3efe6 100%);">
    <?= view('components/header') ?>

    <main class="mx-auto px-6 py-12 container">
        <article class="bg-white/95 shadow-md backdrop-blur-sm border border-gray-200 rounded-lg overflow-hidden">
            <header class="px-8 py-32 text-center">
                <div class="flex justify-center -mt-20">
                    <div class="bg-gray-100 shadow-inner border-4 border-white rounded-full w-40 h-40 overflow-hidden">
                        <img src="<?= esc($obituary['profile_image'] ?? '/logo/avatar-placeholder.png') ?>" alt="<?= esc($obituary['first_name'] . ' ' . $obituary['last_name']) ?>" class="w-full h-full object-cover">
                    </div>
                </div>

                <h1 class="mt-6 font-serif font-bold text-gray-900 text-3xl md:text-4xl leading-tight">
                    <?= esc(trim(($obituary['first_name'] ?? '') . ' ' . ($obituary['middle_name'] ? $obituary['middle_name'] . ' ' : '') . ($obituary['last_name'] ?? ''))) ?>
                </h1>
                <p class="mt-1 text-gray-600 text-sm tracking-widest">In loving memory</p>

                <div class="flex md:flex-row flex-col md:justify-center gap-2 md:gap-6 mt-4 text-gray-700 text-sm">
                    <span><strong>Born</strong> <?= !empty($obituary['date_of_birth']) ? date('F j, Y', strtotime($obituary['date_of_birth'])) : '—' ?></span>
                    <span><strong>Passed</strong> <?= !empty($obituary['date_of_death']) ? date('F j, Y', strtotime($obituary['date_of_death'])) : '—' ?></span>
                    <span><strong>Age</strong> <?= $age !== '' ? esc($age) . ' years' : '—' ?></span>
                </div>
            </header>

            <div class="px-8 pb-10">
                <section class="mx-auto max-w-none text-gray-800 prose prose-sm">
                    <h2 class="font-semibold text-xl">About</h2>
                    <p class="text-gray-700 leading-relaxed"><?= nl2br(esc($obituary['description'] ?? 'No description available.')) ?></p>
                </section>

                <div class="gap-6 grid grid-cols-1 md:grid-cols-3 mt-8">
                    <div class="space-y-6 md:col-span-2">
                        <section class="bg-white p-4 px-10 border border-gray-100 rounded">
                            <h3 class="font-medium text-lg text-center">Family</h3>
                            <?php if (!empty($obituary['family'])): ?>
                                <ul class="space-y-2 mt-3 text-gray-700">
                                    <?php foreach ($obituary['family'] as $f): ?>
                                        <li class="flex justify-evenly items-center gap-6">
                                            <span class="text-gray-800 text-sm"><?= esc(trim(($f['first_name'] ?? '') . ' ' . ($f['middle_initial'] ?? '') . ' ' . ($f['last_name'] ?? ''))) ?></span>
                                            <span class="text-gray-500 text-xs uppercase tracking-wider"><?= esc(ucfirst($f['relation'] ?? '')) ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="mt-2 text-gray-600">No family information provided.</p>
                            <?php endif; ?>
                        </section>

                        <section class="flex gap-3 space-y-4 w-full">
                            <?php foreach ($events as $key => $event): ?>
                                <?= view('components/cards/funeral_service_card', ['event' => $event]) ?>
                            <?php endforeach; ?>
                        </section>

                        <?php if (!empty($obituary['treasured_memories'])): ?>
                            <section class="bg-white p-4 border border-gray-100 rounded">
                                <h3 class="font-medium text-lg">Treasured Memories</h3>
                                <div class="gap-3 grid grid-cols-2 md:grid-cols-3 mt-3">
                                    <?php foreach ($obituary['treasured_memories'] as $memories): ?>
                                        <?= view('components/cards/memory_card', ['memories' => $memories]) ?>
                                    <?php endforeach; ?>
                                </div>
                            </section>
                        <?php endif; ?>

                        <section class="bg-white p-4 border border-gray-100 rounded">
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

                        <?= view('components/cards/share_memory_input_card', ['obituary' => $obituary]) ?>
                    </div>

                    <aside class="space-y-4">
                        <div class="bg-white p-4 border border-gray-100 rounded text-sm">
                            <h4 class="font-medium">Share & Support</h4>
                            <div class="flex flex-col gap-2 mt-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" class="px-3 py-2 border border-gray-200 rounded text-sm text-center">Share on Facebook</a>
                                <a href="mailto:?subject=Memorial for <?= rawurlencode(trim(($obituary['first_name'] ?? '') . ' ' . ($obituary['last_name'] ?? ''))) ?>&body=View: <?= rawurlencode(current_url()) ?>" class="px-3 py-2 border border-gray-200 rounded text-sm text-center">Share via Email</a>
                                <a href="<?= base_url('/obituary/request') ?>" class="bg-gray-900 px-3 py-2 rounded text-white text-sm text-center">Request this design</a>
                            </div>
                        </div>

                        <?php if (!empty($obituary['other_notes'])): ?>
                            <div class="bg-white p-4 border border-gray-100 rounded text-gray-700 text-sm">
                                <h4 class="font-medium">Notes</h4>
                                <p class="mt-2 text-sm"><?= nl2br(esc($obituary['other_notes'])) ?></p>
                            </div>
                        <?php endif; ?>
                    </aside>
                </div>
            </div>
        </article>
    </main>

    <script>
        // Retain minimal carousel logic where applicable (keeps original behavior if carousels exist)
        (function() {
            document.querySelectorAll('[data-carousel-next]').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var id = this.getAttribute('data-carousel-next');
                    var root = document.getElementById(id);
                    if (!root) return;
                    var w = root.clientWidth;
                    root.scrollBy({
                        left: w,
                        behavior: 'smooth'
                    });
                });
            });
            document.querySelectorAll('[data-carousel-prev]').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var id = this.getAttribute('data-carousel-prev');
                    var root = document.getElementById(id);
                    if (!root) return;
                    var w = root.clientWidth;
                    root.scrollBy({
                        left: -w,
                        behavior: 'smooth'
                    });
                });
            });
        })();
    </script>

    <?= view('components/footer') ?>
</body>

</html>