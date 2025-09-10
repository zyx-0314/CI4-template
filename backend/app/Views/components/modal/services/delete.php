<?php
// Accept either array or object service passed from parent view
$svc = $service ?? null;
$svcId = null;
$svcTitle = null;
if ($svc !== null) {
    if (is_array($svc)) {
        $svcId = $svc['id'] ?? null;
        $svcTitle = $svc['title'] ?? null;
    } elseif (is_object($svc)) {
        $svcId = $svc->id ?? null;
        $svcTitle = $svc->title ?? null;
    }
}
?>

<div class="flex justify-end mb-4">
    <button id="btnTriggerDelete" type="button" <?= $svcId !== null ? 'data-delete-service-id="' . esc($svcId) . '"' : '' ?> <?= $svcTitle !== null ? 'data-delete-service-title="' . esc($svcTitle) . '"' : '' ?> class="bg-red-600/70 hover:bg-red-600/60 px-3 py-2 rounded text-white duration-200 cursor-pointer">
        <i class="fa-solid fa-trash"></i>
    </button>
</div>
<div id="deleteServiceModal" class="hidden z-50 fixed inset-0 justify-center items-center m-0">
    <div class="absolute inset-0 bg-black opacity-50" id="deleteServiceModalBackdrop"></div>

    <div class="relative bg-white shadow-lg mx-4 my-8 rounded w-full max-w-lg max-h-[90vh] overflow-auto" role="dialog" aria-modal="true" aria-labelledby="deleteServiceTitle">
        <header class="px-6 py-4 border-b">
            <h3 id="deleteServiceTitle" class="font-semibold text-lg">Delete service</h3>
        </header>

        <form id="deleteServiceForm" class="space-y-4 px-6 py-4" method="POST" action="/admin/services/delete">
            <?= csrf_field() ?>
            <input type="hidden" name="service_id" id="deleteServiceId" value="<?= esc($svcId ?? '') ?>" />

            <p class="text-gray-700 text-sm">You are about to delete the following service. This action cannot be undone.</p>

            <div class="mt-4 px-2">
                <div class="font-medium text-gray-900 text-sm">Service</div>
                <div id="deleteServiceName" class="mt-1 text-gray-700 text-base"><?= $svcTitle ? esc($svcTitle) : '—' ?></div>
            </div>

            <footer class="flex justify-end space-x-2 pt-4 border-t">
                <button type="button" id="btnCancelDelete" class="px-4 py-2 border rounded cursor-pointer">Cancel</button>
                <button type="submit" class="bg-red-600 px-4 py-2 rounded text-white cursor-pointer">Delete</button>
            </footer>
        </form>
    </div>
</div>

<script>
    (function() {
        const modal = document.getElementById('deleteServiceModal');
        const backdrop = document.getElementById('deleteServiceModalBackdrop');
        const btnCancel = document.getElementById('btnCancelDelete');
        const inputId = document.getElementById('deleteServiceId');
        const serviceNameEl = document.getElementById('deleteServiceName');

        function openModal(id, title) {
            if (!modal) return;
            // Prevent background scrolling
            document.body.style.overflow = 'hidden';

            inputId.value = id || '';
            serviceNameEl.textContent = title || '—';

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            const cancel = modal.querySelector('#btnCancelDelete');
            if (cancel) cancel.focus();
        }

        function closeModal() {
            if (!modal) return;
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.body.style.overflow = '';

            if (inputId) inputId.value = '';
            if (serviceNameEl) serviceNameEl.textContent = '—';
        }

        document.addEventListener('click', function(e) {
            const trigger = e.target.closest('[data-delete-service-id]');
            if (!trigger) return;
            e.preventDefault();
            const id = trigger.getAttribute('data-delete-service-id');
            const title = trigger.getAttribute('data-delete-service-title') || trigger.textContent || '';
            openModal(id, title.trim());
        });

        if (backdrop) backdrop.addEventListener('click', closeModal);
        if (btnCancel) btnCancel.addEventListener('click', closeModal);

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) closeModal();
        });
    })();
</script>