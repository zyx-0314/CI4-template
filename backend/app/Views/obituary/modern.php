<?php

/**
 * Modern obituary design
 * Expects $obituary array from controller
 */
?>
<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => 'Modern - ' . ($obituary['first_name'] ?? '')]) ?>

<body class="bg-white text-slate-800" style="background-color:#f8fafb;">
    <?= view('components/header') ?>

    <style>
        :root {
            /* 3-color palette inspired by reference image: brand / accent / neutral */
            --brand: #7B3F52;
            /* wine */
            --accent: #CFA6B6;
            /* soft rose */
            --neutral: #F7F4F6;
            /* off-white */
            --text: #22262a;
            /* main text */
            --muted: rgba(34, 38, 42, 0.45);
            --card-radius: 12px;
        }

        body {
            background: var(--brand);
            color: var(--text);
        }

        .page-inner {
            background: var(--neutral);
            padding: 28px;
            border-radius: 8px;
            box-shadow: 0 6px 30px rgba(17, 20, 24, 0.06);
        }

        .brand {
            color: var(--brand)
        }

        .brand-bg {
            background-color: var(--brand)
        }

        .accent {
            color: var(--accent)
        }

        .accent-bg {
            background-color: var(--accent)
        }

        .muted {
            color: var(--muted)
        }

        /* subtle card elevation and transitions */
        .card {
            transition: transform .18s ease, box-shadow .18s ease
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(17, 20, 24, 0.06)
        }

        /* tabs (icon + label) */
        .tabs {
            display: flex;
            gap: 2rem;
            align-items: center;
            border-bottom: 1px solid rgba(34, 38, 42, 0.06);
            padding: 1rem 0;
        }

        .tab {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            gap: .35rem;
            padding: .5rem .25rem;
            color: var(--muted);
            text-decoration: none
        }

        .tab svg {
            width: 22px;
            height: 22px;
            opacity: .9
        }

        .tab.active {
            color: var(--brand);
            border-bottom: 3px solid var(--brand);
            padding-bottom: .6rem
        }

        /* timeline */
        .timeline {
            position: relative;
            padding-left: 1.25rem
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0.625rem;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(180deg, rgba(123, 63, 82, 0.25), rgba(207, 166, 182, 0.12));
            border-radius: 2px
        }

        .timeline-item {
            position: relative;
            padding: .5rem 0 1rem 1.5rem
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -0.2rem;
            top: .6rem;
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: var(--brand);
            box-shadow: 0 0 0 4px rgba(207, 166, 182, 0.12)
        }

        /* responsive sticky aside */
        @media (min-width: 1024px) {
            .sticky-aside {
                position: sticky;
                top: 4.5rem
            }
        }

        /* header name sizing similar to image */
        .obit-name {
            font-size: 2rem;
            line-height: 1.06;
            font-weight: 600
        }
    </style>

    <main class="mx-auto px-6 py-12 max-w-6xl">
        <div class="items-start gap-8 grid lg:grid-cols-3">
            <!-- Left column: visual + quick actions (personal & connected) -->
            <aside class="sticky-aside lg:col-span-1">
                <div class="bg-white shadow-md border rounded-lg overflow-hidden">
                    <div class="relative">
                        <img src="<?= esc($obituary['profile_image'] ?? '/logo/avatar-placeholder.png') ?>" alt="<?= esc($obituary['first_name'] . ' ' . $obituary['last_name']) ?>" class="w-full h-64 object-cover">
                        <div class="bottom-4 left-4 absolute flex items-center gap-2 bg-white/90 backdrop-blur-sm px-3 py-1 border rounded-full">
                            <svg class="w-4 h-4 brand" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h8m-8 4h6"></path>
                            </svg>
                            <span class="text-xs muted">Profile</span>
                        </div>
                    </div>

                    <div class="p-4">
                        <h1 class="font-semibold text-slate-900 text-2xl tracking-tight"><?= esc($obituary['first_name'] . ' ' . $obituary['last_name']) ?></h1>
                        <p class="mt-1 text-sm muted"><?= date('F j, Y', strtotime($obituary['date_of_birth'] ?? '1970-01-01')) ?> — <?= date('F j, Y', strtotime($obituary['date_of_death'] ?? '1970-01-01')) ?></p>



                        <div class="flex gap-3 mt-4">
                            <a href="<?= base_url('/obituary/request') ?>" class="inline-flex flex-1 justify-center items-center gap-2 hover:opacity-95 px-3 py-2 rounded text-white brand-bg">Request</a>
                            <a href="<?= base_url('/obituary') ?>" class="inline-flex justify-center items-center px-3 py-2 border rounded muted">Back</a>
                        </div>

                        <div class="flex items-center gap-2 mt-4 text-xs">
                            <span class="uppercase tracking-wide muted">Connected</span>
                            <div class="flex gap-3 ml-auto">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" class="brand">Facebook</a>
                                <a href="mailto:?subject=Memorial for <?= rawurlencode(trim(($obituary['first_name'] ?? '') . ' ' . ($obituary['last_name'] ?? ''))) ?>&body=View: <?= rawurlencode(current_url()) ?>" class="muted">Email</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm mt-6 p-4 border rounded-lg text-sm card">
                    <nav class="tabs" role="tablist" aria-label="Obituary sections">
                        <a href="#life-legacy" class="tab active" role="tab" aria-selected="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2v20M3 7h18" />
                            </svg>
                            <span class="text-xs">About</span>
                        </a>

                        <?php if (!empty($obituary['description'])): ?>
                            <a href="#life-legacy" class="tab" role="tab">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h8M8 12h8M8 17h8" />
                                </svg>
                                <span class="text-xs">Obituary</span>
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($obituary['treasured_memories'])): ?>
                            <a href="#" class="tab" role="tab">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7h18v10H3z" />
                                </svg>
                                <span class="text-xs">Memories</span>
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($obituary['flowers'])): ?>
                            <a href="#" class="tab" role="tab">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2s4 3 4 6-1 4-4 6-4 3-4 6" />
                                </svg>
                                <span class="text-xs">Flowers</span>
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($obituary['viewing_date_time']) || !empty($obituary['funeral_date_time']) || !empty($obituary['burial_date_time']) || !empty($obituary['other_events'])): ?>
                            <a href="#" class="tab" role="tab">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7v10M16 7v10M3 12h18" />
                                </svg>
                                <span class="text-xs">Events</span>
                            </a>
                        <?php endif; ?>
                    </nav>

                    <div class="mt-4">
                        <h4 class="font-medium text-slate-800">Quick Highlights</h4>
                        <ul class="space-y-3 mt-3 muted">
                            <?php foreach ($obituary['highlights'] ?? ($obituary['treasured_memories'] ?? []) as $m): ?>
                                <li class="flex items-start gap-3">
                                    <span class="flex-none mt-2 rounded-full w-2 h-2 brand-bg" style="box-shadow:0 4px 10px rgba(123,63,82,0.06)"></span>
                                    <div>
                                        <div class="font-medium text-slate-800 text-sm"><?= esc($m['title'] ?? ($m['name'] ?? '')) ?></div>
                                        <div class="text-slate-500 text-xs"><?= esc($m['descriptions'] ?? $m['description'] ?? '') ?></div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </aside>

            <!-- Main content: dynamic, personal timeline & family -->
            <section class="space-y-6 lg:col-span-2">
                <div id="life-legacy" class="bg-white shadow-md p-5 border rounded-lg">
                    <h3 class="font-semibold text-slate-900 text-lg">Life & Legacy</h3>
                    <div class="mt-3 text-slate-700 text-sm leading-relaxed">
                        <?= nl2br(esc($obituary['description'] ?? 'No description available.')) ?>
                    </div>
                    <div class="gap-4 grid md:grid-cols-2 mt-4">
                        <div>
                            <h4 class="font-medium text-slate-800 text-sm">Family & Relations</h4>
                            <div class="mt-3 text-slate-700 text-sm">
                                <?php if (!empty($obituary['family'])): ?>
                                    <ul class="space-y-3">
                                        <?php foreach ($obituary['family'] as $f): ?>
                                            <li class="flex items-center gap-3">
                                                <div class="flex-none bg-gray-100 rounded-full w-10 h-10 overflow-hidden">
                                                    <img src="<?= esc($f['avatar'] ?? '/logo/avatar-placeholder.png') ?>" alt="<?= esc($f['first_name'] . ' ' . $f['last_name']) ?>" class="w-full h-full object-cover">
                                                </div>
                                                <div class="flex-1">
                                                    <div class="font-medium text-slate-800 text-sm"><?= esc(trim(($f['first_name'] ?? '') . ' ' . ($f['last_name'] ?? ''))) ?></div>
                                                    <div class="text-xs uppercase tracking-wide muted"><?= esc(ucfirst($f['relation'] ?? '')) ?></div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p class="text-slate-500">No family data available.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-medium text-slate-800 text-sm">Events</h4>
                            <div class="mt-3 text-slate-700 text-sm timeline">
                                <div class="timeline-item">
                                    <div class="font-medium">Viewing</div>
                                    <div class="text-xs muted"><?= !empty($obituary['viewing_date_time']) ? date('F j, Y, g:i A', strtotime($obituary['viewing_date_time'])) : 'TBA' ?></div>
                                </div>
                                <div class="timeline-item">
                                    <div class="font-medium">Funeral</div>
                                    <div class="text-xs muted"><?= !empty($obituary['funeral_date_time']) ? date('F j, Y, g:i A', strtotime($obituary['funeral_date_time'])) : 'TBA' ?></div>
                                </div>
                                <div class="timeline-item">
                                    <div class="font-medium">Burial</div>
                                    <div class="text-xs muted"><?= !empty($obituary['burial_date_time']) ? date('F j, Y, g:i A', strtotime($obituary['burial_date_time'])) : 'TBA' ?></div>
                                </div>
                                <?php if (!empty($obituary['other_events'])): ?>
                                    <?php foreach ($obituary['other_events'] as $e): ?>
                                        <div class="timeline-item">
                                            <div class="font-medium"><?= esc($e['title'] ?? 'Event') ?></div>
                                            <div class="text-xs muted"><?= !empty($e['date_time']) ? date('F j, Y, g:i A', strtotime($e['date_time'])) : 'TBA' ?></div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (!empty($obituary['treasured_memories'])): ?>
                    <div class="bg-white shadow-md p-5 border rounded-lg card">
                        <div class="flex justify-between items-center">
                            <h3 class="font-semibold text-slate-900 text-lg">Treasured Memories</h3>
                            <div class="text-xs muted">Captured moments</div>
                        </div>
                        <div class="gap-4 grid grid-cols-2 md:grid-cols-3 mt-4">
                            <?php foreach ($obituary['treasured_memories'] as $m): ?>
                                <figure class="bg-white border rounded overflow-hidden">
                                    <div class="bg-gray-50 h-44 overflow-hidden">
                                        <img src="<?= esc($m['img'] ?? '') ?>" alt="<?= esc($m['title'] ?? 'Memory') ?>" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                    </div>
                                    <figcaption class="p-3 text-slate-700 text-sm">
                                        <div class="font-medium text-slate-800"><?= esc($m['title'] ?? '') ?></div>
                                        <div class="text-xs muted"><?= esc($m['descriptions'] ?? '') ?></div>
                                    </figcaption>
                                </figure>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="bg-white shadow-md p-5 border rounded-lg card">
                    <div class="flex justify-between items-center">
                        <h3 class="font-semibold text-slate-900 text-lg">Messages & Tributes</h3>
                        <div class="text-xs muted">Share a memory</div>
                    </div>
                    <?php if (!empty($obituary['shared_messages'])): ?>
                        <div class="space-y-4 mt-4">
                            <?php foreach ($obituary['shared_messages'] as $s): ?>
                                <div class="hover:shadow-sm p-3 border rounded transition">
                                    <div class="flex justify-between items-center">
                                        <div class="font-medium text-slate-800 text-sm"><?= esc(!empty($s['anonymous']) ? 'Anonymous' : ($s['name'] ?? 'Guest')) ?></div>
                                        <div class="text-xs muted"><?= !empty($s['created_at']) ? date('F j, Y', strtotime($s['created_at'])) : '' ?></div>
                                    </div>
                                    <p class="mt-2 text-slate-700 text-sm"><?= nl2br(esc($s['message'] ?? '')) ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="mt-2 text-slate-500">No messages yet. Be the first to share a tribute.</p>
                    <?php endif; ?>
                    <div class="flex gap-2 mt-4">
                        <a href="<?= base_url('/obituary/tribute/' . ($obituary['id'] ?? '')) ?>" class="px-3 py-2 rounded text-white text-sm brand-bg">Leave a tribute</a>
                        <a href="#" class="px-3 py-2 border rounded text-sm muted">Share</a>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>
<script>
    // Smooth scroll for internal links (simple, unobtrusive)
    (function() {
        document.querySelectorAll('a[href^="#"]').forEach(function(a) {
            a.addEventListener('click', function(e) {
                var href = this.getAttribute('href');
                if (!href || href === '#') return;
                var target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    history.replaceState && history.replaceState(null, null, href);
                }
            });
        });
    })();
</script>