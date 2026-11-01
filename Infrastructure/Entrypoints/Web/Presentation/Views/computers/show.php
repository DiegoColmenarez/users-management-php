<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Detalle del computador</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php
$fields = array(
    'id' => 'ID',
    'brand' => 'Marca',
    'category' => 'Categoría',
    'cpu_brand' => 'Marca de CPU',
    'cpu_speed' => 'Velocidad de CPU',
    'ram_technology' => 'Tecnología RAM',
    'ram_capacity' => 'Capacidad RAM',
    'storage_technology' => 'Tecnología de almacenamiento',
    'storage_capacity' => 'Capacidad de almacenamiento',
    'usb_ports' => 'Puertos USB',
    'hdmi_ports' => 'Puertos HDMI',
    'monitor_brand' => 'Marca del monitor',
    'screen_size_inches' => 'Tamaño de pantalla (pulgadas)',
    'price' => 'Precio',
);
?>

<table class="detail-table">
    <?php foreach ($fields as $key => $label): ?>
        <tr>
            <th><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></th>
            <td><?= htmlspecialchars((string) ($computer[$key] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<p style="margin-top: 16px;">
    <a class="btn btn-warning"
        href="?route=computers.edit&amp;id=<?= urlencode((string) ($computer['id'] ?? '')) ?>">Editar</a>
    &nbsp;
    <a class="btn" href="?route=computers.index">Volver al listado</a>
</p>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
