<!doctype html>
<html lang="en">

<?= view('components/head') ?>

<body class="bg-gray-50 font-sans text-slate-900">
    <?= view('components/header', [
        'title' => 'Sunset Funeral Homes',
        'nav' => [
            ['label' => 'Home', 'href' => '/', 'active' => true],
            ['label' => 'Road map', 'href' => '/road-map', 'active' => false],
            ['label' => 'Login', 'href' => '/login'],
        ],
        'cta' => ['label' => 'Request Assistance', 'href' => '/services']
    ]) ?>

    <main class="mx-auto px-6 py-12 max-w-6xl">
        <!-- Hero -->
        <section class="items-center gap-8 grid grid-cols-1 md:grid-cols-2">
            <div class="order-2 md:order-1">
                <h1 class="font-serif font-extrabold text-slate-900 text-4xl md:text-5xl leading-tight">A dignified service your family can trust</h1>
                <p class="mt-4 max-w-xl text-gray-700">We provide respectful, professional support for families during difficult moments — clear guidance, compassionate staff, and thoughtful service options.</p>

                <div class="flex flex-wrap items-center gap-3 mt-6">
                    <?= view('components/buttons/button_primary', ['label' => 'Request Assistance', 'href' => '#']) ?>
                </div>

                <div class="mt-6">
                    <div class="inline-flex items-center gap-3 bg-sage-light px-4 py-3 rounded-full text-sage-dark">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8" />
                        </svg>
                        <div>
                            <div class="font-semibold text-sm">Speak to our Care Team</div>
                            <div class="text-sm">Call (555) 123-4567</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="order-1 md:order-2">
                <div class="shadow-lg rounded-2xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1400&q=80" alt="Family embracing in a living room" class="w-full h-72 md:h-[420px] object-cover">
                </div>
            </div>
        </section>

        <!-- Features (fragmented into reusable cards) -->
        <section class="mt-12">
            <div class="gap-6 grid grid-cols-1 md:grid-cols-3">
                <?= view('components/cards/card', ['title' => 'Simple process', 'excerpt' => 'We guide you step-by-step so arrangements are clear and manageable.', 'image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=200&q=80']) ?>
                <?= view('components/cards/card', ['title' => 'Transparent pricing', 'excerpt' => 'Upfront options and pricing to remove uncertainty for families.', 'image' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=200&q=80']) ?>
                <?= view('components/cards/card', ['title' => 'Compassionate care', 'excerpt' => 'Our team supports families with empathy and professionalism.', 'image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=200&q=80']) ?>
            </div>
        </section>

        <!-- Package summary -->
        <section class="bg-white shadow mt-12 p-6 rounded-lg">
            <div class="md:flex md:justify-between md:items-center gap-6">
                <div class="md:flex-1">
                    <h3 class="font-semibold text-xl">Direct service package</h3>
                    <p class="mt-2 text-gray-700">A straightforward package that includes essential care and arrangements.</p>
                    <ul class="space-y-1 mt-4 text-gray-700 list-disc list-inside">
                        <li>Guided arrangements with a licensed director</li>
                        <li>Careful preparation and dignified transfer</li>
                        <li>All necessary paperwork and permits</li>
                    </ul>
                </div>

                <div class="mt-4 md:mt-0 md:w-64">
                    <div class="text-gray-500 text-sm">Starting from</div>
                    <div class="mt-1 font-bold text-sage-dark text-2xl">$650</div>
                    <?= view('components/buttons/button_primary', ['label' => 'Get an instant quote', 'href' => '#']) ?>
                </div>
            </div>
        </section>

        <!-- Steps -->
        <section class="mt-12">
            <h3 class="font-semibold text-lg">We guide you through the process</h3>
            <div class="gap-6 grid grid-cols-1 md:grid-cols-4 mt-6">
                <?php
                $process  = ["You Arrange", "We Collect", "We Register", "We Return"];
                foreach ($process as $value) : ?>
                    <div class="bg-white p-4 rounded-lg text-center">
                        <div class="font-medium text-sm"><?php echo $value ?></div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>
        </section>

        <!-- CTA (component) -->
        <?= view('components/cta', [
            'heading' => 'Can we help?',
            'sub' => 'Our Care Team is available 24 hours a day by phone and live-chat.',
            'primary' => ['label' => 'Call (555) 123-4567', 'href' => 'tel:5551234567'],
            'secondary' => ['label' => 'Request Assistance', 'href' => '/services']
        ]) ?>

    </main>

    <?= view('components/footer', [
        'copyright' => 'Sunset Funeral Homes — CI4 Sample Project 1',
        'links' => [
            ['label' => 'Services', 'href' => '/services'],
            ['label' => 'Mood board', 'href' => '/mood-board'],
            ['label' => 'Road map', 'href' => '/road-map']
        ]
    ]) ?>
</body>

</html>