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
                <a href="/road-map" class="text-gray-700">Road map</a>
                <a href="/login" class="text-gray-700">Login</a>
                <a href="/services" class="inline-block px-4 py-2 rounded header-cta" role="button">Request Assistance</a>
            </nav>
        </div>
        </nav>
        </div>
    </header>

    <div class="mx-auto px-6 py-12 max-w-5xl">
        <header class="mb-6">
            <h1 class="font-bold text-2xl">Road map</h1>
            <p class="text-gray-600">High-level plan and status for upcoming features.</p>
        </header>

        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center space-x-3">
                <label class="text-gray-600 text-sm">Filter:</label>
                <select id="statusFilter" class="border-gray-300 rounded text-sm">
                    <option value="all">All</option>
                    <option value="Backlog">Backlog</option>
                    <option value="Planned">Planned</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Done">Done</option>
                </select>
            </div>
            <div class="text-gray-500 text-sm">This is a UI-only roadmap for planning.</div>
        </div>

        <section id="roadmapList" class="space-y-4">
            <?= view('staticData/roadmap') ?>
        </section>

    </div>
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

    <script>
        (function() {
            const select = document.getElementById('statusFilter');

            function normalize(s) {
                return String(s || '').trim().toLowerCase();
            }
            select.addEventListener('change', function(e) {
                const v = normalize(e.target.value);
                document.querySelectorAll('#roadmapList article').forEach(function(el) {
                    const s = normalize(el.dataset.status);
                    if (v === 'all' || s === v) el.style.display = '';
                    else el.style.display = 'none';
                });
            });
        })();
    </script>
</body>

</html>