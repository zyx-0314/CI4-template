<?php

/**
 * Modern Obituary Design
 * Clean, contemporary layout with card-based design
 */
?>

<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => $obituary['name'] ?? 'Memorial']) ?>

<body class="bg-gradient-to-br from-slate-100 to-slate-200 font-sans">
    <?= view('components/header') ?>

    <main class="mx-auto px-4 py-8 max-w-6xl">
        <!-- Hero Section -->
        <div class="relative bg-white shadow-xl mb-8 rounded-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 to-slate-700/90"></div>
            <div class="relative flex items-center h-96">
                <div class="px-8 py-12 w-full">
                    <div class="flex md:flex-row flex-col items-center gap-8">
                        <div class="relative">
                            <div class="shadow-2xl border-4 border-white/20 rounded-full w-40 h-40 overflow-hidden">
                                <img src="<?= esc($obituary['photo'] ?? '/logo/default-profile.jpg') ?>"
                                    alt="<?= esc($obituary['name'] ?? 'Memorial Photo') ?>"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="-top-2 -right-2 absolute flex justify-center items-center bg-white/10 backdrop-blur-sm rounded-full w-16 h-16">
                                <i class="text-white text-xl fas fa-star"></i>
                            </div>
                        </div>
                        <div class="text-white md:text-left text-center">
                            <h1 class="mb-3 font-light text-5xl"><?= esc($obituary['name'] ?? 'Jane Smith') ?></h1>
                            <div class="flex md:flex-row flex-col items-center md:items-start gap-2 mb-4">
                                <span class="bg-white/20 px-4 py-2 rounded-full text-lg">
                                    <?= esc($obituary['birth_date'] ?? 'March 15, 1955') ?>
                                </span>
                                <span class="font-light text-2xl">—</span>
                                <span class="bg-white/20 px-4 py-2 rounded-full text-lg">
                                    <?= esc($obituary['death_date'] ?? 'December 28, 2024') ?>
                                </span>
                            </div>
                            <p class="text-white/80 text-xl"><?= esc($obituary['subtitle'] ?? 'Beloved Mother, Teacher, and Friend') ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="gap-8 grid lg:grid-cols-4">
            <!-- Main Content -->
            <div class="space-y-6 lg:col-span-3">
                <!-- Life Story -->
                <div class="bg-white shadow-lg p-8 rounded-xl">
                    <div class="flex items-center mb-6">
                        <div class="flex justify-center items-center bg-sage/10 mr-4 rounded-full w-12 h-12">
                            <i class="text-sage text-xl fas fa-book-open"></i>
                        </div>
                        <h2 class="font-light text-gray-800 text-3xl">Her Story</h2>
                    </div>
                    <div class="max-w-none text-gray-600 prose prose-lg">
                        <p class="mb-6 text-xl leading-relaxed">
                            <?= esc($obituary['opening'] ?? 'Jane Smith, age 69, passed peacefully surrounded by loved ones on December 28, 2024. Her life was a testament to compassion, dedication, and the power of education to change lives.') ?>
                        </p>
                        <div class="gap-8 grid md:grid-cols-2">
                            <div>
                                <h4 class="mb-3 font-semibold text-gray-800 text-lg">Early Life & Career</h4>
                                <p><?= esc($obituary['early_life'] ?? 'Born in Chicago, Jane dedicated over 30 years to teaching elementary school, touching the lives of hundreds of students. She believed every child had potential waiting to be unlocked.') ?></p>
                            </div>
                            <div>
                                <h4 class="mb-3 font-semibold text-gray-800 text-lg">Family & Passions</h4>
                                <p><?= esc($obituary['family_passions'] ?? 'A devoted mother of three and grandmother of seven, Jane loved gardening, painting watercolors, and volunteering at the local animal shelter.') ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Photo Gallery -->
                <div class="bg-white shadow-lg p-8 rounded-xl">
                    <div class="flex items-center mb-6">
                        <div class="flex justify-center items-center bg-sage/10 mr-4 rounded-full w-12 h-12">
                            <i class="text-sage text-xl fas fa-images"></i>
                        </div>
                        <h3 class="font-light text-gray-800 text-2xl">Treasured Memories</h3>
                    </div>
                    <div class="gap-4 grid grid-cols-2 md:grid-cols-4">
                        <?php
                        $gallery_images = $obituary['gallery'] ?? [
                            ['src' => '/logo/default-profile.jpg', 'caption' => 'Teaching days'],
                            ['src' => '/logo/default-profile.jpg', 'caption' => 'Family vacation'],
                            ['src' => '/logo/default-profile.jpg', 'caption' => 'Graduation ceremony'],
                            ['src' => '/logo/default-profile.jpg', 'caption' => 'Garden flowers']
                        ];
                        ?>
                        <?php foreach ($gallery_images as $image): ?>
                            <div class="group cursor-pointer">
                                <div class="bg-gray-100 rounded-lg aspect-square overflow-hidden">
                                    <img src="<?= esc($image['src']) ?>"
                                        alt="<?= esc($image['caption']) ?>"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                </div>
                                <p class="mt-2 text-gray-600 text-sm text-center"><?= esc($image['caption']) ?></p>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>

                <!-- Memorial Messages -->
                <div class="bg-white shadow-lg p-8 rounded-xl">
                    <div class="flex items-center mb-6">
                        <div class="flex justify-center items-center bg-sage/10 mr-4 rounded-full w-12 h-12">
                            <i class="text-sage text-xl fas fa-comments"></i>
                        </div>
                        <h3 class="font-light text-gray-800 text-2xl">Messages of Love</h3>
                    </div>

                    <!-- Add Message Form -->
                    <div class="bg-gray-50 mb-8 p-6 rounded-lg">
                        <form class="space-y-4">
                            <div class="gap-4 grid md:grid-cols-2">
                                <input type="text" placeholder="Your name"
                                    class="p-3 border border-gray-300 focus:border-sage rounded-lg focus:ring-1 focus:ring-sage">
                                <input type="email" placeholder="Email (optional)"
                                    class="p-3 border border-gray-300 focus:border-sage rounded-lg focus:ring-1 focus:ring-sage">
                            </div>
                            <textarea placeholder="Share your memory or condolences..." rows="3"
                                class="p-3 border border-gray-300 focus:border-sage rounded-lg focus:ring-1 focus:ring-sage w-full"></textarea>
                            <button type="submit" class="bg-sage hover:bg-sage-dark px-8 py-3 rounded-lg text-white transition duration-300">
                                <i class="mr-2 fas fa-heart"></i>Share Message
                            </button>
                        </form>
                    </div>

                    <!-- Messages -->
                    <div class="space-y-6">
                        <?php $messages = $obituary['messages'] ?? [] ?>
                        <?php if (empty($messages)): ?>
                            <p class="py-8 text-gray-500 text-center">No messages yet. Be the first to share your memory.</p>
                        <?php else: ?>
                            <?php foreach ($messages as $message): ?>
                                <div class="py-4 pl-6 border-sage/30 border-l-4">
                                    <p class="mb-3 text-gray-700"><?= esc($message['content']) ?></p>
                                    <div class="flex items-center text-gray-500 text-sm">
                                        <div class="flex justify-center items-center bg-sage/10 mr-3 rounded-full w-8 h-8">
                                            <i class="text-sage fas fa-user"></i>
                                        </div>
                                        <span class="font-medium"><?= esc($message['name']) ?></span>
                                        <span class="mx-2">•</span>
                                        <span><?= esc($message['date']) ?></span>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Service Details -->
                <div class="bg-white shadow-lg p-6 rounded-xl">
                    <h4 class="mb-4 font-semibold text-gray-800 text-xl">
                        <i class="mr-2 text-sage fas fa-calendar-alt"></i>Services
                    </h4>
                    <div class="space-y-4">
                        <div class="bg-sage/5 p-4 rounded-lg">
                            <h5 class="font-medium text-gray-800">Visitation</h5>
                            <p class="mt-1 text-gray-600 text-sm"><?= esc($obituary['visitation'] ?? 'January 3, 2025, 4-8 PM') ?></p>
                            <p class="text-gray-600 text-sm"><?= esc($obituary['visitation_location'] ?? 'Sunset Funeral Home') ?></p>
                        </div>
                        <div class="bg-sage/5 p-4 rounded-lg">
                            <h5 class="font-medium text-gray-800">Memorial Service</h5>
                            <p class="mt-1 text-gray-600 text-sm"><?= esc($obituary['memorial_service'] ?? 'January 4, 2025, 2:00 PM') ?></p>
                            <p class="text-gray-600 text-sm"><?= esc($obituary['memorial_location'] ?? 'First Presbyterian Church') ?></p>
                        </div>
                    </div>
                </div>

                <!-- Memorial Fund -->
                <div class="bg-white shadow-lg p-6 rounded-xl">
                    <h4 class="mb-4 font-semibold text-gray-800 text-xl">
                        <i class="mr-2 text-sage fas fa-seedling"></i>Memorial Fund
                    </h4>
                    <p class="mb-4 text-gray-600 text-sm">
                        Honor Jane's memory with a donation to causes she loved.
                    </p>
                    <div class="space-y-3">
                        <div class="p-3 border border-gray-200 rounded-lg">
                            <p class="font-medium text-gray-800">Education Foundation</p>
                            <p class="text-gray-600 text-sm">Supporting local schools</p>
                        </div>
                        <div class="p-3 border border-gray-200 rounded-lg">
                            <p class="font-medium text-gray-800">Animal Shelter</p>
                            <p class="text-gray-600 text-sm">Helping rescue animals</p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white shadow-lg p-6 rounded-xl">
                    <h4 class="mb-4 font-semibold text-gray-800 text-xl">
                        <i class="mr-2 text-sage fas fa-share-alt"></i>Share
                    </h4>
                    <div class="space-y-3">
                        <button class="bg-blue-600 hover:bg-blue-700 px-4 py-3 rounded-lg w-full text-white transition">
                            <i class="mr-2 fab fa-facebook"></i>Share on Facebook
                        </button>
                        <button class="bg-gray-100 hover:bg-gray-200 px-4 py-3 rounded-lg w-full text-gray-800 transition">
                            <i class="mr-2 fas fa-link"></i>Copy Memorial Link
                        </button>
                        <button class="bg-gray-100 hover:bg-gray-200 px-4 py-3 rounded-lg w-full text-gray-800 transition">
                            <i class="mr-2 fas fa-download"></i>Download Program
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>