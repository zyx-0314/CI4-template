<?php

/**
 * Classic Obituary Design
 * Traditional, elegant layout with formal styling
 */
?>

<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => $obituary['name'] ?? 'Memorial']) ?>

<body class="bg-gray-50 font-serif">
    <?= view('components/header') ?>

    <main class="mx-auto px-4 py-12 max-w-4xl">
        <!-- Header Section -->
        <div class="bg-white shadow-lg mb-8 rounded-lg overflow-hidden">
            <div class="bg-gradient-to-r from-gray-800 to-gray-900 p-8 text-white">
                <div class="flex md:flex-row flex-col items-center gap-6">
                    <div class="flex-shrink-0 border-4 border-white rounded-full w-32 md:w-40 h-32 md:h-40 overflow-hidden">
                        <img src="<?= esc($obituary['photo'] ?? '/logo/default-profile.jpg') ?>"
                            alt="<?= esc($obituary['name'] ?? 'Memorial Photo') ?>"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="md:text-left text-center">
                        <h1 class="mb-2 font-bold text-4xl"><?= esc($obituary['name'] ?? 'John Doe') ?></h1>
                        <p class="mb-1 text-gray-300 text-xl">
                            <?= esc($obituary['birth_date'] ?? 'January 1, 1950') ?> - <?= esc($obituary['death_date'] ?? 'December 31, 2024') ?>
                        </p>
                        <p class="text-gray-400 text-lg"><?= esc($obituary['age'] ?? '74') ?> Years Old</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="gap-8 grid md:grid-cols-3">
            <!-- Obituary Text -->
            <div class="md:col-span-2">
                <div class="bg-white shadow mb-6 p-8 rounded-lg">
                    <h2 class="mb-6 pb-2 border-sage border-b-2 font-bold text-gray-800 text-2xl">
                        <i class="mr-2 text-sage fas fa-heart"></i>In Loving Memory
                    </h2>
                    <div class="max-w-none text-gray-700 leading-relaxed prose prose-lg">
                        <p class="mb-4">
                            <?= esc($obituary['obituary_text'] ?? 'It is with heavy hearts that we announce the peaceful passing of John Doe, beloved husband, father, and grandfather. John passed away surrounded by his loving family on December 31, 2024, at the age of 74.') ?>
                        </p>
                        <p class="mb-4">
                            <?= esc($obituary['life_story'] ?? 'Born in Springfield on January 1, 1950, John lived a full and meaningful life dedicated to his family and community. He worked for over 40 years as an engineer and was known for his kindness, wisdom, and infectious laugh.') ?>
                        </p>
                        <p class="mb-4">
                            <?= esc($obituary['family_info'] ?? 'John is survived by his loving wife of 50 years, Mary; his children Sarah (Mike) and David (Jennifer); and his cherished grandchildren Emma, Lucas, and Sophie. He was preceded in death by his parents and his brother Robert.') ?>
                        </p>
                    </div>
                </div>

                <!-- Guestbook -->
                <div class="bg-white shadow p-8 rounded-lg">
                    <h3 class="mb-6 pb-2 border-gray-200 border-b font-bold text-gray-800 text-xl">
                        <i class="mr-2 text-sage fas fa-pen"></i>Share Your Memories
                    </h3>
                    <div class="space-y-4 mb-6">
                        <?php $guestbook_entries = $obituary['guestbook'] ?? [] ?>
                        <?php if (empty($guestbook_entries)): ?>
                            <p class="text-gray-500 italic">Be the first to share a memory...</p>
                        <?php else: ?>
                            <?php foreach ($guestbook_entries as $entry): ?>
                                <div class="py-2 pl-4 border-sage border-l-4">
                                    <p class="mb-2 text-gray-700"><?= esc($entry['message']) ?></p>
                                    <p class="text-gray-500 text-sm">- <?= esc($entry['name']) ?>, <?= esc($entry['date']) ?></p>
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>

                    <form class="space-y-4">
                        <input type="text" placeholder="Your Name" class="p-3 border border-gray-300 focus:border-sage rounded focus:ring-1 focus:ring-sage w-full">
                        <textarea placeholder="Share your memory..." rows="4" class="p-3 border border-gray-300 focus:border-sage rounded focus:ring-1 focus:ring-sage w-full"></textarea>
                        <button type="submit" class="bg-sage hover:bg-sage-dark px-6 py-3 rounded text-white transition duration-300">
                            Share Memory
                        </button>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Service Information -->
                <div class="bg-white shadow p-6 rounded-lg">
                    <h3 class="mb-4 font-bold text-gray-800 text-lg">
                        <i class="mr-2 text-sage fas fa-calendar"></i>Service Information
                    </h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="font-semibold text-gray-700">Viewing</p>
                            <p class="text-gray-600"><?= esc($obituary['viewing_date'] ?? 'January 5, 2025 - 2:00 PM to 6:00 PM') ?></p>
                            <p class="text-gray-600"><?= esc($obituary['viewing_location'] ?? 'Sunset Funeral Home Chapel') ?></p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-700">Funeral Service</p>
                            <p class="text-gray-600"><?= esc($obituary['service_date'] ?? 'January 6, 2025 - 10:00 AM') ?></p>
                            <p class="text-gray-600"><?= esc($obituary['service_location'] ?? 'St. Mary\'s Church') ?></p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-700">Burial</p>
                            <p class="text-gray-600"><?= esc($obituary['burial_date'] ?? 'January 6, 2025 - 12:00 PM') ?></p>
                            <p class="text-gray-600"><?= esc($obituary['burial_location'] ?? 'Peaceful Rest Cemetery') ?></p>
                        </div>
                    </div>
                </div>

                <!-- Memorial Donations -->
                <div class="bg-white shadow p-6 rounded-lg">
                    <h3 class="mb-4 font-bold text-gray-800 text-lg">
                        <i class="mr-2 text-sage fas fa-hand-holding-heart"></i>Memorial Donations
                    </h3>
                    <p class="mb-3 text-gray-600 text-sm">
                        In lieu of flowers, the family requests donations be made to:
                    </p>
                    <div class="text-gray-700 text-sm">
                        <p class="font-semibold"><?= esc($obituary['charity_name'] ?? 'American Heart Association') ?></p>
                        <p><?= esc($obituary['charity_address'] ?? '123 Charity Lane, Springfield, IL 62701') ?></p>
                    </div>
                </div>

                <!-- Share -->
                <div class="bg-white shadow p-6 rounded-lg">
                    <h3 class="mb-4 font-bold text-gray-800 text-lg">
                        <i class="mr-2 text-sage fas fa-share"></i>Share Memorial
                    </h3>
                    <div class="flex space-x-3">
                        <button class="flex-1 bg-blue-600 hover:bg-blue-700 px-3 py-2 rounded text-white text-sm transition">
                            <i class="mr-1 fab fa-facebook"></i>Facebook
                        </button>
                        <button class="flex-1 bg-gray-800 hover:bg-gray-900 px-3 py-2 rounded text-white text-sm transition">
                            <i class="mr-1 fas fa-link"></i>Copy Link
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>