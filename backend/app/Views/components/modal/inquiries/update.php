<?php
// Component: components/modal/inquiries/update.php
// Data contract:
// $requestObj: object array
// $accountList: object array
?>

<div class="flex justify-end mb-4">
    <button type="button" <?= $requestObj['id'] ? 'data-update-request-id="' . esc($requestObj['id']) . '"' : '' ?> <?= $requestObj['first_name'] ? 'data-update-request-first-name="' . esc($requestObj['first_name']) . '"' : '' ?> <?= $requestObj['last_name'] ? 'data-update-request-last-name="' . esc($requestObj['last_name']) . '"' : '' ?> class="bg-amber-600/70 hover:bg-amber-600/60 px-3 py-2 rounded text-white duration-200 cursor-pointer js-update-request-trigger">
        <i class="fa-pen-to-square fa-solid"></i>
    </button>
</div>

<div class="hidden z-50 fixed inset-0 justify-center items-center m-0 update-request-modal">
    <div class="absolute inset-0 bg-black opacity-50 update-request-backdrop"></div>

    <div class="relative bg-white shadow-lg mx-4 my-8 rounded w-full max-w-2xl max-h-[90vh] overflow-auto" role="dialog" aria-modal="true" aria-labelledby="updateRequestTitle">
        <header class="px-6 py-4 border-b">
            <h3 id="updateRequestTitle" class="font-semibold text-lg">Update inquiry</h3>
        </header>

        <div class="space-y-4 px-6 py-4 update-request-content">
            <form class="update-request-form" method="POST" action="/admin/requests/update">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="update-request-id-<?php echo esc($requestObj['id']) ?>" value="<?= esc($requestObj['id'] ?? '') ?>" />

                <p class="text-gray-700 text-sm">Edit allowed fields below and click Update to save.</p>

                <div class="gap-4 grid grid-cols-1 mt-4 px-2">
                    <div>
                        <label class="block font-medium text-gray-900 text-sm">Status</label>
                        <?php
                        $__statuses = ['not open', 'un available', 'called', 'messaged', 'meeting scheduled', 'assigned', 'on going', 'complete'];
                        $currentStatus = $requestObj['status'] ?? '';
                        ?>
                        <select name="status" id="update-request-status-input-<?php echo esc($requestObj['id']) ?>" class="block mt-1 px-3 py-2 border rounded w-full">
                            <?php foreach ($__statuses as $__s): ?>
                                <option value="<?= esc($__s) ?>" <?= ($currentStatus === $__s) ? 'selected' : '' ?>><?= esc($__s) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-900 text-sm">Service (ID)</label>
                        <input name="service_id" type="text" id="update-request-service-id-input-<?php echo esc($requestObj['id']) ?>" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($requestObj['service_id'] ?? '') ?>" />
                    </div>

                    <div class="gap-4 grid grid-cols-2">
                        <div>
                            <label class="block font-medium text-gray-900 text-sm">First name</label>
                            <input name="first_name" type="text" id="update-request-first-name-input-<?php echo esc($requestObj['id']) ?>" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($requestObj['first_name'] ?? '') ?>" />
                        </div>
                        <div>
                            <label class="block font-medium text-gray-900 text-sm">Last name</label>
                            <input name="last_name" type="text" id="update-request-last-name-input-<?php echo esc($requestObj['id']) ?>" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($requestObj['last_name'] ?? '') ?>" />
                        </div>
                    </div>

                    <div class="gap-4 grid grid-cols-2">
                        <div>
                            <label class="block font-medium text-gray-900 text-sm">Start date</label>
                            <input name="date_start" type="date" id="update-request-date-start-input-<?php echo esc($requestObj['id']) ?>" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($requestObj['date_start'] ?? '') ?>" />
                        </div>
                        <div>
                            <label class="block font-medium text-gray-900 text-sm">End date</label>
                            <input name="date_end" type="date" id="update-request-date-end-input-<?php echo esc($requestObj['id']) ?>" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($requestObj['date_end'] ?? '') ?>" />
                        </div>
                    </div>

                    <div class="gap-4 grid grid-cols-2">
                        <div>
                            <label class="block font-medium text-gray-900 text-sm">Phone</label>
                            <input name="phone" type="text" id="update-request-phone-input-<?php echo esc($requestObj['id']) ?>" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($requestObj['phone'] ?? '') ?>" />
                        </div>
                        <div>
                            <label class="block font-medium text-gray-900 text-sm">Email</label>
                            <input name="email" type="email" id="update-request-email-input-<?php echo esc($requestObj['id']) ?>" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($requestObj['email'] ?? '') ?>" />
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-900 text-sm">Additional requests (CSV)</label>
                        <input name="additional_requests" type="text" id="update-request-additional-input-<?php echo esc($requestObj['id']) ?>" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($requestObj['additional'] ?? '') ?>" />
                    </div>

                    <div>
                        <label class="block font-medium text-gray-900 text-sm">User ID</label>
                        <?php $currentUserId = $requestObj['user_id'] ?? ''; ?>
                        <select name="user_id" id="update-request-user-id-input-<?php echo esc($requestObj['id']) ?>" class="block mt-1 px-3 py-2 border rounded w-full">
                            <option value="">-- Select user --</option>
                            <?php if (!empty($accountList) && is_array($accountList)): ?>
                                <?php foreach ($accountList as $acc): ?>
                                    <?php $label = trim($acc->first_name . ', ' . $acc->last_name); ?>
                                    <option value="<?= esc($acc->id) ?>" <?= ($currentUserId == $acc->id) ? 'selected' : '' ?>><?= esc($label) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <br>

                </div>

                <footer class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" class="px-4 py-2 border rounded cursor-pointer btn-cancel-update-request">Cancel</button>
                    <button type="submit" class="bg-amber-600 px-4 py-2 rounded text-white cursor-pointer">Update</button>
                </footer>
            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        if (window.__updateRequestModalInit) return;
        window.__updateRequestModalInit = true;

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

        document.addEventListener('click', function(e) {
            const trigger = e.target.closest('[data-update-request-id], .js-update-request-trigger');
            if (!trigger) return;
            e.preventDefault();

            const id = trigger.getAttribute('data-update-request-id');
            const firstName = trigger.getAttribute('data-update-request-first-name');
            const lastName = trigger.getAttribute('data-update-request-last-name');
            const serviceId = trigger.getAttribute('data-update-request-service-id');
            const status = trigger.getAttribute('data-update-request-status');
            const start = trigger.getAttribute('data-update-request-date-start');
            const end = trigger.getAttribute('data-update-request-date-end');
            const phone = trigger.getAttribute('data-update-request-phone');
            const email = trigger.getAttribute('data-update-request-email');
            const additional = trigger.getAttribute('data-update-request-additional');
            const userId = trigger.getAttribute('data-update-request-user-id');

            const container = trigger.closest('td') || trigger.closest('tr') || trigger.closest('.request-row') || document;
            let modal = container && container.querySelector('.update-request-modal');
            if (!modal) modal = document.querySelector('.update-request-modal');
            if (!modal) return;

            const form = modal.querySelector('.update-request-form');
            const inputId = form ? form.querySelector('input[name="id"]') : null;
            const statusInput = form ? form.querySelector('select[name="status"]') : null;
            const serviceInput = form ? form.querySelector('input[name="service_id"]') : null;
            const firstNameInput = form ? form.querySelector('input[name="first_name"]') : null;
            const lastNameInput = form ? form.querySelector('input[name="last_name"]') : null;
            const startInput = form ? form.querySelector('input[name="date_start"]') : null;
            const endInput = form ? form.querySelector('input[name="date_end"]') : null;
            const phoneInput = form ? form.querySelector('input[name="phone"]') : null;
            const emailInput = form ? form.querySelector('input[name="email"]') : null;
            const additionalInput = form ? form.querySelector('input[name="additional_requests"]') : null;
            const userIdInput = form ? form.querySelector('select[name="user_id"]') : null;

            const backdrop = modal.querySelector('.update-request-backdrop');
            const btnCancel = modal.querySelector('.btn-cancel-update-request');

            const currentValues = {
                id: (inputId && inputId.value) || '',
                status: (statusInput && statusInput.value) || '',
                service_id: (serviceInput && serviceInput.value) || '',
                first_name: (firstNameInput && firstNameInput.value) || '',
                last_name: (lastNameInput && lastNameInput.value) || '',
                date_start: (startInput && startInput.value) || '',
                date_end: (endInput && endInput.value) || '',
                phone: (phoneInput && phoneInput.value) || '',
                email: (emailInput && emailInput.value) || '',
                additional_requests: (additionalInput && additionalInput.value) || '',
                user_id: (userIdInput && userIdInput.value) || '',
            };

            modal.__update_originals = Object.assign({}, currentValues);

            document.body.style.overflow = 'hidden';
            if (inputId) inputId.value = id || currentValues.id;
            if (statusInput) statusInput.value = (status !== null ? status : currentValues.status);
            if (serviceInput) serviceInput.value = (serviceId !== null ? serviceId : currentValues.service_id);
            if (firstNameInput) firstNameInput.value = (firstName !== null ? firstName : currentValues.first_name);
            if (lastNameInput) lastNameInput.value = (lastName !== null ? lastName : currentValues.last_name);
            if (startInput) startInput.value = (start !== null ? start : currentValues.date_start);
            if (endInput) endInput.value = (end !== null ? end : currentValues.date_end);
            if (phoneInput) phoneInput.value = (phone !== null ? phone : currentValues.phone);
            if (emailInput) emailInput.value = (email !== null ? email : currentValues.email);
            if (additionalInput) additionalInput.value = (additional !== null ? additional : currentValues.additional_requests);
            if (userIdInput) userIdInput.value = (userId !== null ? userId : currentValues.user_id);

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            if (btnCancel) btnCancel.focus();

            function restoreAndClose() {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
                document.body.style.overflow = '';
                try {
                    const o = modal.__update_originals || {};
                    if (inputId) inputId.value = o.id || '';
                    if (statusInput) statusInput.value = o.status || '';
                    if (serviceInput) serviceInput.value = o.service_id || '';
                    if (firstNameInput) firstNameInput.value = o.first_name || '';
                    if (lastNameInput) lastNameInput.value = o.last_name || '';
                    if (startInput) startInput.value = o.date_start || '';
                    if (endInput) endInput.value = o.date_end || '';
                    if (phoneInput) phoneInput.value = o.phone || '';
                    if (emailInput) emailInput.value = o.email || '';
                    if (additionalInput) additionalInput.value = o.additional_requests || '';
                    if (userIdInput) userIdInput.value = o.user_id || '';
                } catch (e) {
                    /* ignore */
                }

                if (backdrop) backdrop.removeEventListener('click', onBackdrop);
                if (btnCancel) btnCancel.removeEventListener('click', onCancel);
                if (form) form.removeEventListener('submit', onSubmit);
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

                const statusToast = showToast('Updating inquiry...', 'info', 60000);
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