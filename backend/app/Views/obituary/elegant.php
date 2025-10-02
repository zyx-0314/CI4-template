<?php

/**
 * Elegant obituary design
 */
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

                <p class="mx-auto mt-3 max-w-2xl text-gray-600" style="line-height:1.6;">
                    <?= nl2br(esc($obituary['description'] ?? '')) ?>
                </p>

                <!-- decorative divider -->
                <div class="flex justify-center items-center mt-6">
                    <span class="border-gray-300 border-t w-1/4"></span>
                    <svg class="mx-3 w-6 h-6 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 5v14" />
                        <path d="M5 12h14" />
                    </svg>
                    <span class="border-gray-300 border-t w-1/4"></span>
                </div>

                <p class="mt-4 font-semibold text-gray-800">
                    <?= !empty($obituary['date_of_birth']) ? date('j F Y', strtotime($obituary['date_of_birth'])) : '—' ?> — <?= !empty($obituary['date_of_death']) ? date('j F Y', strtotime($obituary['date_of_death'])) : '—' ?>
                </p>

                <div class="mt-6">
                    <a href="<?= base_url('/obituary/request') ?>" class="inline-block bg-rose-500 hover:bg-rose-600 px-5 py-2 rounded text-white">Request this design</a>
                    <a href="<?= base_url('/obituary') ?>" class="inline-block ml-3 text-rose-600">Back to templates</a>
                </div>
            </article>

            <!-- Content sections - single page stacked layout -->
            <div class="space-y-6 mt-10">
                <section class="bg-white p-6 border border-gray-100 rounded text-left">
                    <h2 class="font-semibold text-gray-800 text-xl">About</h2>
                    <p class="mt-3 text-gray-700 leading-relaxed"><?= nl2br(esc($obituary['description'] ?? 'No description available.')) ?></p>
                </section>

                <!-- decorative divider (reuse style) -->
                <div class="flex justify-center items-center">
                    <span class="border-gray-300 border-t w-1/4"></span>
                    <svg class="mx-3 w-6 h-6 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 5v14" />
                        <path d="M5 12h14" />
                    </svg>
                    <span class="border-gray-300 border-t w-1/4"></span>
                </div>

                <section class="bg-white p-4 border border-gray-100 rounded">
                    <h3 class="font-medium text-lg">Family</h3>
                    <?php if (!empty($obituary['family'])): ?>
                        <ul class="space-y-2 mt-3 text-gray-700">
                            <?php foreach ($obituary['family'] as $f): ?>
                                <li class="flex justify-between items-center">
                                    <span class="text-gray-800 text-sm"><?= esc(trim(($f['first_name'] ?? '') . ' ' . ($f['middle_initial'] ?? '') . ' ' . ($f['last_name'] ?? ''))) ?></span>
                                    <span class="text-gray-500 text-xs uppercase tracking-wider"><?= esc(ucfirst($f['relation'] ?? '')) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="mt-2 text-gray-600">No family information provided.</p>
                    <?php endif; ?>
                </section>

                <div class="flex justify-center items-center">
                    <span class="border-gray-300 border-t w-1/4"></span>
                    <svg class="mx-3 w-6 h-6 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 5v14" />
                        <path d="M5 12h14" />
                    </svg>
                    <span class="border-gray-300 border-t w-1/4"></span>
                </div>

                <section class="bg-white p-4 border border-gray-100 rounded">
                    <h3 class="font-medium text-lg">Services & Events</h3>
                    <?php $events = ['viewing' => ['date_time' => 'viewing_date_time', 'place' => 'viewing_place', 'label' => 'Viewing'], 'funeral' => ['date_time' => 'funeral_date_time', 'place' => 'funeral_place', 'label' => 'Funeral'], 'burial' => ['date_time' => 'burial_date_time', 'place' => 'burial_place', 'label' => 'Burial']]; ?>
                    <div class="space-y-3 mt-3">
                        <?php foreach ($events as $key => $ev): ?>
                            <div class="flex items-start gap-3">
                                <div class="mt-1 text-gray-400">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2v6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M7 12h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M10 16h4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-sm"><?= $ev['label'] ?></h4>
                                    <p class="text-gray-500 text-xs"><?= !empty($obituary[$ev['date_time']]) ? date('F j, Y, g:i A', strtotime($obituary[$ev['date_time']])) : 'TBA' ?></p>
                                    <p class="mt-1 text-gray-700 text-sm"><?= esc($obituary[$ev['place']] ?? 'No location provided') ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <?php if (!empty($obituary['treasured_memories'])): ?>
                    <div class="flex justify-center items-center">
                        <span class="border-gray-300 border-t w-1/4"></span>
                        <svg class="mx-3 w-6 h-6 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M12 5v14" />
                            <path d="M5 12h14" />
                        </svg>
                        <span class="border-gray-300 border-t w-1/4"></span>
                    </div>

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

                <div class="flex justify-center items-center">
                    <span class="border-gray-300 border-t w-1/4"></span>
                    <svg class="mx-3 w-6 h-6 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 5v14" />
                        <path d="M5 12h14" />
                    </svg>
                    <span class="border-gray-300 border-t w-1/4"></span>
                </div>

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

                <div class="flex justify-center items-center">
                    <span class="border-gray-300 border-t w-1/4"></span>
                    <svg class="mx-3 w-6 h-6 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 5v14" />
                        <path d="M5 12h14" />
                    </svg>
                    <span class="border-gray-300 border-t w-1/4"></span>
                </div>

                <section class="bg-white p-4 border border-gray-100 rounded">
                    <h3 class="font-medium text-lg">Share a memory or message</h3>
                    <form method="post" action="<?= base_url('/obituary/share/' . ($obituary['id'] ?? '')) ?>" class="space-y-3 mt-3">
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
                </section>

                <!-- Moved aside content to bottom -->
                <div class="flex justify-center items-center">
                    <span class="border-gray-300 border-t w-1/4"></span>
                    <svg class="mx-3 w-6 h-6 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 5v14" />
                        <path d="M5 12h14" />
                    </svg>
                    <span class="border-gray-300 border-t w-1/4"></span>
                </div>

                <section class="bg-white p-4 border border-gray-100 rounded text-sm">
                    <h4 class="font-medium">Share & Support</h4>
                    <div class="flex flex-col gap-2 mt-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" class="px-3 py-2 border border-gray-200 rounded text-sm text-center">Share on Facebook</a>
                        <a href="mailto:?subject=Memorial for <?= rawurlencode(trim(($obituary['first_name'] ?? '') . ' ' . ($obituary['last_name'] ?? ''))) ?>&body=View: <?= rawurlencode(current_url()) ?>" class="px-3 py-2 border border-gray-200 rounded text-sm text-center">Share via Email</a>
                        <a href="<?= base_url('/obituary/request') ?>" class="bg-gray-900 px-3 py-2 rounded text-white text-sm text-center">Request this design</a>
                    </div>
                </section>

                <?php if (!empty($obituary['other_notes'])): ?>
                    <section class="bg-white p-4 border border-gray-100 rounded text-gray-700 text-sm">
                        <h4 class="font-medium">Notes</h4>
                        <p class="mt-2 text-sm"><?= nl2br(esc($obituary['other_notes'])) ?></p>
                    </section>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>