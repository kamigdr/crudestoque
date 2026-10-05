<?php
require_once "config/conexao.php";

$resultado = $conn->query("SELECT * FROM produtos ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Estoque</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h1>Sistema de Gestão de Estoque</h1>
    <a class="botao" href="cadastrar.php">Cadastrar produto</a>

    <?php if (isset($_GET["mensagem"])): ?>
        <p class="sucesso"><?= htmlspecialchars($_GET["mensagem"]) ?></p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Validade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($produto = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $produto["id"] ?></td>
                <td><?= htmlspecialchars($produto["nome"]) ?></td>
                <td><?= htmlspecialchars($produto["categoria"]) ?></td>
                <td><?= htmlspecialchars($produto["descricao"]) ?></td>
                <td>R$ <?= number_format($produto["preco"], 2, ",", ".") ?></td>
                <td><?= $produto["quantidade_estoque"] ?></td>
                <td><?= date("d/m/Y", strtotime($produto["data_validade"])) ?></td>
                <td>
                    <a href="editar.php?id=<?= $produto["id"] ?>">Editar</a> |
                    <a href="excluir.php?id=<?= $produto["id"] ?>"
                       onclick="return confirm('Deseja excluir este produto?')">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
