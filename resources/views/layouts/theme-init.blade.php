<script>
    (() => {
        let preference = 'system';
        try { preference = localStorage.getItem('multiresume-manager.appearance') || localStorage.getItem('resumefolio.appearance') || 'system';
            localStorage.setItem('multiresume-manager.appearance', preference); } catch (_) {}
        if (!['light', 'dark', 'system'].includes(preference)) preference = 'system';
        const dark = preference === 'dark' || (preference === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
        document.documentElement.dataset.theme = dark ? 'dark' : 'light';
        document.documentElement.dataset.appearance = preference;
        document.documentElement.style.colorScheme = dark ? 'dark' : 'light';
    })();
</script>
