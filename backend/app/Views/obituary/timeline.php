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

    <main class="mx-auto px-6 py-12 max-w-6xl">
        <div class="md:flex md:space-x-8">
            <!-- LEFT: image (top) with semi-transparent bottom, name over image, then dates and family -->
            <aside class="bg-white shadow rounded-lg md:w-1/2 overflow-hidden">
                <?php
                // prioritize the controller's profile image key, fall back to other common keys if present
                $photo = $obituary['profile_image'] ?? null;
                if (empty($photo)) {
                    if (!empty($obituary['image'])) $photo = $obituary['image'];
                    elseif (!empty($obituary['photo'])) $photo = $obituary['photo'];
                    elseif (!empty($obituary['avatar'])) $photo = $obituary['avatar'];
                }
                ?>

                <div class="relative bg-gray-100 h-64 md:h-80">
                    <?php if ($photo): ?>
                        <div class="absolute inset-0 bg-cover bg-center" style="background-image:url('<?= esc($photo) ?>')"></div>
                    <?php else: ?>
                        <div class="absolute inset-0 bg-gradient-to-b from-gray-200 to-gray-300"></div>
                    <?php endif; ?>

                    <!-- semi-transparent bottom strip -->
                    <div class="bottom-0 absolute inset-x-0 bg-gradient-to-t from-black via-black/40 to-transparent h-32"></div>

                    <!-- name over image at bottom -->
                    <div class="bottom-4 left-4 absolute text-white">
                        <h1 class="drop-shadow-md font-extrabold text-2xl md:text-3xl"><?= esc($obituary['first_name'] . ' ' . $obituary['last_name']) ?></h1>
                    </div>
                </div>

                <div class="p-6">
                    <div class="text-gray-700">
                        <div class="text-sm">Born</div>
                        <div class="font-medium"><?= date('F j, Y', strtotime($obituary['date_of_birth'] ?? '1970-01-01')) ?></div>
                        <div class="mt-3 text-sm">Died</div>
                        <div class="font-medium"><?= date('F j, Y', strtotime($obituary['date_of_death'] ?? '1970-01-01')) ?></div>
                    </div>

                    <div class="mt-6">
                        <h2 class="font-semibold text-gray-800 text-lg">Family</h2>
                        <?php
                        $family = null;
                        if (!empty($obituary['family'])) $family = $obituary['family'];
                        elseif (!empty($obituary['family_members'])) $family = $obituary['family_members'];
                        ?>

                        <?php if ($family): ?>
                            <?php if (is_array($family) && count($family) > 0): ?>
                                <?php $ftabId = 'family-tabs-' . ($obituary['id'] ?? '0'); ?>
                                <div id="<?= $ftabId ?>" class="mt-3">
                                    <div role="tablist" aria-label="Family members" class="flex space-x-2 overflow-auto">
                                        <?php foreach ($family as $i => $f): ?>
                                            <?php
                                            $label = $f['relation'] ?? ('Member ' . ($i + 1));
                                            $isActive = $i === 0;
                                            ?>
                                            <button
                                                type="button"
                                                role="tab"
                                                aria-selected="<?= $isActive ? 'true' : 'false' ?>"
                                                data-tab="<?= $i ?>"
                                                class="px-3 py-2 rounded-t-md focus:outline-none <?= $isActive ? 'border-b-2 border-indigo-600 text-indigo-600' : 'text-gray-600' ?>">
                                                <?= esc(ucfirst(str_replace('_', ' ', $label))) ?>
                                            </button>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="bg-gray-50 mt-3 border border-gray-100 rounded-b-md">
                                        <?php foreach ($family as $i => $f): ?>
                                            <?php $isActive = $i === 0; ?>
                                            <div data-content="<?= $i ?>" role="tabpanel" <?= $isActive ? '' : 'hidden' ?> class="p-3 text-gray-700 text-sm">
                                                <?php
                                                $relation = $f['relation'] ?? null;
                                                $first = $f['first_name'] ?? null;
                                                $middle = $f['middle_initial'] ?? null;
                                                $last = $f['last_name'] ?? null;
                                                $full = trim(($first ? $first : '') . ' ' . ($middle ? $middle : '') . ' ' . ($last ? $last : ''));
                                                ?>
                                                <div class="text-gray-500 text-sm">Relation</div>
                                                <div class="mb-2 font-medium text-gray-800"><?= esc($relation ?? 'Family') ?></div>

                                                <div class="text-gray-500 text-sm">Name</div>
                                                <div class="font-medium text-gray-800"><?= esc($full ?: 'Name not provided') ?></div>

                                                <?php if (!empty($f['notes'])): ?>
                                                    <div class="mt-3 text-gray-700"><?= esc($f['notes']) ?></div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <script>
                                    (function() {
                                        var container = document.getElementById('<?= $ftabId ?>');
                                        if (!container) return;
                                        var buttons = container.querySelectorAll('[role="tab"]');
                                        var panels = container.querySelectorAll('[role="tabpanel"]');
                                        buttons.forEach(function(btn) {
                                            btn.addEventListener('click', function() {
                                                var idx = btn.getAttribute('data-tab');
                                                buttons.forEach(function(b) {
                                                    b.classList.remove('border-b-2', 'border-indigo-600', 'text-indigo-600');
                                                    b.classList.add('text-gray-600');
                                                    b.setAttribute('aria-selected', 'false');
                                                });
                                                panels.forEach(function(p) {
                                                    p.hidden = true;
                                                });
                                                btn.classList.add('border-b-2', 'border-indigo-600', 'text-indigo-600');
                                                btn.classList.remove('text-gray-600');
                                                btn.setAttribute('aria-selected', 'true');
                                                var active = container.querySelector('[data-content="' + idx + '"]');
                                                if (active) active.hidden = false;
                                            });
                                        });
                                    })();
                                </script>
                            <?php else: ?>
                                <div class="mt-3 text-gray-700 text-sm"><?= esc($family) ?></div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="mt-3 text-gray-500 text-sm">No family information provided.</div>
                        <?php endif; ?>
                    </div>

                    <div class="flex items-center gap-3 mt-6">
                        <a href="<?= base_url('/obituary/request') ?>" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-md text-white">Request this design</a>
                        <a href="<?= base_url('/obituary') ?>" class="text-indigo-600">Back</a>
                    </div>
                </div>
            </aside>

            <!-- RIGHT: events timeline, treasured memories, messages -->
            <section class="mt-6 md:mt-0 md:w-1/2">
                <div class="bg-white shadow p-6 rounded-lg">
                    <?php
                    // use the explicit event fields provided by the controller
                    $viewing_dt = $obituary['viewing_date_time'] ?? null;
                    $viewing_place = $obituary['viewing_place'] ?? null;
                    $burial_dt = $obituary['burial_date_time'] ?? null;
                    $burial_place = $obituary['burial_place'] ?? null;
                    $funeral_dt = $obituary['funeral_date_time'] ?? null;
                    $funeral_place = $obituary['funeral_place'] ?? null;
                    $hasEvents = $viewing_dt || $viewing_place || $burial_dt || $burial_place || $funeral_dt || $funeral_place;
                    ?>

                    <h2 class="font-semibold text-gray-800 text-lg">Service Timeline</h2>
                    <div class="mt-4">
                        <?php if ($hasEvents): ?>
                            <div class="space-y-4">
                                <?php if ($viewing_dt || $viewing_place): ?>
                                    <div class="flex items-start gap-4">
                                        <div class="bg-indigo-600 mt-1 rounded-full w-3 h-3"></div>
                                        <div>
                                            <div class="font-semibold text-gray-800">Viewing</div>
                                            <div class="text-gray-600 text-sm">
                                                <?php if ($viewing_dt): ?>
                                                    <?= date('F j, Y g:ia', strtotime($viewing_dt)) ?>
                                                <?php endif; ?>
                                                <?php if ($viewing_place): ?>
                                                    <?= $viewing_dt ? ' • ' : '' ?><?= esc($viewing_place) ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($burial_dt || $burial_place): ?>
                                    <div class="flex items-start gap-4">
                                        <div class="bg-indigo-600 mt-1 rounded-full w-3 h-3"></div>
                                        <div>
                                            <div class="font-semibold text-gray-800">Burial</div>
                                            <div class="text-gray-600 text-sm">
                                                <?php if ($burial_dt): ?>
                                                    <?= date('F j, Y g:ia', strtotime($burial_dt)) ?>
                                                <?php endif; ?>
                                                <?php if ($burial_place): ?>
                                                    <?= $burial_dt ? ' • ' : '' ?><?= esc($burial_place) ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($funeral_dt || $funeral_place): ?>
                                    <div class="flex items-start gap-4">
                                        <div class="bg-indigo-600 mt-1 rounded-full w-3 h-3"></div>
                                        <div>
                                            <div class="font-semibold text-gray-800">Funeral</div>
                                            <div class="text-gray-600 text-sm">
                                                <?php if ($funeral_dt): ?>
                                                    <?= date('F j, Y g:ia', strtotime($funeral_dt)) ?>
                                                <?php endif; ?>
                                                <?php if ($funeral_place): ?>
                                                    <?= $funeral_dt ? ' • ' : '' ?><?= esc($funeral_place) ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="text-gray-500">No service event details provided.</div>
                        <?php endif; ?>
                    </div>

                    <!-- treasured memories -->
                    <div class="mt-8">
                        <h3 class="font-semibold text-gray-800 text-lg">Treasured Memories</h3>
                        <div class="gap-4 grid grid-cols-1 mt-4">
                            <?php $memories = $obituary['treasured_memories'] ?? []; ?>
                            <?php if (!empty($memories)): ?>
                                <?php foreach ($memories as $m): ?>
                                    <article class="bg-white shadow-sm border border-gray-100 rounded-lg overflow-hidden">
                                        <?php if (!empty($m['img'])): ?>
                                            <div class="bg-gray-100 w-full h-48 overflow-hidden">
                                                <img src="<?= esc($m['img']) ?>" alt="<?= esc($m['title'] ?? 'Memory image') ?>" class="w-full h-full object-cover">
                                            </div>
                                        <?php else: ?>
                                            <div class="bg-gradient-to-b from-gray-200 to-gray-300 w-full h-48"></div>
                                        <?php endif; ?>

                                        <div class="p-4 text-left">
                                            <div class="font-medium text-gray-800"><?= esc($m['title'] ?? '') ?></div>
                                            <?php if (!empty($m['date']) || !empty($m['year'])): ?>
                                                <div class="mt-1 text-gray-500 text-sm"><?= esc($m['date'] ?? $m['year'] ?? '') ?></div>
                                            <?php endif; ?>
                                            <?php if (!empty($m['descriptions'])): ?>
                                                <div class="mt-2 text-gray-600 text-sm"><?= esc($m['descriptions']) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-gray-500">No treasured memories have been added.</div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- messages / shared memories -->
                    <div class="mt-8">
                        <h3 class="font-semibold text-gray-800 text-lg">Messages & Shared Memories</h3>
                        <?php
                        $messages = null;
                        if (!empty($obituary['messages'])) $messages = $obituary['messages'];
                        elseif (!empty($obituary['shared_memories'])) $messages = $obituary['shared_memories'];
                        elseif (!empty($obituary['condolences'])) $messages = $obituary['condolences'];
                        ?>

                        <div class="space-y-3 mt-4">
                            <?php if ($messages): ?>
                                <?php if (is_array($messages)): ?>
                                    <?php foreach ($messages as $msg): ?>
                                        <div class="bg-white p-3 border border-gray-100 rounded-lg text-gray-700 text-sm"><?= esc(is_array($msg) ? ($msg['message'] ?? json_encode($msg)) : $msg) ?></div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="bg-white p-3 border border-gray-100 rounded-lg text-gray-700 text-sm"><?= esc($messages) ?></div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="text-gray-500">No messages or shared memories.</div>
                            <?php endif; ?>
                        </div>

                        <!-- message submission form -->
                        <div class="mt-6">
                            <h4 class="font-semibold text-gray-800 text-md">Leave a message</h4>
                            <form action="<?= base_url('/obituary/' . ($obituary['id'] ?? '') . '/messages') ?>" method="post" class="space-y-3 mt-3">
                                <?= csrf_field() ?>

                                <div>
                                    <label for="msg_name" class="block text-gray-700 text-sm">Name (optional)</label>
                                    <input id="msg_name" name="name" type="text" class="block mt-1 px-3 py-2 border border-gray-200 rounded w-full" value="<?= esc(old('name')) ?>">
                                </div>

                                <div>
                                    <label for="msg_content" class="block text-gray-700 text-sm">Message</label>
                                    <textarea id="msg_content" name="message" required class="block mt-1 px-3 py-2 border border-gray-200 rounded w-full" rows="4"><?= esc(old('message')) ?></textarea>
                                </div>

                                <?php if (session()->getFlashdata('errors')): ?>
                                    <div class="text-red-600 text-sm">
                                        <?php foreach (session()->getFlashdata('errors') as $err): ?>
                                            <div><?= esc($err) ?></div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <div>
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded text-white">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>