@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const themeToggle = document.querySelector('.switch__input');

        themeToggle.addEventListener('change', function () {
            const isDarkMode = this.checked;

            if (isDarkMode) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }

            localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
        });

        // Check the user's theme preference and set the toggle accordingly
        const currentTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : null;
        if (currentTheme === 'dark') {
            document.documentElement.classList.add('dark');
            themeToggle.checked = true;
        }
    });
</script>
@endpush

<label class="inline-flex items-center cursor-pointer">
    <input type="checkbox" class="switch__input sr-only peer" />
    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
</label>
