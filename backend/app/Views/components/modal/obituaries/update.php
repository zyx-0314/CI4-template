<?php
// Component: components/modal/obituaries/update.php
// Data contract: $ob (array|object)
?>

<div class="flex justify-end mb-4">
    <button type="button" <?= is_array($ob) ? ('data-ob-id="' . esc($ob['id'] ?? '') . '"') : ('data-ob-id="' . esc($ob->id ?? '') . '"') ?> class="bg-amber-600/70 hover:bg-amber-600/60 px-3 py-2 rounded text-white duration-200 cursor-pointer js-update-ob-trigger">
        <i class="fa-pen-to-square fa-solid"></i>
    </button>
</div>

<div class="hidden z-50 fixed inset-0 justify-center items-center m-0 update-ob-modal">
    <div class="absolute inset-0 bg-black opacity-50 update-ob-backdrop"></div>

    <div class="relative bg-white shadow-lg mx-4 my-8 rounded w-full max-w-2xl max-h-[90vh] overflow-auto" role="dialog" aria-modal="true" aria-labelledby="updateObTitle">
        <header class="px-6 py-4 border-b">
            <h3 id="updateObTitle" class="font-semibold text-lg">Update Obituary Request</h3>
        </header>

        <div class="space-y-4 px-6 py-4 update-ob-content">
            <form class="update-ob-form" method="POST" action="/admin/obituaries/update" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= is_array($ob) ? esc($ob['id'] ?? '') : esc($ob->id ?? '') ?>" />

                <div class="gap-4 grid grid-cols-1 mt-4 px-2">
                    <div>
                        <label class="block font-medium text-gray-900 text-sm">Status</label>
                        <?php $__statuses = ['request', 'confirmed'];
                        $currentStatus = is_array($ob) ? ($ob['status'] ?? '') : ($ob->status ?? ''); ?>
                        <select name="status" class="block mt-1 px-3 py-2 border rounded w-full">
                            <?php foreach ($__statuses as $__s): ?>
                                <option value="<?= esc($__s) ?>" <?= ($currentStatus === $__s) ? 'selected' : '' ?>><?= esc($__s) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-900 text-sm">Obituary type</label>
                        <?php $__types = ['classic', 'modern', 'elegant', 'minimalist', 'timeline'];
                        $currentType = is_array($ob) ? ($ob['obituary_type'] ?? '') : ($ob->obituary_type ?? ''); ?>
                        <select name="obituary_type" class="block mt-1 px-3 py-2 border rounded w-full">
                            <?php foreach ($__types as $__t): ?>
                                <option value="<?= esc($__t) ?>" <?= ($currentType === $__t) ? 'selected' : '' ?>><?= esc(ucfirst($__t)) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="gap-4 grid grid-cols-2">
                        <div>
                            <label class="block font-medium text-gray-900 text-sm">First name</label>
                            <input name="first_name" type="text" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= is_array($ob) ? esc($ob['first_name'] ?? '') : esc($ob->first_name ?? '') ?>" />
                        </div>
                        <div>
                            <label class="block font-medium text-gray-900 text-sm">Middle name</label>
                            <input name="middle_name" type="text" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= is_array($ob) ? esc($ob['middle_name'] ?? '') : esc($ob->middle_name ?? '') ?>" />
                        </div>
                    </div>

                    <div class="gap-4 grid grid-cols-2">
                        <div>
                            <label class="block font-medium text-gray-900 text-sm">Last name</label>
                            <input name="last_name" type="text" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= is_array($ob) ? esc($ob['last_name'] ?? '') : esc($ob->last_name ?? '') ?>" />
                        </div>
                        <div>
                            <label class="block font-medium text-gray-900 text-sm">Profile image (path)</label>
                            <input name="profile_image" type="text" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= is_array($ob) ? esc($ob['profile_image'] ?? '') : esc($ob->profile_image ?? '') ?>" />
                        </div>
                    </div>

                    <div class="gap-4 grid grid-cols-2">
                        <div>
                            <label class="block font-medium text-gray-900 text-sm">Date of birth</label>
                            <input name="date_of_birth" type="date" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= is_array($ob) ? esc($ob['date_of_birth'] ?? '') : esc($ob->date_of_birth ?? '') ?>" />
                        </div>
                        <div>
                            <label class="block font-medium text-gray-900 text-sm">Date of death</label>
                            <input name="date_of_death" type="date" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= is_array($ob) ? esc($ob['date_of_death'] ?? '') : esc($ob->date_of_death ?? '') ?>" />
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-900 text-sm">Description</label>
                        <textarea name="description" rows="3" class="block mt-1 px-3 py-2 border rounded w-full"><?= is_array($ob) ? esc($ob['description'] ?? '') : esc($ob->description ?? '') ?></textarea>
                    </div>

                    <div class="gap-4 grid grid-cols-2">
                        <div>
                            <label class="block font-medium text-gray-900 text-sm">Viewing date & time</label>
                            <input name="viewing_date_time" type="datetime-local" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= is_array($ob) ? esc($ob['viewing_date_time'] ?? '') : esc($ob->viewing_date_time ?? '') ?>" />
                        </div>
                        <div>
                            <label class="block font-medium text-gray-900 text-sm">Viewing place</label>
                            <input name="viewing_place" type="text" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= is_array($ob) ? esc($ob['viewing_place'] ?? '') : esc($ob->viewing_place ?? '') ?>" />
                        </div>
                    </div>

                    <div class="gap-4 grid grid-cols-2">
                        <div>
                            <label class="block font-medium text-gray-900 text-sm">Funeral date & time</label>
                            <input name="funeral_date_time" type="datetime-local" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= is_array($ob) ? esc($ob['funeral_date_time'] ?? '') : esc($ob->funeral_date_time ?? '') ?>" />
                        </div>
                        <div>
                            <label class="block font-medium text-gray-900 text-sm">Funeral place</label>
                            <input name="funeral_place" type="text" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= is_array($ob) ? esc($ob['funeral_place'] ?? '') : esc($ob->funeral_place ?? '') ?>" />
                        </div>
                    </div>

                    <div class="gap-4 grid grid-cols-2">
                        <div>
                            <label class="block font-medium text-gray-900 text-sm">Burial date & time</label>
                            <input name="burial_date_time" type="datetime-local" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= is_array($ob) ? esc($ob['burial_date_time'] ?? '') : esc($ob->burial_date_time ?? '') ?>" />
                        </div>
                        <div>
                            <label class="block font-medium text-gray-900 text-sm">Burial place</label>
                            <input name="burial_place" type="text" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= is_array($ob) ? esc($ob['burial_place'] ?? '') : esc($ob->burial_place ?? '') ?>" />
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-900 text-sm">Treasured memories</label>
                        <?php
                        $tm_raw = is_array($ob) ? ($ob['treasured_memories'] ?? '') : ($ob->treasured_memories ?? '');
                        $treasured_list = [];
                        if ($tm_raw) {
                            if (is_array($tm_raw)) {
                                $treasured_list = $tm_raw;
                            } else {
                                $decoded = json_decode($tm_raw, true);
                                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                    $treasured_list = $decoded;
                                }
                            }
                        }
                        ?>

                        <div class="space-y-2 mt-2 treasured-list">
                            <?php if (!empty($treasured_list)): ?>
                                <?php foreach ($treasured_list as $__tm_idx => $__tm_item): ?>
                                    <?php $__tm = is_array($__tm_item) ? $__tm_item : (is_object($__tm_item) ? (array) $__tm_item : []); ?>
                                    <div class="p-3 border rounded treasured-item" data-index="<?= $__tm_idx ?>">
                                        <div class="gap-2 grid grid-cols-2">
                                            <div>
                                                <label class="text-sm">Image path</label>
                                                <input name="treasured_memories[][img]" type="text" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($__tm['img'] ?? '') ?>" />
                                            </div>
                                            <div>
                                                <label class="text-sm">Title</label>
                                                <input name="treasured_memories[][title]" type="text" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($__tm['title'] ?? '') ?>" />
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <label class="text-sm">Description</label>
                                            <input name="treasured_memories[][descriptions]" type="text" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($__tm['descriptions'] ?? '') ?>" />
                                        </div>
                                        <div class="mt-2 text-right">
                                            <button type="button" class="inline-flex items-center bg-white px-3 py-1 border rounded text-sm remove-treasured">Remove</button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <div class="mt-3">
                            <button type="button" class="inline-flex items-center bg-white px-3 py-2 border rounded add-treasured-btn">Add treasured memory</button>
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-900 text-sm">Family</label>
                        <?php
                        $fam_raw = is_array($ob) ? ($ob['family'] ?? '') : ($ob->family ?? '');
                        $family_list = [];
                        if ($fam_raw) {
                            if (is_array($fam_raw)) {
                                $family_list = $fam_raw;
                            } else {
                                $decodedF = json_decode($fam_raw, true);
                                if (json_last_error() === JSON_ERROR_NONE && is_array($decodedF)) {
                                    $family_list = $decodedF;
                                }
                            }
                        }
                        ?>

                        <div class="space-y-2 mt-2 family-list">
                            <?php if (!empty($family_list)): ?>
                                <?php foreach ($family_list as $__f_idx => $__f_item): ?>
                                    <?php $__f = is_array($__f_item) ? $__f_item : (is_object($__f_item) ? (array) $__f_item : []); ?>
                                    <div class="p-3 border rounded family-item" data-index="<?= $__f_idx ?>">
                                        <div class="gap-2 grid grid-cols-2">
                                            <div>
                                                <label class="text-sm">Relation</label>
                                                <input name="family[][relation]" type="text" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($__f['relation'] ?? '') ?>" />
                                            </div>
                                            <div>
                                                <label class="text-sm">Relative</label>
                                                <input name="family[][relative]" type="text" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($__f['relative'] ?? '') ?>" />
                                            </div>
                                        </div>
                                        <div class="mt-2 text-right">
                                            <button type="button" class="inline-flex items-center bg-white px-3 py-1 border rounded text-sm remove-family">Remove</button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <div class="mt-3">
                            <button type="button" class="inline-flex items-center bg-white px-3 py-2 border rounded add-family-btn">Add family</button>
                        </div>
                    </div>
                </div>

                <footer class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" class="px-4 py-2 border rounded cursor-pointer btn-cancel-update-ob">Cancel</button>
                    <button type="submit" class="bg-amber-600 px-4 py-2 rounded text-white cursor-pointer">Update</button>
                </footer>
            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        if (window.__updateObModalInit) return;
        window.__updateObModalInit = true;
        document.addEventListener('click', function(e) {
            const trigger = e.target.closest('.js-update-ob-trigger');
            if (!trigger) return;
            const container = trigger.closest('td') || trigger.closest('tr') || document;
            let modal = container && container.querySelector('.update-ob-modal');
            if (!modal) modal = document.querySelector('.update-ob-modal');
            if (!modal) return;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
            const btnCancel = modal.querySelector('.btn-cancel-update-ob');

            function close() {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }
            btnCancel && btnCancel.addEventListener('click', close);
        });
    })();
</script>

<script>
    (function() {
        // Treasured memories dynamic UI
        function createTreasuredHtml(item = {
            img: '',
            title: '',
            descriptions: ''
        }) {
            const wrapper = document.createElement('div');
            wrapper.className = 'treasured-item border p-3 rounded';
            wrapper.innerHTML = `
                <div class="gap-2 grid grid-cols-2">
                    <div>
                        <label class="text-sm">Image path</label>
                        <input name="treasured_memories[][img]" type="text" class="block mt-1 px-3 py-2 border rounded w-full" value="${item.img || ''}" />
                    </div>
                    <div>
                        <label class="text-sm">Title</label>
                        <input name="treasured_memories[][title]" type="text" class="block mt-1 px-3 py-2 border rounded w-full" value="${item.title || ''}" />
                    </div>
                </div>
                <div class="mt-2">
                    <label class="text-sm">Description</label>
                    <input name="treasured_memories[][descriptions]" type="text" class="block mt-1 px-3 py-2 border rounded w-full" value="${item.descriptions || ''}" />
                </div>
                <div class="mt-2 text-right">
                    <button type="button" class="inline-flex items-center bg-white px-3 py-1 border rounded text-sm remove-treasured">Remove</button>
                </div>
            `;
            return wrapper;
        }

        function initTreasuredForModal(modal) {
            if (!modal) return;
            // guard to avoid attaching handlers multiple times
            if (modal.__treasuredInit) return;
            modal.__treasuredInit = true;

            const list = modal.querySelector('.treasured-list');
            const addBtn = modal.querySelector('.add-treasured-btn');
            if (!list || !addBtn) return;

            // Single add handler — will append one item per click
            addBtn.addEventListener('click', function(event) {
                event.preventDefault();
                const node = createTreasuredHtml();
                list.appendChild(node);
                // attach remove handler for this new node
                const rem = node.querySelector('.remove-treasured');
                if (rem) rem.addEventListener('click', function() {
                    node.remove();
                });
            });

            // Use delegation for remove buttons inside the list
            list.addEventListener('click', function(e) {
                const btn = e.target.closest('.remove-treasured');
                if (!btn) return;
                const item = btn.closest('.treasured-item');
                if (item) item.remove();
            });
        }

        // Initialize when modal shows (we already show modals via click handler above)
        document.addEventListener('click', function(e) {
            const trigger = e.target.closest('.js-update-ob-trigger');
            if (!trigger) return;
            const container = trigger.closest('td') || trigger.closest('tr') || document;
            let modal = container && container.querySelector('.update-ob-modal');
            if (!modal) modal = document.querySelector('.update-ob-modal');
            if (!modal) return;
            // Lazy init for this modal instance
            initTreasuredForModal(modal);
            initFamilyForModal(modal);
        });
    })();
</script>

<script>
    (function() {
        function createFamilyHtml(item = {
            relation: '',
            relative: ''
        }) {
            const wrapper = document.createElement('div');
            wrapper.className = 'family-item p-3 border rounded';
            wrapper.innerHTML = `
                <div class="gap-2 grid grid-cols-2">
                    <div>
                        <label class="text-sm">Relation</label>
                        <input name="family[][relation]" type="text" class="block mt-1 px-3 py-2 border rounded w-full" value="${item.relation || ''}" />
                    </div>
                    <div>
                        <label class="text-sm">Relative</label>
                        <input name="family[][relative]" type="text" class="block mt-1 px-3 py-2 border rounded w-full" value="${item.relative || ''}" />
                    </div>
                </div>
                <div class="mt-2 text-right">
                    <button type="button" class="inline-flex items-center bg-white px-3 py-1 border rounded text-sm remove-family">Remove</button>
                </div>
            `;
            return wrapper;
        }

        function initFamilyForModal(modal) {
            if (!modal) return;
            if (modal.__familyInit) return;
            modal.__familyInit = true;

            const list = modal.querySelector('.family-list');
            const addBtn = modal.querySelector('.add-family-btn');
            if (!list || !addBtn) return;

            addBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const node = createFamilyHtml();
                list.appendChild(node);
                const rem = node.querySelector('.remove-family');
                if (rem) rem.addEventListener('click', function() {
                    node.remove();
                });
            });

            list.addEventListener('click', function(e) {
                const btn = e.target.closest('.remove-family');
                if (!btn) return;
                const item = btn.closest('.family-item');
                if (item) item.remove();
            });
        }
        // Expose for the outer initializer that runs when modal opens
        try {
            window.initFamilyForModal = initFamilyForModal;
        } catch (e) {
            /* ignore in strict contexts */
        }
    })();
</script>