const themeSelector = () => {
  const themeInputs = document.querySelectorAll<HTMLInputElement>(
    'input[name="theme"]',
  );

  const setDarkModeCSS = (isDarkMode: boolean) =>
    document.documentElement.classList.toggle("dark", isDarkMode);

  const setThemeInputs = (theme: string) =>
    themeInputs.forEach((input) => (input.checked = input.value === theme));

  const prefersDarkMode = window.matchMedia("(prefers-color-scheme: dark)");

  const processThemeChange = (theme: string) => {
    setThemeInputs(theme);
    if (theme === "system") {
      setDarkModeCSS(prefersDarkMode.matches);
    } else {
      setDarkModeCSS(theme === "dark");
    }
  };

  prefersDarkMode.addEventListener("change", (e) => {
    if (localStorage.theme === "system") {
      setDarkModeCSS(e.matches);
    }
  });

  themeInputs.forEach((input) => {
    input.addEventListener("change", (e) => {
      const selectedTheme = (e.target as HTMLInputElement).value;
      localStorage.theme = selectedTheme;
      processThemeChange(selectedTheme);
    });
  });

  processThemeChange(localStorage.theme || "system");
};

export default themeSelector;
