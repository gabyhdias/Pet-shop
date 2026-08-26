<?php
require_once 'db.php';

if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $stmt = $pdo->prepare("DELETE FROM animais WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: animais.php");
    exit;
}

$sql = "SELECT a.*, c.nome as responsavel FROM animais a 
        INNER JOIN clientes c ON a.cliente_id = c.id ORDER BY a.nome ASC";
$animais = $pdo->query($sql)->fetchAll();
include 'header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Animais</h2>
    <a href="animal_form.php" class="btn btn-success">Novo Animal</a>
</div>

<table class="table table-striped bg-white shadow-sm rounded">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Raça</th>
            <th>Idade</th>
            <th>Responsável</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($animais as $a): ?>
        <tr>
            <td><?= $a['id'] ?></td>
            <td><?= htmlspecialchars($a['nome']) ?></td>
            <td><?= htmlspecialchars($a['tipo']) ?></td>
            <td><?= htmlspecialchars($a['raca']) ?></td>
            <td><?= $a['idade'] ?> anos</td>
            <td><?= htmlspecialchars($a['responsavel']) ?></td>
            <td>
                <a href="animal_form.php?id=<?= $a['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="animais.php?excluir=<?= $a['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Excluir este animal?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include 'footer.php'; ?>