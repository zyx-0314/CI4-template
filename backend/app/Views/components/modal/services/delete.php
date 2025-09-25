<?php
// Component: components/modal/services/delete.php
// Data contract:
// $service: object array
?>
<div class="flex justify-end mb-4">
    <button type="button" <?= $service->id !== null ? 'data-delete-service-id="' . esc($service->id) . '"' : '' ?> <?= $service->title !== null ? 'data-delete-service-title="' . esc($service->title) . '"' : '' ?> class="bg-red-600/70 hover:bg-red-600/60 px-3 py-2 rounded text-white duration-200 cursor-pointer js-delete-service-trigger">
        <i class="fa-solid fa-trash"></i>
    </button>
</div>

<!-- Modal instance (one per row) - use class selectors so JS finds modal relative to trigger -->
<div class="hidden z-50 fixed inset-0 justify-center items-center m-0 delete-service-modal">
    <div class="absolute inset-0 bg-black opacity-50 delete-service-backdrop"></div>

    <div class="relative bg-white shadow-lg mx-4 my-8 rounded w-full max-w-lg max-h-[90vh] overflow-auto" role="dialog" aria-modal="true" aria-labelledby="deleteServiceTitle">
        <header class="px-6 py-4 border-b">
            <h3 id="deleteServiceTitle" class="font-semibold text-lg">Delete service</h3>
        </header>

        <form class="space-y-4 px-6 py-4 delete-service-form" method="POST" action="/admin/services/delete">
            <?= csrf_field() ?>
            <input type="hidden" name="id" class="delete-service-id" value="<?= esc($service->id ?? '') ?>" />

            <p class="text-gray-700 text-sm">You are about to delete the following service. This action cannot be undone.</p>

            <div class="mt-4 px-2">
                <div class="font-medium text-gray-900 text-sm">Service</div>
                <div class="mt-1 text-gray-700 text-base delete-service-name"><?= $service->title ? esc($service->title) : '\u2014' ?></div>
            </div>

            <footer class="flex justify-end space-x-2 pt-4 border-t">
                <button type="button" class="px-4 py-2 border rounded cursor-pointer btn-cancel-delete">Cancel</button>
                <button type="submit" class="bg-red-600 px-4 py-2 rounded text-white cursor-pointer">Delete</button>
            </footer>
        </form>
    </div>
</div>

<script>
    (function() {
        if (window.__deleteServiceModalInit) return; // already installed
        window.__deleteServiceModalInit = true;

        // Delegated handler: opens the modal instance associated with the clicked trigger.
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

        document.addEventListener('click', async function(e) {
            // Trigger: match by data attribute or class
            const trigger = e.target.closest('[data-delete-service-id], .js-delete-service-trigger');
            if (!trigger) return;
            e.preventDefault();
            const id = trigger.getAttribute('data-delete-service-id');
            const title = trigger.getAttribute('data-delete-service-title') || trigger.textContent || '';

            // find modal within same table cell/row
            const container = trigger.closest('td') || trigger.closest('tr') || document;
            const modal = container.querySelector('.delete-service-modal');
            if (!modal) return;

            const inputId = modal.querySelector('.delete-service-id');
            const nameEl = modal.querySelector('.delete-service-name');
            const backdrop = modal.querySelector('.delete-service-backdrop');
            const btnCancel = modal.querySelector('.btn-cancel-delete');
            const form = modal.querySelector('.delete-service-form');

            // open
            document.body.style.overflow = 'hidden';
            if (inputId) inputId.value = id || '';
            if (nameEl) nameEl.textContent = title.trim() || '\u2014';
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // focus cancel
            if (btnCancel) btnCancel.focus();

            // attach handlers for backdrop/cancel and form submit for this modal only
            function closeModal() {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
                document.body.style.overflow = '';
                if (inputId) inputId.value = '';
                if (nameEl) nameEl.textContent = '\u2014';
                // remove listeners
                if (backdrop) backdrop.removeEventListener('click', onBackdrop);
                if (btnCancel) btnCancel.removeEventListener('click', onCancel);
                if (form) form.removeEventListener('submit', onSubmit);
            }

            function onBackdrop() {
                closeModal();
            }

            function onCancel() {
                closeModal();
            }

            let _isSubmitting = false;
            async function onSubmit(ev) {
                ev.preventDefault();
                if (_isSubmitting) return;
                _isSubmitting = true;
                if (backdrop) backdrop.removeEventListener('click', onBackdrop);
                if (btnCancel) btnCancel.disabled = true;
                const statusToast = showToast('Deleting service...', 'info', 60000);
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
                        showToast(data.message || 'Deleted', 'success', 3000);
                        setTimeout(() => location.reload(), 600);
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