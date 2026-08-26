<?php
require_once 'db.php';

$id = $_GET['id'] ?? null;
$nome = $tipo = $raca = $idade = $cliente_id = '';

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM animais WHERE id = ?");
    $stmt->execute([$id]);
    $animal = $stmt->fetch();
    if ($animal) {
        $nome = $animal['nome']; $tipo = $animal['tipo'];
        $raca = $animal['raca']; $idade = $animal['idade'];
        $cliente_id = $animal['cliente_id'];
    }
}

$clientes = $pdo->query("SELECT id, nome FROM clientes ORDER BY nome ASC")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome']; $tipo = $_POST['tipo'];
    $raca = $_POST['raca']; $idade = $_POST['idade'];
    $cliente_id = $_POST['cliente_id'];

    if (!empty($cliente_id)) {
        if ($id) {
            $stmt = $pdo->prepare("UPDATE animais SET nome = ?, tipo = ?, raca = ?, idade = ?, cliente_id = ? WHERE id = ?");
            $stmt->execute([$nome, $tipo, $raca, $idade, $cliente_id, $id]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO animais (nome, tipo, raca, idade, cliente_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nome, $tipo, $raca, $idade, $cliente_id]);
        }
        header("Location: animais.php");
        exit;
    }
}
include 'header.php';
?>

<h2><?= $id ? 'Editar Animal' : 'Novo Animal' ?></h2>
<div class="card p-4 shadow-sm bg-white">
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nome do Animal</label>
            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($nome) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tipo (Ex: Cachorro, Gato)</label>
            <input type="text" name="tipo" class="form-control" value="<?= htmlspecialchars($tipo) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Raça</label>
            <input type="text" name="raca" class="form-control" value="<?= htmlspecialchars($raca) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Idade (anos)</label>
            <input type="number" name="idade" class="form-control" value="<?= htmlspecialchars($idade) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Responsável (Cliente)</label>
            <select name="cliente_id" class="form-select" required>
                <option value="">-- Selecione o Dono --</option>
                <?php foreach ($clientes as $c): ?>
                    <option value="<?= $c['id'] ?>" <?= $c['id'] == $cliente_id ? 'selected' : '' ?>><?= htmlspecialchars($c['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="animais.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?php include 'footer.php'; ?>