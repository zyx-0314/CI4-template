<?= view('components/head', ['title' => 'Admin — Services']) ?>
<?= view('components/header') ?>

<main class="mx-auto px-6 py-10 max-w-6xl">
    <div class="md:flex md:space-x-6">
        <?= view('components/admin/aside', ['active' => 'services']) ?>

        <section class="flex-1">
            <h2 class="mb-6 font-semibold text-2xl">Services</h2>
            <div class="flex justify-end mb-4">
                <button id="btnCreate" class="bg-blue-600 px-3 py-2 rounded text-white">Create service</button>
            </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-4 overflow-x-auto">
            <table class="w-full text-left min-w-[640px]">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3">ID</th>
                        <th class="p-3">Title</th>
                        <th class="p-3">Cost</th>
                        <th class="p-3">Available</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t" data-id="1" data-title="Traditional Filipino" data-cost="10000.00" data-inclusions="Flowers,Vehicle,Chapel" data-desc="Traditional Filipino funeral package">
                        <td class="p-3">1</td>
                        <td class="p-3">Traditional Filipino</td>
                        <td class="p-3">₱10,000.00</td>
                        <td class="p-3">Yes</td>
                        <td class="p-3">
                            <button class="btnPreview mr-3 text-sm text-gray-700" type="button">View</button>
                            <button class="btnEdit mr-3 text-blue-600 text-sm" type="button">Edit</button>
                            <button class="btnDelete text-red-600 text-sm" type="button">Delete</button>
                        </td>
                    </tr>

                    <tr class="border-t" data-id="2" data-title="Cremation" data-cost="8500.00" data-inclusions="Urn,Certificate" data-desc="Cremation package">
                        <td class="p-3">2</td>
                        <td class="p-3">Cremation</td>
                        <td class="p-3">₱8,500.00</td>
                        <td class="p-3">Yes</td>
                        <td class="p-3">
                            <button class="btnPreview mr-3 text-sm text-gray-700" type="button">View</button>
                            <button class="btnEdit mr-3 text-blue-600 text-sm" type="button">Edit</button>
                            <button class="btnDelete text-red-600 text-sm" type="button">Delete</button>
                        </td>
                    </tr>

                    <tr class="border-t" data-id="3" data-title="Green Burial" data-cost="12000.00" data-inclusions="Tree planting,Shroud" data-desc="Eco-friendly burial">
                        <td class="p-3">3</td>
                        <td class="p-3">Green Burial</td>
                        <td class="p-3">₱12,000.00</td>
                        <td class="p-3">No</td>
                        <td class="p-3">
                            <button class="btnPreview mr-3 text-sm text-gray-700" type="button">View</button>
                            <button class="btnEdit mr-3 text-blue-600 text-sm" type="button">Edit</button>
                            <button class="btnDelete text-red-600 text-sm" type="button">Delete</button>
                        </td>
                    </tr>

                    <tr class="border-t" data-id="4" data-title="Hybrid Funeral" data-cost="15000.00" data-inclusions="Chapel,Streaming,Vehicle" data-desc="Hybrid funeral with livestream">
                        <td class="p-3">4</td>
                        <td class="p-3">Hybrid Funeral</td>
                        <td class="p-3">₱15,000.00</td>
                        <td class="p-3">Yes</td>
                        <td class="p-3">
                            <button class="btnPreview mr-3 text-sm text-gray-700" type="button">View</button>
                            <button class="btnEdit mr-3 text-blue-600 text-sm" type="button">Edit</button>
                            <button class="btnDelete text-red-600 text-sm" type="button">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </section>

    <!-- Modals -->
    <div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div id="modal" class="bg-white rounded-lg shadow-lg w-11/12 max-w-2xl p-6">
            <button id="modalClose" class="float-right text-gray-600">&times;</button>
            <div id="modalContent"></div>
        </div>
    </div>

    <template id="previewTemplate">
        <div>
            <h3 class="text-xl font-semibold" id="svcTitle"></h3>
            <p class="text-gray-600 mt-2" id="svcDesc"></p>
            <p class="mt-3"><strong>Cost:</strong> ₱<span id="svcCost"></span></p>
            <p class="mt-2"><strong>Inclusions:</strong></p>
            <ul id="svcInclusions" class="list-disc pl-6 mt-1 text-sm text-gray-700"></ul>
        </div>
    </template>

    <template id="editTemplate">
        <form id="editForm">
            <div>
                <label class="block text-sm">Title</label>
                <input name="title" class="w-full border p-2 rounded mt-1" />
            </div>
            <div class="mt-3">
                <label class="block text-sm">Cost</label>
                <input name="cost" class="w-full border p-2 rounded mt-1" />
            </div>
            <div class="mt-3">
                <label class="block text-sm">Inclusions (comma separated)</label>
                <input name="inclusions" class="w-full border p-2 rounded mt-1" />
            </div>
            <div class="mt-3 text-right">
                <button type="button" id="saveEdit" class="bg-blue-600 text-white px-3 py-2 rounded">Save</button>
            </div>
        </form>
    </template>

    <template id="deleteTemplate">
        <div>
            <p>Are you sure you want to delete <strong id="delTitle"></strong>?</p>
            <div class="mt-4 text-right">
                <button id="confirmDelete" class="bg-red-600 text-white px-3 py-2 rounded mr-2">Delete</button>
                <button id="cancelDelete" class="px-3 py-2 rounded border">Cancel</button>
            </div>
        </div>
    </template>

    <script>
    (function(){
        const overlay = document.getElementById('modalOverlay');
        const modalContent = document.getElementById('modalContent');
        const modalClose = document.getElementById('modalClose');

        function openModal(html){
            modalContent.innerHTML = '';
            if (typeof html === 'string') modalContent.innerHTML = html;
            else modalContent.appendChild(html);
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
        }

        function closeModal(){
            overlay.classList.add('hidden');
            overlay.classList.remove('flex');
            modalContent.innerHTML = '';
        }

        modalClose.addEventListener('click', closeModal);
        overlay.addEventListener('click', function(e){ if(e.target === overlay) closeModal(); });

        // Preview
        document.querySelectorAll('.btnPreview').forEach(btn => btn.addEventListener('click', function(){
            const tr = this.closest('tr');
            const title = tr.dataset.title;
            const desc = tr.dataset.desc;
            const cost = tr.dataset.cost;
            const inclusions = (tr.dataset.inclusions||'').split(',').filter(Boolean);

            const tpl = document.getElementById('previewTemplate');
            const node = tpl.content.cloneNode(true);
            node.getElementById('svcTitle').textContent = title;
            node.getElementById('svcDesc').textContent = desc;
            node.getElementById('svcCost').textContent = parseFloat(cost).toFixed(2);
            const ul = node.getElementById('svcInclusions');
            inclusions.forEach(i => { const li = document.createElement('li'); li.textContent = i.trim(); ul.appendChild(li); });

            openModal(node);
        }));

        // Edit
        document.querySelectorAll('.btnEdit').forEach(btn => btn.addEventListener('click', function(){
            const tr = this.closest('tr');
            const title = tr.dataset.title;
            const cost = tr.dataset.cost;
            const inclusions = tr.dataset.inclusions;

            const tpl = document.getElementById('editTemplate');
            const node = tpl.content.cloneNode(true);
            const form = node.getElementById('editForm');
            form.elements['title'].value = title;
            form.elements['cost'].value = cost;
            form.elements['inclusions'].value = inclusions;

            openModal(node);

            document.getElementById('saveEdit').addEventListener('click', function(){
                // For now we just close the modal. Implement save via AJAX later.
                closeModal();
                alert('Saved (client-side demo).');
            });
        }));

        // Delete
        document.querySelectorAll('.btnDelete').forEach(btn => btn.addEventListener('click', function(){
            const tr = this.closest('tr');
            const title = tr.dataset.title;

            const tpl = document.getElementById('deleteTemplate');
            const node = tpl.content.cloneNode(true);
            node.getElementById('delTitle').textContent = title;

            openModal(node);

            document.getElementById('cancelDelete').addEventListener('click', closeModal);
            document.getElementById('confirmDelete').addEventListener('click', function(){
                closeModal();
                alert('Deleted (client-side demo).');
            });
        }));

        // Create
        document.getElementById('btnCreate').addEventListener('click', function(){
            const tpl = document.getElementById('editTemplate');
            const node = tpl.content.cloneNode(true);
            openModal(node);
            document.getElementById('saveEdit').addEventListener('click', function(){ closeModal(); alert('Created (client-side demo).'); });
        });
    })();
    </script>
</main>

<?= view('components/footer') ?>