// Arquivo: js/validacao.js
// Este script é responsável por toda a validação do formulário da página SAC.

/* Esperamos o HTML da página carregar (evento "DOMContentLoaded") antes de rodar nosso JS.
  Isso garante que todos os elementos (formulário, campos) já existem 
  na página e o JS consegue "enxergá-los" para adicionar os eventos.
*/
document.addEventListener("DOMContentLoaded", () => {
    
    // Aqui, "linkamos" o JS com os elementos do HTML da página sac.html
    // Usamos os IDs que definimos no HTML para buscar cada elemento.
    const form = document.getElementById("sac-form"); // O formulário todo
    const emailInput = document.getElementById("id_email"); // O campo de e-mail
    const cpfInput = document.getElementById("id_cpf"); // O campo de CPF
    const statusMessage = document.getElementById("status-message"); // A <div> para mostrar as mensagens

    // --- INÍCIO DA MÁSCARA DE CPF ---
    // Este addEventListener fica "ouvindo" o campo do CPF.
    // O evento 'input' é disparado a CADA tecla que o usuário digita.
    cpfInput.addEventListener('input', (event) => {
        // Pega o valor atual do campo (o que o usuário acabou de digitar)
        let value = event.target.value;
        
        // 1. Limpa o valor:
        // Usamos uma Regex (/\D/g) para encontrar qualquer coisa que NÃO seja
        // um dígito (letra, espaço, ponto, etc.) e trocamos por nada ('').
        // Isso garante que só temos números puros para trabalhar.
        value = value.replace(/\D/g, '');
        
        // 2. Aplica a máscara (999.999.999-99) dinamicamente:
        // A lógica aqui é ir "fatiando" (slice) a string de números
        // e recolocando os pontos e o hífen nos lugares certos conforme o usuário digita.
        
        // Coloca o primeiro ponto (ex: 123.4)
        if (value.length > 3) {
          value = value.slice(0, 3) + '.' + value.slice(3);
        }
        // Coloca o segundo ponto (ex: 123.456.7)
        if (value.length > 7) {
          value = value.slice(0, 7) + '.' + value.slice(7);
        }
        // Coloca o hífen (ex: 123.456.789-0)
        if (value.length > 11) {
          value = value.slice(0, 11) + '-' + value.slice(11);
        }

        // 3. Trava o tamanho:
        // Não deixa o usuário digitar mais que 14 caracteres (tamanho final do CPF formatado)
        if (value.length > 14) {
          value = value.slice(0, 14);
        }
        
        // 4. Finalmente, devolve o valor já formatado para o campo (o usuário vê a máscara)
        event.target.value = value;
    });
    // --- FIM DA MÁSCARA DE CPF ---

  
    // --- VALIDAÇÃO NO ENVIO (SUBMIT) ---
    // Agora, ficamos "ouvindo" o evento de 'submit', que é quando o usuário
    // clica no botão "Enviar" do formulário.
    form.addEventListener("submit", (event) => {
      
      // event.preventDefault() é a linha mais importante da validação!
      // Ela impede o formulário de fazer o comportamento padrão (que é recarregar a página).
      // Assim, nós podemos validar os dados com JS antes de qualquer coisa.
      event.preventDefault();
  
      // Reseta a <div> de mensagens para ela ficar limpa a cada tentativa
      statusMessage.textContent = "";
      statusMessage.className = ""; // Limpa as classes CSS (verde/vermelho)
  
      // Pega os valores que estão nos campos *no momento* do clique
      const email = emailInput.value;
      const cpf = cpfInput.value;
  
      // 1. Validação do E-mail
      // Usamos uma Regex (Expressão Regular) que basicamente define o formato "texto@texto.texto"
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      // O método .test() retorna true (se for válido) ou false (se não for)
      if (!emailRegex.test(email)) {
        // Se o teste falhar (retornar false), mostramos o erro
        mostrarMensagem("Erro: Por favor, insira um e-mail válido (ex: seu.nome@dominio.com).", "error");
        return; // O 'return' para a execução do código. Não adianta validar o CPF se o e-mail já está errado.
      }
  
      // 2. Validação do CPF
      // Regex que define o formato "999.999.999-99"
      // O \d{3} significa "exatamente 3 dígitos numéricos" e o \. significa "exatamente um ponto"
      const cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
      if (!cpfRegex.test(cpf)) {
        // Se falhar, mostra o erro e para
        mostrarMensagem("Erro: Por favor, insira um CPF válido no formato 999.999.999-99.", "error");
        return; 
      }
  
      // Se o código chegou até aqui, significa que o e-mail E o CPF são válidos.
      mostrarMensagem("Formulário enviado com sucesso!", "success");
      form.reset(); // Limpa os campos do formulário para um novo envio
    });
  
    // --- FUNÇÃO AUXILIAR ---
    // Criei essa função para não ter que repetir código (princípio DRY: Don't Repeat Yourself).
    // Ela simplesmente pega a <div> de status e coloca a mensagem
    // e a classe CSS correta (verde para sucesso, vermelho para erro), que estão no style.css.
    function mostrarMensagem(mensagem, tipo) {
      statusMessage.textContent = mensagem;
      if (tipo === "success") {
        statusMessage.className = "message-success";
      } else if (tipo === "error") {
        statusMessage.className = "message-error";
      }
    }
  });
