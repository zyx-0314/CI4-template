<?php
// View: backend/app/Views/user/services.php
// Expects: $services = array of associative arrays with keys:
//   id, title, category, cost, duration, description, image, created_at
// This view provides a GET form for server-side filtering and client-side JS for instant filtering/sorting.
// If $services is not provided, an empty array will be used.

$services = $services ?? [];
?>
<!doctype html>
<html lang="en">

<?= view('components/head') ?>

<body class="bg-gray-50 font-sans text-slate-900">
    <?= view('components/header', ['active' => 'Home']) ?>

    <main class="mx-auto px-4 sm:px-6 lg:px-8 py-8 max-w-7xl">
        <h1 class="mb-6 font-semibold text-slate-900 text-2xl">Services</h1>

        <form id="filterForm" onsubmit="return false;" class="flex sm:flex-row flex-col sm:items-center gap-3 mb-6">
            <input type="search" id="q" placeholder="Search services" class="shadow-sm px-3 py-2 border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 w-full sm:w-1/3">



            <select id="sort" class="shadow-sm px-3 py-2 border border-slate-200 rounded-md focus:outline-none w-full sm:w-48">
                <option value="">Sort — default</option>
                <option value="cost_asc">cost: low → high</option>
                <option value="cost_desc">cost: high → low</option>
                <option value="newest">Newest</option>
            </select>

            <div class="flex gap-2 ml-auto">
                <button type="button" id="resetBtn" class="inline-flex items-center bg-white hover:bg-slate-50 shadow-sm px-3 py-2 border border-slate-200 rounded-md">Reset</button>
            </div>
        </form>

        <div id="results" class="gap-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Client-side rendered, interactive results -->
            <?php if (empty($services)): ?>
                <div class="col-span-full py-12 text-slate-600 text-center">No services available.</div>
            <?php else: ?>
                <?php foreach ($services as $s): ?>
                    <?= view('components/cards/service_card', ['s' => $s]) ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <script>
        (function() {
            const container = document.getElementById('results');
            const qInput = document.getElementById('q');
            const sortSelect = document.getElementById('sort');
            const resetBtn = document.getElementById('resetBtn');

            // snapshot original cards
            const originals = Array.from(container.querySelectorAll('.card')).map(card => ({
                html: card.outerHTML,
                title: card.querySelector('h3') ? card.querySelector('h3').textContent.trim() : '',
                category: (card.dataset.category || '').toLowerCase(),
                cost: parseFloat(card.dataset.cost) || 0,
                created: card.dataset.created || ''
            }));

            function render(list) {
                if (!list.length) {
                    container.innerHTML = '<div class="col-span-full py-12 text-slate-600 text-center">No services match your filters.</div>';
                    return;
                }
                container.innerHTML = list.map(i => i.html).join('\n');
            }

            function apply() {
                const q = (qInput.value || '').toLowerCase();
                const min = -Infinity;
                const max = Infinity;
                const sort = sortSelect.value;

                let out = originals.filter(item => {
                    if (q && !(item.title.toLowerCase().includes(q) || item.category.toLowerCase().includes(q))) return false;
                    return true;
                });

                if (sort === 'cost_asc') out.sort((a, b) => a.cost - b.cost);
                else if (sort === 'cost_desc') out.sort((a, b) => b.cost - a.cost);
                else if (sort === 'newest') out.sort((a, b) => new Date(b.created) - new Date(a.created));

                render(out);
            }

            [qInput, sortSelect].forEach(el => el && el.addEventListener('input', apply));
            resetBtn.addEventListener('click', () => {
                qInput.value = '';
                sortSelect.value = '';
                apply();
            });

            // initial
            apply();
        })();
    </script>
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