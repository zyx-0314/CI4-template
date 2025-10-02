<?php
// Page: obituary/obituary_request_form
// Data contract:
// $errors: array|null
// $old: array|null
// $fieldErrors: array|null
?>
<!doctype html>
<html lang="en">
<?= view('components/head', ['title' => 'Request an Obituary']) ?>

<body class="bg-gray-50 font-sans text-slate-900">
    <?= view('components/header', ['active' => 'Obituaries']) ?>

    <main class="mx-auto p-6 max-w-3xl">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-sage-light px-6 py-5 border-b">
                <h1 class="font-semibold text-slate-900 text-2xl">Request an Obituary</h1>
                <div class="mt-1 text-slate-700 text-sm">Provide details and we will prepare a memorial page for your loved one.</div>
            </div>

            <div class="space-y-6 p-6">
                <?php if (!empty($errors)): ?>
                    <div class="bg-rose-light p-3 border border-rose rounded text-rose-dark">
                        <ul class="list-inside list-none">
                            <?php foreach ($errors as $e): ?>
                                <li>
                                    <i class="text-red-700 fa-solid fa-triangle-exclamation"></i>
                                    <?= esc($e) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?= base_url('/obituary/request') ?>" class="gap-4 grid grid-cols-1">
                    <?= csrf_field() ?>

                    <?php if (!empty($obituaries) && is_array($obituaries)): ?>
                        <label class="block">
                            <div class="mb-1 font-medium text-sm">Select existing obituary (optional)</div>
                            <select name="obituary_id" class="block px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full">
                                <?php foreach ($obituaries as $o): ?>
                                    <?php $selected = ((string)($old['obituary_id'] ?? ($selected_obituary ?? '')) === (string)$o['id']) ? 'selected' : ''; ?>
                                    <option value="<?= esc($o['id']) ?>" <?= $selected ?>><?= !empty($o['design']) ? esc($o['design']) : '' ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    <?php endif; ?>

                    <div class="gap-4 grid grid-cols-1 sm:grid-cols-2">
                        <label class="block">
                            <div class="mb-1 font-medium text-sm">First name</div>
                            <input name="first_name" value="<?= esc($old['first_name'] ?? '') ?>" class="block px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                            <?php if (!empty($fieldErrors['first_name'])): ?>
                                <div class="mt-2 text-red-500 text-sm"><?= esc($fieldErrors['first_name']) ?></div>
                            <?php endif; ?>
                        </label>

                        <label class="block">
                            <div class="mb-1 font-medium text-sm">Last name</div>
                            <input name="last_name" value="<?= esc($old['last_name'] ?? '') ?>" class="block px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                            <?php if (!empty($fieldErrors['last_name'])): ?>
                                <div class="mt-2 text-red-500 text-sm"><?= esc($fieldErrors['last_name']) ?></div>
                            <?php endif; ?>
                        </label>
                    </div>

                    <label class="block">
                        <div class="mb-1 font-medium text-sm">Middle name (optional)</div>
                        <input name="middle_name" value="<?= esc($old['middle_name'] ?? '') ?>" class="block px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                    </label>

                    <label class="block">
                        <div class="mb-1 font-medium text-sm">Date of birth (optional)</div>
                        <input type="date" name="date_of_birth" value="<?= esc($old['date_of_birth'] ?? $old['birth_date'] ?? '') ?>" class="block px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                    </label>

                    <label class="block">
                        <div class="mb-1 font-medium text-sm">Date of death (optional)</div>
                        <input type="date" name="date_of_death" value="<?= esc($old['date_of_death'] ?? $old['death_date'] ?? '') ?>" class="block px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                    </label>

                    <label class="block">
                        <div class="mb-1 font-medium text-sm">Short headline / subtitle</div>
                        <input name="subtitle" value="<?= esc($old['subtitle'] ?? '') ?>" class="block px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                    </label>

                    <label class="block">
                        <div class="mb-1 font-medium text-sm">Obituary text</div>
                        <textarea name="description" rows="6" class="block px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full"><?= esc($old['description'] ?? $old['obituary_text'] ?? '') ?></textarea>
                        <?php if (!empty($fieldErrors['description']) || !empty($fieldErrors['obituary_text'])): ?>
                            <div class="mt-2 text-red-500 text-sm"><?= esc($fieldErrors['description'] ?? $fieldErrors['obituary_text'] ?? '') ?></div>
                        <?php endif; ?>
                    </label>

                    <label class="block">
                        <div class="mb-1 font-medium text-sm">Contact Email</div>
                        <input type="email" name="contact_email" value="<?= esc($old['contact_email'] ?? '') ?>" class="block px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                    </label>

                    <label class="block">
                        <div class="mb-1 font-medium text-sm">Contact Phone</div>
                        <input name="contact_phone" value="<?= esc($old['contact_phone'] ?? '') ?>" class="block px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                    </label>

                    <div class="flex items-center gap-3 pt-2">
                        <button class="shadow px-4 py-2 rounded-md text-white btn-sage"> <i class="mr-2 fa fa-check"></i> Submit request</button>
                        <a href="<?= previous_url() ?>" class="px-4 py-2 btn-border rounded-md">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>