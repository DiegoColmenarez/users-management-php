<?php require __DIR__ . '/layouts/header.php'; ?>
<?php require __DIR__ . '/layouts/menu.php'; ?>

<h1><?= isset($_SESSION['auth']) ? 'Menú principal del CRUDL de usuarios' : 'Gestión de usuarios' ?></h1>

<p>
    <?= isset($_SESSION['auth'])
        ? 'Desde aquí podrás acceder a las operaciones del sistema.'
        : 'Inicia sesión o crea una cuenta para comenzar.' ?>
</p>

<?php if (!isset($_SESSION['auth'])): ?>
    <p>
        <a class="btn btn-primary" href="?route=users.create">Registrar usuario</a>
        <a class="btn" href="?route=auth.login">Iniciar sesión</a>
    </p>
<?php endif; ?>

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

<?php if (isset($_SESSION['auth'])): ?>
    <ul>
        <li><strong>C:</strong> Registrar usuario</li>
        <li><strong>R:</strong> Consultar usuario</li>
        <li><strong>U:</strong> Actualizar usuario</li>
        <li><strong>D:</strong> Eliminar usuario</li>
        <li><strong>L:</strong> Listar usuarios</li>
    </ul>
<?php endif; ?>

<?php require __DIR__ . '/layouts/footer.php'; ?>