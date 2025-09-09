<button type="button" id="openForgotModal" class="font-medium text-emerald-600 hover:underline">Forgot your password?</button>

<!-- Template (inert inside the page) to avoid being inside the login form DOM tree -->
<template id="forgot-template">
    <div id="forgotModal" class="z-50 fixed inset-0 flex justify-center items-center bg-black/40">
        <div role="dialog" aria-modal="true" aria-labelledby="forgotTitle" class="bg-white mx-4 p-6 rounded-lg w-full max-w-md">
            <h3 id="forgotTitle" class="font-semibold text-lg">Reset your password</h3>
            <p class="mt-2 text-gray-600 text-sm">Enter the email address for your account and we'll send a reset link.</p>

            <form id="forgotForm" class="mt-4" action="/forgot" method="post">
                <?= csrf_field() ?>
                <label for="forgotEmail" class="sr-only">Email address</label>
                <input id="forgotEmail" name="email" type="email" required placeholder="you@example.com" class="px-3 py-2 border border-gray-300 rounded-md w-full">

                <div id="forgotFeedback" class="mt-3 text-gray-700 text-sm" aria-live="polite"></div>

                <div class="flex justify-end items-center gap-3 mt-4">
                    <button type="button" id="cancelForgot" class="px-4 py-2 border rounded-md">Cancel</button>
                    <button type="submit" id="sendResetBtn" class="bg-emerald-600 px-4 py-2 rounded-md text-white">Send reset</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    (function() {
        var opener = document.getElementById('openForgotModal');
        var tpl = document.getElementById('forgot-template');

        function modalEl() {
            return document.getElementById('forgotModal');
        }

        function openModal() {
            if (!modalEl()) {
                var clone = tpl.content.cloneNode(true);
                document.body.appendChild(clone);

                var m = modalEl();
                m.addEventListener('click', function(e) {
                    if (e.target === m) closeModal();
                });

                var cancel = document.getElementById('cancelForgot');
                cancel && cancel.addEventListener('click', closeModal);

                var form = document.getElementById('forgotForm');
                var feedback = document.getElementById('forgotFeedback');
                var submit = document.getElementById('sendResetBtn');

                if (form) {
                    form.addEventListener('submit', function(ev) {
                        ev.preventDefault();
                        if (!form.checkValidity()) {
                            form.reportValidity();
                            return;
                        }
                        feedback.textContent = '';
                        submit.disabled = true;
                        var old = submit.textContent;
                        submit.textContent = 'Sending...';

                        fetch(form.action, {
                                method: 'POST',
                                body: new FormData(form),
                                credentials: 'same-origin'
                            })
                            .then(function(res) {
                                submit.disabled = false;
                                submit.textContent = old;
                                var ct = (res.headers.get('content-type') || '');
                                if (ct.indexOf('application/json') !== -1) return res.json().then(function(d) {
                                    if (d.error) {
                                        feedback.textContent = d.error.message || JSON.stringify(d.error);
                                        feedback.className = 'mt-3 text-sm text-red-600';
                                    } else {
                                        feedback.textContent = d.message || 'If an account exists we sent a reset link.';
                                        feedback.className = 'mt-3 text-sm text-green-600';
                                    }
                                });
                                return res.text().then(function() {
                                    feedback.textContent = 'If an account exists we sent a reset link.';
                                    feedback.className = 'mt-3 text-sm text-green-600';
                                });
                            })
                            .catch(function() {
                                submit.disabled = false;
                                submit.textContent = old;
                                feedback.textContent = 'Network error.';
                                feedback.className = 'mt-3 text-sm text-red-600';
                            });
                    });
                }
            }
            setTimeout(function() {
                var e = document.getElementById('forgotEmail');
                e && e.focus();
            }, 10);
        }

        function closeModal() {
            var m = modalEl();
            if (m) m.remove();
        }

        opener && opener.addEventListener('click', openModal);
    })();
</script>