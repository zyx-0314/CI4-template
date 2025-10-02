<?php

/**
 * Minimalist obituary design
 */
?>
<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => 'Minimalist - ' . ($obituary['first_name'] ?? '')]) ?>

<body class="bg-rose-50 text-gray-800 antialiased">
    <?= view('components/header') ?>

    <main class="mx-auto px-6 py-12 max-w-4xl">
        <section class="bg-white shadow-sm border rounded-lg overflow-hidden">
            <!-- Hero: large background image that fades to white toward the bottom -->
            <div class="relative">
                <?php $hero = esc($obituary['profile_image'] ?? '/logo/avatar-placeholder.png'); ?>
                <div class="bg-cover bg-center w-full" style="background-image: url('<?= $hero ?>'); height: 22rem;"></div>

                <!-- gradient overlay that fades to white so the page content blends naturally -->
                <div class="absolute inset-0 pointer-events-none" style="background: linear-gradient(to bottom, rgba(255,255,255,0) 40%, rgba(255,255,255,1) 92%);"></div>

                <!-- minimal hero text placed above the bottom of the image -->
                <div class="right-0 bottom-6 left-0 absolute flex flex-col items-center px-6">
                    <p class="drop-shadow-sm text-white/90 text-xs uppercase tracking-widest">In loving memory of</p>
                    <h1 class="drop-shadow-md mt-1 font-bold text-white text-3xl" style="font-family: 'Brush Script MT', 'Lucida Handwriting', cursive;">
                        <?= esc(trim(($obituary['first_name'] ?? '') . ' ' . ($obituary['middle_name'] ? $obituary['middle_name'] . ' ' : '') . ($obituary['last_name'] ?? ''))) ?>
                    </h1>
                    <p class="drop-shadow-sm mt-1 text-white/90 text-sm">
                        <?= !empty($obituary['date_of_birth']) ? date('j F Y', strtotime($obituary['date_of_birth'])) : '—' ?> — <?= !empty($obituary['date_of_death']) ? date('j F Y', strtotime($obituary['date_of_death'])) : '—' ?>
                    </p>
                </div>

                <!-- small actions tucked into the hero, minimal labels only -->
                <div class="top-4 right-4 absolute">
                    <a href="<?= base_url('/obituary/request') ?>" class="bg-white/90 px-3 py-1 rounded text-rose-600 text-sm">Request</a>
                </div>
            </div>

            <div class="space-y-6 px-8 py-6 divide-y divide-gray-100">
                <!-- About -->
                <section class="py-4">
                    <h2 class="font-semibold text-lg">About</h2>
                    <p class="mt-3 text-gray-700 text-sm leading-relaxed"><?= nl2br(esc($obituary['description'] ?? 'No description available.')) ?></p>
                </section>

                <!-- Family -->
                <section class="py-4">
                    <h3 class="font-medium text-md">Family</h3>
                    <?php if (!empty($obituary['family'])): ?>
                        <ul class="space-y-2 mt-3 text-gray-700 text-sm">
                            <?php foreach ($obituary['family'] as $f): ?>
                                <li class="flex justify-between items-center">
                                    <span class="font-medium"><?= esc(trim(($f['first_name'] ?? '') . ' ' . ($f['middle_initial'] ?? '') . ' ' . ($f['last_name'] ?? ''))) ?></span>
                                    <span class="text-gray-500 text-xs uppercase tracking-wider"><?= esc(ucfirst($f['relation'] ?? '')) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="mt-2 text-gray-600 text-sm">No family information provided.</p>
                    <?php endif; ?>
                </section>

                <!-- Services & Events -->
                <section class="py-4">
                    <h3 class="font-medium text-md">Services & Events</h3>
                    <?php $events = ['viewing' => ['date_time' => 'viewing_date_time', 'place' => 'viewing_place', 'label' => 'Viewing'], 'funeral' => ['date_time' => 'funeral_date_time', 'place' => 'funeral_place', 'label' => 'Funeral'], 'burial' => ['date_time' => 'burial_date_time', 'place' => 'burial_place', 'label' => 'Burial']]; ?>
                    <div class="gap-4 grid grid-cols-1 md:grid-cols-3 mt-3 text-gray-700 text-sm">
                        <?php foreach ($events as $key => $ev): ?>
                            <div class="p-3 border border-gray-50 rounded">
                                <div class="text-gray-500 text-xs uppercase tracking-wider"><?= $ev['label'] ?></div>
                                <div class="mt-1 font-medium"><?= !empty($obituary[$ev['date_time']]) ? date('F j, Y, g:i A', strtotime($obituary[$ev['date_time']])) : 'TBA' ?></div>
                                <div class="mt-1 text-gray-600 text-xs"><?= esc($obituary[$ev['place']] ?? 'No location provided') ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <!-- Treasured Memories -->
                <?php if (!empty($obituary['treasured_memories'])): ?>
                    <section class="py-4">
                        <h3 class="font-medium text-md">Treasured Memories</h3>
                        <div class="gap-3 grid grid-cols-2 md:grid-cols-4 mt-3">
                            <?php foreach ($obituary['treasured_memories'] as $m): ?>
                                <figure class="text-sm text-center">
                                    <div class="bg-gray-100 rounded w-full h-20 overflow-hidden">
                                        <img src="<?= esc($m['img'] ?? '') ?>" alt="<?= esc($m['title'] ?? 'Memory') ?>" class="w-full h-full object-cover">
                                    </div>
                                    <figcaption class="mt-1 text-gray-700">
                                        <div class="font-medium"><?= esc($m['title'] ?? '') ?></div>
                                        <div class="text-gray-500 text-xs"><?= esc($m['descriptions'] ?? '') ?></div>
                                    </figcaption>
                                </figure>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <!-- Messages & Share form -->
                <section class="py-4">
                    <h3 class="font-medium text-md">Messages & Shared Memories</h3>
                    <?php if (!empty($obituary['shared_messages'])): ?>
                        <div class="space-y-3 mt-3 text-sm">
                            <?php foreach ($obituary['shared_messages'] as $s): ?>
                                <blockquote class="bg-gray-50 p-3 border-gray-200 border-l-2 rounded">
                                    <div class="text-gray-500 text-xs">
                                        <strong><?= esc(!empty($s['anonymous']) ? 'Anonymous' : ($s['name'] ?? 'Guest')) ?></strong>
                                        <span class="ml-2"><?= !empty($s['created_at']) ? date('F j, Y', strtotime($s['created_at'])) : '' ?></span>
                                    </div>
                                    <p class="mt-2 text-gray-700"><?= nl2br(esc($s['message'] ?? '')) ?></p>
                                </blockquote>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="mt-2 text-gray-600 text-sm">No messages yet. Be the first to share a memory.</p>
                    <?php endif; ?>

                    <div class="mt-4">
                        <h4 class="font-medium text-sm">Share a memory or message</h4>
                        <form method="post" action="<?= base_url('/obituary/share/' . ($obituary['id'] ?? '')) ?>" class="space-y-3 mt-3 text-sm">
                            <div class="flex items-center gap-3">
                                <label class="flex items-center gap-2 text-sm">
                                    <input id="anonymousSwitch" type="checkbox" name="anonymous" checked class="w-4 h-4">
                                    <span>Share anonymously</span>
                                </label>
                                <div id="nameInputContainer" class="hidden flex-1">
                                    <input type="text" name="name" id="sharerName" placeholder="Your name" class="p-2 border rounded w-full text-sm">
                                </div>
                            </div>

                            <div>
                                <label for="message" class="sr-only">Message</label>
                                <textarea id="message" name="message" rows="4" class="p-3 border rounded w-full text-sm" placeholder="Write something about <?= esc($obituary['first_name'] ?? 'the person') ?>..."></textarea>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="bg-gray-900 px-4 py-2 rounded text-white text-sm">Submit</button>
                            </div>
                        </form>
                    </div>
                </section>

                <!-- Notes & Share links -->
                <section class="py-4">
                    <div class="flex md:flex-row flex-col md:justify-between gap-4">
                        <div class="flex-1">
                            <?php if (!empty($obituary['other_notes'])): ?>
                                <h4 class="font-medium text-sm">Notes</h4>
                                <p class="mt-2 text-gray-700 text-sm"><?= nl2br(esc($obituary['other_notes'])) ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="w-44">
                            <h4 class="font-medium text-sm">Share & Support</h4>
                            <div class="flex flex-col gap-2 mt-2 text-sm">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" class="px-3 py-2 border border-gray-200 rounded text-center">Share on Facebook</a>
                                <a href="mailto:?subject=Memorial for <?= rawurlencode(trim(($obituary['first_name'] ?? '') . ' ' . ($obituary['last_name'] ?? ''))) ?>&body=View: <?= rawurlencode(current_url()) ?>" class="px-3 py-2 border border-gray-200 rounded text-center">Share via Email</a>
                                <a href="<?= base_url('/obituary/request') ?>" class="bg-gray-900 px-3 py-2 rounded text-white text-center">Request this design</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </main>

    <?= view('components/footer') ?>

    <script>
        // small JS to toggle name input when anonymous unchecked
        (function() {
            var anon = document.getElementById('anonymousSwitch');
            var nameContainer = document.getElementById('nameInputContainer');
            var nameInput = document.getElementById('sharerName');

            function toggle() {
                if (anon.checked) {
                    nameContainer.classList.add('hidden');
                    nameInput.value = '';
                } else {
                    nameContainer.classList.remove('hidden');
                }
            }
            if (anon && nameContainer) {
                anon.addEventListener('change', toggle);
                toggle();
            }
        })();
    </script>
</body>

</html>