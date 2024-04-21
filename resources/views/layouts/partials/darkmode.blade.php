@push('script')
<script>
    const themeToggle = document.querySelector("#theme-toggle");

    themeToggle.addEventListener("click", () => {
        const isLightMode = document.documentElement.classList.contains("light");
        isLightMode ? enableDarkMode() : enableLightMode();
        localStorage.setItem('theme', isLightMode ? 'dark' : 'light');
    });

    function enableDarkMode() {
        document.documentElement.classList.remove("light");
        document.documentElement.classList.add("dark");
        themeToggle.setAttribute("aria-label", "Switch to light theme");
    }

    function enableLightMode() {
        document.documentElement.classList.remove("dark");
        document.documentElement.classList.add("light");
        themeToggle.setAttribute("aria-label", "Switch to dark theme");
    }

    function setThemePreference() {
        const storedTheme = localStorage.getItem('theme');
        if (storedTheme === 'dark') {
            enableDarkMode();
        } else if (storedTheme === 'light') {
            enableLightMode();
        } else {
            if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
                enableDarkMode();
            } else {
                enableLightMode();
            }
        }
    }

    setThemePreference();
</script>
@endpush

  <button id="theme-toggle" aria-label="Switch to dark theme">
    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 472.39 472.39">
      <g class="toggle-sun">
        <path d="M403.21,167V69.18H305.38L236.2,0,167,69.18H69.18V167L0,236.2l69.18,69.18v97.83H167l69.18,69.18,69.18-69.18h97.83V305.38l69.18-69.18Zm-167,198.17a129,129,0,1,1,129-129A129,129,0,0,1,236.2,365.19Z" />
      </g>
      <g class="toggle-circle">
        <circle class="cls-1" cx="236.2" cy="236.2" r="103.78" />
      </g>
    </svg>

  </button>
