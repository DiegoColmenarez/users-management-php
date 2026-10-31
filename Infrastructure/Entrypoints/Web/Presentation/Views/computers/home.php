<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Gestión de computadores</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="alert-success">
        <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<p>Selecciona una operación para administrar los computadores registrados.</p>

<p>
    <a class="btn btn-primary" href="?route=computers.create">Registrar computador</a>
    <a class="btn" href="?route=computers.index">Listar computadores</a>
</p>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
