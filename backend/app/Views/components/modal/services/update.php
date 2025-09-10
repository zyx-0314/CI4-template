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
        $svcBanner = $svc['banner'] ?? $svc['banner_url'] ?? $svc['bannerUrl'] ?? null;
        $svcIsActive = $svc['is_active'] ?? $svc['isActive'] ?? $svc['active'] ?? null;
        $svcIsAvailable = $svc['is_available'] ?? $svc['isAvailable'] ?? $svc['available'] ?? null;
    } elseif (is_object($svc)) {
        $svcId = $svc->id ?? null;
        $svcTitle = $svc->title ?? null;
        $svcCost = $svc->cost ?? null;
        $svcDescription = $svc->description ?? null;
        $svcInclusions = $svc->inclusions ?? null;
        $svcBanner = $svc->banner ?? $svc->banner_url ?? $svc->bannerUrl ?? null;
        $svcIsActive = $svc->is_active ?? $svc->isActive ?? $svc->active ?? null;
        $svcIsAvailable = $svc->is_available ?? $svc->isAvailable ?? $svc->available ?? null;
    }
}
?>

<div class="flex justify-end mb-4">
    <button id="btnTriggerUpdate" type="button" class="bg-yellow-600/70 hover:bg-yellow-600/60 px-3 py-2 rounded text-white duration-200 cursor-pointer btnUpdateService"
        <?= $svcId !== null ? 'data-id="' . esc($svcId) . '"' : '' ?>
        <?= $svcTitle !== null ? 'data-title="' . esc($svcTitle) . '"' : '' ?>
        <?= $svcCost !== null ? 'data-cost="' . esc($svcCost) . '"' : '' ?>
        <?= $svcDescription !== null ? 'data-description="' . esc($svcDescription) . '"' : '' ?>
        <?= $svcInclusions !== null ? 'data-inclusions="' . esc($svcInclusions) . '"' : '' ?>
        <?= $svcIsActive !== null ? 'data-is_active="' . esc($svcIsActive) . '"' : '' ?>
        <?= $svcIsAvailable !== null ? 'data-is_available="' . esc($svcIsAvailable) . '"' : '' ?>
        <?= $svcBanner !== null ? 'data-banner="' . esc($svcBanner) . '"' : '' ?>>
        <i class="fa-pen-to-square fa-solid"></i>
    </button>
</div>

<div id="updateServiceModal" class="hidden z-50 fixed inset-0 justify-center items-center m-0">
    <div class="absolute inset-0 bg-black opacity-50" id="updateServiceModalBackdrop"></div>

    <div class="relative bg-white shadow-lg mx-4 my-8 rounded w-full max-w-2xl max-h-[90vh] overflow-auto" role="dialog" aria-modal="true" aria-labelledby="updateServiceTitle">
        <header class="px-6 py-4 border-b">
            <h3 id="updateServiceTitle" class="font-semibold text-lg">Update service</h3>
        </header>

        <form id="updateServiceForm" class="space-y-4 px-6 py-4" method="POST" action="/admin/services/update" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="update_id" value="<?= esc($svcId ?? '') ?>" />

            <div>
                <label for="update_title" class="block font-medium text-gray-700 text-sm">Title</label>
                <input id="update_title" name="title" required class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($svcTitle ?? '') ?>" />
            </div>

            <div>
                <label for="update_cost" class="block font-medium text-gray-700 text-sm">Cost</label>
                <input id="update_cost" name="cost" type="number" step="0.01" min="0" required class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($svcCost ?? '') ?>" />
            </div>

            <div>
                <label for="update_description" class="block font-medium text-gray-700 text-sm">Description</label>
                <textarea id="update_description" name="description" rows="4" class="block mt-1 px-3 py-2 border rounded w-full"><?= esc($svcDescription ?? '') ?></textarea>
            </div>

            <div>
                <label for="update_inclusions" class="block font-medium text-gray-700 text-sm">Inclusions (CSV)</label>
                <input id="update_inclusions" name="inclusions" placeholder="item1,item2,item3" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($svcInclusions ?? '') ?>" />
            </div>

            <div>
                <label for="update_banner_image" class="block font-medium text-gray-700 text-sm">Banner image</label>
                <input id="update_banner_image" name="banner_image" type="file" accept="image/*" class="block mt-1 px-3 py-2 border rounded w-full cursor-pointer" />
                <img id="updateBannerPreview"
                    data-placeholder="https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1400&q=80"
                    class="mt-2 rounded w-full h-48 object-contain"
                    style="background:#f3f4f6;display:block;"
                    alt="banner preview"
                    src="<?= $svcBanner ? esc($svcBanner) : 'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1400&q=80' ?>"
                    onerror="this.onerror=null; if(this.dataset && this.dataset.placeholder) this.src=this.dataset.placeholder;" />
            </div>

            <div class="flex items-center space-x-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" id="update_is_available" name="is_available" value="1" class="cursor-pointer form-checkbox" <?= !empty($svcIsAvailable) ? 'checked' : '' ?> />
                    <span class="ml-2 text-sm cursor-pointer">Is available (shown but not browsable)</span>
                </label>
            </div>

            <footer class="flex justify-end space-x-2 pt-4 border-t">
                <button type="button" id="btnCancelUpdate" class="px-4 py-2 border rounded cursor-pointer">Cancel</button>
                <button type="submit" class="bg-yellow-600 px-4 py-2 rounded text-white cursor-pointer">Save changes</button>
            </footer>
        </form>
    </div>
</div>

<script>
    (function() {
        // Elements
        const demoBtn = document.getElementById('btnUpdateDemo');
        const modal = document.getElementById('updateServiceModal');
        const backdrop = document.getElementById('updateServiceModalBackdrop');
        const btnCancel = document.getElementById('btnCancelUpdate');
        const bannerInput = document.getElementById('update_banner_image');
        const bannerPreview = document.getElementById('updateBannerPreview');
        const form = document.getElementById('updateServiceForm');

        // Input fields
        const fldId = document.getElementById('update_id');
        const fldTitle = document.getElementById('update_title');
        const fldCost = document.getElementById('update_cost');
        const fldDescription = document.getElementById('update_description');
        const fldInclusions = document.getElementById('update_inclusions');
        const fldIsActive = document.getElementById('update_is_active');
        const fldIsAvailable = document.getElementById('update_is_available');

        let _currentBannerObjectUrl = null;
        const PLACEHOLDER = (bannerPreview && bannerPreview.dataset && bannerPreview.dataset.placeholder) ?
            bannerPreview.dataset.placeholder :
            'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1400&q=80';

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

            const bannerUrl = prefill.banner || prefill.bannerUrl || prefill.banner_url;
            if (bannerUrl) {
                if (_currentBannerObjectUrl) {
                    try {
                        URL.revokeObjectURL(_currentBannerObjectUrl);
                    } catch (e) {}
                    _currentBannerObjectUrl = null;
                }
                bannerPreview.src = bannerUrl;
            } else {
                bannerPreview.src = PLACEHOLDER;
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
            if (bannerPreview) bannerPreview.src = PLACEHOLDER;
        }

        function onTriggerClick(trigger) {
            const ds = trigger.dataset || {};
            const prefill = {};
            Object.keys(ds).forEach(k => prefill[k] = ds[k]);

            if (prefill.id) {}

            openModal(prefill);
        }

        document.addEventListener('click', function(e) {
            const trigger = e.target.closest('.btnUpdateService, [data-update-service]');
            if (!trigger) return;
            e.preventDefault();
            onTriggerClick(trigger);
        });

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
            });
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
        });
    })();
</script>