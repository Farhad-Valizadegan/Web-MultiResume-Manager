const root = document.documentElement;
const systemTheme = window.matchMedia('(prefers-color-scheme: dark)');
let preference = root.dataset.appearance || 'system';
function applyAppearance(value) {
    preference = ['light', 'dark', 'system'].includes(value) ? value : 'system';
    const theme = preference === 'system' ? (systemTheme.matches ? 'dark' : 'light') : preference;
    root.dataset.appearance = preference;
    root.dataset.theme = theme;
    root.style.colorScheme = theme;
    document.querySelectorAll('[data-appearance]').forEach(select => { select.value = preference; });
}
applyAppearance(preference);
document.querySelectorAll('[data-appearance]').forEach(select => select.addEventListener('change', () => {
    applyAppearance(select.value);
    try { localStorage.setItem('multiresume-manager.appearance', preference); } catch (_) {}
}));
systemTheme.addEventListener('change', () => { if (preference === 'system') applyAppearance('system'); });
window.addEventListener('storage', event => {
    if (event.key === 'multiresume-manager.appearance') applyAppearance(event.newValue || 'system');
});
// Build navigation from real section headings so create and edit stay consistent.
document.querySelectorAll('[data-section-links]').forEach(container => {
    const form = container.closest('form');
    form.querySelectorAll('[data-editor-section]').forEach((section, index) => {
        const heading = section.querySelector('[data-section-title]');
        if (!heading) return;
        section.id = section.id || 'resume-section-' + index;
        section.style.scrollMarginTop = '6rem';
        const link = document.createElement('a');
        link.href = '#' + section.id;
        link.textContent = heading.textContent.trim();
        link.addEventListener('click', () => { section.open = true; });
        container.append(link);
    });
});
const search = document.querySelector('[data-resume-search]');
const status = document.querySelector('[data-resume-status]');
if (search && status) {
    const cards = [...document.querySelectorAll('[data-resume-card]')];
    const results = document.querySelector('[data-resume-results]');
    const empty = document.querySelector('[data-resume-empty]');
    function filterResumes() {
        const query = search.value.trim().toLocaleLowerCase();
        let visible = 0;
        cards.forEach(card => {
            const matches = card.dataset.search.toLocaleLowerCase().includes(query) && (status.value === 'all' || card.dataset.status === status.value);
            card.hidden = !matches;
            if (matches) visible++;
        });
        results.textContent = cards.length ? visible + ' of ' + cards.length + ' resumes' : '';
        empty.hidden = !cards.length || visible !== 0;
    }
    search.addEventListener('input', filterResumes);
    status.addEventListener('change', filterResumes);
    filterResumes();
}
