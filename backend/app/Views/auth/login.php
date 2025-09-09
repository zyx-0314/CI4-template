<?php

/**
 * views/auth/login.php
 *
 * Data contract (optional):
 * - $action: string - form action URL (default: '/login')
 * - $method: string - http method (default: 'post')
 * - $errors: array|null - validation errors keyed by field name
 * - $old: array|null - old input values, e.g. old('email')
 *
 * This view renders an accessible login form. It expects the framework's
 * `csrf_field()` helper to be available for CSRF protection.
 */

$action = $action ?? '/login';
$method = strtoupper($method ?? 'post');
$errors = $errors ?? [];
$old = $old ?? [];

?>
<!doctype html>
<html lang="en">
<?= view('components/head', ['title' => 'Sunset Funeral Homes — Compassionate Care']) ?>

<body class="bg-gray-50 min-h-screen font-sans text-slate-900">
    <?= view('components/header', ['active' => 'Login']) ?>


    <main class="flex justify-center items-center bg-gray-50 px-4 sm:px-6 lg:px-8 py-12">
        <div class="space-y-8 w-full max-w-md">
            <div>
                <img class="mx-auto w-auto h-12" src="<?= esc(base_url('logo/main.svg')) ?>" alt="<?= esc($brandTitle ?? 'Sunset Funeral Homes') ?>">
                <h2 class="mt-6 font-extrabold text-gray-900 text-3xl text-center">Sign in to your account</h2>
                <p class="mt-2 text-gray-600 text-sm text-center">Don't have an account? <a href="/signup" class="font-medium text-emerald-600 hover:underline">Sign up</a></p>
            </div>

            <form class="space-y-6 mt-8" action="<?= esc($action) ?>" method="<?= $method === 'GET' ? 'get' : 'post' ?>" novalidate>
                <?= csrf_field() ?>
                <input type="hidden" name="remember" value="0">
                <div class="-space-y-px shadow-sm rounded-md">
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            value="<?= esc($old['email'] ?? '') ?>"
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border <?= isset($errors['email']) ? 'border-red-500' : 'border-gray-300' ?> placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                            placeholder="Email address" aria-invalid="<?= isset($errors['email']) ? 'true' : 'false' ?>" aria-describedby="email-error">
                        <?php if (! empty($errors['email'])): ?>
                            <p id="email-error" class="mt-2 text-red-600 text-sm"><?= esc($errors['email']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border <?= isset($errors['password']) ? 'border-red-500' : 'border-gray-300' ?> placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                            placeholder="Password" aria-invalid="<?= isset($errors['password']) ? 'true' : 'false' ?>" aria-describedby="password-error">
                        <?php if (! empty($errors['password'])): ?>
                            <p id="password-error" class="mt-2 text-red-600 text-sm"><?= esc($errors['password']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" value="1" class="border-gray-300 rounded focus:ring-emerald-500 w-4 h-4 text-emerald-600" <?= ! empty($old['remember']) ? 'checked' : '' ?>>
                        <label for="remember" class="block ml-2 text-gray-900 text-sm">Remember me</label>
                    </div>

                    <div class="text-sm">
                        <?= view('components/modal/forgetPassword.php') ?>
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative flex justify-center bg-emerald-600 hover:bg-emerald-700 px-4 py-2 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 w-full font-medium text-white text-sm">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </main>



    <?= view('components/footer') ?>
</body>

</html>