const copyMessage = document.querySelector('[data-copy-message]');
document.querySelectorAll('[data-copy-link]').forEach(button => {
    button.addEventListener('click', async () => {
        try {
            await navigator.clipboard.writeText(button.dataset.copyLink);
            copyMessage.textContent = 'Public link copied. You can share it with your application.';
        } catch (_) {
            copyMessage.textContent = 'Copy is unavailable in this browser. Select the public link and copy it manually.';
        }
        copyMessage.hidden = false;
        copyMessage.scrollIntoView({ block: 'nearest', behavior: 'auto' });
    });
});
const reset = document.querySelector('[data-reset-filters]');
if (reset) reset.addEventListener('click', () => {
    const search = document.querySelector('[data-resume-search]');
    const status = document.querySelector('[data-resume-status]');
    search.value = '';
    status.value = 'all';
    search.dispatchEvent(new Event('input', { bubbles: true }));
    search.focus();
});

// Labels also apply to repeatable fields added after the page loads.
let fieldSequence = 0;
function associateLabels(container) {
    container.querySelectorAll('label:not([for])').forEach(label => {
        if (label.querySelector('input,textarea,select')) return;
        const fields = label.parentElement.querySelectorAll('input:not([type=hidden]):not([type=checkbox]):not([type=radio]),textarea,select');
        if (fields.length !== 1) return;
        const field = fields[0];
        if (!field.id) {
            do { fieldSequence++; } while (document.getElementById('rf-field-' + fieldSequence));
            field.id = 'rf-field-' + fieldSequence;
        }
        label.htmlFor = field.id;
    });
}
document.querySelectorAll('form[data-resume-editor]').forEach(form => {
    associateLabels(form);
    new MutationObserver(() => associateLabels(form)).observe(form, { childList: true, subtree: true });
    let dirty = false;
    form.addEventListener('input', () => { dirty = true; });
    form.addEventListener('change', () => { dirty = true; });
    form.addEventListener('click', event => {
        if (event.target.closest('button[onclick]')) dirty = true;
    });
    form.addEventListener('submit', () => { dirty = false; });
    window.addEventListener('beforeunload', event => {
        if (dirty) { event.preventDefault(); event.returnValue = ''; }
    });
});
