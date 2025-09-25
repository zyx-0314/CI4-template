<?php

/**
 * Minimalist Obituary Design
 * Clean, simple layout focusing on content and readability
 */
?>

<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => $obituary['name'] ?? 'Memorial']) ?>

<body class="bg-gray-50 font-sans text-gray-800">
    <?= view('components/header') ?>

    <main class="mx-auto px-4 py-16 max-w-4xl">
        <!-- Header -->
        <header class="mb-16 text-center">
            <div class="inline-block">
                <div class="bg-white shadow-lg mx-auto mb-8 rounded-full w-40 h-40 overflow-hidden">
                    <img src="<?= esc($obituary['photo'] ?? '/logo/default-profile.jpg') ?>"
                        alt="<?= esc($obituary['name'] ?? 'Memorial Photo') ?>"
                        class="w-full h-full object-cover">
                </div>

                <h1 class="mb-4 font-light text-gray-900 text-4xl">
                    <?= esc($obituary['name'] ?? 'Robert James Thompson') ?>
                </h1>

                <div class="space-x-2 text-gray-600 text-xl">
                    <time><?= esc($obituary['birth_date'] ?? '1952') ?></time>
                    <span>—</span>
                    <time><?= esc($obituary['death_date'] ?? '2024') ?></time>
                </div>

                <?php if (!empty($obituary['age'])): ?>
                    <p class="mt-2 text-gray-500 text-lg"><?= esc($obituary['age']) ?> years</p>
                <?php endif ?>
            </div>
        </header>

        <!-- Content -->
        <div class="space-y-16">
            <!-- Obituary Text -->
            <section class="max-w-none prose prose-xl prose-gray">
                <div class="mb-12 text-center">
                    <div class="bg-gray-300 mx-auto w-16 h-px"></div>
                </div>

                <p class="mb-8 text-xl text-center leading-relaxed">
                    <?= esc($obituary['opening'] ?? 'Robert James Thompson, beloved father, grandfather, and friend, passed away peacefully on December 15, 2024, at the age of 72.') ?>
                </p>

                <div class="space-y-6 mx-auto max-w-3xl text-lg leading-relaxed">
                    <p>
                        <?= esc($obituary['life_summary'] ?? 'Robert was born in Denver, Colorado, where he spent his childhood exploring the Rocky Mountains and developing a deep love for the outdoors. This passion would shape his entire life, leading him to a career in environmental conservation and countless adventures with family and friends.') ?>
                    </p>

                    <p>
                        <?= esc($obituary['career_achievements'] ?? 'After graduating from Colorado State University with a degree in Environmental Science, Robert dedicated 40 years to protecting natural habitats and educating others about conservation. His work took him across the country, but he always considered Colorado home.') ?>
                    </p>

                    <p>
                        <?= esc($obituary['personal_life'] ?? 'Robert married his college sweetheart, Linda, in 1975. Together, they raised two children, Sarah and Michael, instilling in them the same love for nature and respect for the environment that defined Robert\'s character. He was an avid hiker, photographer, and storyteller who could captivate audiences with tales of his wilderness adventures.') ?>
                    </p>

                    <p>
                        <?= esc($obituary['legacy'] ?? 'Robert\'s legacy lives on through the national parks he helped preserve, the countless lives he touched through his environmental education programs, and most importantly, through his family who continue to share his passion for the natural world.') ?>
                    </p>
                </div>

                <div class="mt-12 text-center">
                    <div class="bg-gray-300 mx-auto w-16 h-px"></div>
                </div>
            </section>

            <!-- Family Information -->
            <section class="bg-white shadow-sm p-8 rounded-lg">
                <h2 class="mb-8 font-light text-2xl text-center">Family</h2>

                <div class="gap-8 grid md:grid-cols-2 text-center">
                    <div>
                        <h3 class="mb-4 font-medium text-gray-800 text-lg">Survived By</h3>
                        <div class="space-y-2 text-gray-600">
                            <?php
                            $survivors = $obituary['survivors'] ?? [
                                'Wife Linda Thompson',
                                'Daughter Sarah Thompson-Miller (James)',
                                'Son Michael Thompson (Jennifer)',
                                'Grandchildren: Emma, Lucas, and Sophia',
                                'Brother David Thompson (Mary)'
                            ];
                            ?>
                            <?php foreach ($survivors as $survivor): ?>
                                <p><?= esc($survivor) ?></p>
                            <?php endforeach ?>
                        </div>
                    </div>

                    <div>
                        <h3 class="mb-4 font-medium text-gray-800 text-lg">Preceded in Death By</h3>
                        <div class="space-y-2 text-gray-600">
                            <?php
                            $preceded = $obituary['preceded_by'] ?? [
                                'Parents James and Mary Thompson',
                                'Sister Patricia Thompson-Lee'
                            ];
                            ?>
                            <?php foreach ($preceded as $person): ?>
                                <p><?= esc($person) ?></p>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Services -->
            <section class="bg-white shadow-sm p-8 rounded-lg">
                <h2 class="mb-8 font-light text-2xl text-center">Memorial Services</h2>

                <div class="space-y-8">
                    <div class="text-center">
                        <h3 class="mb-4 font-medium text-gray-800 text-xl">Memorial Service</h3>
                        <div class="space-y-2 text-gray-600">
                            <p class="text-lg"><?= esc($obituary['service_date'] ?? 'Saturday, December 21, 2024 at 2:00 PM') ?></p>
                            <p><?= esc($obituary['service_location'] ?? 'Mountain View Community Center') ?></p>
                            <p><?= esc($obituary['service_address'] ?? '1234 Pine Street, Denver, CO 80202') ?></p>
                        </div>
                    </div>

                    <?php if (!empty($obituary['reception'])): ?>
                        <div class="pt-4 border-gray-200 border-t text-center">
                            <h3 class="mb-2 font-medium text-gray-800 text-lg">Reception</h3>
                            <p class="text-gray-600"><?= esc($obituary['reception']) ?></p>
                        </div>
                    <?php endif ?>

                    <div class="pt-4 border-gray-200 border-t text-gray-500 text-sm text-center">
                        <p>All are welcome to attend and celebrate Robert's life</p>
                    </div>
                </div>
            </section>

            <!-- Memorial Donations -->
            <section class="bg-white shadow-sm p-8 rounded-lg">
                <h2 class="mb-8 font-light text-2xl text-center">Memorial Contributions</h2>

                <div class="mx-auto max-w-2xl text-center">
                    <p class="mb-6 text-gray-600">
                        In lieu of flowers, the family requests that donations be made to organizations that were close to Robert's heart:
                    </p>

                    <div class="space-y-4">
                        <?php
                        $charities = $obituary['memorial_charities'] ?? [
                            [
                                'name' => 'National Park Foundation',
                                'description' => 'Protecting America\'s national parks',
                                'website' => 'www.nationalparks.org'
                            ],
                            [
                                'name' => 'Colorado Environmental Coalition',
                                'description' => 'Local environmental conservation efforts',
                                'website' => 'www.ourcolorado.org'
                            ]
                        ];
                        ?>
                        <?php foreach ($charities as $charity): ?>
                            <div class="p-4 border border-gray-200 rounded-lg">
                                <h3 class="font-medium text-gray-800"><?= esc($charity['name']) ?></h3>
                                <p class="mt-1 text-gray-600 text-sm"><?= esc($charity['description']) ?></p>
                                <?php if (!empty($charity['website'])): ?>
                                    <p class="mt-1 text-sage text-sm"><?= esc($charity['website']) ?></p>
                                <?php endif ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </section>

            <!-- Condolences -->
            <section class="bg-white shadow-sm p-8 rounded-lg">
                <h2 class="mb-8 font-light text-2xl text-center">Share Your Memories</h2>

                <!-- Form -->
                <div class="mx-auto mb-12 max-w-2xl">
                    <form class="space-y-6">
                        <div class="gap-6 grid md:grid-cols-2">
                            <input type="text" placeholder="Your Name"
                                class="p-4 border border-gray-300 focus:border-sage rounded focus:ring-1 focus:ring-sage w-full">
                            <input type="email" placeholder="Email (optional)"
                                class="p-4 border border-gray-300 focus:border-sage rounded focus:ring-1 focus:ring-sage w-full">
                        </div>
                        <textarea placeholder="Share a memory or message..." rows="4"
                            class="p-4 border border-gray-300 focus:border-sage rounded focus:ring-1 focus:ring-sage w-full"></textarea>
                        <div class="text-center">
                            <button type="submit" class="bg-gray-800 hover:bg-gray-900 px-8 py-3 rounded text-white transition duration-300">
                                Share Memory
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Messages -->
                <div class="mx-auto max-w-3xl">
                    <?php $condolences = $obituary['condolences'] ?? [] ?>
                    <?php if (empty($condolences)): ?>
                        <p class="py-12 text-gray-500 text-center">No messages yet. Be the first to share your memory of Robert.</p>
                    <?php else: ?>
                        <div class="space-y-8">
                            <?php foreach ($condolences as $condolence): ?>
                                <div class="pl-6 border-gray-200 border-l-2">
                                    <p class="mb-3 text-gray-700"><?= esc($condolence['message']) ?></p>
                                    <p class="text-gray-500 text-sm">
                                        — <?= esc($condolence['name']) ?>, <?= esc($condolence['date']) ?>
                                    </p>
                                </div>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>
                </div>
            </section>

            <!-- Footer Actions -->
            <section class="space-y-4 text-center">
                <div class="flex justify-center space-x-4">
                    <button class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded text-white transition">
                        Share on Facebook
                    </button>
                    <button class="bg-gray-600 hover:bg-gray-700 px-6 py-3 rounded text-white transition">
                        Copy Link
                    </button>
                    <button class="bg-gray-600 hover:bg-gray-700 px-6 py-3 rounded text-white transition">
                        Print Page
                    </button>
                </div>
            </section>
        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>