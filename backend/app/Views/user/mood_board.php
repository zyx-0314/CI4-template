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
        :root {
            --sage-dark: #6F8E78;
            --sage: #8DAA91;
            --sage-light: #CFE6D7;

            --rose-dark: #A87D79;
            --rose: #C7A6A0;
            --rose-light: #EDD9D6;

            --stone-dark: #B1B1B1;
            --stone: #E2E2E2;
            --stone-light: #F7F7F7;
        }

        .swatch {
            width: 100%;
            height: 3rem;
            border-radius: .375rem;
            border: 1px solid rgba(0, 0, 0, 0.06);
        }

        /* Button color utilities using design tokens */
        .btn-sage {
            background: var(--sage);
            color: white;
        }

        .btn-sage:hover {
            background: var(--sage-dark);
        }

        .btn-rose {
            background: var(--rose);
            color: white;
        }

        .btn-rose:hover {
            background: var(--rose-dark);
        }

        .btn-stone {
            background: transparent;
            border: 1px solid var(--stone-dark);
            color: #1f2937;
        }

        .btn-disabled {
            background: var(--stone-light);
            color: #9ca3af;
            cursor: not-allowed;
        }

        /* Header CTA uses the main accent (sage-dark) */
        .header-cta {
            background: var(--sage-dark);
            color: white;
        }

        .header-cta:hover {
            background: var(--sage);
        }

        /* Small token-driven utilities */
        .text-sage-dark {
            color: var(--sage-dark);
        }

        .text-sage {
            color: var(--sage);
        }

        .bg-sage-light {
            background: var(--sage-light);
        }

        .bg-stone-light {
            background: var(--stone-light);
        }

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

<body class="bg-gray-50 text-gray-900">
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
                <a href="/road-map" class="text-gray-700">Road map</a>
                <a href="/login" class="text-gray-700">Login</a>
                <a href="/services" class="inline-block px-4 py-2 rounded header-cta" role="button">Request Assistance</a>
            </nav>
        </div>
        </nav>
        </div>
    </header>
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
                    <button class="px-4 py-2 rounded btn-sage">Primary</button>
                    <button class="px-4 py-2 rounded btn-rose">Secondary</button>
                    <button class="px-4 py-2 rounded btn-stone">Border</button>
                    <button class="px-4 py-2 rounded btn-disabled" disabled>Disabled</button>
                </div>
                <p class="text-gray-500 text-sm">Primary for main CTAs, secondary for supportive actions, border for subtle actions, disabled for unavailable states.</p>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="mb-4 font-semibold text-lg">Card sample</h2>
            <div class="gap-4 grid grid-cols-1">

                <!-- Card 1: Dashboard-style landscape (row layout inside a stacked column) -->
                <div class="flex flex-col space-y-4 bg-white shadow p-6 rounded-lg w-1/4">
                    <div class="font-extrabold text-sage-dark text-4xl">1,254</div>
                    <div>
                        <h3 class="font-semibold text-lg">Memorials Completed</h3>
                        <p class="mt-2 text-gray-600 text-xs">Lorem, ipsum dolor.</p>
                    </div>
                </div>

                <!-- Card 2: Services display (content left, image right) -->
                <div class="flex flex-row bg-white shadow rounded-lg overflow-hidden">
                    <div class="flex-1 p-4">
                        <h3 class="font-semibold text-lg">Premium Casket</h3>
                        <p class="mt-2 text-gray-600 text-sm">Handcrafted oak casket with satin interior and personalized engraving options.</p>
                        <div class="mt-4 font-bold text-sage-dark text-xl">$1,299</div>
                        <div class="flex space-x-2 mt-3">
                            <span class="bg-gray-100 px-2 py-1 rounded text-xs">Delivery</span>
                            <span class="bg-gray-100 px-2 py-1 rounded text-xs">Warranty</span>
                        </div>
                    </div>
                    <div class="hidden sm:block w-48">
                        <div class="w-full h-full" style="background-image: url('logo/main.svg'); background-size: cover; background-position: center right; height:100%;"></div>
                    </div>
                </div>

                <!-- Card 3: Reviews-focused (centered, emphasis on quote) -->
                <div class="flex flex-col items-center bg-white shadow px-8 py-12 rounded-lg text-center">
                    <div class="flex justify-center items-center bg-stone-light mb-4 rounded-full w-16 h-16 text-gray-500 text-xl">U</div>
                    <p class="text-gray-700 text-lg italic">"Compassionate and attentive service during a difficult time — we felt supported every step of the way."</p>
                    <p class="mt-3 text-gray-500 text-sm">— Jane D., Family</p>
                </div>

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