<?php
// Component: components/modal/accounts/create.php
// Data contract:
// $errors: array|null
// $old: array|null
// $fieldErrors: array|null
?>
<?php
$errors = $errors ?? [];
$old = $old ?? [];
$fieldErrors = $fieldErrors ?? [];
?>

<div class="flex justify-end mb-4">
    <button id="btnCreateAccount" class="px-3 py-2 rounded text-white cursor-pointer btn-sage dark:btn-sage-dark">
        <i class="fa-solid fa-plus"></i>
        Create account
    </button>
</div>

<div id="createAccountModal" class="hidden z-50 fixed inset-0 justify-center items-center m-0" aria-hidden="true">
    <div class="absolute inset-0 bg-black opacity-50" id="createAccountModalBackdrop"></div>

    <div class="relative bg-white shadow-lg mx-4 my-8 rounded w-full max-w-2xl max-h-[90vh] overflow-auto" role="dialog" aria-modal="true" aria-labelledby="createAccountTitle">
        <header class="px-6 py-4 border-b">
            <h3 id="createAccountTitle" class="font-semibold text-lg">Create account</h3>
        </header>

        <form id="createAccountForm" class="space-y-4 px-6 py-4" method="POST" action="/admin/accounts/create" enctype="multipart/form-data" aria-labelledby="createAccountTitle">
            <?= csrf_field() ?>

            <div class="gap-4 grid grid-cols-1 md:grid-cols-3">
                <div>
                    <label for="first_name" class="block font-medium text-gray-700 text-sm">First name</label>
                    <input id="first_name" name="first_name" required class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($old['first_name'] ?? '') ?>" />
                    <div class="mt-2 text-red-500 text-sm" id="firstNameError"><?= esc($fieldErrors['first_name'] ?? '') ?></div>

                </div>

                <div>
                    <label for="middle_name" class="block font-medium text-gray-700 text-sm">Middle name</label>
                    <input id="middle_name" name="middle_name" class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($old['middle_name'] ?? '') ?>" />
                </div>

                <div>
                    <label for="last_name" class="block font-medium text-gray-700 text-sm">Last name</label>
                    <input id="last_name" name="last_name" required class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($old['last_name'] ?? '') ?>" />
                    <div class="mt-2 text-red-500 text-sm" id="lastNameError"><?= esc($fieldErrors['last_name'] ?? '') ?></div>
                </div>

                <div class="col-span-3">
                    <label for="email" class="block font-medium text-gray-700 text-sm">Email</label>
                    <input id="email" name="email" type="email" required class="block mt-1 px-3 py-2 border rounded w-full" value="<?= esc($old['email'] ?? '') ?>" />
                    <div class="mt-2 text-red-500 text-sm" id="emailError"><?= esc($fieldErrors['email'] ?? '') ?></div>
                </div>

                <div class="flex gap-4 col-span-3">
                    <div class="w-1/2">
                        <label for="password" class="block font-medium text-gray-700 text-sm">Password</label>
                        <input id="password" name="password" type="password" required minlength="8" class="block mt-1 px-3 py-2 border rounded w-full" />
                        <div class="mt-2 text-red-500 text-sm" id="passwordError"><?= esc($fieldErrors['password'] ?? '') ?></div>
                    </div>

                    <div class="w-1/2">
                        <label for="password_confirm" class="block font-medium text-gray-700 text-sm">Confirm password</label>
                        <input id="password_confirm" name="password_confirm" type="password" required minlength="8" class="block mt-1 px-3 py-2 border rounded w-full" />
                        <div class="mt-2 text-red-500 text-sm" id="passwordConfirmError"></div>
                    </div>
                </div>

                <div class="flex col-span-3">
                    <ul id="passwordRequirements" class="space-y-1 grid grid-cols-1 md:grid-cols-2 text-sm">
                        <li id="req-upper" class="text-gray-500">• At least 1 uppercase letter</li>
                        <li id="req-lower" class="text-gray-500">• At least 1 lowercase letter</li>
                        <li id="req-number" class="text-gray-500">• At least 1 number</li>
                        <li id="req-special" class="text-gray-500">• At least 1 special character (e.g. !@#$%)</li>
                        <li id="req-minlen" class="text-gray-500">• Minimum 8 characters</li>
                    </ul>
                </div>

                <div>
                    <label for="type" class="block font-medium text-gray-700 text-sm">Type</label>
                    <select id="type" name="type" class="block mt-1 px-3 py-2 border rounded w-full">
                        <option value="client" <?= isset($old['type']) && $old['type'] === 'client' ? 'selected' : '' ?>>Client</option>
                        <option value="embalmer" <?= isset($old['type']) && $old['type'] === 'embalmer' ? 'selected' : '' ?>>Embalmer</option>
                        <option value="driver" <?= isset($old['type']) && $old['type'] === 'driver' ? 'selected' : '' ?>>Driver</option>
                        <option value="florist" <?= isset($old['type']) && $old['type'] === 'florist' ? 'selected' : '' ?>>Florist</option>
                        <option value="manager" <?= isset($old['type']) && $old['type'] === 'manager' ? 'selected' : '' ?>>Manager</option>
                        <option value="staff" <?= isset($old['type']) && $old['type'] === 'staff' ? 'selected' : '' ?>>Staff</option>
                    </select>
                </div>

                <div>
                    <label for="gender" class="block font-medium text-gray-700 text-sm">Gender</label>
                    <select id="gender" name="gender" class="block mt-1 px-3 py-2 border rounded w-full">
                        <option value="">Prefer not to say</option>
                        <option value="male" <?= isset($old['gender']) && $old['gender'] === 'male' ? 'selected' : '' ?>>Male</option>
                        <option value="female" <?= isset($old['gender']) && $old['gender'] === 'female' ? 'selected' : '' ?>>Female</option>
                        <option value="other" <?= isset($old['gender']) && $old['gender'] === 'other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>

                <div class="col-span-3">
                    <label for="profile_image" class="block font-medium text-gray-700 text-sm">Profile image</label>
                    <input id="profile_image" name="profile_image" type="file" accept="image/*" class="block mt-1 px-3 py-2 border rounded w-full" />
                    <img id="profilePreview"
                        data-placeholder="https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1400&q=80"
                        class="mt-2 rounded w-full h-64 object-contain"
                        style="background:#f3f4f6;display:block;"
                        alt="profile preview"
                        src="https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1400&q=80"
                        onerror="this.onerror=null; if(this.dataset && this.dataset.placeholder) this.src=this.dataset.placeholder;" />
                </div>

                <input type="hidden" id="newsletter" name="newsletter" value="1" class="form-checkbox" />
            </div>

            <footer class="flex justify-end space-x-2 pt-4 border-t">
                <button type="button" id="btnCancelCreateAccount" class="px-4 py-2 border rounded cursor-pointer">Cancel</button>
                <button type="submit" id="btnSubmitCreateAccount" class="bg-blue-600 px-4 py-2 rounded text-white cursor-pointer" disabled>Create</button>
            </footer>
        </form>
    </div>
</div>
<script src="<?= base_url('js/toast.js') ?>"></script>
<script>
    (function() {
        const btnCreate = document.getElementById('btnCreateAccount');
        const modal = document.getElementById('createAccountModal');
        const backdrop = document.getElementById('createAccountModalBackdrop');
        const btnCancel = document.getElementById('btnCancelCreateAccount');
        const profileInput = document.getElementById('profile_image');
        const profilePreview = document.getElementById('profilePreview');
        const emailError = document.getElementById('emailError');
        const firstNameError = document.getElementById('firstNameError');
        const lastNameError = document.getElementById('lastNameError');
        const passwordError = document.getElementById('passwordError');
        const passwordInput = document.getElementById('password');
        const passwordConfirmInput = document.getElementById('password_confirm');
        const passwordConfirmError = document.getElementById('passwordConfirmError');
        const reqUpper = document.getElementById('req-upper');
        const reqLower = document.getElementById('req-lower');
        const reqNumber = document.getElementById('req-number');
        const reqSpecial = document.getElementById('req-special');
        const reqMinlen = document.getElementById('req-minlen');

        let _lastFocusedBeforeOpen = null;
        let _currentProfileObjectUrl = null;
        const PLACEHOLDER = (profilePreview && profilePreview.dataset && profilePreview.dataset.placeholder) ?
            profilePreview.dataset.placeholder :
            '';

        function openModal() {
            _lastFocusedBeforeOpen = document.activeElement;
            document.body.style.overflow = 'hidden';
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modal.setAttribute('aria-hidden', 'false');
            const first = modal.querySelector('input,textarea,select,button');
            if (first) first.focus();
        }

        let _canClose = true;

        function closeModal() {
            if (!_canClose) return;
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            if (_currentProfileObjectUrl) {
                try {
                    URL.revokeObjectURL(_currentProfileObjectUrl);
                } catch (e) {}
                _currentProfileObjectUrl = null;
            }
            if (profilePreview) profilePreview.src = PLACEHOLDER || profilePreview.dataset.placeholder || profilePreview.src;
            const form = document.getElementById('createAccountForm');
            if (form) form.reset();
            try {
                if (_lastFocusedBeforeOpen && typeof _lastFocusedBeforeOpen.focus === 'function') {
                    _lastFocusedBeforeOpen.focus();
                } else if (btnCreate) {
                    btnCreate.focus();
                }
            } catch (e) {}
        }

        if (btnCreate) btnCreate.addEventListener('click', openModal);
        if (backdrop) backdrop.addEventListener('click', closeModal);
        if (btnCancel) btnCancel.addEventListener('click', closeModal);

        if (profileInput && profilePreview) {
            profileInput.addEventListener('change', function(e) {
                const file = (e.target.files || [])[0];
                if (!file) {
                    if (_currentProfileObjectUrl) {
                        try {
                            URL.revokeObjectURL(_currentProfileObjectUrl);
                        } catch (e) {}
                        _currentProfileObjectUrl = null;
                    }
                    if (profilePreview) profilePreview.src = PLACEHOLDER || profilePreview.dataset.placeholder || profilePreview.src;
                    return;
                }
                if (_currentProfileObjectUrl) {
                    try {
                        URL.revokeObjectURL(_currentProfileObjectUrl);
                    } catch (e) {}
                }
                const url = URL.createObjectURL(file);
                _currentProfileObjectUrl = url;
                profilePreview.src = url;
            });
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
        });

        const form = document.getElementById('createAccountForm');
        const submitBtn = document.getElementById('btnSubmitCreateAccount');

        // Password match validation: real-time and on-submit guard
        function checkPasswords() {
            if (!passwordInput || !passwordConfirmInput) return true;
            const a = passwordInput.value || '';
            const b = passwordConfirmInput.value || '';

            // evaluate requirements
            const hasUpper = /[A-Z]/.test(a);
            const hasLower = /[a-z]/.test(a);
            const hasNumber = /[0-9]/.test(a);
            const hasSpecial = /[^A-Za-z0-9]/.test(a);
            const hasMinLen = a.length >= 8;

            // helper to toggle classes
            function mark(el, ok) {
                if (!el) return;
                el.classList.toggle('text-green-600', ok);
                el.classList.toggle('text-gray-500', !ok);
            }

            mark(reqUpper, hasUpper);
            mark(reqLower, hasLower);
            mark(reqNumber, hasNumber);
            mark(reqSpecial, hasSpecial);
            mark(reqMinlen, hasMinLen);

            const reqsOk = hasUpper && hasLower && hasNumber && hasSpecial && hasMinLen;

            if (!a && !b) {
                passwordConfirmError.textContent = '';
                return true;
            }

            if (a !== b) {
                passwordConfirmError.textContent = 'Passwords do not match';
                if (submitBtn) submitBtn.disabled = true;
                return false;
            }

            // both match: ensure requirements passed
            if (!reqsOk) {
                passwordConfirmError.textContent = 'Password does not meet requirements';
                if (submitBtn) submitBtn.disabled = true;
                return false;
            }

            passwordConfirmError.textContent = '';
            if (submitBtn) submitBtn.disabled = false;
            return true;
        }

        if (passwordInput && passwordConfirmInput) {
            passwordInput.addEventListener('input', checkPasswords);
            passwordConfirmInput.addEventListener('input', checkPasswords);
        }

        // run check once to set initial state
        try {
            checkPasswords();
        } catch (e) {}

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Ensure passwords match before submitting
                if (typeof checkPasswords === 'function') {
                    const ok = checkPasswords();
                    if (!ok) {
                        toast('Please fix password errors before submitting', 'error');
                        return;
                    }
                }

                const fd = new FormData(form);
                _canClose = false;
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Creating...';
                }
                toast('Creating account 62; please wait', 'info');

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json'
                    },
                    body: fd,
                }).then(async (res) => {
                    const data = await res.json().catch(() => null);
                    if (res.ok && data && data.success) {
                        toast(data.message || 'Created', 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    } else {
                        const msg = (data && data.message) ? data.message : 'Failed to create account';
                        console.log(data);
                        if (data && data.errors) {
                            if (data.errors.email) emailError.textContent = data.errors.email;
                            if (data.errors.first_name) firstNameError.textContent = data.errors.first_name;
                            if (data.errors.last_name) lastNameError.textContent = data.errors.last_name;
                            if (data.errors.password) passwordError.textContent = data.errors.password;
                        }
                        toast(msg, 'error');
                        _canClose = true;
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.textContent = 'Create';
                        }
                    }
                }).catch((err) => {
                    console.error('Create account request failed', err);
                    toast('Network error while creating account', 'error');
                    _canClose = true;
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Create';
                    }
                });
            });
        }
    })();
</script>