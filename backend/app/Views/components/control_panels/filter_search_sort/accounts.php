<?php
// Component: components/control_panels/filter_search_sort/accounts.php
// Renders search/sort/type controls for admin accounts and initializes client-side filtering.
?>
<form id="accountsFilterForm" onsubmit="return false;" class="flex sm:flex-row flex-col sm:items-center gap-3 mb-4">
    <input type="search" id="accounts_q" placeholder="Search by name or email" class="shadow-sm px-3 py-2 border border-slate-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 w-full sm:w-1/3">

    <select id="accounts_sort" class="shadow-sm px-3 py-2 border border-slate-200 rounded-md focus:outline-none w-full sm:w-48">
        <option value="">Sort — default</option>
        <option value="name_asc">Name A → Z</option>
        <option value="name_desc">Name Z → A</option>
        <option value="email_asc">Email A → Z</option>
        <option value="email_desc">Email Z → A</option>
    </select>

    <select id="accounts_type" class="shadow-sm px-3 py-2 border border-slate-200 rounded-md focus:outline-none w-full sm:w-48">
        <option value="all">Type — all</option>
        <option value="client">Client</option>
        <option value="driver">Driver</option>
        <option value="embalmer">Embalmer</option>
        <option value="staff">Staff</option>
        <option value="florist">Florist</option>
        <option value="manager">Manager</option>
        <option value="employee">Employee (non-client)</option>
    </select>

    <div class="flex gap-2 ml-auto">
        <button type="button" id="accountsResetBtn" class="inline-flex items-center bg-white hover:bg-slate-50 shadow-sm px-3 py-2 border border-slate-200 rounded-md">Reset</button>
    </div>
</form>

<script>
    /**
     * Safe initializer: wait for the accounts table to exist before snapshotting rows.
     * This component can be included before or after the table.
     */
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

            const qInput = document.getElementById('accounts_q');
            const sortSelect = document.getElementById('accounts_sort');
            const typeSelect = document.getElementById('accounts_type');
            const resetBtn = document.getElementById('accountsResetBtn');

            // Build array snapshot of rows with searchable fields
            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const snapshot = rows.map(row => {
                const cols = Array.from(row.querySelectorAll('td'));
                const name = (cols[0] ? cols[0].textContent.trim() : '').toLowerCase();
                const email = (cols[1] ? cols[1].textContent.trim() : '').toLowerCase();
                const type = (cols[2] ? cols[2].textContent.trim() : '').toLowerCase();
                return {
                    row,
                    name,
                    email,
                    type,
                    html: row.outerHTML
                };
            });

            function render(list) {
                const tbody = table.querySelector('tbody');
                if (!list.length) {
                    tbody.innerHTML = '<tr><td class="p-3" colspan="8">No accounts match your search.</td></tr>';
                    return;
                }
                tbody.innerHTML = list.map(i => i.html).join('\n');
            }

            function apply() {
                const q = (qInput.value || '').toLowerCase().trim();
                const sort = sortSelect.value;
                const typeFilter = (typeSelect && typeSelect.value) ? typeSelect.value : 'all';

                let out = snapshot.filter(item => {
                    if (q && !(item.name.includes(q) || item.email.includes(q))) return false;
                    // type filtering
                    if (typeFilter && typeFilter !== 'all') {
                        if (typeFilter === 'employee') {
                            // employee = any non-client type
                            if (item.type === 'client' || item.type === '') return false;
                        } else {
                            if (item.type !== typeFilter) return false;
                        }
                    }
                    return true;
                });

                if (sort === 'name_asc') out.sort((a, b) => a.name.localeCompare(b.name));
                else if (sort === 'name_desc') out.sort((a, b) => b.name.localeCompare(a.name));
                else if (sort === 'email_asc') out.sort((a, b) => a.email.localeCompare(b.email));
                else if (sort === 'email_desc') out.sort((a, b) => b.email.localeCompare(a.email));

                render(out);
            }

            [qInput, sortSelect, typeSelect].forEach(el => el && el.addEventListener('input', apply));
            resetBtn && resetBtn.addEventListener('click', () => {
                qInput.value = '';
                sortSelect.value = '';
                if (typeSelect) typeSelect.value = 'all';
                apply();
            });

            // initial
            apply();
        }

        // Wait for DOM ready and the table to exist (useful if table is rendered server-side after this include)
        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            waitForTable().then(initForTable);
        } else {
            document.addEventListener('DOMContentLoaded', () => waitForTable().then(initForTable));
        }
    })();
</script>