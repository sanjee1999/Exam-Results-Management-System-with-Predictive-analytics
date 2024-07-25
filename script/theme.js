
  const themeToggle = document.getElementById('theme-toggle');
  const currentTheme = localStorage.getItem('theme');

  // Apply the saved theme
  if (currentTheme === 'dark') {
    document.body.classList.add('dark-mode');
  }

  themeToggle.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');

    // Save the current theme to localStorage
    if (document.body.classList.contains('dark-mode')) {
      localStorage.setItem('theme', 'dark');
    } else {
      localStorage.setItem('theme', 'light');
    }
  });

