<?php
// Component: components/modal/accounts/email_verification.php
// Data contract: Uses session data - requires 'user' array in session with 'id' and 'email'
$userSession = session()->get('user');
$sessionUserId = $userSession['id'] ?? null;
$sessionEmail = $userSession['email'] ?? null;
?>

<div class="flex justify-end mb-4">
    <button type="button" <?= $sessionUserId ? 'data-verify-user-id="' . esc($sessionUserId) . '"' : '' ?> <?= $sessionEmail ? 'data-verify-user-email="' . esc($sessionEmail) . '"' : '' ?> class="bg-blue-600/70 hover:bg-blue-600/60 px-3 py-2 rounded text-white duration-200 cursor-pointer js-verify-email-trigger">
        <i class="fa-solid fa-envelope-circle-check"></i>
    </button>
</div>

<div class="hidden z-50 fixed inset-0 justify-center items-center m-0 email-verification-modal">
    <div class="absolute inset-0 bg-black opacity-50 email-verification-backdrop"></div>

    <div class="relative bg-white shadow-lg mx-4 my-8 rounded w-full max-w-md max-h-[90vh] overflow-auto" role="dialog" aria-modal="true" aria-labelledby="emailVerificationTitle">
        <header class="px-6 py-4 border-b">
            <h3 id="emailVerificationTitle" class="font-semibold text-lg">Email Verification</h3>
        </header>

        <div class="space-y-6 px-6 py-6">
            <div class="text-center">
                <div class="flex justify-center items-center bg-blue-100 mx-auto mb-4 rounded-full w-12 h-12">
                    <i class="text-blue-600 fa-solid fa-envelope"></i>
                </div>
                <p class="text-gray-700 text-sm">
                    We've sent a 6-character verification code to:
                </p>
                <p class="mt-1 font-medium text-gray-900 verification-email"><?= esc($sessionEmail ?? 'your email') ?></p>
            </div>

            <form class="space-y-6 email-verification-form" method="POST" action="/settings/verify-email">
                <?= csrf_field() ?>
                <input type="hidden" name="user_id" class="verification-user-id" value="<?= esc($sessionUserId ?? '') ?>" />

                <!-- Code Input Section -->
                <div class="space-y-4">
                    <label class="block font-medium text-gray-700 text-sm text-center">
                        Enter Verification Code
                    </label>

                    <div class="flex justify-center space-x-2">
                        <!-- Letter inputs -->
                        <input type="text" maxlength="1" class="border-2 border-gray-300 focus:border-blue-500 rounded-lg focus:ring-2 focus:ring-blue-200 w-12 h-12 font-bold text-lg text-center uppercase verification-code-input" data-index="0" />
                        <input type="text" maxlength="1" class="border-2 border-gray-300 focus:border-blue-500 rounded-lg focus:ring-2 focus:ring-blue-200 w-12 h-12 font-bold text-lg text-center uppercase verification-code-input" data-index="1" />

                        <div class="flex justify-center items-center w-4">
                            <div class="bg-gray-400 w-2 h-0.5"></div>
                        </div>

                        <!-- Number inputs -->
                        <input type="text" maxlength="1" class="border-2 border-gray-300 focus:border-blue-500 rounded-lg focus:ring-2 focus:ring-blue-200 w-12 h-12 font-bold text-lg text-center verification-code-input" data-index="2" />
                        <input type="text" maxlength="1" class="border-2 border-gray-300 focus:border-blue-500 rounded-lg focus:ring-2 focus:ring-blue-200 w-12 h-12 font-bold text-lg text-center verification-code-input" data-index="3" />
                        <input type="text" maxlength="1" class="border-2 border-gray-300 focus:border-blue-500 rounded-lg focus:ring-2 focus:ring-blue-200 w-12 h-12 font-bold text-lg text-center verification-code-input" data-index="4" />
                        <input type="text" maxlength="1" class="border-2 border-gray-300 focus:border-blue-500 rounded-lg focus:ring-2 focus:ring-blue-200 w-12 h-12 font-bold text-lg text-center verification-code-input" data-index="5" />
                    </div>

                    <input type="hidden" name="verification_code" class="full-verification-code" />
                </div>

                <!-- Timer and Resend Section -->
                <div class="space-y-3 text-center">
                    <div class="timer-section">
                        <p class="text-gray-600 text-sm">
                            Code expires in: <span class="font-mono font-semibold text-blue-600 countdown-timer">01:00</span>
                        </p>
                    </div>

                    <div class="hidden resend-section">
                        <button type="button" class="font-medium text-blue-600 hover:text-blue-800 text-sm resend-code-btn">
                            Resend Code
                        </button>
                        <p class="mt-1 text-gray-500 text-xs">
                            Resent: <span class="resend-counter">0</span>/5 times
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <footer class="flex justify-end space-x-2 pt-4 border-t">
                    <button type="button" class="hover:bg-gray-50 px-4 py-2 border border-gray-300 rounded text-gray-700 cursor-pointer btn-cancel-verification">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 disabled:opacity-50 px-4 py-2 rounded text-white cursor-pointer disabled:cursor-not-allowed verify-code-btn" disabled>
                        Verify
                    </button>
                </footer>
            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        if (window.__emailVerificationModalInit) return;
        window.__emailVerificationModalInit = true;

        function showToast(message, type = 'info', timeout = 3000) {
            const id = 'toast_' + Date.now();
            const el = document.createElement('div');
            el.id = id;
            el.className = 'fixed right-4 top-4 z-50 px-4 py-2 rounded shadow-lg text-white';
            el.style.background = type === 'error' ? '#ef4444' : (type === 'success' ? '#10b981' : '#111827');
            el.textContent = message;
            document.body.appendChild(el);
            setTimeout(() => {
                try {
                    el.remove();
                } catch (e) {}
            }, timeout);
            return id;
        }

        document.addEventListener('click', function(e) {
            const trigger = e.target.closest('[data-verify-user-id], .js-verify-email-trigger');
            if (!trigger) return;
            e.preventDefault();

            const userId = trigger.getAttribute('data-verify-user-id');
            const email = trigger.getAttribute('data-verify-user-email') || '';

            const container = trigger.closest('td') || trigger.closest('tr') || document;
            const modal = container.querySelector('.email-verification-modal');
            if (!modal) return;

            // Initialize modal state
            let timerInterval = null;
            let timeRemaining = 60; // 1 minute in seconds
            let resendCount = 0;
            const maxResends = 5;

            const userIdInput = modal.querySelector('.verification-user-id');
            const emailDisplay = modal.querySelector('.verification-email');
            const codeInputs = modal.querySelectorAll('.verification-code-input');
            const fullCodeInput = modal.querySelector('.full-verification-code');
            const verifyBtn = modal.querySelector('.verify-code-btn');
            const backdrop = modal.querySelector('.email-verification-backdrop');
            const btnCancel = modal.querySelector('.btn-cancel-verification');
            const form = modal.querySelector('.email-verification-form');
            const timerDisplay = modal.querySelector('.countdown-timer');
            const timerSection = modal.querySelector('.timer-section');
            const resendSection = modal.querySelector('.resend-section');
            const resendBtn = modal.querySelector('.resend-code-btn');
            const resendCounter = modal.querySelector('.resend-counter');

            // Set initial values
            document.body.style.overflow = 'hidden';
            if (userIdInput) userIdInput.value = userId || '';
            if (emailDisplay) emailDisplay.textContent = email || '';
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // Send initial verification code
            sendVerificationCode().then(() => {
                // Focus first input after sending code
                if (codeInputs[0]) codeInputs[0].focus();
                // Reset form state
                resetForm();
            });

            async function sendVerificationCode() {
                try {
                    const response = await fetch('/settings/send-verification', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        showToast(data.message || 'Verification code sent!', 'success');
                    } else {
                        showToast(data.message || 'Failed to send verification code', 'error');
                    }
                } catch (error) {
                    showToast('Network error. Please try again.', 'error');
                }
            }

            function resetForm() {
                codeInputs.forEach(input => {
                    input.value = '';
                    input.classList.remove('border-red-500', 'border-green-500');
                    input.classList.add('border-gray-300');
                });
                if (fullCodeInput) fullCodeInput.value = '';
                if (verifyBtn) verifyBtn.disabled = true;
                timeRemaining = 60;
                startTimer();
            }

            function startTimer() {
                if (timerInterval) clearInterval(timerInterval);

                timerSection.classList.remove('hidden');
                resendSection.classList.add('hidden');

                timerInterval = setInterval(() => {
                    timeRemaining--;
                    const minutes = Math.floor(timeRemaining / 60);
                    const seconds = timeRemaining % 60;
                    timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                    if (timeRemaining <= 0) {
                        clearInterval(timerInterval);
                        timerSection.classList.add('hidden');
                        if (resendCount < maxResends) {
                            resendSection.classList.remove('hidden');
                        } else {
                            showToast('Maximum resend attempts reached. Please try again later.', 'error');
                        }
                    }
                }, 1000);
            }

            // Handle code input
            codeInputs.forEach((input, index) => {
                input.addEventListener('input', function(e) {
                    const value = e.target.value;

                    // Only allow letters for first 2 inputs, numbers for last 4
                    if (index < 2) {
                        // Letters only
                        e.target.value = value.replace(/[^a-zA-Z]/g, '').toUpperCase();
                    } else {
                        // Numbers only
                        e.target.value = value.replace(/[^0-9]/g, '');
                    }

                    // Move to next input if filled
                    if (e.target.value && index < codeInputs.length - 1) {
                        codeInputs[index + 1].focus();
                    }

                    updateFullCode();
                });

                input.addEventListener('keydown', function(e) {
                    // Move to previous input on backspace if current is empty
                    if (e.key === 'Backspace' && !e.target.value && index > 0) {
                        codeInputs[index - 1].focus();
                    }
                });

                input.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const pasteData = e.clipboardData.getData('text').toUpperCase();

                    if (pasteData.length === 6) {
                        codeInputs.forEach((inp, idx) => {
                            if (idx < 2) {
                                // Letters for first 2
                                inp.value = pasteData[idx].match(/[A-Z]/) ? pasteData[idx] : '';
                            } else {
                                // Numbers for last 4
                                inp.value = pasteData[idx].match(/[0-9]/) ? pasteData[idx] : '';
                            }
                        });
                        updateFullCode();
                    }
                });
            });

            function updateFullCode() {
                const code = Array.from(codeInputs).map(input => input.value).join('');
                if (fullCodeInput) fullCodeInput.value = code;

                const isComplete = code.length === 6 &&
                    code.substring(0, 2).match(/^[A-Z]{2}$/) &&
                    code.substring(2).match(/^[0-9]{4}$/);

                if (verifyBtn) verifyBtn.disabled = !isComplete;
            }

            // Handle resend
            if (resendBtn) {
                resendBtn.addEventListener('click', async function() {
                    if (resendCount >= maxResends) return;

                    // Disable button during request
                    resendBtn.disabled = true;
                    const originalText = resendBtn.textContent;
                    resendBtn.textContent = 'Sending...';

                    try {
                        const response = await fetch('/settings/send-verification', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        const data = await response.json();

                        if (response.ok && data.success) {
                            resendCount++;
                            resendCounter.textContent = resendCount;

                            if (resendCount >= maxResends) {
                                resendBtn.textContent = 'Max attempts reached';
                                resendBtn.classList.add('opacity-50', 'cursor-not-allowed');
                            } else {
                                resendBtn.disabled = false;
                                resendBtn.textContent = originalText;
                            }

                            resetForm();
                            showToast(data.message || 'Verification code resent!', 'success');
                        } else {
                            resendBtn.disabled = false;
                            resendBtn.textContent = originalText;
                            showToast(data.message || 'Failed to resend verification code', 'error');
                        }
                    } catch (error) {
                        resendBtn.disabled = false;
                        resendBtn.textContent = originalText;
                        showToast('Network error. Please try again.', 'error');
                    }
                });
            }

            function closeModal() {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
                document.body.style.overflow = '';

                if (timerInterval) clearInterval(timerInterval);

                // Reset all form elements
                if (userIdInput) userIdInput.value = '';
                if (emailDisplay) emailDisplay.textContent = '';
                resetForm();
                resendCount = 0;
                if (resendCounter) resendCounter.textContent = '0';
                if (resendBtn) {
                    resendBtn.disabled = false;
                    resendBtn.textContent = 'Resend Code';
                    resendBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }

                // Remove event listeners
                if (backdrop) backdrop.removeEventListener('click', onBackdrop);
                if (btnCancel) btnCancel.removeEventListener('click', onCancel);
                if (form) form.removeEventListener('submit', onSubmit);
            }

            function onBackdrop() {
                closeModal();
            }

            function onCancel() {
                closeModal();
            }

            let _isSubmitting = false;
            async function onSubmit(ev) {
                ev.preventDefault();
                if (_isSubmitting) return;

                const code = fullCodeInput.value;
                if (code.length !== 6) {
                    showToast('Please enter the complete 6-character code', 'error');
                    return;
                }

                _isSubmitting = true;
                if (backdrop) backdrop.removeEventListener('click', onBackdrop);
                if (btnCancel) btnCancel.disabled = true;
                if (verifyBtn) verifyBtn.disabled = true;

                const statusToast = showToast('Verifying code...', 'info', 60000);
                const fd = new FormData(form);

                try {
                    const resp = await fetch(form.action, {
                        method: 'POST',
                        body: fd
                    });

                    let data = null;
                    try {
                        data = await resp.json();
                    } catch (err) {
                        data = null;
                    }

                    if (resp.ok && data && data.success) {
                        showToast(data.message || 'Email verified successfully!', 'success', 3000);
                        setTimeout(() => {
                            closeModal();
                            location.reload();
                        }, 1500);
                    } else {
                        const msg = data && data.message ? data.message : 'Verification failed';
                        showToast(msg, 'error', 5000);

                        // Mark inputs as invalid
                        codeInputs.forEach(input => {
                            input.classList.remove('border-gray-300', 'border-green-500');
                            input.classList.add('border-red-500');
                        });
                    }
                } catch (err) {
                    showToast('Network or server error', 'error', 5000);
                } finally {
                    _isSubmitting = false;
                    try {
                        const t = document.getElementById(statusToast);
                        if (t) t.remove();
                    } catch (e) {}
                    if (backdrop) backdrop.addEventListener('click', onBackdrop);
                    if (btnCancel) btnCancel.disabled = false;
                    if (verifyBtn) verifyBtn.disabled = false;
                }
            }

            // Add event listeners
            if (backdrop) backdrop.addEventListener('click', onBackdrop);
            if (btnCancel) btnCancel.addEventListener('click', onCancel);
            if (form) form.addEventListener('submit', onSubmit);
        });
    })();
</script>