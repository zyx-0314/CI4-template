<!doctype html>
<html lang="en">

<?= view('components/head', ['title' => 'Accounts']) ?>

<body class="bg-gray-100 text-gray-900">
    <?= view('components/header') ?>
    <div class="mx-auto mt-10 max-w-4xl">
        <div class="bg-white shadow p-6 rounded-lg">
            <div class="flex items-center space-x-4">
                <div class="flex justify-center items-center bg-gray-200 rounded-full w-24 h-24 overflow-hidden">
                    <?php if (!empty($user->profile_image)): ?>
                        <img src="<?= esc($user->profile_image) ?>" alt="Profile" class="w-full h-full object-cover">
                    <?php else: ?>
                        <span class="text-gray-500 text-3xl"><?= esc(substr($user->first_name ?? '', 0, 1) . strtoupper(substr($user->last_name ?? '', 0, 1))) ?></span>
                    <?php endif; ?>
                </div>
                <div>
                    <h1 class="font-semibold text-2xl"><?= esc(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?></h1>
                    <p class="text-gray-600 text-sm"><?= esc($user->email ?? '') ?></p>
                    <div class="mt-2 text-sm">
                        <span class="inline-block bg-green-100 mr-2 px-2 py-1 rounded text-green-800">Type: <?= esc($user->type ?? 'client') ?></span>
                        <span class="inline-block bg-blue-100 px-2 py-1 rounded text-blue-800">Status: <?= esc($user->account_status ? 'Active' : 'Inactive') ?></span>
                    </div>
                </div>
            </div>

            <hr class="my-6">

            <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                <div class="bg-gray-50 p-4 rounded">
                    <h2 class="mb-2 font-medium">Personal Info</h2>
                    <p><strong>First name:</strong> <?= esc($user->first_name ?? '') ?></p>
                    <p><strong>Middle name:</strong> <?= esc($user->middle_name ?? '-') ?></p>
                    <p><strong>Last name:</strong> <?= esc($user->last_name ?? '') ?></p>
                    <p><strong>Gender:</strong> <?= esc($user->gender ?? '-') ?></p>
                </div>

                <div class="bg-gray-50 p-4 rounded">
                    <h2 class="mb-2 font-medium">Account</h2>
                    <p><strong>Email Activated:</strong>
                        <?php if ($user->email_activated ?? 0): ?>
                            <span class="text-green-600">Yes</span>
                        <?php else: ?>
                            <span class="text-red-600">No</span>
                            <button type="button" class="ml-2 text-blue-600 hover:text-blue-800 text-sm underline js-verify-email-trigger">
                                Verify Now
                            </button>
                        <?php endif; ?>
                    </p>
                    <p><strong>Newsletter:</strong> <?= esc(($user->newsletter ?? 0) ? 'Subscribed' : 'Unsubscribed') ?></p>
                    <p class="mt-3 text-gray-600 text-sm">Member since: <?= esc((!empty($user->created_at)) ? date('M j, Y', strtotime($user->created_at)) : '-') ?></p>
                </div>
            </div>

            <div class="mt-6 text-right">
                <a href="/settings/edit" class="inline-block bg-indigo-600 shadow px-4 py-2 rounded text-white">Edit Profile</a>
            </div>
            <?= view('components/modal/accounts/email_verification') ?>
        </div>
    </div>
    <?= view('components/footer') ?>
</body>

</html>