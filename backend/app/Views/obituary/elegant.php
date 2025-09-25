<?php

/**
 * Elegant Obituary Design
 * Sophisticated layout with floral elements and soft colors
 */
?>

<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => $obituary['name'] ?? 'Memorial']) ?>

<body class="bg-gradient-to-b from-rose-50 to-pink-50 font-serif">
    <?= view('components/header') ?>

    <main class="mx-auto px-4 py-12 max-w-5xl">
        <!-- Header with Decorative Border -->
        <div class="relative bg-white shadow-2xl mb-12 rounded-3xl overflow-hidden">
            <!-- Decorative top border -->
            <div class="bg-gradient-to-r from-rose-300 via-pink-300 to-rose-300 h-2"></div>

            <div class="p-12">
                <div class="mb-8 text-center">
                    <!-- Decorative flourish -->
                    <div class="mb-4 text-rose-300 text-6xl">❀</div>
                    <h1 class="mb-4 font-light text-gray-800 text-5xl"><?= esc($obituary['name'] ?? 'Margaret Rose Williams') ?></h1>
                    <div class="flex justify-center items-center space-x-4 text-gray-600 text-xl">
                        <span><?= esc($obituary['birth_date'] ?? 'June 12, 1945') ?></span>
                        <span class="text-rose-300">✦</span>
                        <span><?= esc($obituary['death_date'] ?? 'December 20, 2024') ?></span>
                    </div>
                    <p class="mt-4 font-light text-rose-600 text-2xl italic">
                        "<?= esc($obituary['quote'] ?? 'Love never ends') ?>"
                    </p>
                </div>

                <div class="flex lg:flex-row flex-col items-center gap-12">
                    <!-- Photo with decorative frame -->
                    <div class="relative flex-shrink-0">
                        <div class="shadow-xl border-8 border-rose-100 rounded-full w-64 h-64 overflow-hidden">
                            <img src="<?= esc($obituary['photo'] ?? '/logo/default-profile.jpg') ?>"
                                alt="<?= esc($obituary['name'] ?? 'Memorial Photo') ?>"
                                class="w-full h-full object-cover">
                        </div>
                        <!-- Decorative corner elements -->
                        <div class="-top-4 -left-4 absolute text-rose-200 text-4xl">❀</div>
                        <div class="-top-4 -right-4 absolute text-rose-200 text-4xl">❀</div>
                        <div class="-bottom-4 -left-4 absolute text-rose-200 text-4xl">❀</div>
                        <div class="-right-4 -bottom-4 absolute text-rose-200 text-4xl">❀</div>
                    </div>

                    <!-- Intro Text -->
                    <div class="lg:text-left text-center">
                        <div class="space-y-4 text-gray-700 text-xl leading-relaxed">
                            <p class="italic">
                                <?= esc($obituary['intro'] ?? 'With profound sadness and beautiful memories, we announce the peaceful passing of our beloved Margaret Rose Williams.') ?>
                            </p>
                            <p>
                                <?= esc($obituary['summary'] ?? 'Margaret was a beacon of love, grace, and wisdom who touched countless lives throughout her 79 years. Her legacy of compassion and joy will forever bloom in the hearts of those who knew her.') ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Sections -->
        <div class="gap-8 grid lg:grid-cols-3">
            <!-- Main Content -->
            <div class="space-y-8 lg:col-span-2">
                <!-- Life Journey -->
                <div class="bg-white/80 shadow-lg backdrop-blur p-8 rounded-2xl">
                    <div class="mb-8 text-center">
                        <div class="mb-2 text-rose-300 text-4xl">🌸</div>
                        <h2 class="font-light text-gray-800 text-3xl">A Beautiful Life</h2>
                        <div class="bg-rose-300 mx-auto mt-4 w-24 h-px"></div>
                    </div>

                    <div class="space-y-6 text-gray-700 text-lg leading-relaxed">
                        <p>
                            <?= esc($obituary['early_life'] ?? 'Born in the spring of 1945 in Portland, Oregon, Margaret grew up surrounded by the beauty of nature that would inspire her lifelong love of gardening and flowers. She was the eldest of four children and learned early the values of care and responsibility.') ?>
                        </p>

                        <p>
                            <?= esc($obituary['career'] ?? 'After graduating from Oregon State University with a degree in Elementary Education, Margaret devoted 35 years to teaching young minds. Her classroom was known for its warmth, creativity, and the small garden where children learned to nurture both plants and friendships.') ?>
                        </p>

                        <p>
                            <?= esc($obituary['family'] ?? 'In 1968, she married her college sweetheart, Robert Williams, and together they built a loving home filled with laughter, music, and the aroma of her famous apple pies. They were blessed with three children: Elizabeth, Michael, and Sarah, and later with eight grandchildren who were the light of her eyes.') ?>
                        </p>
                    </div>
                </div>

                <!-- Memories & Tributes -->
                <div class="bg-white/80 shadow-lg backdrop-blur p-8 rounded-2xl">
                    <div class="mb-8 text-center">
                        <div class="mb-2 text-rose-300 text-4xl">💝</div>
                        <h3 class="font-light text-gray-800 text-3xl">Memories & Tributes</h3>
                        <div class="bg-rose-300 mx-auto mt-4 w-24 h-px"></div>
                    </div>

                    <!-- Add Memory Form -->
                    <div class="bg-rose-50/50 mb-8 p-6 border border-rose-100 rounded-xl">
                        <h4 class="mb-4 font-light text-gray-800 text-xl">Share a Memory</h4>
                        <form class="space-y-4">
                            <div class="gap-4 grid md:grid-cols-2">
                                <input type="text" placeholder="Your name"
                                    class="bg-white/70 p-4 border-2 border-rose-100 focus:border-rose-300 rounded-lg focus:ring-0">
                                <select class="bg-white/70 p-4 border-2 border-rose-100 focus:border-rose-300 rounded-lg focus:ring-0">
                                    <option>Relationship to Margaret</option>
                                    <option>Family</option>
                                    <option>Friend</option>
                                    <option>Former Student</option>
                                    <option>Colleague</option>
                                    <option>Neighbor</option>
                                </select>
                            </div>
                            <textarea placeholder="Share your favorite memory of Margaret..." rows="4"
                                class="bg-white/70 p-4 border-2 border-rose-100 focus:border-rose-300 rounded-lg focus:ring-0 w-full"></textarea>
                            <button type="submit" class="bg-rose-400 hover:bg-rose-500 px-8 py-3 rounded-lg font-light text-white transition duration-300">
                                <i class="mr-2 fas fa-heart"></i>Share Memory
                            </button>
                        </form>
                    </div>

                    <!-- Memory Cards -->
                    <div class="space-y-6">
                        <?php
                        $memories = $obituary['memories'] ?? [
                            [
                                'name' => 'Former Student',
                                'relationship' => 'Student',
                                'memory' => 'Mrs. Williams taught me in 3rd grade. She made learning magical and always believed in every student. Her flower garden lessons taught me more than just botany - they taught me patience and care.',
                                'date' => '2 days ago'
                            ]
                        ];
                        ?>
                        <?php if (empty($memories)): ?>
                            <div class="py-12 text-center">
                                <div class="mb-4 text-rose-200 text-6xl">🌹</div>
                                <p class="text-gray-500 italic">Be the first to share a memory of Margaret...</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($memories as $memory): ?>
                                <div class="bg-white/70 shadow-sm p-6 border border-rose-100 rounded-xl">
                                    <div class="flex items-start gap-4">
                                        <div class="flex justify-center items-center bg-rose-100 rounded-full w-12 h-12">
                                            <i class="text-rose-400 fas fa-user"></i>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-2">
                                                <h5 class="font-semibold text-gray-800"><?= esc($memory['name']) ?></h5>
                                                <span class="bg-rose-100 px-2 py-1 rounded text-rose-700 text-sm">
                                                    <?= esc($memory['relationship']) ?>
                                                </span>
                                            </div>
                                            <p class="mb-2 text-gray-700 italic">"<?= esc($memory['memory']) ?>"</p>
                                            <p class="text-gray-500 text-sm"><?= esc($memory['date']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Service Information -->
                <div class="bg-white/80 shadow-lg backdrop-blur p-6 rounded-2xl">
                    <div class="mb-6 text-center">
                        <div class="mb-2 text-rose-300 text-3xl">⚘</div>
                        <h4 class="font-light text-gray-800 text-2xl">Celebration of Life</h4>
                        <div class="bg-rose-300 mx-auto mt-2 w-16 h-px"></div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-rose-50/50 p-4 border border-rose-100 rounded-lg text-center">
                            <h5 class="mb-2 font-semibold text-gray-800">Visitation</h5>
                            <p class="text-gray-600"><?= esc($obituary['visitation_date'] ?? 'December 23, 2024') ?></p>
                            <p class="text-gray-600"><?= esc($obituary['visitation_time'] ?? '2:00 PM - 7:00 PM') ?></p>
                            <p class="mt-2 text-gray-500 text-sm"><?= esc($obituary['visitation_location'] ?? 'Sunset Funeral Home') ?></p>
                        </div>

                        <div class="bg-rose-50/50 p-4 border border-rose-100 rounded-lg text-center">
                            <h5 class="mb-2 font-semibold text-gray-800">Memorial Service</h5>
                            <p class="text-gray-600"><?= esc($obituary['service_date'] ?? 'December 24, 2024') ?></p>
                            <p class="text-gray-600"><?= esc($obituary['service_time'] ?? '11:00 AM') ?></p>
                            <p class="mt-2 text-gray-500 text-sm"><?= esc($obituary['service_location'] ?? 'Grace Community Church') ?></p>
                        </div>
                    </div>
                </div>

                <!-- In Lieu of Flowers -->
                <div class="bg-white/80 shadow-lg backdrop-blur p-6 rounded-2xl">
                    <div class="mb-4 text-center">
                        <div class="mb-2 text-rose-300 text-3xl">🌻</div>
                        <h4 class="font-light text-gray-800 text-xl">In Lieu of Flowers</h4>
                        <div class="bg-rose-300 mx-auto mt-2 w-16 h-px"></div>
                    </div>

                    <p class="mb-4 text-gray-600 text-center italic">
                        Margaret would be honored by donations to:
                    </p>

                    <div class="space-y-3">
                        <div class="bg-rose-50/50 p-3 border border-rose-100 rounded-lg text-center">
                            <h6 class="font-semibold text-gray-800"><?= esc($obituary['charity1'] ?? 'Children\'s Education Fund') ?></h6>
                            <p class="text-gray-600 text-sm"><?= esc($obituary['charity1_desc'] ?? 'Supporting local schools') ?></p>
                        </div>
                        <div class="bg-rose-50/50 p-3 border border-rose-100 rounded-lg text-center">
                            <h6 class="font-semibold text-gray-800"><?= esc($obituary['charity2'] ?? 'Community Garden Project') ?></h6>
                            <p class="text-gray-600 text-sm"><?= esc($obituary['charity2_desc'] ?? 'Beautifying neighborhoods') ?></p>
                        </div>
                    </div>
                </div>

                <!-- Family -->
                <div class="bg-white/80 shadow-lg backdrop-blur p-6 rounded-2xl">
                    <div class="mb-4 text-center">
                        <div class="mb-2 text-rose-300 text-3xl">👑</div>
                        <h4 class="font-light text-gray-800 text-xl">Survived By</h4>
                        <div class="bg-rose-300 mx-auto mt-2 w-16 h-px"></div>
                    </div>

                    <div class="space-y-3 text-sm">
                        <div class="bg-rose-50/50 p-3 rounded-lg text-center">
                            <p class="text-gray-700"><?= esc($obituary['survived_by'] ?? 'Loving husband Robert of 56 years; Children: Elizabeth (James), Michael (Sarah), Sarah (David); 8 grandchildren; 2 great-grandchildren; Sister Helen and brother Thomas.') ?></p>
                        </div>
                    </div>
                </div>

                <!-- Share Memorial -->
                <div class="bg-white/80 shadow-lg backdrop-blur p-6 rounded-2xl">
                    <div class="mb-4 text-center">
                        <div class="mb-2 text-rose-300 text-3xl">💌</div>
                        <h4 class="font-light text-gray-800 text-xl">Share Memorial</h4>
                        <div class="bg-rose-300 mx-auto mt-2 w-16 h-px"></div>
                    </div>

                    <div class="space-y-3">
                        <button class="bg-rose-400 hover:bg-rose-500 px-4 py-3 rounded-lg w-full font-light text-white transition">
                            <i class="mr-2 fab fa-facebook"></i>Share on Facebook
                        </button>
                        <button class="bg-rose-100 hover:bg-rose-200 px-4 py-3 rounded-lg w-full font-light text-rose-700 transition">
                            <i class="mr-2 fas fa-envelope"></i>Send via Email
                        </button>
                        <button class="bg-rose-100 hover:bg-rose-200 px-4 py-3 rounded-lg w-full font-light text-rose-700 transition">
                            <i class="mr-2 fas fa-print"></i>Print Memorial
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>