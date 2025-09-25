<?php

/**
 * Timeline Obituary Design
 * Life journey presented as an interactive timeline
 */
?>

<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => $obituary['name'] ?? 'Memorial']) ?>

<body class="bg-gradient-to-br from-indigo-50 to-purple-50 font-sans">
    <?= view('components/header') ?>

    <main class="mx-auto px-4 py-8 max-w-6xl">
        <!-- Hero Section -->
        <div class="bg-white shadow-xl mb-8 rounded-3xl overflow-hidden">
            <div class="relative bg-gradient-to-r from-indigo-600 to-purple-600 h-96">
                <div class="absolute inset-0 bg-black/30"></div>
                <div class="relative flex justify-center items-center h-full">
                    <div class="text-white text-center">
                        <div class="mx-auto mb-6 border-4 border-white/30 rounded-full w-32 h-32 overflow-hidden">
                            <img src="<?= esc($obituary['photo'] ?? '/logo/default-profile.jpg') ?>"
                                alt="<?= esc($obituary['name'] ?? 'Memorial Photo') ?>"
                                class="w-full h-full object-cover">
                        </div>
                        <h1 class="mb-4 font-bold text-5xl"><?= esc($obituary['name'] ?? 'Dr. Emily Catherine Johnson') ?></h1>
                        <p class="mb-2 text-2xl"><?= esc($obituary['title'] ?? 'Physician • Mother • Humanitarian') ?></p>
                        <div class="text-xl">
                            <?= esc($obituary['birth_year'] ?? '1960') ?> - <?= esc($obituary['death_year'] ?? '2024') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline Navigation -->
        <div class="bg-white shadow-lg mb-8 p-6 rounded-2xl">
            <div class="flex flex-wrap justify-center gap-4">
                <button onclick="scrollToSection('early-life')" class="bg-indigo-100 hover:bg-indigo-200 px-4 py-2 rounded-full text-indigo-700 transition">
                    Early Life
                </button>
                <button onclick="scrollToSection('education')" class="bg-indigo-100 hover:bg-indigo-200 px-4 py-2 rounded-full text-indigo-700 transition">
                    Education
                </button>
                <button onclick="scrollToSection('career')" class="bg-indigo-100 hover:bg-indigo-200 px-4 py-2 rounded-full text-indigo-700 transition">
                    Career
                </button>
                <button onclick="scrollToSection('family')" class="bg-indigo-100 hover:bg-indigo-200 px-4 py-2 rounded-full text-indigo-700 transition">
                    Family
                </button>
                <button onclick="scrollToSection('legacy')" class="bg-indigo-100 hover:bg-indigo-200 px-4 py-2 rounded-full text-indigo-700 transition">
                    Legacy
                </button>
            </div>
        </div>

        <!-- Timeline Content -->
        <div class="relative">
            <!-- Central Timeline Line -->
            <div class="left-1/2 absolute bg-gradient-to-b from-indigo-300 to-purple-300 w-0.5 h-full -translate-x-px transform"></div>

            <!-- Timeline Items -->
            <div class="space-y-12">
                <!-- Early Life -->
                <div id="early-life" class="relative">
                    <div class="flex lg:flex-row flex-col items-center">
                        <div class="lg:pr-8 lg:w-1/2">
                            <div class="bg-white shadow-lg ml-6 lg:ml-0 p-8 rounded-2xl">
                                <div class="flex items-center mb-4">
                                    <div class="flex justify-center items-center bg-indigo-100 mr-4 rounded-full w-12 h-12">
                                        <i class="text-indigo-600 fas fa-baby"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-800 text-2xl">Early Life</h3>
                                        <p class="font-medium text-indigo-600">1960 - 1978</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 leading-relaxed">
                                    <?= esc($obituary['early_life'] ?? 'Born in Boston, Massachusetts, Emily showed an early interest in helping others. As the youngest of four children, she was known for caring for injured animals and organizing neighborhood "medical checkups" for her dolls and pets.') ?>
                                </p>
                            </div>
                        </div>
                        <div class="mt-6 lg:mt-0 lg:pl-8 lg:w-1/2">
                            <div class="bg-gray-200 rounded-2xl w-full h-64 overflow-hidden">
                                <img src="<?= esc($obituary['early_photo'] ?? '/logo/default-profile.jpg') ?>"
                                    alt="Early life" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                    <!-- Timeline Dot -->
                    <div class="left-1/2 absolute bg-indigo-500 shadow-lg border-4 border-white rounded-full w-6 h-6 -translate-x-1/2 transform"></div>
                </div>

                <!-- Education -->
                <div id="education" class="relative">
                    <div class="flex lg:flex-row-reverse flex-col items-center">
                        <div class="lg:pl-8 lg:w-1/2">
                            <div class="bg-white shadow-lg mr-6 lg:mr-0 p-8 rounded-2xl">
                                <div class="flex items-center mb-4">
                                    <div class="flex justify-center items-center bg-purple-100 mr-4 rounded-full w-12 h-12">
                                        <i class="text-purple-600 fas fa-graduation-cap"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-800 text-2xl">Education</h3>
                                        <p class="font-medium text-purple-600">1978 - 1990</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 leading-relaxed">
                                    <?= esc($obituary['education'] ?? 'Emily excelled at Harvard University, graduating summa cum laude with a degree in Biology. She then attended Johns Hopkins Medical School, where she specialized in pediatric medicine and graduated at the top of her class in 1986.') ?>
                                </p>
                            </div>
                        </div>
                        <div class="mt-6 lg:mt-0 lg:pr-8 lg:w-1/2">
                            <div class="bg-gray-200 rounded-2xl w-full h-64 overflow-hidden">
                                <img src="<?= esc($obituary['education_photo'] ?? '/logo/default-profile.jpg') ?>"
                                    alt="Education years" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                    <!-- Timeline Dot -->
                    <div class="left-1/2 absolute bg-purple-500 shadow-lg border-4 border-white rounded-full w-6 h-6 -translate-x-1/2 transform"></div>
                </div>

                <!-- Career -->
                <div id="career" class="relative">
                    <div class="flex lg:flex-row flex-col items-center">
                        <div class="lg:pr-8 lg:w-1/2">
                            <div class="bg-white shadow-lg ml-6 lg:ml-0 p-8 rounded-2xl">
                                <div class="flex items-center mb-4">
                                    <div class="flex justify-center items-center bg-indigo-100 mr-4 rounded-full w-12 h-12">
                                        <i class="text-indigo-600 fas fa-stethoscope"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-800 text-2xl">Medical Career</h3>
                                        <p class="font-medium text-indigo-600">1986 - 2020</p>
                                    </div>
                                </div>
                                <div class="space-y-4 text-gray-700">
                                    <p>
                                        <?= esc($obituary['career_start'] ?? 'Dr. Johnson began her career at Children\'s Hospital Boston, where she quickly became known for her compassionate care and innovative treatment approaches.') ?>
                                    </p>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h4 class="mb-2 font-semibold">Career Highlights:</h4>
                                        <ul class="space-y-1 text-sm list-disc list-inside">
                                            <?php
                                            $achievements = $obituary['achievements'] ?? [
                                                'Chief of Pediatrics (2000-2020)',
                                                'Published 50+ research papers',
                                                'Established free clinic for underserved children',
                                                'Received Humanitarian Award 2015'
                                            ];
                                            ?>
                                            <?php foreach ($achievements as $achievement): ?>
                                                <li><?= esc($achievement) ?></li>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 lg:mt-0 lg:pl-8 lg:w-1/2">
                            <div class="bg-gray-200 rounded-2xl w-full h-64 overflow-hidden">
                                <img src="<?= esc($obituary['career_photo'] ?? '/logo/default-profile.jpg') ?>"
                                    alt="Medical career" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                    <!-- Timeline Dot -->
                    <div class="left-1/2 absolute bg-indigo-500 shadow-lg border-4 border-white rounded-full w-6 h-6 -translate-x-1/2 transform"></div>
                </div>

                <!-- Family -->
                <div id="family" class="relative">
                    <div class="flex lg:flex-row-reverse flex-col items-center">
                        <div class="lg:pl-8 lg:w-1/2">
                            <div class="bg-white shadow-lg mr-6 lg:mr-0 p-8 rounded-2xl">
                                <div class="flex items-center mb-4">
                                    <div class="flex justify-center items-center bg-purple-100 mr-4 rounded-full w-12 h-12">
                                        <i class="text-purple-600 fas fa-heart"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-800 text-2xl">Family Life</h3>
                                        <p class="font-medium text-purple-600">1985 - Present</p>
                                    </div>
                                </div>
                                <p class="mb-4 text-gray-700 leading-relaxed">
                                    <?= esc($obituary['family_life'] ?? 'Emily married her medical school classmate, Dr. Robert Johnson, in 1985. Together they raised three wonderful children: Sarah, Michael, and David. Family time was precious, filled with camping trips, medical missions abroad, and teaching moments.') ?>
                                </p>
                                <div class="bg-purple-50 p-4 rounded-lg">
                                    <p class="font-medium text-purple-800 text-sm">
                                        <?= esc($obituary['family_survived'] ?? 'Survived by: Husband Robert, children Sarah (Mark), Michael (Jennifer), David (Lisa), and 6 grandchildren') ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 lg:mt-0 lg:pr-8 lg:w-1/2">
                            <div class="gap-2 grid grid-cols-2">
                                <div class="bg-gray-200 rounded-xl h-32 overflow-hidden">
                                    <img src="<?= esc($obituary['family_photo1'] ?? '/logo/default-profile.jpg') ?>"
                                        alt="Family photo" class="w-full h-full object-cover">
                                </div>
                                <div class="bg-gray-200 rounded-xl h-32 overflow-hidden">
                                    <img src="<?= esc($obituary['family_photo2'] ?? '/logo/default-profile.jpg') ?>"
                                        alt="Family photo" class="w-full h-full object-cover">
                                </div>
                                <div class="col-span-2 bg-gray-200 rounded-xl h-32 overflow-hidden">
                                    <img src="<?= esc($obituary['family_photo3'] ?? '/logo/default-profile.jpg') ?>"
                                        alt="Family photo" class="w-full h-full object-cover">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Timeline Dot -->
                    <div class="left-1/2 absolute bg-purple-500 shadow-lg border-4 border-white rounded-full w-6 h-6 -translate-x-1/2 transform"></div>
                </div>

                <!-- Legacy -->
                <div id="legacy" class="relative">
                    <div class="text-center">
                        <div class="bg-white shadow-lg mx-auto p-8 rounded-2xl max-w-4xl">
                            <div class="flex justify-center items-center mb-6">
                                <div class="flex justify-center items-center bg-gradient-to-r from-indigo-100 to-purple-100 mr-4 rounded-full w-16 h-16">
                                    <i class="text-indigo-600 text-2xl fas fa-star"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800 text-3xl">Her Lasting Legacy</h3>
                                    <p class="font-medium text-indigo-600">Forever in Our Hearts</p>
                                </div>
                            </div>
                            <p class="mb-6 text-gray-700 text-xl leading-relaxed">
                                <?= esc($obituary['legacy'] ?? 'Dr. Emily Johnson\'s impact extends far beyond her medical practice. She touched thousands of lives through her compassionate care, mentorship of young doctors, and dedication to serving underserved communities. Her legacy lives on through the Emily Johnson Foundation, which continues her mission of providing medical care to children worldwide.') ?>
                            </p>
                            <div class="gap-6 grid md:grid-cols-3 mt-8">
                                <div class="text-center">
                                    <div class="font-bold text-indigo-600 text-3xl"><?= esc($obituary['patients_helped'] ?? '10,000+') ?></div>
                                    <p class="text-gray-600">Patients Helped</p>
                                </div>
                                <div class="text-center">
                                    <div class="font-bold text-purple-600 text-3xl"><?= esc($obituary['doctors_trained'] ?? '200+') ?></div>
                                    <p class="text-gray-600">Doctors Trained</p>
                                </div>
                                <div class="text-center">
                                    <div class="font-bold text-indigo-600 text-3xl"><?= esc($obituary['years_service'] ?? '34') ?></div>
                                    <p class="text-gray-600">Years of Service</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Timeline Dot -->
                    <div class="left-1/2 absolute bg-gradient-to-r from-indigo-500 to-purple-500 shadow-lg border-4 border-white rounded-full w-8 h-8 -translate-x-1/2 transform"></div>
                </div>
            </div>
        </div>

        <!-- Service Information & Actions -->
        <div class="gap-8 grid lg:grid-cols-2 mt-16">
            <!-- Services -->
            <div class="bg-white shadow-lg p-8 rounded-2xl">
                <h3 class="mb-6 font-bold text-gray-800 text-2xl text-center">
                    <i class="mr-2 text-indigo-600 fas fa-calendar"></i>Memorial Services
                </h3>
                <div class="space-y-6">
                    <div class="bg-indigo-50 p-6 rounded-xl">
                        <h4 class="mb-2 font-semibold text-gray-800 text-xl">Celebration of Life</h4>
                        <p class="mb-1 text-gray-600"><?= esc($obituary['celebration_date'] ?? 'January 8, 2025 at 2:00 PM') ?></p>
                        <p class="mb-3 text-gray-600"><?= esc($obituary['celebration_location'] ?? 'Boston Convention Center, Grand Ballroom') ?></p>
                        <p class="text-gray-500 text-sm">Reception to follow</p>
                    </div>
                    <div class="bg-purple-50 p-6 rounded-xl">
                        <h4 class="mb-2 font-semibold text-gray-800 text-xl">Private Burial</h4>
                        <p class="text-gray-600"><?= esc($obituary['burial_info'] ?? 'Family burial service at Mount Auburn Cemetery') ?></p>
                    </div>
                </div>
            </div>

            <!-- Memorial Fund -->
            <div class="bg-white shadow-lg p-8 rounded-2xl">
                <h3 class="mb-6 font-bold text-gray-800 text-2xl text-center">
                    <i class="mr-2 text-purple-600 fas fa-hands-helping"></i>Memorial Fund
                </h3>
                <p class="mb-6 text-gray-600 text-center">
                    Continue Emily's mission of healing and helping others
                </p>
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 mb-6 p-6 rounded-xl">
                    <h4 class="mb-2 font-semibold text-gray-800 text-lg">Emily Johnson Foundation</h4>
                    <p class="mb-3 text-gray-600 text-sm">Providing medical care to underserved children worldwide</p>
                    <button class="bg-gradient-to-r from-indigo-600 hover:from-indigo-700 to-purple-600 hover:to-purple-700 px-4 py-3 rounded-lg w-full text-white transition">
                        Donate Now
                    </button>
                </div>
                <div class="space-y-3">
                    <button class="bg-blue-600 hover:bg-blue-700 px-4 py-3 rounded-lg w-full text-white transition">
                        Share Memorial
                    </button>
                    <button class="bg-gray-100 hover:bg-gray-200 px-4 py-3 rounded-lg w-full text-gray-800 transition">
                        Sign Guestbook
                    </button>
                </div>
            </div>
        </div>
    </main>

    <?= view('components/footer') ?>

    <script>
        function scrollToSection(sectionId) {
            document.getElementById(sectionId).scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
    </script>
</body>

</html>