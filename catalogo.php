<?php
// catalogo.php (Traduzido de catalogo.php do professor)

// Inclui o "cérebro" (DAO) e a conexão
// __DIR__ é um atalho para a pasta ATUAL (raiz do projeto)
require_once __DIR__ . '/backend/dbconfig.php';
require_once __DIR__ . '/backend/livros_dao.php';

// 1. Inicia a conexão com o banco
$pdo = getDbConnection();

// 2. Busca todos os livros usando a função do DAO
// Esta é a linha que substitui o 'fetch('dados.json')'
$livros = readLivros($pdo, null); // null = buscar todos

$pageTitle = 'Bookfy: Catálogo'; // Define o título
include 'header.php';
include 'nav.php';
?>

<main>
    <h2>Livros em Destaque</h2>
    <p>Lista do Ranking Best Sellers 2025 (agora vindo do Banco de Dados!)</p>
    
    <!-- Botão para ir ao formulário de cadastro -->
    <a href="livro_form.php">
        <button type="button" style="margin-bottom: 1rem;">Cadastrar Novo Livro</button>
    </a>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Capa</th>
                    <th>Título</th>
                    <th>Gênero</th>
                    <th>Editora</th>
                    <th>Autor</th>
                    <th>Ações</th> <!-- Nova coluna de ações -->
                </tr>
            </thead>
            <tbody id="tabela-livros-body">
                
                <?php if (empty($livros)): ?>
                    <tr>
                        <td colspan="6">Nenhum livro encontrado no banco de dados.</td>
                    </tr>
                <?php else: ?>
                    <!-- Loop PHP para desenhar a tabela -->
                    <?php foreach ($livros as $livro): ?>
                        <tr class="destaque-livro">
                            <td>
                                <!-- Mostra a imagem ou 'N/A' se não tiver capa -->
                                <?php if (!empty($livro['capa'])): ?>
                                    <img src="<?= htmlspecialchars($livro['capa']) ?>" alt="Capa do livro <?= htmlspecialchars($livro['titulo']) ?>">
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($livro['titulo']) ?></td>
                            <td><?= htmlspecialchars($livro['genero']) ?></td>
                            <td><?= htmlspecialchars($livro['editora']) ?></td>
                            <td><?= htmlspecialchars($livro['autor']) ?></td>
                            <td>
                                <!-- Botão Editar (traduzido do professor) -->
                                <button 
                                    style="background-color: #d4a017; width: 100%; margin-bottom: 5px; cursor: pointer;"
                                    onclick="window.location.href='livro_form.php?action=editar&id=<?= $livro['id'] ?>'">
                                    Editar
                                </button>

                                <!-- Botão Deletar (traduzido do professor) -->
                                <button
                                    style="background-color: #b30000; width: 100%; color: white; cursor: pointer;"
                                    onclick="deleteLivro(<?= $livro['id'] ?>)">
                                    Deletar
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                
            </tbody>
        </table>
    </div>      
</main>

<?php 
include 'footer.php'; // Inclui o rodapé
?>

<!-- Inclui o JS para a função deletarLivro() -->
<script src="<?= BASE_URL ?>/js/deletar_livro.js" defer></script>