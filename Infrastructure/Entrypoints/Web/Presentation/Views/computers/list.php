<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Computadores registrados</h1>

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

<p>
    <a class="btn btn-primary" href="?route=computers.create">Registrar computador</a>
</p>

<?php if (empty($computers)): ?>
    <p>No hay computadores registrados todavía.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Categoría</th>
                <th>CPU</th>
                <th>RAM</th>
                <th>Almacenamiento</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($computers as $computer): ?>
                <tr>
                    <td class="col-id"><?= htmlspecialchars((string) $computer['id'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars((string) $computer['brand'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars((string) $computer['category'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td>
                        <?= htmlspecialchars((string) $computer['cpu_brand'], ENT_QUOTES, 'UTF-8') ?>
                        (<?= htmlspecialchars((string) $computer['cpu_speed'], ENT_QUOTES, 'UTF-8') ?>)
                    </td>
                    <td>
                        <?= htmlspecialchars((string) $computer['ram_capacity'], ENT_QUOTES, 'UTF-8') ?>
                        <?= htmlspecialchars((string) $computer['ram_technology'], ENT_QUOTES, 'UTF-8') ?>
                    </td>
                    <td>
                        <?= htmlspecialchars((string) $computer['storage_capacity'], ENT_QUOTES, 'UTF-8') ?>
                        <?= htmlspecialchars((string) $computer['storage_technology'], ENT_QUOTES, 'UTF-8') ?>
                    </td>
                    <td><?= htmlspecialchars((string) $computer['price'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="col-actions">
                        <a class="btn btn-sm"
                            href="?route=computers.show&amp;id=<?= urlencode((string) $computer['id']) ?>">Ver</a>
                        <a class="btn btn-warning btn-sm"
                            href="?route=computers.edit&amp;id=<?= urlencode((string) $computer['id']) ?>">Editar</a>
                        <form method="POST" action="?route=computers.delete" style="display:inline;"
                            onsubmit="return confirmDelete(this);"
                            data-name="<?= htmlspecialchars((string) $computer['brand'], ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="id"
                                value="<?= htmlspecialchars((string) $computer['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
