<?php

/**
 * Obituary Index Page
 * Shows listing of available obituary designs for demonstration
 */
?>

<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => 'Obituary & Memorial Pages']) ?>

<body class="bg-gray-50">
    <?= view('components/header') ?>

    <main class="mx-auto px-4 py-12 max-w-6xl">
        <div class="mb-12 text-center">
            <h1 class="mb-4 font-bold text-gray-800 text-4xl">Obituary & Memorial Pages</h1>
            <p class="mx-auto max-w-3xl text-gray-600 text-xl">
                Honor your loved ones with beautiful, personalized memorial pages. Choose from our collection of thoughtfully designed templates.
            </p>
        </div>

        <!-- Design Gallery -->
        <div class="gap-8 grid md:grid-cols-2 lg:grid-cols-3 mb-12">
            <!-- Classic Design -->
            <div class="bg-white shadow-lg hover:shadow-xl rounded-xl overflow-hidden transition duration-300">
                <div class="relative bg-gradient-to-r from-gray-600 to-gray-800 h-48">
                    <div class="absolute inset-0 flex justify-center items-center">
                        <div class="text-white text-center">
                            <i class="mb-3 text-4xl fas fa-crown"></i>
                            <h3 class="font-bold text-2xl">Classic</h3>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h4 class="mb-3 font-semibold text-gray-800 text-xl">Traditional & Elegant</h4>
                    <p class="mb-4 text-gray-600">Timeless design with formal styling, perfect for traditional memorial services.</p>
                    <div class="flex gap-2 mb-4">
                        <span class="bg-gray-100 px-3 py-1 rounded-full text-gray-700 text-sm">Formal</span>
                        <span class="bg-gray-100 px-3 py-1 rounded-full text-gray-700 text-sm">Traditional</span>
                    </div>
                    <a href="<?= base_url('/obituary/classic/1') ?>"
                        class="block bg-gray-800 hover:bg-gray-900 px-4 py-3 rounded-lg w-full text-white text-center transition duration-300">
                        View Sample
                    </a>
                </div>
            </div>

            <!-- Modern Design -->
            <div class="bg-white shadow-lg hover:shadow-xl rounded-xl overflow-hidden transition duration-300">
                <div class="relative bg-gradient-to-r from-slate-600 to-slate-800 h-48">
                    <div class="absolute inset-0 flex justify-center items-center">
                        <div class="text-white text-center">
                            <i class="mb-3 text-4xl fas fa-star"></i>
                            <h3 class="font-bold text-2xl">Modern</h3>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h4 class="mb-3 font-semibold text-gray-800 text-xl">Clean & Contemporary</h4>
                    <p class="mb-4 text-gray-600">Card-based design with photo galleries and interactive elements.</p>
                    <div class="flex gap-2 mb-4">
                        <span class="bg-slate-100 px-3 py-1 rounded-full text-slate-700 text-sm">Interactive</span>
                        <span class="bg-slate-100 px-3 py-1 rounded-full text-slate-700 text-sm">Photo Gallery</span>
                    </div>
                    <a href="<?= base_url('/obituary/modern/2') ?>"
                        class="block bg-slate-700 hover:bg-slate-800 px-4 py-3 rounded-lg w-full text-white text-center transition duration-300">
                        View Sample
                    </a>
                </div>
            </div>

            <!-- Elegant Design -->
            <div class="bg-white shadow-lg hover:shadow-xl rounded-xl overflow-hidden transition duration-300">
                <div class="relative bg-gradient-to-r from-rose-400 to-pink-500 h-48">
                    <div class="absolute inset-0 flex justify-center items-center">
                        <div class="text-white text-center">
                            <i class="mb-3 text-4xl fas fa-heart"></i>
                            <h3 class="font-bold text-2xl">Elegant</h3>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h4 class="mb-3 font-semibold text-gray-800 text-xl">Floral & Sophisticated</h4>
                    <p class="mb-4 text-gray-600">Beautiful floral elements with soft colors and elegant typography.</p>
                    <div class="flex gap-2 mb-4">
                        <span class="bg-rose-100 px-3 py-1 rounded-full text-rose-700 text-sm">Floral</span>
                        <span class="bg-rose-100 px-3 py-1 rounded-full text-rose-700 text-sm">Feminine</span>
                    </div>
                    <a href="<?= base_url('/obituary/elegant/3') ?>"
                        class="block bg-rose-500 hover:bg-rose-600 px-4 py-3 rounded-lg w-full text-white text-center transition duration-300">
                        View Sample
                    </a>
                </div>
            </div>

            <!-- Minimalist Design -->
            <div class="bg-white shadow-lg hover:shadow-xl rounded-xl overflow-hidden transition duration-300">
                <div class="relative bg-gradient-to-r from-gray-400 to-gray-600 h-48">
                    <div class="absolute inset-0 flex justify-center items-center">
                        <div class="text-white text-center">
                            <i class="mb-3 text-4xl fas fa-circle"></i>
                            <h3 class="font-bold text-2xl">Minimalist</h3>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h4 class="mb-3 font-semibold text-gray-800 text-xl">Simple & Clean</h4>
                    <p class="mb-4 text-gray-600">Focus on content with clean typography and minimal distractions.</p>
                    <div class="flex gap-2 mb-4">
                        <span class="bg-gray-100 px-3 py-1 rounded-full text-gray-700 text-sm">Simple</span>
                        <span class="bg-gray-100 px-3 py-1 rounded-full text-gray-700 text-sm">Clean</span>
                    </div>
                    <a href="<?= base_url('/obituary/minimalist/4') ?>"
                        class="block bg-gray-600 hover:bg-gray-700 px-4 py-3 rounded-lg w-full text-white text-center transition duration-300">
                        View Sample
                    </a>
                </div>
            </div>

            <!-- Timeline Design -->
            <div class="bg-white shadow-lg hover:shadow-xl rounded-xl overflow-hidden transition duration-300">
                <div class="relative bg-gradient-to-r from-indigo-500 to-purple-600 h-48">
                    <div class="absolute inset-0 flex justify-center items-center">
                        <div class="text-white text-center">
                            <i class="mb-3 text-4xl fas fa-history"></i>
                            <h3 class="font-bold text-2xl">Timeline</h3>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h4 class="mb-3 font-semibold text-gray-800 text-xl">Life Journey</h4>
                    <p class="mb-4 text-gray-600">Interactive timeline showcasing life milestones and achievements.</p>
                    <div class="flex gap-2 mb-4">
                        <span class="bg-indigo-100 px-3 py-1 rounded-full text-indigo-700 text-sm">Interactive</span>
                        <span class="bg-indigo-100 px-3 py-1 rounded-full text-indigo-700 text-sm">Timeline</span>
                    </div>
                    <a href="<?= base_url('/obituary/timeline/5') ?>"
                        class="block bg-indigo-600 hover:bg-indigo-700 px-4 py-3 rounded-lg w-full text-white text-center transition duration-300">
                        View Sample
                    </a>
                </div>
            </div>

            <!-- Coming Soon -->
            <div class="bg-white opacity-75 shadow-lg hover:shadow-xl rounded-xl overflow-hidden transition duration-300">
                <div class="relative bg-gradient-to-r from-gray-300 to-gray-400 h-48">
                    <div class="absolute inset-0 flex justify-center items-center">
                        <div class="text-white text-center">
                            <i class="mb-3 text-4xl fas fa-plus"></i>
                            <h3 class="font-bold text-2xl">More Designs</h3>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h4 class="mb-3 font-semibold text-gray-800 text-xl">Coming Soon</h4>
                    <p class="mb-4 text-gray-600">We're working on additional beautiful designs for memorial pages.</p>
                    <div class="flex gap-2 mb-4">
                        <span class="bg-gray-100 px-3 py-1 rounded-full text-gray-700 text-sm">Coming Soon</span>
                    </div>
                    <button disabled
                        class="block bg-gray-400 px-4 py-3 rounded-lg w-full text-white text-center cursor-not-allowed">
                        Coming Soon
                    </button>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-white shadow-lg mb-12 p-8 rounded-2xl">
            <h2 class="mb-8 font-bold text-gray-800 text-3xl text-center">Memorial Page Features</h2>
            <div class="gap-8 grid md:grid-cols-3">
                <div class="text-center">
                    <div class="flex justify-center items-center bg-sage/10 mx-auto mb-4 rounded-full w-16 h-16">
                        <i class="text-sage text-2xl fas fa-images"></i>
                    </div>
                    <h3 class="mb-3 font-semibold text-gray-800 text-xl">Photo Galleries</h3>
                    <p class="text-gray-600">Share cherished memories with beautiful photo galleries and image collections.</p>
                </div>
                <div class="text-center">
                    <div class="flex justify-center items-center bg-sage/10 mx-auto mb-4 rounded-full w-16 h-16">
                        <i class="text-sage text-2xl fas fa-comments"></i>
                    </div>
                    <h3 class="mb-3 font-semibold text-gray-800 text-xl">Guest Messages</h3>
                    <p class="text-gray-600">Allow friends and family to share condolences and favorite memories.</p>
                </div>
                <div class="text-center">
                    <div class="flex justify-center items-center bg-sage/10 mx-auto mb-4 rounded-full w-16 h-16">
                        <i class="text-sage text-2xl fas fa-heart"></i>
                    </div>
                    <h3 class="mb-3 font-semibold text-gray-800 text-xl">Memorial Donations</h3>
                    <p class="text-gray-600">Direct donations to meaningful charities and causes in memory of your loved one.</p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center">
            <h2 class="mb-4 font-bold text-gray-800 text-3xl">Need Help Creating a Memorial?</h2>
            <p class="mx-auto mb-8 max-w-2xl text-gray-600 text-xl">
                Our compassionate team is here to help you create a beautiful memorial page that honors your loved one's memory.
            </p>
            <div class="flex sm:flex-row flex-col justify-center gap-4">
                <a href="<?= base_url('/services') ?>"
                    class="bg-sage hover:bg-sage-dark px-8 py-4 rounded-lg text-white text-lg transition duration-300">
                    View Our Services
                </a>
                <a href="<?= base_url('/reservation/1') ?>"
                    class="bg-white hover:bg-sage px-8 py-4 border-2 border-sage rounded-lg text-sage hover:text-white text-lg transition duration-300">
                    Request Consultation
                </a>
            </div>
        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>