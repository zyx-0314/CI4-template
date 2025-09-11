<?php
// Accept either array or object service passed from parent view
$svc = $service ?? null;
$svcId = $svcTitle = $svcCost = $svcDescription = $svcInclusions = $svcBanner = null;
$svcIsActive = $svcIsAvailable = null;
if ($svc !== null) {
    if (is_array($svc)) {
        $svcId = $svc['id'] ?? null;
        $svcTitle = $svc['title'] ?? null;
        $svcCost = $svc['cost'] ?? null;
        $svcDescription = $svc['description'] ?? null;
        $svcInclusions = $svc['inclusions'] ?? null;
        $svcBanner = $svc['banner_image']  ?? null;
        $svcIsActive = $svc['is_active'] ?? null;
        $svcIsAvailable = $svc['is_available'] ?? null;
    }
}

?>

<div class="flex justify-end mb-4">
    <button id="btnTriggerUpdate<?php echo $svcId ?>" type="button" class="bg-yellow-600/70 hover:bg-yellow-600/60 px-3 py-2 rounded text-white duration-200 cursor-pointer btnUpdateService"
        <?= $svcId !== null ? 'data-id="' . esc($svcId) . '"' : '' ?>
        <?= $svcTitle !== null ? 'data-title="' . esc($svcTitle) . '"' : '' ?>
        <?= $svcCost !== null ? 'data-cost="' . esc($svcCost) . '"' : '' ?>
        <?= $svcDescription !== null ? 'data-description="' . esc($svcDescription) . '"' : '' ?>
        <?= $svcInclusions !== null ? 'data-inclusions="' . esc($svcInclusions) . '"' : '' ?>
        <?= $svcIsActive !== null ? 'data-is_active="' . esc($svcIsActive) . '"' : '' ?>
        <?= $svcIsAvailable !== null ? 'data-is_available="' . esc($svcIsAvailable) . '"' : '' ?>
        <?= $svcBanner ? 'data-banner="' . esc($svcBanner) . '" data-initial="' . esc($svcBanner) . '"' : '' ?>>
        <i class="fa-pen-to-square fa-solid"></i>
    </button>
</div>

<div id="updateServiceModal<?php echo $svcId ?>" class="hidden z-50 fixed inset-0 justify-center items-center m-0">
    <div class="absolute inset-0 bg-black opacity-50" id="updateServiceModalBackdrop<?php echo $svcId ?>"></div>

    <div class="relative bg-white shadow-lg mx-4 my-8 rounded w-full max-w-2xl max-h-[90vh] overflow-auto" role="dialog" aria-modal="true" aria-labelledby="updateServiceTitle">
        <header class="px-6 py-4 border-b">
            <h3 id="updateServiceTitle<?php echo $svcId ?>" class="font-semibold text-lg">Update service</h3>
        </header>

        <form id="updateServiceForm<?php echo $svcId ?>" class="space-y-4 px-6 py-4" method="POST" action="/admin/services/update" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="update_id<?php echo $svcId ?>" value="<?= esc($svcId ?? '') ?>" />

            <div>
                <label for="update_title" class="block font-medium text-gray-700 text-sm">Title</label>
                <input id="update_title<?php echo $svcId ?>" name="title" required class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($svcTitle ?? '') ?>" />
            </div>

            <div>
                <label for="update_cost" class="block font-medium text-gray-700 text-sm">Cost</label>
                <input id="update_cost<?php echo $svcId ?>" name="cost" type="number" step="0.01" min="0" required class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($svcCost ?? '') ?>" />
            </div>

            <div>
                <label for="update_description" class="block font-medium text-gray-700 text-sm">Description</label>
                <textarea id="update_description<?php echo $svcId ?>" name="description" rows="4" class="block mt-1 px-3 py-2 border rounded w-full"><?= esc($svcDescription ?? '') ?></textarea>
            </div>

            <div>
                <label for="update_inclusions" class="block font-medium text-gray-700 text-sm">Inclusions (CSV)</label>
                <input id="update_inclusions<?php echo $svcId ?>" name="inclusions" placeholder="item1,item2,item3" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($svcInclusions ?? '') ?>" />
            </div>

            <div>
                <label for="update_banner_image<?php echo $svcId ?>" class="block font-medium text-gray-700 text-sm">Banner image</label>
                <input id="update_banner_image<?php echo $svcId ?>" name="banner_image" type="file" accept="image/*" class="block mt-1 px-3 py-2 border rounded w-full cursor-pointer" />
                <img id="updateBannerPreview<?php echo $svcId ?>"
                    class="mt-2 rounded w-full h-48 object-contain"
                    style="background:#f3f4f6;display:block;"
                    alt="banner preview"
                    src="<?= esc($svcBanner ? "/" . $svcBanner : 'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1400&q=80') ?>" />
            </div>

            <div class="flex items-center space-x-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" id="update_is_available<?php echo $svcId ?>" name="is_available" value="1" class="cursor-pointer form-checkbox" <?= !empty($svcIsAvailable) ? 'checked' : '' ?> />
                    <span class="ml-2 text-sm cursor-pointer">Is available (shown but not browsable)</span>
                </label>
            </div>

            <footer class="flex justify-end space-x-2 pt-4 border-t">
                <button type="button" id="btnCancelUpdate<?php echo $svcId ?>" class="px-4 py-2 border rounded cursor-pointer">Cancel</button>
                <button type="submit" class="bg-yellow-600 px-4 py-2 rounded text-white cursor-pointer">Save changes</button>
            </footer>
        </form>
    </div>
</div>

<script>
    (function() {
        // Elements
        const demoBtn = document.getElementById('btnUpdateDemo<?php echo $svcId ?>');
        const modal = document.getElementById('updateServiceModal<?php echo $svcId ?>');
        const backdrop = document.getElementById('updateServiceModalBackdrop<?php echo $svcId ?>');
        const btnCancel = document.getElementById('btnCancelUpdate<?php echo $svcId ?>');
        const bannerInput = document.getElementById('update_banner_image<?php echo $svcId ?>');
        const bannerPreview = document.getElementById('updateBannerPreview<?php echo $svcId ?>');
        const form = document.getElementById('updateServiceForm<?php echo $svcId ?>');
        const existingImage = bannerPreview ? bannerPreview.src : '';

        // Input fields
        const fldId = document.getElementById('update_id<?php echo $svcId ?>');
        const fldTitle = document.getElementById('update_title<?php echo $svcId ?>');
        const fldCost = document.getElementById('update_cost<?php echo $svcId ?>');
        const fldDescription = document.getElementById('update_description<?php echo $svcId ?>');
        const fldInclusions = document.getElementById('update_inclusions<?php echo $svcId ?>');
        const fldIsActive = document.getElementById('update_is_active<?php echo $svcId ?>');
        const fldIsAvailable = document.getElementById('update_is_available<?php echo $svcId ?>');

        let _currentBannerObjectUrl = null;
        let initialBannerUrl = null;
        let _isSubmitting = false;

        // Simple toast helper (append to body)
        function showToast(message, type = 'info', timeout = 3000) {
            const id = 'toast_' + Date.now();
            const el = document.createElement('div');
            el.id = id;
            el.className = 'fixed right-4 top-4 z-50 px-4 py-2 rounded shadow-lg text-white';
            el.style.background = type === 'error' ? '#ef4444' : (type === 'success' ? '#10b981' : '#111827');
            el.textContent = message;
            document.body.appendChild(el);
            setTimeout(() => {
                try {
                    el.remove();
                } catch (e) {}
            }, timeout);
            return id;
        }

        // Submit the update form via AJAX and show feedback
        async function submitUpdateForm(e) {
            e.preventDefault();
            if (_isSubmitting) return;
            _isSubmitting = true;

            // prevent closing while in flight
            if (backdrop) backdrop.removeEventListener('click', closeModal);
            if (btnCancel) btnCancel.disabled = true;

            const statusToast = showToast('Updating service...', 'info', 60000);

            const fd = new FormData(form);
            try {
                const resp = await fetch('/admin/services/update', {
                    method: 'POST',
                    body: fd
                });
                let data = null;
                try {
                    data = await resp.json();
                } catch (e) {
                    data = null;
                }
                if (resp.ok && data && data.success) {
                    showToast(data.message || 'Updated', 'success', 3000);
                    // refresh page to show updated data
                    setTimeout(() => {
                        location.reload();
                    }, 600);
                } else {
                    const msg = data && data.message ? data.message : 'Update failed';
                    showToast(msg, 'error', 5000);
                }
            } catch (err) {
                showToast('Network or server error', 'error', 5000);
            } finally {
                _isSubmitting = false;
                try {
                    const t = document.getElementById(statusToast);
                    if (t) t.remove();
                } catch (e) {}
                // restore close handlers
                if (backdrop) backdrop.addEventListener('click', closeModal);
                if (btnCancel) btnCancel.disabled = false;
            }
        }

        // initialize initialBannerUrl from rendered image (if any)
        initialBannerUrl = existingImage || '';

        function openModal(prefill = {}) {
            document.body.style.overflow = 'hidden';
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            if (prefill.id) fldId.value = prefill.id;
            if (typeof prefill.title !== 'undefined') fldTitle.value = prefill.title;
            if (typeof prefill.cost !== 'undefined') fldCost.value = prefill.cost;
            if (typeof prefill.description !== 'undefined') fldDescription.value = prefill.description;
            if (typeof prefill.inclusions !== 'undefined') fldInclusions.value = prefill.inclusions;

            const truthy = v => (v === '1' || v === 'true' || v === 'yes' || v === 'on');
            fldIsActive.checked = truthy(prefill.isActive || prefill.is_active || prefill.active);
            fldIsAvailable.checked = truthy(prefill.isAvailable || prefill.is_available || prefill.available);

            // banner values may be provided as absolute data attributes on the trigger
            const svcBanner = prefill.banner || prefill.svcBanner || prefill.banner_url || prefill.banner || prefill.svcBanner;
            // prefer any explicit 'initial' data (absolute URL) coming from the trigger
            if (prefill.initial) {
                initialsvcBanner = prefill.initial;
            } else if (prefill.banner || prefill.svcBanner || prefill.banner_url) {
                initialBannerUrl = prefill.banner || prefill.bannerUrl || prefill.banner_url;
            }

            if (initialBannerUrl) {
                if (_currentBannerObjectUrl) {
                    try {
                        URL.revokeObjectURL(_currentBannerObjectUrl);
                    } catch (e) {}
                    _currentBannerObjectUrl = null;
                }
                bannerPreview.src = initialBannerUrl;
            } else {
                // no DB banner: clear src so no fallback image is shown
                bannerPreview.src = '';
            }

            const first = modal.querySelector('input,textarea,select,button');
            if (first) first.focus();
        }

        function closeModal() {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.body.style.overflow = '';

            if (_currentBannerObjectUrl) {
                try {
                    URL.revokeObjectURL(_currentBannerObjectUrl);
                } catch (e) {}
                _currentBannerObjectUrl = null;
            }

            if (form) form.reset();
            if (bannerPreview) bannerPreview.src = existingImage;
        }

        function onTriggerClick(trigger) {
            const ds = trigger.dataset || {};
            const prefill = {};
            Object.keys(ds).forEach(k => prefill[k] = ds[k]);

            if (prefill.id) {}

            openModal(prefill);
        }

        // Prefer binding directly to the specific trigger button for this service to avoid
        // multiple modal instances reacting to a single click (which opened all modals).
        const localTrigger = document.getElementById('btnTriggerUpdate<?= esc($svcId) ?>');
        if (localTrigger) {
            localTrigger.addEventListener('click', function(e) {
                e.preventDefault();
                onTriggerClick(this);
            });
        } else {
            // Fallback: guarded document listener that only reacts when the clicked trigger's
            // data-id matches this service id (prevents other modal instances from opening).
            const THIS_SVC_ID = '<?= esc($svcId) ?>';
            document.addEventListener('click', function(e) {
                const trigger = e.target.closest('.btnUpdateService, [data-update-service]');
                if (!trigger) return;
                const trigId = trigger.dataset && trigger.dataset.id ? String(trigger.dataset.id) : '';
                if (THIS_SVC_ID && trigId !== String(THIS_SVC_ID)) return;
                e.preventDefault();
                onTriggerClick(trigger);
            });
        }

        if (demoBtn) demoBtn.addEventListener('click', function() {
            onTriggerClick({
                dataset: {
                    id: '123',
                    title: 'Funeral Service Package',
                    cost: '2500.00',
                    description: 'Full-service funeral package',
                    inclusions: 'casket,flowers,transport',
                    is_active: '1',
                    is_available: '0',
                    banner: 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=1400&q=80'
                }
            });
        });

        if (backdrop) backdrop.addEventListener('click', closeModal);
        if (btnCancel) btnCancel.addEventListener('click', closeModal);
        if (form) form.addEventListener('submit', submitUpdateForm);

        if (bannerInput && bannerPreview) {
            bannerInput.addEventListener('change', function(e) {
                const file = (e.target.files || [])[0];
                if (!file) {
                    if (_currentBannerObjectUrl) {
                        try {
                            URL.revokeObjectURL(_currentBannerObjectUrl);
                        } catch (e) {}
                        _currentBannerObjectUrl = null;
                    }
                    // restore DB-provided banner (if any); otherwise clear preview
                    bannerPreview.src = initialBannerUrl || '';
                    return;
                }

                if (_currentBannerObjectUrl) {
                    try {
                        URL.revokeObjectURL(_currentBannerObjectUrl);
                    } catch (e) {}
                }

                const url = URL.createObjectURL(file);
                _currentBannerObjectUrl = url;
                bannerPreview.src = url;
            });
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
        });
    })();
</script>