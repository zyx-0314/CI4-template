<?php
// Component: components/modal/accounts/update.php
// Data contract:
// $account: object array
?>

<div class="flex justify-end mb-4">
    <button type="button" <?= isset($account->id) ? 'data-update-account-id="' . esc($account->id) . '"' : '' ?> <?= isset($account->type) ? 'data-update-account-type="' . esc($account->type) . '"' : '' ?> class="bg-amber-600/70 hover:bg-amber-600/60 px-3 py-2 rounded text-white duration-200 cursor-pointer js-update-account-trigger">
        <i class="fa-pen-to-square fa-solid"></i>
    </button>
</div>

<div class="hidden z-50 fixed inset-0 justify-center items-center m-0 update-account-modal">
    <div class="absolute inset-0 bg-black opacity-50 update-account-backdrop"></div>

    <div class="relative bg-white shadow-lg mx-4 my-8 rounded w-full max-w-lg max-h-[90vh] overflow-auto" role="dialog" aria-modal="true" aria-labelledby="updateAccountTitle">
        <header class="px-6 py-4 border-b">
            <h3 id="updateAccountTitle" class="font-semibold text-lg">Update account</h3>
        </header>

        <div class="space-y-4 px-6 py-4 update-account-content">
            <form class="update-account-form" method="POST" action="/admin/accounts/update">
                <?= csrf_field() ?>
                <input type="hidden" name="id" class="update-account-id" value="<?= esc($account->id ?? '') ?>" />

                <p class="text-gray-700 text-sm">Choose the account type and click Update to save.</p>

                <div class="mt-4 px-2">
                    <label class="block font-medium text-gray-900 text-sm">Type</label>
                    <select name="type" class="block mt-1 px-3 py-2 border rounded w-full update-account-type-input">
                        <option value="client" <?= isset($account->type) && $account->type === 'client' ? 'selected' : '' ?>>Client</option>
                        <option value="embalmer" <?= isset($account->type) && $account->type === 'embalmer' ? 'selected' : '' ?>>Embalmer</option>
                        <option value="driver" <?= isset($account->type) && $account->type === 'driver' ? 'selected' : '' ?>>Driver</option>
                        <option value="florist" <?= isset($account->type) && $account->type === 'florist' ? 'selected' : '' ?>>Florist</option>
                        <option value="manager" <?= isset($account->type) && $account->type === 'manager' ? 'selected' : '' ?>>Manager</option>
                        <option value="staff" <?= isset($account->type) && $account->type === 'staff' ? 'selected' : '' ?>>Staff</option>
                    </select>
                </div>

                <br>

                <footer class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" class="px-4 py-2 border rounded cursor-pointer btn-cancel-update-account">Cancel</button>
                    <button type="submit" class="bg-amber-600 px-4 py-2 rounded text-white cursor-pointer">Update</button>
                </footer>
            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        if (window.__updateAccountModalInit) return;
        window.__updateAccountModalInit = true;

        document.addEventListener('click', function(e) {
            const trigger = e.target.closest('[data-update-account-id], .js-update-account-trigger');
            if (!trigger) return;
            e.preventDefault();

            const id = trigger.getAttribute('data-update-account-id');
            const type = trigger.getAttribute('data-update-account-type') || '';

            const container = trigger.closest('td') || trigger.closest('tr') || document;
            const modal = container.querySelector('.update-account-modal');
            if (!modal) return;

            const inputId = modal.querySelector('.update-account-id');
            const typeInput = modal.querySelector('.update-account-type-input');
            const backdrop = modal.querySelector('.update-account-backdrop');
            const btnClose = modal.querySelector('.btn-cancel-update-account');
            const form = modal.querySelector('.update-account-form');

            document.body.style.overflow = 'hidden';
            if (inputId) inputId.value = id || '';
            if (typeInput) typeInput.value = type || '';
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            if (btnClose) btnClose.focus();

            function closeModal() {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
                document.body.style.overflow = '';
                if (inputId) inputId.value = '';
                if (typeInput) typeInput.value = '';
                if (backdrop) backdrop.removeEventListener('click', onBackdrop);
                if (btnClose) btnClose.removeEventListener('click', onCancel);
                if (form) form.removeEventListener('submit', onSubmit);
            }

            function onBackdrop() {
                closeModal();
            }

            function onCancel() {
                closeModal();
            }

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

            async function onSubmit(ev) {
                ev.preventDefault();
                if (_isSubmitting) return;
                _isSubmitting = true;

                if (backdrop) backdrop.removeEventListener('click', onBackdrop);
                if (btnClose) btnClose.disabled = true;

                const statusToast = showToast('Updating account...', 'info', 60000);
                const fd = new FormData(form);
                if (inputId && inputId.value) fd.set('id', inputId.value);

                try {
                    const resp = await fetch(form.action, {
                        method: 'POST',
                        body: fd,
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
                    if (btnClose) btnClose.disabled = false;
                }
            }

            if (backdrop) backdrop.addEventListener('click', onBackdrop);
            if (btnClose) btnClose.addEventListener('click', onCancel);
            if (form) form.addEventListener('submit', onSubmit);
        });
    })();
</script>