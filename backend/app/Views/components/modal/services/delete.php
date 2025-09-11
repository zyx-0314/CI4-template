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
            <input type="hidden" name="id" id="deleteServiceId" value="<?= esc($svcId ?? '') ?>" />

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

        // AJAX submit handler: post to /admin/services/delete with FormData, show toast, reload on success
        const form = document.getElementById('deleteServiceForm');
        let _isSubmitting = false;

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

        async function submitDelete(e) {
            e.preventDefault();
            if (_isSubmitting) return;
            _isSubmitting = true;

            // disable close actions while deleting
            if (backdrop) backdrop.removeEventListener('click', closeModal);
            if (btnCancel) btnCancel.disabled = true;

            const statusToast = showToast('Deleting service...', 'info', 60000);

            const fd = new FormData(form);
            // ensure 'id' is present (forms may use service_id previously)
            const hiddenId = document.getElementById('deleteServiceId');
            if (hiddenId && hiddenId.value) fd.set('id', hiddenId.value);

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
                    showToast(data.message || 'Deleted', 'success', 3000);
                    setTimeout(() => {
                        location.reload();
                    }, 600);
                } else {
                    const msg = data && data.message ? data.message : 'Delete failed';
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
                if (backdrop) backdrop.addEventListener('click', closeModal);
                if (btnCancel) btnCancel.disabled = false;
            }
        }

        if (form) form.addEventListener('submit', submitDelete);
    })();
</script>