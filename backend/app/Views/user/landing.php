<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Website</title>

    <!-- Default CDN includes -->
    <!-- Google Fonts: Playfair Display + Lato (global) -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Global base typography -->
    <style>
        /* Base typography */
        html,
        body {
            font-family: 'Lato', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: 'Playfair Display', Georgia, serif;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans text-slate-900">
    <header class="bg-white shadow px-4">
        <div class="flex justify-between items-center mx-auto py-6 max-w-5xl">
            <div class="flex items-center space-x-4">
                <a href="/" class="flex items-center space-x-3" aria-label="Sunset Funeral Homes">
                    <img src="logo/main.svg" alt="Sunset Funeral Homes" class="h-11">
                    <div class="hidden sm:block">
                        <h1 class="font-semibold text-xl">Sunset Funeral Homes</h1>
                        <p class="text-gray-500 text-sm">Compassionate care, every step of the way</p>
                    </div>
                </a>
            </div>
            <nav class="flex items-center space-x-4 text-sm" aria-label="Primary navigation">
                <a href="/" class="text-gray-700">Home</a>
                <a href="/roadmap" class="text-gray-700">Road map</a>
                <a href="/login" class="text-gray-700">Login</a>
                <a href="/services" class="inline-block bg-emerald-400 hover:bg-emerald-500 px-4 py-2 rounded text-white" role="button">Request Assistance</a>
            </nav>
        </div>
        </nav>
        </div>
    </header>

    <main class="mx-auto px-6 py-12 max-w-6xl">
        <!-- Hero -->
        <section class="items-center gap-8 grid grid-cols-1 md:grid-cols-2">
            <div class="order-2 md:order-1">
                <h1 class="font-serif font-extrabold text-slate-900 text-4xl md:text-5xl leading-tight">A dignified service your family can trust</h1>
                <p class="mt-4 max-w-xl text-gray-700">We provide respectful, professional support for families during difficult moments — clear guidance, compassionate staff, and thoughtful service options.</p>

                <div class="flex flex-wrap items-center gap-3 mt-6">
                    <a href="/services" class="inline-flex items-center bg-emerald-400 hover:bg-emerald-500 shadow px-6 py-3 rounded-md font-medium text-white">Request Assistance</a>
                </div>

                <div class="mt-6">
                    <div class="inline-flex items-center gap-3 bg-emerald-100 px-4 py-3 rounded-full text-emerald-700">
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

        <!-- Features -->
        <section class="mt-12">
            <div class="gap-6 grid grid-cols-1 md:grid-cols-3">
                <div class="flex items-start gap-4 bg-white shadow p-6 rounded-lg">
                    <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=200&q=80" alt="care icon" class="rounded-full w-12 h-12 object-cover">
                    <div>
                        <h3 class="font-semibold">Simple process</h3>
                        <p class="mt-2 text-gray-600 text-sm">We guide you step-by-step so arrangements are clear and manageable.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 bg-[var(--stone-light)] shadow p-6 rounded-lg">
                    <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=200&q=80" alt="process icon" class="rounded-full w-12 h-12 object-cover">
                    <div>
                        <h3 class="font-semibold">Transparent pricing</h3>
                        <p class="mt-2 text-gray-600 text-sm">Upfront options and pricing to remove uncertainty for families.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 bg-[var(--stone-light)] shadow p-6 rounded-lg">
                    <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=200&q=80" alt="care icon" class="rounded-full w-12 h-12 object-cover">
                    <div>
                        <h3 class="font-semibold">Compassionate care</h3>
                        <p class="mt-2 text-gray-600 text-sm">Our team supports families with empathy and professionalism.</p>
                    </div>
                </div>
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
                    <div class="mt-1 font-bold text-emerald-700 text-2xl">$650</div>
                    <a href="/services" class="inline-block bg-emerald-400 hover:bg-emerald-500 mt-4 px-4 py-2 rounded-md w-full text-white text-center">Get an instant quote</a>
                </div>
            </div>
        </section>

        <!-- Steps -->
        <section class="mt-12">
            <h3 class="font-semibold text-lg">We guide you through the process</h3>
            <div class="gap-6 grid grid-cols-1 md:grid-cols-4 mt-6">
                <div class="bg-white p-4 rounded-lg text-center">
                    <div class="font-medium text-sm">You arrange</div>
                </div>
                <div class="bg-white p-4 rounded-lg text-center">
                    <div class="font-medium text-sm">We collect</div>
                </div>
                <div class="bg-white p-4 rounded-lg text-center">
                    <div class="font-medium text-sm">We register</div>
                </div>
                <div class="bg-white p-4 rounded-lg text-center">
                    <div class="font-medium text-sm">We return</div>
                </div>
            </div>
        </section>

        <!-- CTA band -->
        <section class="mt-12 rounded-lg overflow-hidden">
            <div class="md:flex md:justify-between md:items-center bg-amber-300 px-6 py-10 text-amber-900">
                <div>
                    <h3 class="font-serif font-bold text-2xl">Can we help?</h3>
                    <p class="mt-2 text-white/90">Our Care Team is available 24 hours a day by phone and live-chat.</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="tel:5551234567" class="inline-block bg-white px-5 py-3 rounded-md font-semibold text-amber-700">Call (555) 123-4567</a>
                </div>
            </div>
        </section>

    </main>

    <footer class="bg-white mt-12 border-t" role="contentinfo">
        <div class="mx-auto px-6 py-8 max-w-5xl text-gray-600 text-sm">
            <div class="flex md:flex-row flex-col md:justify-between md:items-start gap-6">
                <div>
                    <img src="logo/main.svg" alt="Sunset Funeral Homes" class="mb-2 h-11">
                    <p>Sunset Funeral Homes — Compassionate care, every step of the way</p>
                </div>
                <div class="gap-6 grid grid-cols-1 sm:grid-cols-3">
                    <div>
                        <h4 class="mb-2 font-semibold">Services</h4>
                        <ul>
                            <li><a href="/services/traditional" class="hover:underline">Traditional Filipino</a></li>
                            <li><a href="/services/cremation" class="hover:underline">Cremation</a></li>
                            <li><a href="/services/green" class="hover:underline">Green burial</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="mb-2 font-semibold">Company</h4>
                        <ul>
                            <li><a href="/mood-board" class="hover:underline">Mood board</a></li>
                            <li><a href="/roadmap" class="hover:underline">Road map</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="mb-2 font-semibold">Contact</h4>
                        <p>Phone: (555) 123-4567</p>
                        <p>Email: <a href="mailto:info@sunsetfunerals.example" class="hover:underline">info@sunsetfunerals.example</a></p>
                    </div>
                </div>
            </div>
            <div class="mt-6 text-gray-500">© Sunset Funeral Homes — CI4 Sample Project 1</div>
        </div>
    </footer>
</body>

</html>