<?php
require_once "config/conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("Ido.");
}D inváli

$stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$produto = $resultado->fetch_assoc();
$stmt->close();

if (!$produto) {
    die("Produto não encontrado.");
}

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
            "UPDATE produtos
             SET nome = ?, categoria = ?, descricao = ?, preco = ?,
                 quantidade_estoque = ?, data_validade = ?
             WHERE id = ?"
        );

        $stmt->bind_param(
            "sssdisi",
            $nome,
            $categoria,
            $descricao,
            $preco,
            $quantidade,
            $data_validade,
            $id
        );

        if ($stmt->execute()) {
            header("Location: index.php?mensagem=Produto atualizado com sucesso.");
            exit;
        } else {
            $erro = "Erro ao atualizar o produto.";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container pequeno">
    <h1>Editar Produto</h1>

    <?php if ($erro): ?>
        <p class="erro"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nome</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($produto["nome"]) ?>" maxlength="100" required>

        <label>Categoria</label>
        <input type="text" name="categoria" value="<?= htmlspecialchars($produto["categoria"]) ?>" maxlength="50" required>

        <label>Descrição</label>
        <textarea name="descricao" maxlength="255" required><?= htmlspecialchars($produto["descricao"]) ?></textarea>

        <label>Preço</label>
        <input type="number" name="preco" value="<?= $produto["preco"] ?>" step="0.01" min="0" required>

        <label>Quantidade em estoque</label>
        <input type="number" name="quantidade_estoque" value="<?= $produto["quantidade_estoque"] ?>" min="0" required>

        <label>Data de validade</label>
        <input type="date" name="data_validade" value="<?= $produto["data_validade"] ?>" required>

        <button type="submit">Salvar alterações</button>
        <a class="voltar" href="index.php">Voltar</a>
    </form>
</div>
</body>
</html>