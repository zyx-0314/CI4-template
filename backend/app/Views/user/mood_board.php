<!doctype html>
<html lang="en">

<?= view('components/head') ?>

<body class="bg-gray-50 text-gray-900">
    <?= view('components/header', [
        'title' => 'Sunset Funeral Homes',
        'nav' => [
            ['label' => 'Home', 'href' => '/', 'active' => false],
            ['label' => 'Road map', 'href' => '/road-map'],
            ['label' => 'Login', 'href' => '/login'],
            ['label' => 'Request Assistance', 'href' => '/services']
        ]
    ]) ?>

    <main class="mx-auto px-6 py-12 max-w-5xl">
        <header class="mb-8">
            <h1 class="font-bold text-2xl">Mood board</h1>
            <p class="text-gray-600">Visual identity samples for Sunset Funeral Homes (funeral services)</p>
        </header>

        <section class="mb-8">
            <h2 class="mb-4 font-semibold text-lg">Color system</h2>
            <p class="mb-4 text-gray-600 text-sm">Three main colors with three vibrance levels (dark → light). Preview and hex codes shown below.</p>
            <div class="gap-4 grid grid-cols-1 sm:grid-cols-3">
                <!-- Sage Green (Accent) -->
                <div>
                    <div class="gap-2 grid grid-cols-1">
                        <div class="swatch" style="background:var(--sage-dark)"></div>
                        <div class="swatch" style="background:var(--sage)"></div>
                        <div class="swatch" style="background:var(--sage-light)"></div>
                    </div>
                    <p class="mt-3 font-medium">Sage Green (Main accent)</p>
                    <div class="mt-1 text-gray-500 text-sm">#6F8E78 — #8DAA91 — #CFE6D7</div>
                </div>

                <!-- Muted Rose -->
                <div>
                    <div class="gap-2 grid grid-cols-1">
                        <div class="swatch" style="background:var(--rose-dark)"></div>
                        <div class="swatch" style="background:var(--rose)"></div>
                        <div class="swatch" style="background:var(--rose-light)"></div>
                    </div>
                    <p class="mt-3 font-medium">Muted Rose (Subtle warmth)</p>
                    <div class="mt-1 text-gray-500 text-sm">#A87D79 — #C7A6A0 — #EDD9D6</div>
                </div>

                <!-- Cool Stone Gray -->
                <div>
                    <div class="gap-2 grid grid-cols-1">
                        <div class="swatch" style="background:var(--stone-dark)"></div>
                        <div class="swatch" style="background:var(--stone)"></div>
                        <div class="swatch" style="background:var(--stone-light)"></div>
                    </div>
                    <p class="mt-3 font-medium">Cool Stone Gray (Secondary background)</p>
                    <div class="mt-1 text-gray-500 text-sm">#B1B1B1 — #E2E2E2 — #F7F7F7</div>
                </div>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="mb-4 font-semibold text-lg">Typography</h2>
            <div class="gap-6 grid grid-cols-2">
                <div>
                    <p class="text-gray-500 text-sm">Heading font</p>
                    <p class="font-sample font-semibold">Playfair Display — Heading example</p>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Body font</p>
                    <p class="font-sample">Lato — Body text example that demonstrates readable copy for longer paragraphs.</p>
                </div>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="mb-4 font-semibold text-lg">Buttons</h2>
            <div class="space-y-4">
                <div class="flex items-center space-x-4">
                    <?= view('components/buttons/button_primary', ['label' => 'Primary', 'href' => '#']) ?>
                    <?= view('components/buttons/button_secondary', ['label' => 'Secondary', 'href' => '#']) ?>
                    <?= view('components/buttons/button_ghost', ['label' => 'Border', 'href' => '#']) ?>
                    <?= view('components/buttons/button_primary', ['label' => 'Disabled', 'href' => '#']) ?>
                </div>
                <p class="text-gray-500 text-sm">Primary for main CTAs, secondary for supportive actions, border for subtle actions, disabled for unavailable states.</p>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="mb-4 font-semibold text-lg">Card sample</h2>
            <div class="gap-4 grid grid-cols-1 md:grid-cols-3">
                <?= view('components/cards/card', ['title' => '1,254', 'excerpt' => 'Memorials Completed', 'image' => null]) ?>
                <?= view('components/cards/card', ['title' => 'Premium Casket', 'excerpt' => 'Handcrafted oak casket with satin interior and personalized engraving options.', 'image' => null]) ?>
                <?= view('components/cards/card', ['title' => '"Compassionate and attentive service during a difficult time — we felt supported every step of the way."', 'excerpt' => '— Jane D., Family', 'image' => null]) ?>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="mb-4 font-semibold text-lg">Logos</h2>
            <div class="gap-4 grid grid-cols-2">
                <div class="bg-white shadow p-6 rounded text-center">
                    <div class="flex justify-center items-center bg-white mx-auto mb-3 rounded-full w-24 h-24 overflow-hidden">
                        <img src="logo/main.svg" alt="Sunset Funeral Homes" style="width:120px; height:120px; object-fit:cover; transform:translateX(0);">
                    </div>
                    <p class="font-medium">Main — Circle</p>
                </div>
                <div class="bg-white shadow p-6 rounded text-center">
                    <div class="flex justify-center items-center bg-white mx-auto mb-3 rounded-md w-24 h-24 overflow-hidden">
                        <img src="logo/main.svg" alt="Sunset Funeral Homes" style="width:120px; height:120px; object-fit:cover; transform:translateX(0);">
                    </div>
                    <p class="font-medium">Main — Square</p>
                </div>
            </div>
        </section>

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