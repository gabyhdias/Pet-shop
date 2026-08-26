<?php
require_once 'db.php';

$id = $_GET['id'] ?? null;
$nome = $telefone = $email = '';

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = ?");
    $stmt->execute([$id]);
    $cliente = $stmt->fetch();
    if ($cliente) {
        $nome = $cliente['nome'];
        $telefone = $cliente['telefone'];
        $email = $cliente['email'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    if ($id) {
        $stmt = $pdo->prepare("UPDATE clientes SET nome = ?, telefone = ?, email = ? WHERE id = ?");
        $stmt->execute([$nome, $telefone, $email, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO clientes (nome, telefone, email) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $telefone, $email]);
    }
    header("Location: clientes.php");
    exit;
}
include 'header.php';
?>

<h2><?= $id ? 'Editar Cliente' : 'Novo Cliente' ?></h2>
<div class="card p-4 shadow-sm bg-white">
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nome Completo</label>
            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($nome) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control" value="<?= htmlspecialchars($telefone) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>">
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="clientes.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?php include 'footer.php'; ?>