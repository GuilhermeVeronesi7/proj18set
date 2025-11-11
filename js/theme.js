// 3. Alteração de tema (theme.js)

document.addEventListener("DOMContentLoaded", () => {
    const themeToggleButton = document.getElementById('theme-toggle');
    const themeLink = document.getElementById('theme-style');
  
    // Caminhos para os arquivos CSS
    const themeLight = 'css/style.css';
    const themeDark = 'css/style-dark.css';
  
    // 3e. Verifica o tema salvo no localStorage ao carregar a página
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
      themeLink.href = themeDark;
    } else {
      themeLink.href = themeLight; // Padrão é o claro
    }
  
    // 3d. Adiciona o evento de clique ao botão
    themeToggleButton.addEventListener('click', () => {
      // Verifica qual tema está ativo ATRAVÉS DO link.href
      // Usar includes() torna a verificação mais robusta
      let isDark = themeLink.href.includes('style-dark.css');
  
      if (isDark) {
        // Troca para o tema claro
        themeLink.href = themeLight;
        localStorage.setItem('theme', 'light');
      } else {
        // Troca para o tema escuro
        themeLink.href = themeDark;
        localStorage.setItem('theme', 'dark');
      }
    });
  });