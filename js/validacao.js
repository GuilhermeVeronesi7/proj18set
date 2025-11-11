// 1. Validação de campo (validacao.js)

document.addEventListener("DOMContentLoaded", () => {
    // Seleciona o formulário e os campos
    const form = document.getElementById("sac-form");
    const emailInput = document.getElementById("id_email");
    const cpfInput = document.getElementById("id_cpf"); // Novo campo
    const statusMessage = document.getElementById("status-message"); // Div para mensagens
  
    // Adiciona o listener para o evento 'submit' do formulário
    form.addEventListener("submit", (event) => {
      // 1. Impede o envio padrão do formulário (que recarrega a página)
      event.preventDefault();
  
      // Limpa mensagens de status anteriores
      statusMessage.textContent = "";
      statusMessage.className = ""; // Limpa classes (ex: success, error)
  
      const email = emailInput.value;
      const cpf = cpfInput.value;
  
      // 1a. Validação do E-mail
      // Regex simples para verificar o formato "texto@texto.texto"
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        mostrarMensagem("Erro: Por favor, insira um e-mail válido (ex: seu.nome@dominio.com).", "error");
        return; // Para a execução
      }
  
      // 1b. Validação do CPF
      // Regex para o formato 999.999.999-99
      const cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
      if (!cpfRegex.test(cpf)) {
        mostrarMensagem("Erro: Por favor, insira um CPF válido no formato 999.999.999-99.", "error");
        return; // Para a execução
      }
  
      // Se passou em todas as validações
      mostrarMensagem("Formulário enviado com sucesso!", "success");
      form.reset(); // Limpa o formulário
    });
  
    // Função auxiliar para mostrar mensagens de status
    function mostrarMensagem(mensagem, tipo) {
      statusMessage.textContent = mensagem;
      if (tipo === "success") {
        statusMessage.className = "message-success";
      } else if (tipo === "error") {
        statusMessage.className = "message-error";
      }
    }
  });