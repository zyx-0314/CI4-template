<?php
// View: backend/app/Views/user/reservation_form.php
$service = $service ?? null;
$errors = $errors ?? [];
$old = $old ?? [];
$focal_name = $focal_name ?? '';
$fieldErrors = $fieldErrors ?? [];
?>
<!doctype html>
<html lang="en">
<?= view('components/head') ?>

<body class="bg-gray-50 font-sans text-slate-900">
    <?= view('components/header', ['active' => 'Services']) ?>

    <main class="mx-auto p-6 max-w-3xl">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-sage-light px-6 py-5 border-b">
                <h1 class="font-semibold text-slate-900 text-2xl">Reserve Service</h1>
                <?php if (!empty($service)): ?>
                    <div class="mt-1 text-slate-700 text-sm">
                        <?= esc($service['title']) ?> • <span class="font-medium">$<?= number_format((float)($service['cost'] ?? 0), 2) ?></span>
                    </div>
                <?php endif; ?>
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

                <form method="post" action="/reservation" class="gap-4 grid grid-cols-1">
                    <?= csrf_field() ?>
                    <!-- Service selector -->
                    <label class="block">
                        <div class="mb-1 font-medium text-sm">Service</div>
                        <select name="service_id" id="service_id" class="block px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full">
                            <?php if (!empty($services) && is_array($services)): ?>
                                <?php foreach ($services as $svc): ?>
                                    <?php $selected = ((string)($old['service_id'] ?? ($service['id'] ?? '')) === (string)$svc['id']) ? 'selected' : ''; ?>
                                    <option value="<?= esc($svc['id']) ?>" <?= $selected ?>><?= esc($svc['title']) ?> — $<?= number_format((float)($svc['cost'] ?? 0), 2) ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="<?= esc($service['id'] ?? '') ?>"><?= esc($service['title'] ?? 'Select a service') ?></option>
                            <?php endif; ?>
                        </select>
                    </label>

                    <!-- Focal person and phone -->
                    <div class="gap-4 grid grid-cols-1 sm:grid-cols-2">
                        <label class="block">
                            <div class="mb-1 font-medium text-sm">First name</div>
                            <div class="relative">
                                <span class="left-0 absolute inset-y-0 flex items-center pl-3 text-slate-500"><i class="fa fa-user"></i></span>
                                <input name="first_name" value="<?= esc($old['first_name'] ?? ($first_name ?? '')) ?>" class="block px-3 py-2 pl-10 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                            </div>
                            <?php if (!empty($fieldErrors['first_name'])): ?>
                                <div class="mt-2 text-rose text-sm"><?= esc($fieldErrors['first_name']) ?></div>
                            <?php endif; ?>
                        </label>

                        <label class="block">
                            <div class="mb-1 font-medium text-sm">Last name</div>
                            <div class="relative">
                                <span class="left-0 absolute inset-y-0 flex items-center pl-3 text-slate-500"><i class="fa fa-user"></i></span>
                                <input name="last_name" value="<?= esc($old['last_name'] ?? ($last_name ?? '')) ?>" class="block px-3 py-2 pl-10 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                            </div>
                            <?php if (!empty($fieldErrors['last_name'])): ?>
                                <div class="mt-2 text-rose text-sm"><?= esc($fieldErrors['last_name']) ?></div>
                            <?php endif; ?>
                        </label>
                    </div>

                    <label class="block">
                        <div class="mb-1 font-medium text-sm">Phone</div>
                        <div class="relative">
                            <span class="left-0 absolute inset-y-0 flex items-center pl-3 text-slate-500"><i class="fa fa-phone"></i></span>
                            <input name="phone" value="<?= esc($old['phone'] ?? '') ?>" class="block px-3 py-2 pl-10 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                        </div>
                        <?php if (!empty($fieldErrors['phone'])): ?>
                            <div class="mt-2 text-red-700 text-rose text-sm"><?= esc($fieldErrors['phone']) ?></div>
                        <?php endif; ?>
                    </label>

                    <label class="block">
                        <div class="mb-1 font-medium text-sm">Email</div>
                        <div class="relative">
                            <span class="left-0 absolute inset-y-0 flex items-center pl-3 text-slate-500"><i class="fa fa-envelope"></i></span>
                            <input name="email" value="<?= esc($old['email'] ?? ($email ?? '')) ?>" class="block px-3 py-2 pl-10 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                        </div>
                        <?php if (!empty($fieldErrors['email'])): ?>
                            <div class="mt-2 text-rose text-sm"><?= esc($fieldErrors['email']) ?></div>
                        <?php endif; ?>
                    </label>

                    <div class="gap-4 grid grid-cols-1 sm:grid-cols-2">
                        <label class="block">
                            <div class="mb-1 font-medium text-sm">Start date</div>
                            <div class="relative">
                                <span class="left-0 absolute inset-y-0 flex items-center pl-3 text-slate-500"><i class="fa fa-calendar-days"></i></span>
                                <input type="date" name="date_start" value="<?= esc($old['date_start'] ?? '') ?>" class="block px-3 py-2 pl-10 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                            </div>
                            <?php if (!empty($fieldErrors['date_start'])): ?>
                                <div class="mt-2 text-rose text-sm"><?= esc($fieldErrors['date_start']) ?></div>
                            <?php endif; ?>
                        </label>

                        <label class="block">
                            <div class="mb-1 font-medium text-sm">End date</div>
                            <div class="relative">
                                <span class="left-0 absolute inset-y-0 flex items-center pl-3 text-slate-500"><i class="fa fa-calendar-days"></i></span>
                                <input type="date" name="date_end" value="<?= esc($old['date_end'] ?? '') ?>" class="block px-3 py-2 pl-10 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                            </div>
                            <?php if (!empty($fieldErrors['date_end'])): ?>
                                <div class="mt-2 text-rose text-sm"><?= esc($fieldErrors['date_end']) ?></div>
                            <?php endif; ?>
                        </label>
                    </div>

                    <label class="block">
                        <div class="mb-1 font-medium text-sm">Additional requests (CSV)</div>
                        <div class="relative">
                            <span class="left-0 absolute inset-y-0 flex items-center pl-3 text-slate-500"><i class="fa fa-list"></i></span>
                            <input name="additional_requests" value="<?= esc($old['additional_requests'] ?? '') ?>" placeholder="e.g. Chair,Flowers,Microphone" class="block px-3 py-2 pl-10 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                        </div>
                    </label>

                    <fieldset class="bg-stone-light p-4 border rounded">
                        <legend class="font-medium text-sm">Payment (demo)</legend>
                        <div class="gap-3 grid grid-cols-1 mt-3">
                            <label class="block">
                                <div class="mb-1 text-sm">Name on card</div>
                                <input name="cc_name" value="<?= esc($old['cc_name'] ?? '') ?>" class="block px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                                <?php if (!empty($fieldErrors['cc_name'])): ?>
                                    <div class="mt-2 text-rose text-sm"><?= esc($fieldErrors['cc_name']) ?></div>
                                <?php endif; ?>
                            </label>

                            <label class="block">
                                <div class="mb-1 text-sm">Card number</div>
                                <div class="relative">
                                    <span class="left-0 absolute inset-y-0 flex items-center pl-3 text-slate-500"><i class="fa fa-credit-card"></i></span>
                                    <input id="cc_number" name="cc_number" value="<?= esc($old['cc_number'] ?? '') ?>" placeholder="4242 4242 4242 4242" class="block px-3 py-2 pl-10 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                                </div>
                                <p class="mt-2 text-slate-600 text-xs">We do not store full card numbers in this demo; only last 4 digits are kept.</p>
                            </label>

                            <div class="gap-3 grid grid-cols-1 sm:grid-cols-3">
                                <label class="block">
                                    <div class="mb-1 text-sm">CVV</div>
                                    <input id="cc_cvv" name="cc_cvv" value="<?= esc($old['cc_cvv'] ?? '') ?>" placeholder="123" maxlength="4" class="block px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                                </label>
                                <?php if (!empty($fieldErrors['cc_cvv'])): ?>
                                    <div class="mt-2 text-rose text-sm"><?= esc($fieldErrors['cc_cvv']) ?></div>
                                <?php endif; ?>

                                <label class="block">
                                    <div class="mb-1 text-sm">Expiry (MM/YY)</div>
                                    <input id="cc_expiry" name="cc_expiry" value="<?= esc($old['cc_expiry'] ?? '') ?>" placeholder="MM/YY" maxlength="5" class="block px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-sage w-full" />
                                </label>
                                <?php if (!empty($fieldErrors['cc_expiry'])): ?>
                                    <div class="mt-2 text-rose text-sm"><?= esc($fieldErrors['cc_expiry']) ?></div>
                                <?php endif; ?>

                                <label class="block">
                                    <div class="mb-1 text-sm">Card type (demo)</div>
                                    <div class="flex items-center gap-3">
                                        <label class="inline-flex items-center gap-2 text-sm"><input type="checkbox" id="cc_type_visa" name="cc_type[]" value="visa" <?= in_array('visa', (array)($old['cc_type'] ?? [])) ? 'checked' : '' ?> /> <span>Visa</span></label>
                                        <label class="inline-flex items-center gap-2 text-sm"><input type="checkbox" id="cc_type_master" name="cc_type[]" value="master" <?= in_array('master', (array)($old['cc_type'] ?? [])) ? 'checked' : '' ?> /> <span>Mastercard</span></label>
                                    </div>
                                </label>
                            </div>

                            <div class="flex items-center gap-3 pt-2">
                                <button id="demoPaymentBtn" class="px-3 py-2 border btn-border border-slate-200 rounded-md text-sm"> <i class="mr-2 fa fa-magic"></i> Demo Payment</button>
                                <div class="text-slate-600 text-xs">Click to autofill demo card data (no real charges)</div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="flex items-center gap-3 pt-2">
                        <button class="shadow px-4 py-2 rounded-md text-white btn-sage"> <i class="mr-2 fa fa-check"></i> Submit reservation</button>
                        <a href="/services<?= isset($service['id']) ? '/' . $service['id'] : '' ?>" class="px-4 py-2 btn-border rounded-md"> <i class="fa-arrow-left mr-2 fa"></i> Back</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?= view('components/footer') ?>
</body>

</html>

<script>
    // Demo payment autofill - lightweight and non-invasive
    (() => {
        const btn = document.getElementById('demoPaymentBtn');
        if (!btn) return;
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            // Example demo cards
            const demoVisa = {
                number: '4242 4242 4242 4242',
                cvv: '123',
                expiry: getExpiry(12, 3),
                type: 'visa'
            };
            const demoMaster = {
                number: '5555 5555 5555 4444',
                cvv: '321',
                expiry: getExpiry(6, 2),
                type: 'master'
            };

            // Pick one deterministically (toggle based on current time)
            const pick = (new Date().getSeconds() % 2 === 0) ? demoVisa : demoMaster;

            const numberEl = document.getElementById('cc_number');
            const cvvEl = document.getElementById('cc_cvv');
            const expEl = document.getElementById('cc_expiry');
            const visaEl = document.getElementById('cc_type_visa');
            const masterEl = document.getElementById('cc_type_master');

            if (numberEl) numberEl.value = pick.number;
            if (cvvEl) cvvEl.value = pick.cvv;
            if (expEl) expEl.value = pick.expiry;
            if (visaEl) visaEl.checked = pick.type === 'visa';
            if (masterEl) masterEl.checked = pick.type === 'master';
        });

        function getExpiry(monthsAhead = 6, pad = 2) {
            const d = new Date();
            d.setMonth(d.getMonth() + monthsAhead);
            const mm = String(d.getMonth() + 1).padStart(2, '0');
            const yy = String(d.getFullYear()).slice(-2);
            return `${mm}/${yy}`;
        }
    })();
</script>