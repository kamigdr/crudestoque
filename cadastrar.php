<?php
require_once "config/conexao.php";

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $categoria = trim($_POST["categoria"] ?? "");
    $descricao = trim($_POST["descricao"] ?? "");
    $preco = $_POST["preco"] ?? "";
    $quantidade = $_POST["quantidade_estoque"] ?? "";
    $data_validade = $_POST["data_validade"] ?? "";

    if ($nome === "" || $categoria === "" || $descricao === "" || $preco === "" || $quantidade === "" || $data_validade === "") {
        $erro = "Preencha todos os campos.";
    } elseif (!is_numeric($preco) || $preco < 0) {
        $erro = "Informe um preço válido.";
    } elseif (filter_var($quantidade, FILTER_VALIDATE_INT) === false || $quantidade < 0) {
        $erro = "Informe uma quantidade válida.";
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data_validade)) {
        $erro = "Informe uma data válida.";
    } else {
        $preco = (float)$preco;
        $quantidade = (int)$quantidade;

        $stmt = $conn->prepare(
            "INSERT INTO produtos
            (nome, categoria, descricao, preco, quantidade_estoque, data_validade)
            VALUES (?, ?, ?, ?, ?, ?)"
        );

        if ($stmt) {
            $stmt->bind_param("sssdis", $nome, $categoria, $descricao, $preco, $quantidade, $data_validade);

            if ($stmt->execute()) {
                header("Location: index.php?mensagem=Produto cadastrado com sucesso.");
                exit;
            } else {
                $erro = "Erro ao cadastrar o produto.";
            }

            $stmt->close();
        } else {
            $erro = "Erro ao preparar a operação.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container pequeno">
    <h1>Cadastrar Produto</h1>

    <?php if ($erro): ?>
        <p class="erro"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nome</label>
        <input type="text" name="nome" maxlength="100" required>

        <label>Categoria</label>
        <input type="text" name="categoria" maxlength="50" required>

        <label>Descrição</label>
        <textarea name="descricao" maxlength="255" required></textarea>

        <label>Preço</label>
        <input type="number" name="preco" step="0.01" min="0" required>

        <label>Quantidade em estoque</label>
        <input type="number" name="quantidade_estoque" min="0" required>

        <label>Data de validade</label>
        <input type="date" name="data_validade" required>

        <button type="submit">Cadastrar</button>
        <a class="voltar" href="index.php">Voltar</a>
    </form>
</div>
</body>
</html>
