<?php
// Component: components/control_panels/filter_search_sort/requests.php
// Renders search/filter/sort controls for requests list (service name, first/last name, status, date sorts)
?>
<form id="requestsFilterForm" onsubmit="return false;" class="flex sm:flex-row flex-col sm:items-center gap-3 mb-4">
    <input type="search" id="requests_q" placeholder="Search by service or name" class="shadow-sm px-3 py-2 border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 w-full sm:w-1/3">

    <select id="requests_sort" class="shadow-sm px-3 py-2 border border-slate-200 rounded-md focus:outline-none w-full sm:w-48">
        <option value="">Sort — default</option>
        <option value="start_desc">Start date — Latest</option>
        <option value="start_asc">Start date — Oldest</option>
        <option value="end_desc">End date — Latest</option>
        <option value="end_asc">End date — Oldest</option>
    </select>

    <select id="requests_status" class="shadow-sm px-3 py-2 border border-slate-200 rounded-md focus:outline-none w-full sm:w-48">
        <option value="all">Status — all</option>
        <option value="not open">not open</option>
        <option value="un available">un available</option>
        <option value="called">called</option>
        <option value="messaged">messaged</option>
        <option value="meeting scheduled">meeting scheduled</option>
        <option value="assigned">assigned</option>
        <option value="on going">on going</option>
        <option value="complete">complete</option>
    </select>

    <div class="flex gap-2 ml-auto">
        <button type="button" id="requestsResetBtn" class="inline-flex items-center bg-white hover:bg-slate-50 shadow-sm px-3 py-2 border border-slate-200 rounded-md">Reset</button>
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

        function parseDateFromText(s) {
            if (!s) return null;
            // Try to parse ISO-ish dates first
            const d = new Date(s);
            if (!isNaN(d)) return d;
            // fallback: try to extract yyyy-mm-dd
            const m = s.match(/(\d{4}-\d{2}-\d{2})/);
            if (m) return new Date(m[1]);
            return null;
        }

        function initForTable(table) {
            if (!table) return;

            const qInput = document.getElementById('requests_q');
            const sortSelect = document.getElementById('requests_sort');
            const statusSelect = document.getElementById('requests_status');
            const resetBtn = document.getElementById('requestsResetBtn');

            // Build array snapshot of rows with searchable fields
            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const snapshot = rows.map(row => {
                const cols = Array.from(row.querySelectorAll('td'));
                // Expected columns in requests table: service, name, start, end, status, actions
                const service = (cols[0] ? cols[0].textContent.trim() : '').toLowerCase();
                const firstLast = (cols[1] ? cols[1].textContent.trim() : '').toLowerCase();
                const dateStartText = (cols[2] ? cols[2].textContent.trim() : '');
                const dateEndText = (cols[3] ? cols[3].textContent.trim() : '');
                const status = (cols[4] ? cols[4].textContent.trim().toLowerCase() : '');
                return {
                    row,
                    service,
                    firstLast,
                    dateStart: parseDateFromText(dateStartText),
                    dateEnd: parseDateFromText(dateEndText),
                    status,
                    html: row.outerHTML
                };
            });

            function render(list) {
                const tbody = table.querySelector('tbody');
                if (!list.length) {
                    tbody.innerHTML = '<tr><td class="p-3" colspan="10">No requests match your search.</td></tr>';
                    return;
                }
                tbody.innerHTML = list.map(i => i.html).join('\n');
            }

            function apply() {
                const q = (qInput.value || '').toLowerCase().trim();
                const sort = sortSelect.value;
                const statusFilter = (statusSelect && statusSelect.value) ? statusSelect.value : 'all';

                let out = snapshot.filter(item => {
                    if (q && !(item.service.includes(q) || item.firstLast.includes(q))) return false;
                    if (statusFilter && statusFilter !== 'all') {
                        if (item.status !== statusFilter) return false;
                    }
                    return true;
                });

                if (sort === 'start_desc') out.sort((a, b) => (b.dateStart || 0) - (a.dateStart || 0));
                else if (sort === 'start_asc') out.sort((a, b) => (a.dateStart || 0) - (b.dateStart || 0));
                else if (sort === 'end_desc') out.sort((a, b) => (b.dateEnd || 0) - (a.dateEnd || 0));
                else if (sort === 'end_asc') out.sort((a, b) => (a.dateEnd || 0) - (b.dateEnd || 0));

                render(out);
            }

            [qInput, sortSelect, statusSelect].forEach(el => el && el.addEventListener('input', apply));
            resetBtn && resetBtn.addEventListener('click', () => {
                qInput.value = '';
                sortSelect.value = '';
                if (statusSelect) statusSelect.value = 'all';
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