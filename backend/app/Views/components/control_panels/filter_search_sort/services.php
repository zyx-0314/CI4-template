<?php
// Component: components/control_panels/filter_search_sort/services.php
// Renders search/filter/sort controls for services list (title, cost, availability)
?>

<form id="servicesFilterForm" onsubmit="return false;" class="flex sm:flex-row flex-col sm:items-center gap-3 mb-4">
    <input type="search" id="services_q" placeholder="Search by title" class="shadow-sm px-3 py-2 border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 w-full sm:w-1/3">

    <select id="services_sort" class="shadow-sm px-3 py-2 border border-slate-200 rounded-md focus:outline-none w-full sm:w-48">
        <option value="">Sort — default</option>
        <option value="cost_desc">Cost — High → Low</option>
        <option value="cost_asc">Cost — Low → High</option>
        <option value="name_asc">Name A → Z</option>
        <option value="name_desc">Name Z → A</option>
    </select>

    <select id="services_available" class="shadow-sm px-3 py-2 border border-slate-200 rounded-md focus:outline-none w-full sm:w-48">
        <option value="all">Available — all</option>
        <option value="yes">Yes</option>
        <option value="no">No</option>
    </select>

    <div class="flex gap-2 ml-auto">
        <button type="button" id="servicesResetBtn" class="inline-flex items-center bg-white hover:bg-slate-50 shadow-sm px-3 py-2 border border-slate-200 rounded-md">Reset</button>
    </div>
</form>

<script>
    (function() {
        function waitForTable(maxAttempts = 40, interval = 50) {
            return new Promise((resolve) => {
                let attempts = 0;
                const iv = setInterval(() => {
                    const table = document.querySelector('table');
                    attempts++;
                    if (table || attempts >= maxAttempts) {
                        clearInterval(iv);
                        resolve(table);
                    }
                }, interval);
            });
        }

        function initForTable(table) {
            if (!table) return;

            const qInput = document.getElementById('services_q');
            const sortSelect = document.getElementById('services_sort');
            const availSelect = document.getElementById('services_available');
            const resetBtn = document.getElementById('servicesResetBtn');

            // Assume table columns: title (col 0), cost (col 1), available (col 2)
            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const snapshot = rows.map(row => {
                const cols = Array.from(row.querySelectorAll('td'));
                const title = (cols[0] ? cols[0].textContent.trim() : '').toLowerCase();
                // parse cost as number, remove non-numeric except dot and minus
                const costText = (cols[1] ? cols[1].textContent.trim() : '');
                const cost = parseFloat(costText.replace(/[^0-9.-]+/g, '')) || 0;
                const availableRaw = (cols[2] ? cols[2].textContent.trim().toLowerCase() : '');
                // normalize availability: yes if contains 'yes' or 'available' or 'true' or '1'
                const available = (/(yes|available|true|1)/i).test(availableRaw) ? 'yes' : 'no';
                return {
                    row,
                    title,
                    cost,
                    available,
                    html: row.outerHTML
                };
            });

            function render(list) {
                const tbody = table.querySelector('tbody');
                if (!list.length) {
                    tbody.innerHTML = '<tr><td class="p-3" colspan="8">No services match your search.</td></tr>';
                    return;
                }
                tbody.innerHTML = list.map(i => i.html).join('\n');
            }

            function apply() {
                const q = (qInput.value || '').toLowerCase().trim();
                const sort = sortSelect.value;
                const availFilter = (availSelect && availSelect.value) ? availSelect.value : 'all';

                let out = snapshot.filter(item => {
                    if (q && !item.title.includes(q)) return false; // search only title
                    if (availFilter && availFilter !== 'all') {
                        if (item.available !== availFilter) return false;
                    }
                    return true;
                });

                if (sort === 'cost_desc') out.sort((a, b) => b.cost - a.cost);
                else if (sort === 'cost_asc') out.sort((a, b) => a.cost - b.cost);
                else if (sort === 'name_asc') out.sort((a, b) => a.title.localeCompare(b.title));
                else if (sort === 'name_desc') out.sort((a, b) => b.title.localeCompare(a.title));

                render(out);
            }

            [qInput, sortSelect, availSelect].forEach(el => el && el.addEventListener('input', apply));
            resetBtn && resetBtn.addEventListener('click', () => {
                qInput.value = '';
                sortSelect.value = '';
                if (availSelect) availSelect.value = 'all';
                apply();
            });

            // initial
            apply();
        }

        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            waitForTable().then(initForTable);
        } else {
            document.addEventListener('DOMContentLoaded', () => waitForTable().then(initForTable));
        }
    })();
</script>