<?php 
$pageTitle = 'Bookfy: SAC'; // Define o título
include 'header.php';
include 'nav.php';
?>

<main>
    <h2>Serviço de Atendimento ao Cliente</h2>
    
    <p id="mensagem-destaque">
        Você pode enviar uma mensagem no formulário abaixo!
    </p>

    <!-- Este é o formulário de CONTATO, ele continua o mesmo -->
    <form action="" method="post" id="sac-form">
        <label for="id_nome">Nome do Cliente:</label><br>
        <input type="text" name="nome" id="id_nome"><br><br>
        
        <label for="id_email">E-mail do Cliente: </label><br>
        <input type="text" name="email" id="id_email"><br><br>
        
        <label for="id_cpf">CPF:</label><br>
        <input type="text" name="cpf" id="id_cpf" placeholder="999.999.999-99"><br><br>
        
        <label for="id_assunto">Assunto: </label><br>
        <textarea name="assunto" id="id_assunto"></textarea><br><br>
        
        <label for="id_mensagem">Mensagem:</label><br>
        <textarea name="mensagem" id="id_mensagem"></textarea><br><br>
        
        <button type="submit">Enviar</button>
    </form>

    <div id="status-message"></div>

</main>

<?php 
include 'footer.php'; // Inclui o rodapé
?>

<!-- Carrega o JS de validação (só nesta página) -->
<script src="<?= BASE_URL ?>/js/validacao.js" defer></script>