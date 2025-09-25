<?php
// Page: auth/signup
// Data contract:
// $errors: array
// $old: array
?>
<!doctype html>
<html lang="en">
<?= view('components/head', ['title' => 'Sunset Funeral Homes — Compassionate Care']) ?>

<body class="bg-gray-50 min-h-screen font-sans text-slate-900">
    <?= view('components/header') ?>

    <main class="flex justify-center items-center bg-gray-50 px-4 sm:px-6 lg:px-8 py-12">
        <div class="space-y-8 w-full max-w-md">
            <div>
                <img class="mx-auto w-auto h-12" src="<?= esc(base_url('logo/main.svg')) ?>" alt="<?= esc($brandTitle ?? 'Sunset Funeral Homes') ?>">
                <h2 class="mt-6 font-extrabold text-gray-900 text-3xl text-center">Create an account</h2>
                <p class="mt-2 text-gray-600 text-sm text-center">Already have an account? <a href="/login" class="font-medium text-emerald-600 hover:underline">Sign in</a></p>
            </div>

            <form class="space-y-6 mt-8" action="/signup" method="post" novalidate>
                <?= csrf_field() ?>
                <div class="-space-y-px shadow-sm rounded-md">
                    <div>
                        <label for="first_name" class="sr-only">First name</label>
                        <input id="first_name" name="first_name" type="text" autocomplete="given-name" required
                            value="<?= esc($old['first_name'] ?? '') ?>"
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border <?= isset($errors['first_name']) ? 'border-red-500' : 'border-gray-300' ?> placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                            placeholder="First name" aria-invalid="<?= isset($errors['first_name']) ? 'true' : 'false' ?>" aria-describedby="first-name-error">
                        <?php if (! empty($errors['first_name'])): ?>
                            <p id="first-name-error" class="mt-2 text-red-600 text-sm"><?= esc($errors['first_name']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="middle_name" class="sr-only">Middle name</label>
                        <input id="middle_name" name="middle_name" type="text" autocomplete="additional-name"
                            value="<?= esc($old['middle_name'] ?? '') ?>"
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border <?= isset($errors['middle_name']) ? 'border-red-500' : 'border-gray-300' ?> placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                            placeholder="Middle name (optional)" aria-invalid="<?= isset($errors['middle_name']) ? 'true' : 'false' ?>" aria-describedby="middle-name-error">
                        <?php if (! empty($errors['middle_name'])): ?>
                            <p id="middle-name-error" class="mt-2 text-red-600 text-sm"><?= esc($errors['middle_name']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="last_name" class="sr-only">Last name</label>
                        <input id="last_name" name="last_name" type="text" autocomplete="family-name" required
                            value="<?= esc($old['last_name'] ?? '') ?>"
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border <?= isset($errors['last_name']) ? 'border-red-500' : 'border-gray-300' ?> placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                            placeholder="Last name" aria-invalid="<?= isset($errors['last_name']) ? 'true' : 'false' ?>" aria-describedby="last-name-error">
                        <?php if (! empty($errors['last_name'])): ?>
                            <p id="last-name-error" class="mt-2 text-red-600 text-sm"><?= esc($errors['last_name']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            value="<?= esc($old['email'] ?? '') ?>"
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border <?= isset($errors['email']) ? 'border-red-500' : 'border-gray-300' ?> placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                            placeholder="Email address" aria-invalid="<?= isset($errors['email']) ? 'true' : 'false' ?>" aria-describedby="email-error">
                        <?php if (! empty($errors['email'])): ?>
                            <p id="email-error" class="mt-2 text-red-600 text-sm"><?= esc($errors['email']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border <?= isset($errors['password']) ? 'border-red-500' : 'border-gray-300' ?> placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                            placeholder="Password" aria-invalid="<?= isset($errors['password']) ? 'true' : 'false' ?>" aria-describedby="password-error">
                        <?php if (! empty($errors['password'])): ?>
                            <p id="password-error" class="mt-2 text-red-600 text-sm"><?= esc($errors['password']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="password_confirm" class="sr-only">Confirm password</label>
                        <input id="password_confirm" name="password_confirm" type="password" autocomplete="new-password" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border <?= isset($errors['password_confirm']) ? 'border-red-500' : 'border-gray-300' ?> placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                            placeholder="Confirm password" aria-invalid="<?= isset($errors['password_confirm']) ? 'true' : 'false' ?>" aria-describedby="password-confirm-error">
                        <?php if (! empty($errors['password_confirm'])): ?>
                            <p id="password-confirm-error" class="mt-2 text-red-600 text-sm"><?= esc($errors['password_confirm']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <button name="signup" type="submit" class="group relative flex justify-center bg-emerald-600 hover:bg-emerald-700 px-4 py-2 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 w-full font-medium text-white text-sm">
                        Create account
                    </button>
                </div>
            </form>
        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>