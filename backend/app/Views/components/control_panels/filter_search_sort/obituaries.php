<?php
// Component: components/control_panels/filter_search_sort/obituaries.php
?>
<form id="obituariesFilterForm" onsubmit="return false;" class="flex sm:flex-row flex-col sm:items-center gap-3 mb-4">
    <input type="search" id="obituaries_q" placeholder="Search by name or place" class="shadow-sm px-3 py-2 border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 w-full sm:w-1/3">

    <select id="obituaries_sort" class="shadow-sm px-3 py-2 border border-slate-200 rounded-md focus:outline-none w-full sm:w-48">
        <option value="">Sort — default</option>
        <option value="dob_desc">DOB — Latest</option>
        <option value="dob_asc">DOB — Oldest</option>
        <option value="dod_desc">DOD — Latest</option>
        <option value="dod_asc">DOD — Oldest</option>
    </select>

    <select id="obituaries_status" class="shadow-sm px-3 py-2 border border-slate-200 rounded-md focus:outline-none w-full sm:w-48">
        <option value="all">Status — all</option>
        <option value="request">request</option>
        <option value="confirmed">confirmed</option>
    </select>

    <div class="flex gap-2 ml-auto">
        <button type="button" id="obituariesResetBtn" class="inline-flex items-center bg-white hover:bg-slate-50 shadow-sm px-3 py-2 border border-slate-200 rounded-md">Reset</button>
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
            const d = new Date(s);
            if (!isNaN(d)) return d;
            const m = s.match(/(\d{4}-\d{2}-\d{2})/);
            if (m) return new Date(m[1]);
            return null;
        }

        function initForTable(table) {
            if (!table) return;

            const qInput = document.getElementById('obituaries_q');
            const sortSelect = document.getElementById('obituaries_sort');
            const statusSelect = document.getElementById('obituaries_status');
            const resetBtn = document.getElementById('obituariesResetBtn');

            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const snapshot = rows.map(row => {
                const cols = Array.from(row.querySelectorAll('td'));
                const name = (cols[0] ? cols[0].textContent.trim() : '').toLowerCase();
                const dobText = (cols[1] ? cols[1].textContent.trim() : '');
                const dodText = (cols[2] ? cols[2].textContent.trim() : '');
                const status = (cols[6] ? cols[6].textContent.trim().toLowerCase() : '');
                return {
                    row,
                    name,
                    dob: parseDateFromText(dobText),
                    dod: parseDateFromText(dodText),
                    status,
                    html: row.outerHTML
                };
            });

            function render(list) {
                const tbody = table.querySelector('tbody');
                if (!list.length) {
                    tbody.innerHTML = '<tr><td class="p-3" colspan="10">No obituary requests match your search.</td></tr>';
                    return;
                }
                tbody.innerHTML = list.map(i => i.html).join('\n');
            }

            function apply() {
                const q = (qInput.value || '').toLowerCase().trim();
                const sort = sortSelect.value;
                const statusFilter = (statusSelect && statusSelect.value) ? statusSelect.value : 'all';

                let out = snapshot.filter(item => {
                    if (q && !item.name.includes(q)) return false;
                    if (statusFilter && statusFilter !== 'all') {
                        if (item.status !== statusFilter) return false;
                    }
                    return true;
                });

                if (sort === 'dob_desc') out.sort((a, b) => (b.dob || 0) - (a.dob || 0));
                else if (sort === 'dob_asc') out.sort((a, b) => (a.dob || 0) - (b.dob || 0));
                else if (sort === 'dod_desc') out.sort((a, b) => (b.dod || 0) - (a.dod || 0));
                else if (sort === 'dod_asc') out.sort((a, b) => (a.dod || 0) - (b.dod || 0));

                render(out);
            }

            [qInput, sortSelect, statusSelect].forEach(el => el && el.addEventListener('input', apply));
            resetBtn && resetBtn.addEventListener('click', () => {
                qInput.value = '';
                sortSelect.value = '';
                if (statusSelect) statusSelect.value = 'all';
                apply();
            });

            apply();
        }

        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            waitForTable().then(initForTable);
        } else {
            document.addEventListener('DOMContentLoaded', () => waitForTable().then(initForTable));
        }
    })();
</script>