<?php
$reservation = $reservation ?? [];
?>
<!doctype html>
<html lang="en">
<?= view('components/head') ?>
<?= view('components/header', ['active' => 'Services']) ?>

<body class="bg-gray-50 font-sans text-slate-900">
    <main class="flex justify-center items-center p-6 min-h-[75svh]">
        <div class="relative bg-white shadow-2xl rounded-lg w-[420px] h-[620px] overflow-hidden">
            <!-- Background hero image -->
            <img src="https://images.unsplash.com/photo-1486102515046-44130769cb25?q=80&w=735&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="flower background" class="absolute inset-0 brightness-[0.95] grayscale w-full h-full object-cover">

            <!-- Overlay to improve text contrast -->
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/10 to-black/30"></div>

            <!-- Content centered vertically -->
            <div class="z-10 relative flex flex-col justify-center items-center px-6 h-full text-white text-center">
                <header class="mb-6">
                    <div class="opacity-80 text-sm uppercase tracking-wider">Reservation confirmed</div>
                    <h1 class="mt-2 font-serif font-bold text-2xl md:text-3xl"><?= esc($reservation['service_title'] ?? 'Service Reservation') ?></h1>
                </header>

                <div class="bg-white/10 backdrop-blur-sm p-4 rounded-md w-full max-w-[340px]">
                    <p class="mb-3 text-white/90 text-sm">Our condolences to you and your family. The reservation details are below.</p>

                    <dl class="space-y-2 text-white/95 text-sm text-left">
                        <div>
                            <dt class="font-semibold">Name</dt>
                            <dd><?= esc(trim(($reservation['first_name'] ?? '') . ' ' . ($reservation['last_name'] ?? ''))) ?></dd>
                        </div>
                        <div>
                            <dt class="font-semibold">Service</dt>
                            <dd><?= esc($reservation['service_id'] ?? '') ?></dd>
                        </div>
                        <div>
                            <dt class="font-semibold">Date</dt>
                            <dd><?= esc(($reservation['date_start'] ?? '')) ?> – <?= esc(($reservation['date_end'] ?? '')) ?></dd>
                        </div>
                        <div>
                            <dt class="font-semibold">Contact</dt>
                            <dd><?= esc($reservation['phone'] ?? '') ?> / <?= esc($reservation['email'] ?? '') ?></dd>
                        </div>
                    </dl>
                </div>

                <div class="mt-6 max-w-[340px] text-white/90 text-sm">
                    <p class="italic">With deepest sympathy, we offer our support during this time. If you need any changes, please contact our Care Team.</p>
                </div>
            </div>

            <!-- Company name bottom-left -->
            <div class="bottom-4 left-4 z-20 absolute font-medium text-white/90 text-sm">Sunset Funeral Homes</div>

            <!-- Back link top-left -->
            <a href="/services" class="top-4 left-4 z-20 absolute text-white/80 text-sm">← Back to services</a>
        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>