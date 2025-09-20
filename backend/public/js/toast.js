function toast(message, type = 'info') {
    const id = 'toast-' + Date.now();
    const el = document.createElement('div');
    el.id = id;
    el.className = 'fixed right-4 top-4 z-60 px-4 py-2 rounded shadow text-white';
    el.style.background = (type === 'error') ? '#ef4444' : (type === 'success' ? '#10b981' : '#0ea5e9');
    el.textContent = message;
    document.body.appendChild(el);
    setTimeout(() => {
        try {
            document.body.removeChild(el);
        } catch (e) {}
    }, 5000);
}