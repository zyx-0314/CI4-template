<section class="<?php echo esc($class ?? 'bg-white p-4 border border-gray-100 rounded'); ?>">
    <h3 class="font-medium text-lg">Share a memory or message</h3>
    <form method="post" action="<?= base_url('/obituary/share/' . ($obituary['id'] ?? '')) ?>" class="space-y-3 mt-3">
        <div id="nameInputContainer" class="hidden flex-1">
            <input type="text" name="name" id="sharerName" placeholder="Your name" class="p-2 border rounded w-full text-sm">
        </div>

        <div>
            <label for="message" class="sr-only">Message</label>
            <textarea id="message" name="message" rows="4" class="p-3 border rounded w-full text-sm" placeholder="Write something about <?= esc($obituary['first_name'] ?? 'the person') ?>..."></textarea>
        </div>
        <div class="flex items-center gap-3">
            <input id="anonymousSwitch" type="checkbox" name="anonymous" checked class="w-4 h-4">
            <span>Share anonymously</span>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-gray-900 px-4 py-2 rounded text-white text-sm">Submit</button>
        </div>
    </form>
</section>

<script>
    // Anonymous toggle for share form (unchanged behavior)
    (function() {
        var anon = document.getElementById('anonymousSwitch');
        var nameContainer = document.getElementById('nameInputContainer');
        var nameInput = document.getElementById('sharerName');
        if (anon) {
            function updateName() {
                if (anon.checked) {
                    nameContainer.classList.add('hidden');
                    if (nameInput) nameInput.removeAttribute('required');
                } else {
                    nameContainer.classList.remove('hidden');
                    if (nameInput) nameInput.setAttribute('required', 'required');
                }
            }
            anon.addEventListener('change', updateName);
            updateName();
        }
    })();
</script>