<?php

/**
 * Profile settings (frontend-only demo)
 * Expects $user (array), $errors (array|string), $success (string|null)
 */
?>

<!doctype html>
<html lang="en">
<?= view('components/head', ['title' => 'Profile Settings — Sunset Funeral Homes']) ?>

<body class="bg-gray-50 min-h-screen font-sans text-slate-900">
    <?= view('components/header'); ?>

    <main class="mx-auto p-6 max-w-3xl">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="font-semibold text-lg">Profile Settings</h2>
                <p class="text-gray-500 text-sm">Update your profile information.</p>
            </div>

            <div class="p-6">
                <?php if (! empty($success)): ?>
                    <div class="bg-emerald-50 mb-4 p-3 border border-emerald-100 rounded-md text-emerald-800">
                        <?php echo esc($success); ?>
                    </div>
                <?php endif; ?>

                <?php if (! empty($errors)): ?>
                    <?php if (is_array($errors)): ?>
                        <div class="bg-red-50 mb-4 p-3 border border-red-100 rounded-md text-red-700">
                            <ul class="pl-5 list-disc">
                                <?php foreach ($errors as $err): ?>
                                    <li><?php echo esc($err); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div class="bg-red-50 mb-4 p-3 border border-red-100 rounded-md text-red-700"><?php echo esc($errors); ?></div>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="gap-6 grid grid-cols-1 md:grid-cols-3">
                    <div class="flex flex-col items-center md:col-span-1">
                        <div class="flex justify-center items-center bg-gray-100 rounded-full w-32 h-32 text-gray-400 text-3xl">
                            <?php echo esc(substr(trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')), 0, 1) ?: 'U'); ?>
                        </div>
                        <p class="mt-3 text-gray-600 text-sm text-center"><?php echo esc(($user['email'] ?? '')); ?></p>
                        <p class="mt-2 text-gray-400 text-xs">Avatar placeholder</p>
                    </div>

                    <div class="md:col-span-2">
                        <form method="post" action="/settings/profile" class="space-y-4">
                            <?php echo csrf_field(); ?>

                            <div>
                                <label for="first_name" class="block font-medium text-gray-700 text-sm">First name</label>
                                <input id="first_name" name="first_name" required
                                    class="block shadow-sm mt-1 border-gray-300 focus:border-emerald-500 rounded-md focus:ring-emerald-500 w-full"
                                    value="<?php echo esc($user['first_name'] ?? ''); ?>" />
                                <?php if (! empty($errors['first_name'])): ?>
                                    <p class="mt-1 text-red-600 text-xs"><?php echo esc($errors['first_name']); ?></p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label for="middle_name" class="block font-medium text-gray-700 text-sm">Middle name</label>
                                <input id="middle_name" name="middle_name"
                                    class="block shadow-sm mt-1 border-gray-300 focus:border-emerald-500 rounded-md focus:ring-emerald-500 w-full"
                                    value="<?php echo esc($user['middle_name'] ?? ''); ?>" />
                                <?php if (! empty($errors['middle_name'])): ?>
                                    <p class="mt-1 text-red-600 text-xs"><?php echo esc($errors['middle_name']); ?></p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label for="last_name" class="block font-medium text-gray-700 text-sm">Last name</label>
                                <input id="last_name" name="last_name" required
                                    class="block shadow-sm mt-1 border-gray-300 focus:border-emerald-500 rounded-md focus:ring-emerald-500 w-full"
                                    value="<?php echo esc($user['last_name'] ?? ''); ?>" />
                                <?php if (! empty($errors['last_name'])): ?>
                                    <p class="mt-1 text-red-600 text-xs"><?php echo esc($errors['last_name']); ?></p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label for="email" class="block font-medium text-gray-700 text-sm">Email</label>
                                <input id="email" name="email" type="email" required
                                    class="block shadow-sm mt-1 border-gray-300 focus:border-emerald-500 rounded-md focus:ring-emerald-500 w-full"
                                    value="<?php echo esc($user['email'] ?? ''); ?>" />
                                <?php if (! empty($errors['email'])): ?>
                                    <p class="mt-1 text-red-600 text-xs"><?php echo esc($errors['email']); ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label for="activation_code" class="block font-medium text-gray-700 text-sm">Email activation code (demo)</label>
                                <input id="activation_code" name="activation_code" type="text" maxlength="6" pattern="(?=.*[A-Z])(?=.*\d)[A-Z0-9]+" placeholder="E.g. A1B2C3"
                                    class="block shadow-sm mt-1 border-gray-300 focus:border-emerald-500 rounded-md focus:ring-emerald-500 w-full"
                                    value="" />
                                <p class="mt-1 text-gray-400 text-xs">Code must include at least one capital letter and one number. (UI only)</p>
                            </div>

                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-3">
                                    <input id="newsletter" name="newsletter" type="checkbox" class="border-gray-300 rounded w-4 h-4 text-emerald-600" <?php echo (!empty($user['newsletter']) ? 'checked' : ''); ?> />
                                    <label for="newsletter" class="text-gray-700 text-sm">Subscribe to newsletter</label>
                                </div>

                                <div>
                                    <label class="text-gray-700 text-sm">Gender</label>
                                    <div class="flex items-center space-x-3 mt-1">
                                        <label class="inline-flex items-center"><input type="radio" name="gender" value="male" <?php echo (($user['gender'] ?? '') === 'male') ? 'checked' : ''; ?> class="form-radio" /> <span class="ml-2">Male</span></label>
                                        <label class="inline-flex items-center"><input type="radio" name="gender" value="female" <?php echo (($user['gender'] ?? '') === 'female') ? 'checked' : ''; ?> class="form-radio" /> <span class="ml-2">Female</span></label>
                                        <label class="inline-flex items-center"><input type="radio" name="gender" value="other" <?php echo (($user['gender'] ?? '') === 'other') ? 'checked' : ''; ?> class="form-radio" /> <span class="ml-2">Other</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3 pt-2">
                                <button class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 px-4 py-2 rounded-md text-white">Save changes</button>
                                <a href="/" class="text-gray-600 text-sm hover:underline">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?= view('components/footer') ?>
    <script>
        // Demo-only UI behavior
        document.addEventListener('DOMContentLoaded', function() {
            // Prevent actual submission (UI demo only)
            const form = document.querySelector('form[action="/settings/profile"]');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    alert('Profile UI is demo-only. No changes will be persisted.');
                });
            }

            // Image upload: open file chooser when clicking avatar
            const avatar = document.querySelector('.w-32.h-32');
            if (avatar) {
                const fileInput = document.createElement('input');
                fileInput.type = 'file';
                fileInput.accept = 'image/*';
                fileInput.style.display = 'none';
                document.body.appendChild(fileInput);

                avatar.style.cursor = 'pointer';
                avatar.addEventListener('click', function() {
                    fileInput.click();
                });

                fileInput.addEventListener('change', function() {
                    const file = fileInput.files && fileInput.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        avatar.innerText = '';
                        avatar.style.backgroundImage = `url(${ev.target.result})`;
                        avatar.style.backgroundSize = 'cover';
                        avatar.style.backgroundPosition = 'center';
                    };
                    reader.readAsDataURL(file);
                });
            }

            // Password modal
            let modal = null;

            function createPasswordModal() {
                modal = document.createElement('div');
                modal.innerHTML = `
                <div class="z-50 fixed inset-0 flex justify-center items-center bg-black bg-opacity-40">
                    <div class="bg-white shadow-lg p-6 rounded-lg w-11/12 max-w-md">
                        <h3 class="mb-2 font-semibold text-lg">Change password (demo)</h3>
                        <p class="mb-4 text-gray-500 text-sm">This is a UI-only modal. No request will be sent.</p>
                        <form id="pwdForm" class="space-y-3">
                            <div>
                                <label class="block text-gray-700 text-sm">Confirm current password</label>
                                <input type="password" name="current_password" class="block mt-1 border-gray-300 rounded-md w-full" required />
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm">New password</label>
                                <input type="password" name="new_password" class="block mt-1 border-gray-300 rounded-md w-full" required />
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm">Confirm new password</label>
                                <input type="password" name="confirm_new_password" class="block mt-1 border-gray-300 rounded-md w-full" required />
                            </div>
                            <div class="flex justify-end space-x-2 pt-2">
                                <button type="button" id="pwdCancel" class="bg-gray-100 px-3 py-2 rounded text-sm">Cancel</button>
                                <button type="submit" class="bg-emerald-600 px-3 py-2 rounded text-white text-sm">Change</button>
                            </div>
                        </form>
                    </div>
                </div>`;
                document.body.appendChild(modal);

                // handlers
                modal.querySelector('#pwdCancel').addEventListener('click', function() {
                    closeModal();
                });
                modal.querySelector('#pwdForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    alert('Password change is demo-only. No changes saved.');
                    closeModal();
                });
            }

            function closeModal() {
                if (modal) {
                    document.body.removeChild(modal);
                    modal = null;
                }
            }

            // Create trigger button near password area
            const pwdTrigger = document.createElement('button');
            pwdTrigger.type = 'button';
            pwdTrigger.className = 'mt-2 inline-flex items-center px-3 py-2 bg-gray-100 rounded text-sm';
            pwdTrigger.innerText = 'Change password';
            pwdTrigger.addEventListener('click', function() {
                if (!modal) createPasswordModal();
            });

            // Append to form under email field
            const emailField = document.getElementById('email');
            if (emailField && emailField.parentNode) {
                emailField.parentNode.appendChild(pwdTrigger);
            }
        });
    </script>
</body>

</html>