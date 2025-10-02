<?php
// Page: obituary/obituary_success
// Data contract:
// $name: string|null
?>
<!doctype html>
<html lang="en">
<?= view('components/head', ['title' => 'Request Received']) ?>

<body class="bg-gray-50 font-sans text-slate-900">
    <?= view('components/header', ['active' => 'Obituaries']) ?>

    <main class="mx-auto p-6 max-w-2xl">
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-8 text-center">
            <div class="text-sage text-4xl mb-4"><i class="fas fa-check-circle"></i></div>
            <h1 class="font-semibold text-slate-900 text-2xl mb-2">Request received</h1>
            <p class="text-gray-600 mb-6">Thank you. We have received your obituary request<?= !empty($name) ? ' for ' . esc($name) : '' ?>. Our team will review and follow up via the contact information you provided.</p>
            <a href="<?= base_url('/') ?>" class="bg-sage hover:bg-sage-dark px-6 py-3 rounded text-white">Return home</a>
        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>

