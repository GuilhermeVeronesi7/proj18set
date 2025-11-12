// 1. Validação de campo (validacao.js)

document.addEventListener("DOMContentLoaded", () => {
    // Seleciona o formulário e os campos
    const form = document.getElementById("sac-form");
    const emailInput = document.getElementById("id_email");
    const cpfInput = document.getElementById("id_cpf"); // Novo campo
    const statusMessage = document.getElementById("status-message"); // Div para mensagens

    // --- MELHORIA: MÁSCARA AUTOMÁTICA DE CPF ---
    // Adiciona um listener no campo de CPF para o evento 'input' (cada vez que o usuário digita)
    cpfInput.addEventListener('input', (event) => {
        let value = event.target.value;
        
        // 1. Remove tudo que não for dígito
        // (O \D significa "não dígito")
        value = value.replace(/\D/g, '');
        
        // 2. Aplica a máscara 999.999.999-99 dinamicamente
        
        // Adiciona o primeiro ponto (depois de 3 dígitos)
        if (value.length > 3) {
          value = value.slice(0, 3) + '.' + value.slice(3);
        }
        // Adiciona o segundo ponto (depois de 7 caracteres: 999.)
        if (value.length > 7) {
          value = value.slice(0, 7) + '.' + value.slice(7);
        }
        // Adiciona o hífen (depois de 11 caracteres: 999.999.)
        if (value.length > 11) {
          value = value.slice(0, 11) + '-' + value.slice(11);
        }

        // 3. Limita o tamanho total para 14 caracteres (o tamanho final da máscara)
        if (value.length > 14) {
          value = value.slice(0, 14);
        }
        
        // 4. Atualiza o valor no campo do formulário
        event.target.value = value;
    });
    // --- FIM DA MELHORIA ---

  
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
      // A regex já esperava o formato com pontos e hífen, então funciona perfeitamente.
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
      } else if (tipo ===a === "error") {
        statusMessage.className = "message-error";
      }
    }
  });
