<?php
// Component: components/modal/services/update.php
// Data contract:
// $service: object array

?>

<div class="flex justify-end mb-4">
    <button type="button" <?= isset($service->id) ? 'data-update-service-id="' . esc($service->id) . '"' : '' ?> <?= isset($service->title) ? 'data-update-service-title="' . esc($service->title) . '"' : '' ?> class="bg-amber-600/70 hover:bg-amber-600/60 px-3 py-2 rounded text-white duration-200 cursor-pointer js-update-service-trigger">
        <i class="fa-pen-to-square fa-solid"></i>
    </button>
</div>

<div class="hidden z-50 fixed inset-0 justify-center items-center m-0 update-service-modal">
    <div class="absolute inset-0 bg-black opacity-50 update-service-backdrop"></div>

    <div class="relative bg-white shadow-lg mx-4 my-8 rounded w-full max-w-2xl max-h-[90vh] overflow-auto" role="dialog" aria-modal="true" aria-labelledby="updateServiceTitle">
        <header class="px-6 py-4 border-b">
            <h3 id="updateServiceTitle" class="font-semibold text-lg">Update service</h3>
        </header>

        <div class="space-y-4 px-6 py-4 update-service-content">
            <form class="update-service-form" method="POST" action="/admin/services/update" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="update-service-id-<?php echo $service->id ?>" value="<?= esc($service->id ?? '') ?>" />

                <p class="text-gray-700 text-sm">Edit the service details below and click Update to save.</p>

                <div class="gap-4 grid grid-cols-1 mt-4 px-2">
                    <div>
                        <label class="block font-medium text-gray-900 text-sm">Title</label>
                        <input name="title" type="text" required id="update-service-title-input-<?php echo $service->id ?>" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($service->title ?? '') ?>" />
                    </div>

                    <div>
                        <label class="block font-medium text-gray-900 text-sm">Description</label>
                        <textarea name="description" rows="5" id="update-service-description-input-<?php echo $service->id ?>" class="block mt-1 px-3 py-2 border rounded w-full"><?= esc($service->description) ?></textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-900 text-sm">Cost</label>
                        <input name="cost" type="number" min="1" step="0.01" required id="update-service-cost-input-<?php echo $service->id ?>" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($service->cost ?? '') ?>" />
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="flex-1">
                            <label class="block font-medium text-gray-900 text-sm">Inclusions (CSV)</label>
                            <input name="inclusions" type="text" id="update-service-inclusions-input-<?php echo $service->id ?>" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($service->inclusions ?? '') ?>" />
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-900 text-sm">Banner image</label>
                        <input name="banner_image" type="file" accept="image/*" id="update-service-banner-input-<?php echo $service->id ?>" class="block mt-1 px-3 py-2 border rounded w-full" />
                        <img id="update-service-banner-preview-<?php echo $service->id ?>" class="mt-2 rounded w-full h-48 object-contain"
                            data-placeholder="https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1400&q=80"
                            style="background:#f3f4f6;display:block;"
                            alt="banner preview"
                            src="<?= ! empty($service->banner_image) ? esc(base_url($service->banner_image)) : 'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1400&q=80' ?>"
                            onerror="this.onerror=null; if(this.dataset && this.dataset.placeholder) this.src=this.dataset.placeholder;" />
                    </div>
                    <div class="pb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_available" value="1" id="update-service-is-available-input-<?php echo $service->id ?>" class="mr-2" <?= isset($service->is_available) && $service->is_available ? 'checked' : '' ?> />
                            <span class="text-sm">Is available</span>
                        </label>
                    </div>
                </div>

                <footer class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" class="px-4 py-2 border rounded cursor-pointer btn-cancel-update-service">Cancel</button>
                    <button type="submit" class="bg-amber-600 px-4 py-2 rounded text-white cursor-pointer">Update</button>
                </footer>
            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        // guard so we only initialize the delegated handler once
        if (window.__updateServiceModalInit) return;
        window.__updateServiceModalInit = true;

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

        // Delegated click handler: open the modal that is closest to the clicked trigger
        document.addEventListener('click', function(e) {
            const trigger = e.target.closest('[data-update-service-id], .js-update-service-trigger');
            if (!trigger) return;
            e.preventDefault();

            // read values that are baked into the trigger element
            const id = trigger.getAttribute('data-update-service-id');
            const title = trigger.getAttribute('data-update-service-title');
            const description = trigger.getAttribute('data-update-service-description');
            const cost = trigger.getAttribute('data-update-service-cost');
            const isAvailable = trigger.getAttribute('data-update-service-is-available');
            const inclusions = trigger.getAttribute('data-update-service-inclusions');
            const banner = trigger.getAttribute('data-update-service-banner');

            // find the modal that belongs to the same row/container as the trigger
            const container = trigger.closest('td') || trigger.closest('tr') || trigger.closest('.service-row') || document;
            let modal = container && container.querySelector('.update-service-modal');
            // fallback: global first modal
            if (!modal) modal = document.querySelector('.update-service-modal');
            if (!modal) return;

            // find inputs inside the modal (modal-scoped queries) instead of relying on PHP-generated ids
            const form = modal.querySelector('.update-service-form');
            const inputId = form ? form.querySelector('input[name="id"]') : null;
            const titleInput = form ? form.querySelector('input[name="title"]') : null;
            const descInput = form ? form.querySelector('textarea[name="description"]') : null;
            const costInput = form ? form.querySelector('input[name="cost"]') : null;
            const availInput = form ? form.querySelector('input[name="is_available"]') : null;
            const inclusionsInput = form ? form.querySelector('input[name="inclusions"]') : null;
            const bannerInput = form ? form.querySelector('input[name="banner_image"]') : null;
            const bannerPreview = modal.querySelector('img[alt="banner preview"]');
            const backdrop = modal.querySelector('.update-service-backdrop');
            const btnCancel = modal.querySelector('.btn-cancel-update-service');

            // read current values from modal (pre-rendered by PHP) so we can restore them when needed
            const currentValues = {
                id: (inputId && inputId.value) || '',
                title: (titleInput && titleInput.value) || '',
                description: (descInput && descInput.value) || '',
                cost: (costInput && costInput.value) || '',
                is_available: (availInput && !!availInput.checked) || false,
                inclusions: (inclusionsInput && inclusionsInput.value) || '',
                banner: (bannerPreview && (bannerPreview.src || (bannerPreview.dataset && bannerPreview.dataset.placeholder))) || ''
            };

            // store original values on the modal so we can restore them on close
            modal.__update_originals = Object.assign({}, currentValues);

            // populate modal fields from trigger dataset, but fall back to the modal's pre-rendered values
            document.body.style.overflow = 'hidden';
            if (inputId) inputId.value = id || currentValues.id;
            if (titleInput) titleInput.value = (title !== null ? title : currentValues.title);
            if (descInput) descInput.value = (description !== null ? description : currentValues.description);
            if (costInput) costInput.value = (cost !== null ? cost : currentValues.cost);
            if (availInput) {
                if (isAvailable !== null) {
                    availInput.checked = (isAvailable === '1' || isAvailable === 'true' || isAvailable === 'on' || isAvailable === 'yes');
                } else {
                    availInput.checked = !!currentValues.is_available;
                }
            }
            if (inclusionsInput) inclusionsInput.value = (inclusions !== null ? inclusions : currentValues.inclusions);

            // banner preview setup (prefer banner URL from trigger, fallback to existing src or placeholder)
            const PLACEHOLDER = (bannerPreview && bannerPreview.dataset && bannerPreview.dataset.placeholder) ? bannerPreview.dataset.placeholder : 'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1400&q=80';
            if (bannerPreview) {
                if (banner) {
                    bannerPreview.src = banner;
                    bannerPreview.style.display = '';
                } else if (bannerPreview.src) {
                    bannerPreview.style.display = '';
                } else {
                    bannerPreview.src = PLACEHOLDER;
                    bannerPreview.style.display = '';
                }
            }

            // file -> preview handling (attach once per input)
            if (bannerInput && bannerPreview && !bannerInput.__updateListenerAdded) {
                let _currentBannerObjectUrl = null;
                const onBannerChange = function(e) {
                    const file = (e.target.files || [])[0];
                    if (!file) {
                        if (_currentBannerObjectUrl) {
                            try {
                                URL.revokeObjectURL(_currentBannerObjectUrl);
                            } catch (e) {}
                            _currentBannerObjectUrl = null;
                        }
                        bannerPreview.src = PLACEHOLDER;
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
                    bannerPreview.style.display = '';
                };
                bannerInput.addEventListener('change', onBannerChange);
                bannerInput.__updateListenerAdded = true;
                // keep a reference so we can revoke when modal closes
                modal.__update_bannerRevoke = function() {
                    try {
                        if (_currentBannerObjectUrl) {
                            URL.revokeObjectURL(_currentBannerObjectUrl);
                            _currentBannerObjectUrl = null;
                        }
                    } catch (e) {}
                };
            }

            // show modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            if (btnCancel) btnCancel.focus();

            function restoreAndClose() {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
                document.body.style.overflow = '';

                // restore original values
                try {
                    const o = modal.__update_originals || {};
                    if (inputId) inputId.value = o.id || '';
                    if (titleInput) titleInput.value = o.title || '';
                    if (descInput) descInput.value = o.description || '';
                    if (costInput) costInput.value = o.cost || '';
                    if (availInput) availInput.checked = !!o.is_available;
                    if (inclusionsInput) inclusionsInput.value = o.inclusions || '';
                    if (bannerInput) bannerInput.value = '';
                    if (bannerPreview) bannerPreview.src = o.banner || PLACEHOLDER;
                } catch (e) {
                    /* ignore */ }

                if (backdrop) backdrop.removeEventListener('click', onBackdrop);
                if (btnCancel) btnCancel.removeEventListener('click', onCancel);
                if (form) form.removeEventListener('submit', onSubmit);
                if (modal.__update_bannerRevoke) {
                    try {
                        modal.__update_bannerRevoke();
                    } catch (e) {}
                    delete modal.__update_bannerRevoke;
                }
            }

            function onBackdrop() {
                restoreAndClose();
            }

            function onCancel() {
                restoreAndClose();
            }

            let _isSubmitting = false;
            async function onSubmit(ev) {
                ev.preventDefault();
                if (_isSubmitting) return;
                _isSubmitting = true;

                if (backdrop) backdrop.removeEventListener('click', onBackdrop);
                if (btnCancel) btnCancel.disabled = true;

                const statusToast = showToast('Updating service...', 'info', 60000);
                const fd = new FormData(form);
                if (inputId && inputId.value) fd.set('id', inputId.value);

                try {
                    const resp = await fetch(form.action, {
                        method: 'POST',
                        body: fd
                    });
                    let data = null;
                    try {
                        data = await resp.json();
                    } catch (err) {
                        data = null;
                    }

                    if (resp.ok && data && data.success) {
                        showToast(data.message || 'Updated', 'success', 3000);
                        setTimeout(() => location.reload(), 600);
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
                    if (backdrop) backdrop.addEventListener('click', onBackdrop);
                    if (btnCancel) btnCancel.disabled = false;
                }
            }

            if (backdrop) backdrop.addEventListener('click', onBackdrop);
            if (btnCancel) btnCancel.addEventListener('click', onCancel);
            if (form) form.addEventListener('submit', onSubmit);
        });
    })();
</script>