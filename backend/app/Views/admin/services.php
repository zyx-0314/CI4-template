<?= view('components/head', ['title' => 'Admin — Services']) ?>
<?= view('components/header') ?>

<main class="mx-auto px-6 py-10 max-w-6xl">
    <div class="md:flex md:space-x-6">
        <?= view('components/admin/aside', ['active' => 'services']) ?>

        <section class="flex-1">
            <h2 class="mb-6 font-semibold text-2xl">Services</h2>
            <div class="gap-4 grid grid-cols-1 md:grid-cols-3 mb-6" id="serviceStats">
                <div class="bg-white shadow p-4 rounded">
                    <div class="text-gray-500 text-sm">Total active</div>
                    <div class="font-semibold text-2xl" id="statTotalActive">—</div>
                </div>
                <div class="bg-white shadow p-4 rounded">
                    <div class="text-gray-500 text-sm">Available & active</div>
                    <div class="font-semibold text-2xl" id="statAvailableActive">—</div>
                </div>
                <div class="bg-white shadow p-4 rounded">
                    <div class="text-gray-500 text-sm">Not available but active</div>
                    <div class="font-semibold text-2xl" id="statUnavailableActive">—</div>
                </div>
            </div>
            <div class="flex justify-end mb-4">
                <button id="btnCreate" class="bg-blue-600 px-3 py-2 rounded text-white">Create service</button>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="p-4 overflow-x-auto">
                    <table class="w-full min-w-[640px] text-left">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-3">ID</th>
                                <th class="p-3">Title</th>
                                <th class="p-3">Cost</th>
                                <th class="p-3">Available</th>
                                <th class="p-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="servicesBody">
                            <!-- rows will be rendered here from the API -->
                        </tbody>
                    </table>
                </div>
                <div class="bg-gray-50 p-4 border-t">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-2">
                            <label for="perPageSelect" class="text-gray-700 text-sm">Show</label>
                            <select id="perPageSelect" class="p-1 border rounded text-sm">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                            </select>
                            <span class="text-gray-700 text-sm">per page</span>
                        </div>
                        <div id="pagination" class="flex justify-end items-center space-x-2"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modals -->
        <div id="modalOverlay" class="hidden z-50 fixed inset-0 justify-center items-center bg-black bg-opacity-50">
            <div id="modal" class="bg-white shadow-lg p-6 rounded-lg w-11/12 max-w-2xl">
                <button id="modalClose" class="float-right text-gray-600">&times;</button>
                <div id="modalContent"></div>
            </div>
        </div>

        <template id="previewTemplate">
            <div>
                <h3 class="font-semibold text-xl" id="svcTitle"></h3>
                <p class="mt-2 text-gray-600" id="svcDesc"></p>
                <p class="mt-3"><strong>Cost:</strong> ₱<span id="svcCost"></span></p>
                <p class="mt-2"><strong>Inclusions:</strong></p>
                <ul id="svcInclusions" class="mt-1 pl-6 text-gray-700 text-sm list-disc"></ul>
            </div>
        </template>

        <template id="editTemplate">
            <form id="editForm">
                <div>
                    <label class="block text-sm">Title</label>
                    <input name="title" class="mt-1 p-2 border rounded w-full" required />
                </div>
                <div class="mt-3">
                    <label class="block text-sm">Description</label>
                    <textarea name="description" class="mt-1 p-2 border rounded w-full" rows="2"></textarea>
                </div>
                <div class="mt-3">
                    <label class="block text-sm">Inclusions (comma separated)</label>
                    <textarea name="inclusions" class="mt-1 p-2 border rounded w-full" rows="2"></textarea>
                </div>
                <div class="mt-3">
                    <label class="block text-sm">Cost (₱)</label>
                    <input name="cost" type="number" step="0.01" min="0" class="mt-1 p-2 border rounded w-full" required />
                </div>
                <div class="flex space-x-4 mt-3">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_available" value="1" class="mr-2" checked /> Available
                    </label>
                </div>
                <!-- banner_image skipped for now -->
                <div class="mt-3 text-right">
                    <button type="button" id="saveEdit" class="bg-blue-600 px-3 py-2 rounded text-white">Save</button>
                </div>
            </form>
        </template>

        <template id="deleteTemplate">
            <div>
                <p>Are you sure you want to delete <strong id="delTitle"></strong>?</p>
                <div class="mt-4 text-right">
                    <button id="confirmDelete" class="bg-red-600 mr-2 px-3 py-2 rounded text-white">Delete</button>
                    <button id="cancelDelete" class="px-3 py-2 border rounded">Cancel</button>
                </div>
            </div>
        </template>

        <script>
            (function() {
                const overlay = document.getElementById('modalOverlay');
                const modalContent = document.getElementById('modalContent');
                const modalClose = document.getElementById('modalClose');
                // CSRF token (CodeIgniter helpers)
                const csrfName = '<?= csrf_token() ?>';
                const csrfHash = '<?= csrf_hash() ?>';
                // Public services base URL
                const servicesBase = '<?= site_url('services') ?>';

                function openModal(html) {
                    modalContent.innerHTML = '';
                    if (typeof html === 'string') modalContent.innerHTML = html;
                    else modalContent.appendChild(html);
                    overlay.classList.remove('hidden');
                    overlay.classList.add('flex');
                }

                function closeModal() {
                    overlay.classList.add('hidden');
                    overlay.classList.remove('flex');
                    modalContent.innerHTML = '';
                }

                modalClose.addEventListener('click', closeModal);
                overlay.addEventListener('click', function(e) {
                    if (e.target === overlay) closeModal();
                });

                // Preview -> navigate to public service page
                document.querySelectorAll('.btnPreview').forEach(btn => btn.addEventListener('click', function() {
                    const tr = this.closest('tr');
                    const id = tr && tr.dataset && tr.dataset.id;
                    if (id) {
                        window.location.href = servicesBase + '/' + encodeURIComponent(id);
                    }
                }));

                // Edit
                document.querySelectorAll('.btnEdit').forEach(btn => btn.addEventListener('click', function() {
                    const tr = this.closest('tr');
                    const title = tr.dataset.title;
                    const cost = tr.dataset.cost;
                    const inclusions = tr.dataset.inclusions;

                    const tpl = document.getElementById('editTemplate');
                    const node = tpl.content.cloneNode(true);
                    // Populate values inside the fragment
                    const form = node.querySelector('#editForm');
                    form.elements['title'].value = title;
                    form.elements['cost'].value = cost;
                    form.elements['inclusions'].value = inclusions;

                    openModal(node);

                    // Attach handler to the Save button inside the rendered modal
                    const saveBtnInModal = modalContent.querySelector('#saveEdit');
                    if (saveBtnInModal) {
                        saveBtnInModal.addEventListener('click', function() {
                            closeModal();
                            alert('Saved (client-side demo).');
                        }, {
                            once: true
                        });
                    }
                }));

                // Delete
                document.querySelectorAll('.btnDelete').forEach(btn => btn.addEventListener('click', function() {
                    const tr = this.closest('tr');
                    const title = tr.dataset.title;

                    const tpl = document.getElementById('deleteTemplate');
                    const node = tpl.content.cloneNode(true);
                    node.getElementById('delTitle').textContent = title;

                    openModal(node);

                    document.getElementById('cancelDelete').addEventListener('click', closeModal);
                    document.getElementById('confirmDelete').addEventListener('click', function() {
                        closeModal();
                        alert('Deleted (client-side demo).');
                    });
                }));

                // Create (persist to backend)
                document.getElementById('btnCreate').addEventListener('click', function() {
                    const tpl = document.getElementById('editTemplate');
                    const node = tpl.content.cloneNode(true);

                    // Grab the form from the cloned template (we'll attach handler after rendering)
                    const form = node.querySelector('#editForm');

                    function onCreateClick(e) {
                        e.preventDefault();

                        const title = form.elements['title'].value.trim();
                        const description = form.elements['description'].value.trim();
                        const inclusions = form.elements['inclusions'].value.trim();
                        const cost = form.elements['cost'].value.trim();
                        const is_available = form.elements['is_available'].checked ? 1 : 0;

                        if (!title) {
                            alert('Please provide a title for the service.');
                            return;
                        }
                        if (!cost || isNaN(cost) || Number(cost) < 0) {
                            alert('Please provide a valid cost.');
                            return;
                        }

                        const fd = new FormData();
                        fd.append('title', title);
                        fd.append('description', description);
                        fd.append('inclusions', inclusions);
                        fd.append('cost', cost);
                        fd.append('is_available', is_available);
                        // append CSRF token so CodeIgniter accepts the POST
                        fd.append(csrfName, csrfHash);

                        fetch('<?= site_url('admin/api/services') ?>', {
                                method: 'POST',
                                body: fd,
                                credentials: 'same-origin',
                            })
                            .then(r => r.json())
                            .then(result => {
                                if (result && result.ok) {
                                    closeModal();
                                    // reload list via API
                                    loadServices();
                                } else {
                                    const msg = (result && result.error && result.error.message) ? result.error.message : 'Save failed';
                                    alert(msg);
                                }
                            })
                            .catch(err => {
                                console.error(err);
                                alert('Request failed. See console for details.');
                            });
                    }

                    // Open modal (render) then attach handler to the Save button inside the modal
                    openModal(node);
                    const saveBtnInModal = modalContent.querySelector('#saveEdit');
                    if (saveBtnInModal) saveBtnInModal.addEventListener('click', onCreateClick, {
                        once: true
                    });
                });

                /* -- Service list loading and rendering -- */
                const servicesBody = document.getElementById('servicesBody');

                // Pagination state
                let currentPage = 1;
                // perPage is dynamic now, controlled by select
                let perPage = 5;

                // Attach per-page selector handler once the DOM is ready
                const perPageSelect = document.getElementById('perPageSelect');
                if (perPageSelect) {
                    perPageSelect.value = String(perPage);
                    perPageSelect.addEventListener('change', function() {
                        const val = parseInt(this.value, 10) || 5;
                        perPage = val;
                        // reload starting from first page when page size changes
                        loadServices(1);
                    });
                }

                function renderRows(items) {
                    servicesBody.innerHTML = '';
                    // Only render actively enabled services
                    const activeItems = (items || []).filter(it => Number(it.is_active) === 1);
                    activeItems.forEach(it => {
                        const tr = document.createElement('tr');
                        tr.className = 'border-t';
                        tr.dataset.id = it.id;
                        tr.dataset.title = it.title || '';
                        tr.dataset.desc = it.description || '';
                        tr.dataset.cost = it.cost || 0;
                        tr.dataset.inclusions = it.inclusions || '';

                        tr.innerHTML = `
                            <td class="p-3">${it.id}</td>
                            <td class="p-3">${escapeHtml(it.title || '')}</td>
                            <td class="p-3">₱${Number(it.cost || 0).toFixed(2)}</td>
                            <td class="p-3">${Number(it.is_available) === 1 ? 'Yes' : 'No'}</td>
                            <td class="p-3">
                                <button class="mr-3 text-gray-700 text-sm btnPreview" type="button">View</button>
                                <button class="mr-3 text-blue-600 text-sm btnEdit" type="button">Edit</button>
                                <button class="text-red-600 text-sm btnDelete" type="button">Delete</button>
                            </td>
                        `;

                        servicesBody.appendChild(tr);
                    });

                    bindRowButtons();
                }

                function renderPagination(meta) {
                    const container = document.getElementById('pagination');
                    container.innerHTML = '';
                    if (!meta) return;

                    const total = meta.total || 0;
                    const page = meta.page || 1;
                    const totalPages = meta.total_pages || 1;

                    // Prev
                    const prev = document.createElement('button');
                    prev.className = 'px-3 py-1 border rounded';
                    prev.textContent = 'Prev';
                    prev.disabled = page <= 1;
                    prev.addEventListener('click', function() {
                        if (page > 1) {
                            loadServices(page - 1);
                        }
                    });
                    container.appendChild(prev);

                    // Page buttons (compact: show up to 7 pages)
                    const start = Math.max(1, page - 3);
                    const end = Math.min(totalPages, page + 3);
                    for (let p = start; p <= end; p++) {
                        const btn = document.createElement('button');
                        btn.className = 'px-3 py-1 border rounded ' + (p === page ? 'bg-blue-600 text-white' : '');
                        btn.textContent = p;
                        (function(pn) {
                            btn.addEventListener('click', function() {
                                loadServices(pn);
                            });
                        })(p);
                        container.appendChild(btn);
                    }

                    // Next
                    const next = document.createElement('button');
                    next.className = 'px-3 py-1 border rounded';
                    next.textContent = 'Next';
                    next.disabled = page >= totalPages;
                    next.addEventListener('click', function() {
                        if (page < totalPages) loadServices(page + 1);
                    });
                    container.appendChild(next);
                }

                function escapeHtml(s) {
                    return String(s)
                        .replace(/&/g, '&amp;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;')
                        .replace(/"/g, '&quot;')
                        .replace(/'/g, '&#39;');
                }

                function bindRowButtons() {
                    // Preview
                    document.querySelectorAll('.btnPreview').forEach(btn => {
                        btn.removeEventListener('click', previewHandler);
                        btn.addEventListener('click', previewHandler);
                    });

                    // Edit
                    document.querySelectorAll('.btnEdit').forEach(btn => {
                        btn.removeEventListener('click', editHandler);
                        btn.addEventListener('click', editHandler);
                    });

                    // Delete
                    document.querySelectorAll('.btnDelete').forEach(btn => {
                        btn.removeEventListener('click', deleteHandler);
                        btn.addEventListener('click', deleteHandler);
                    });
                }

                function previewHandler() {
                    const tr = this.closest('tr');
                    const id = tr && tr.dataset && tr.dataset.id;
                    if (id) window.location.href = servicesBase + '/' + encodeURIComponent(id);
                }

                function editHandler() {
                    const tr = this.closest('tr');
                    const id = tr.dataset.id;
                    const title = tr.dataset.title;
                    const cost = tr.dataset.cost;
                    const inclusions = tr.dataset.inclusions;

                    const tpl = document.getElementById('editTemplate');
                    const node = tpl.content.cloneNode(true);
                    const form = node.querySelector('#editForm');
                    form.elements['title'].value = title;
                    form.elements['cost'].value = cost;
                    form.elements['inclusions'].value = inclusions;

                    openModal(node);

                    const saveBtn = modalContent.querySelector('#saveEdit');
                    if (saveBtn) {
                        saveBtn.addEventListener('click', function() {
                            // send update via API
                            const payload = new FormData(form);
                            // Ensure is_available is always sent (checkbox only present when checked)
                            const isAvailField = form.elements['is_available'];
                            const isAvail = isAvailField && isAvailField.checked ? 1 : 0;
                            payload.set('is_available', isAvail);
                            payload.append(csrfName, csrfHash);
                            fetch(`<?= site_url('admin/api/services') ?>/${id}`, {
                                method: 'POST',
                                body: payload,
                                credentials: 'same-origin',
                            }).then(r => r.json()).then(res => {
                                if (res && res.ok) {
                                    closeModal();
                                    loadServices();
                                } else {
                                    alert('Update failed');
                                }
                            }).catch(e => {
                                console.error(e);
                                alert('Update failed');
                            });
                        }, {
                            once: true
                        });
                    }
                }

                function deleteHandler() {
                    const tr = this.closest('tr');
                    const id = tr.dataset.id;
                    const title = tr.dataset.title;

                    const tpl = document.getElementById('deleteTemplate');
                    const node = tpl.content.cloneNode(true);
                    node.querySelector('#delTitle').textContent = title;

                    openModal(node);

                    const cancelBtn = modalContent.querySelector('#cancelDelete');
                    const confirmBtn = modalContent.querySelector('#confirmDelete');
                    if (cancelBtn) cancelBtn.addEventListener('click', closeModal, {
                        once: true
                    });
                    if (confirmBtn) confirmBtn.addEventListener('click', function() {
                        fetch(`<?= site_url('admin/api/services') ?>/${id}`, {
                                method: 'DELETE',
                                credentials: 'same-origin'
                            })
                            .then(r => r.json()).then(res => {
                                if (res && res.ok) {
                                    closeModal();
                                    loadServices();
                                } else {
                                    alert('Delete failed');
                                }
                            }).catch(e => {
                                console.error(e);
                                alert('Delete failed');
                            });
                    }, {
                        once: true
                    });
                }

                function loadServices(page = 1) {
                    currentPage = page;
                    const url = '<?= site_url('admin/api/services') ?>' + '?page=' + encodeURIComponent(page) + '&per_page=' + encodeURIComponent(perPage);
                    fetch(url, {
                            credentials: 'same-origin'
                        })
                        .then(r => r.json())
                        .then(res => {
                            if (res && res.ok && Array.isArray(res.data)) {
                                renderRows(res.data);
                                renderPagination(res.meta || {
                                    page: page,
                                    per_page: perPage,
                                    total: 0,
                                    total_pages: 1
                                });

                                // Populate stat cards if available
                                if (res.meta && res.meta.counts) {
                                    const c = res.meta.counts;
                                    const elTotal = document.getElementById('statTotalActive');
                                    const elAvail = document.getElementById('statAvailableActive');
                                    const elUnavail = document.getElementById('statUnavailableActive');
                                    if (elTotal) elTotal.innerText = String(c.active_total || 0);
                                    if (elAvail) elAvail.innerText = String(c.available_active || 0);
                                    if (elUnavail) elUnavail.innerText = String(c.unavailable_active || 0);
                                }
                            } else {
                                servicesBody.innerHTML = '<tr><td class="p-3" colspan="5">No services found</td></tr>';
                                renderPagination(null);
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            servicesBody.innerHTML = '<tr><td class="p-3" colspan="5">Failed to load services</td></tr>';
                            renderPagination(null);
                        });
                }

                // Initial load
                loadServices();
            })();
        </script>
</main>

<?= view('components/footer') ?>