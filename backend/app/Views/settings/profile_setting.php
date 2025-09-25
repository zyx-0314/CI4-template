<?php
$session = session();
// Load flashed validation errors and old input if present
$errors = $errors ?? $session->getFlashdata('errors') ?? [];
$old = $old ?? $session->getFlashdata('old') ?? [];
?>
<script>
    console.log("<?php echo $user->gender ?>")
</script>

<!doctype html>
<html lang="en">

<?= view('components/head', ['title' => 'Accounts']) ?>

<body class="bg-gray-100 text-gray-900">
    <?= view('components/header') ?>

    <div class="mx-auto mt-10 max-w-3xl">
        <div class="bg-white shadow p-6 rounded-lg">
            <h1 class="mb-4 font-semibold text-xl">Edit Profile</h1>

            <?php if (!empty($session->getFlashdata('success'))): ?>
                <div class="bg-green-50 mb-4 p-3 rounded text-green-800"><?= esc($session->getFlashdata('success')) ?></div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="bg-red-50 mb-4 p-3 rounded text-red-800">
                    <ul class="pl-5 list-disc">
                        <?php if (is_array($errors) || $errors instanceof \Traversable): ?>
                            <?php foreach ($errors as $k => $e): ?>
                                <li><?= is_string($k) ? esc($k . ': ' . $e) : esc($e) ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><?= esc((string) $errors) ?></li>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('/settings/edit') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                    <div>
                        <label class="block mb-1 font-medium text-sm">First name</label>
                        <input name="first_name" value="<?= esc(old('first_name') ?? ($old['first_name'] ?? $user->first_name ?? '')) ?>" class="px-3 py-2 border rounded w-full" required>
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-sm">Middle name</label>
                        <input name="middle_name" value="<?= esc(old('middle_name') ?? ($old['middle_name'] ?? $user->middle_name ?? '')) ?>" class="px-3 py-2 border rounded w-full">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-sm">Last name</label>
                        <input name="last_name" value="<?= esc(old('last_name') ?? ($old['last_name'] ?? $user->last_name ?? '')) ?>" class="px-3 py-2 border rounded w-full" required>
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-sm">Email</label>
                        <input name="email" type="email" value="<?= esc(old('email') ?? ($old['email'] ?? $user->email ?? '')) ?>" class="px-3 py-2 border rounded w-full" required>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-sm">Gender</label>
                        <select name="gender" class="px-3 py-2 border rounded w-full">
                            <?php $g = strtolower(old('gender') ?? ($old['gender'] ?? $user->gender ?? '')); ?>
                            <option value="" <?= empty($g) ? 'selected' : '' ?>>Select</option>
                            <option value="male" <?= ($g === 'male') ? 'selected' : '' ?>>Male</option>
                            <option value="female" <?= ($g === 'female') ? 'selected' : '' ?>>Female</option>
                            <option value="other" <?= ($g === 'other') ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-sm">Newsletter</label>
                        <div class="flex items-center">
                            <?php $news = (old('newsletter') !== null) ? old('newsletter') : (isset($old['newsletter']) ? $old['newsletter'] : ($user->newsletter ?? 0)); ?>
                            <input type="checkbox" name="newsletter" value="1" <?= ($news ? 'checked' : '') ?> class="mr-2">
                            <span class="text-gray-600 text-sm">Subscribe to newsletter</span>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block mb-1 font-medium text-sm">Profile image</label>
                        <?php
                        $placeholder = 'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1400&q=80';
                        $profileSrc = !empty($user->profile_image) ? esc($user->profile_image) : $placeholder;
                        ?>
                        <div class="mb-2">
                            <img id="profilePreview"
                                data-placeholder="<?= esc($placeholder) ?>"
                                src="<?= $profileSrc ?>"
                                alt="profile preview"
                                class="rounded w-24 h-24 object-cover"
                                style="background:#f3f4f6;display:block;"
                                onerror="this.onerror=null; if(this.dataset && this.dataset.placeholder) this.src=this.dataset.placeholder;" />
                        </div>
                        <input id="profile_image" type="file" name="profile_image" accept="image/*">
                    </div>
                </div>

                <div class="mt-6 text-right">
                    <a href="/settings/profile" class="inline-block mr-2 text-gray-700 text-sm">Cancel</a>
                    <button type="submit" class="inline-block bg-indigo-600 px-4 py-2 rounded text-white">Save changes</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        (function() {
            const input = document.getElementById('profile_image');
            const preview = document.getElementById('profilePreview');
            let _currentObjectUrl = null;
            const PLACEHOLDER = (preview && preview.dataset && preview.dataset.placeholder) ? preview.dataset.placeholder : '';

            if (input && preview) {
                input.addEventListener('change', function(e) {
                    const file = (e.target.files || [])[0];
                    if (!file) {
                        if (_currentObjectUrl) {
                            try {
                                URL.revokeObjectURL(_currentObjectUrl);
                            } catch (e) {}
                            _currentObjectUrl = null;
                        }
                        preview.src = PLACEHOLDER || preview.src;
                        return;
                    }

                    if (_currentObjectUrl) {
                        try {
                            URL.revokeObjectURL(_currentObjectUrl);
                        } catch (e) {}
                    }

                    const url = URL.createObjectURL(file);
                    _currentObjectUrl = url;
                    preview.src = url;
                });
            }

            // Revoke object url when navigating away
            window.addEventListener('beforeunload', function() {
                if (_currentObjectUrl) {
                    try {
                        URL.revokeObjectURL(_currentObjectUrl);
                    } catch (e) {}
                    _currentObjectUrl = null;
                }
            });
        })();
    </script>
    <?= view('components/footer') ?>

</body>

</html>