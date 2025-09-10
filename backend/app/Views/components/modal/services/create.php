<div class="flex justify-end mb-4">
    <button id="btnCreate" class="px-3 py-2 rounded text-white cursor-pointer btn-sage dark:btn-sage-dark">
        <i class="fa-solid fa-plus"></i>
        Create service
    </button>
</div>

<div id="createServiceModal" class="hidden z-50 fixed inset-0 justify-center items-center m-0">
    <div class="absolute inset-0 bg-black opacity-50" id="createServiceModalBackdrop"></div>

    <div class="relative bg-white shadow-lg mx-4 my-8 rounded w-full max-w-2xl max-h-[90vh] overflow-auto" role="dialog" aria-modal="true" aria-labelledby="createServiceTitle">
        <header class="px-6 py-4 border-b">
            <h3 id="createServiceTitle" class="font-semibold text-lg">Create service</h3>
        </header>

        <form id="createServiceForm" class="space-y-4 px-6 py-4" method="POST" action="/admin/services/create" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div>
                <label for="title" class="block font-medium text-gray-700 text-sm">Title</label>
                <input id="title" name="title" required class="block mt-1 px-3 py-2 border rounded w-full" />
            </div>

            <div>
                <label for="cost" class="block font-medium text-gray-700 text-sm">Cost</label>
                <input id="cost" name="cost" type="number" step="0.01" min="0" required class="block mt-1 px-3 py-2 border rounded w-full" />
            </div>

            <div>
                <label for="description" class="block font-medium text-gray-700 text-sm">Description</label>
                <textarea id="description" name="description" rows="4" class="block mt-1 px-3 py-2 border rounded w-full"></textarea>
            </div>

            <div>
                <label for="inclusions" class="block font-medium text-gray-700 text-sm">Inclusions (CSV)</label>
                <input id="inclusions" name="inclusions" placeholder="item1,item2,item3" class="block mt-1 px-3 py-2 border rounded w-full" />
            </div>

            <div>
                <label for="banner_image" class="block font-medium text-gray-700 text-sm">Banner image</label>
                <input id="banner_image" name="banner_image" type="file" accept="image/*" class="block mt-1 px-3 py-2 border rounded w-full" />
                <img id="bannerPreview"
                    data-placeholder="https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1400&q=80"
                    class="mt-2 rounded w-full h-48 object-contain"
                    style="background:#f3f4f6;display:block;"
                    alt="banner preview"
                    src="https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1400&q=80"
                    onerror="this.onerror=null; if(this.dataset && this.dataset.placeholder) this.src=this.dataset.placeholder;" />
            </div>

            <div class="flex items-center space-x-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" id="is_available" name="is_available" value="1" class="form-checkbox" />
                    <span class="ml-2 text-sm">Is available (shown but not browsable)</span>
                </label>
            </div>

            <footer class="flex justify-end space-x-2 pt-4 border-t">
                <button type="button" id="btnCancelCreate" class="px-4 py-2 border rounded cursor-pointer">Cancel</button>
                <button type="submit" class="bg-blue-600 px-4 py-2 rounded text-white cursor-pointer">Create</button>
            </footer>
        </form>
    </div>
</div>

<script>
    (function() {
        const btnCreate = document.getElementById('btnCreate');
        const modal = document.getElementById('createServiceModal');
        const backdrop = document.getElementById('createServiceModalBackdrop');
        const btnCancel = document.getElementById('btnCancelCreate');
        const bannerInput = document.getElementById('banner_image');
        const bannerPreview = document.getElementById('bannerPreview');

        let _currentBannerObjectUrl = null;
        const PLACEHOLDER = (bannerPreview && bannerPreview.dataset && bannerPreview.dataset.placeholder) ?
            bannerPreview.dataset.placeholder :
            'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1400&q=80';

        function openModal() {
            document.body.style.overflow = 'hidden';

            modal.classList.remove('hidden');
            modal.classList.add('flex');
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

            if (bannerPreview) bannerPreview.src = PLACEHOLDER;
            const form = document.getElementById('createServiceForm');
            if (form) form.reset();
        }

        if (btnCreate) btnCreate.addEventListener('click', openModal);
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
                    if (bannerPreview) bannerPreview.src = PLACEHOLDER;
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