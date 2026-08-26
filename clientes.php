<?php
require_once 'db.php';

if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: clientes.php");
    exit;
}

$clientes = $pdo->query("SELECT * FROM clientes ORDER BY nome ASC")->fetchAll();
include 'header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Clientes</h2>
    <a href="cliente_form.php" class="btn btn-primary">Novo Cliente</a>
</div>

<table class="table table-striped bg-white shadow-sm rounded">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientes as $c): ?>
        <tr>
            <td><?= $c['id'] ?></td>
            <td><?= htmlspecialchars($c['nome']) ?></td>
            <td><?= htmlspecialchars($c['telefone']) ?></td>
            <td><?= htmlspecialchars($c['email']) ?></td>
            <td>
                <a href="cliente_detalhes.php?id=<?= $c['id'] ?>" class="btn btn-info btn-sm text-white">Ver Detalhes</a>
                <a href="cliente_form.php?id=<?= $c['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="clientes.php?excluir=<?= $c['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Aviso: Excluir este cliente apagará também todos os seus animais!')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include 'footer.php'; ?>