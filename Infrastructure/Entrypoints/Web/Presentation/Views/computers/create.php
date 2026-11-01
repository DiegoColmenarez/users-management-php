<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Registrar computador</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<form method="POST" action="?route=computers.store">
    <div class="form-group">
        <label for="brand">Marca</label><br>
        <input type="text" id="brand" name="brand" required
            value="<?= htmlspecialchars($old['brand'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="category">Categoría</label><br>
        <select id="category" name="category" required>
            <?php foreach (array('DESKTOP', 'LAPTOP', 'ALL-IN-ONE', 'SERVER') as $category): ?>
                <option value="<?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?>"
                    <?= (($old['category'] ?? '') === $category) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="cpu_brand">Marca de CPU</label><br>
        <input type="text" id="cpu_brand" name="cpu_brand" required
            value="<?= htmlspecialchars($old['cpu_brand'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="cpu_speed">Velocidad de CPU</label><br>
        <input type="number" id="cpu_speed" name="cpu_speed" min="0" step="any" required
            value="<?= htmlspecialchars($old['cpu_speed'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="ram_technology">Tecnología RAM</label><br>
        <input type="text" id="ram_technology" name="ram_technology" required
            value="<?= htmlspecialchars($old['ram_technology'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="ram_capacity">Capacidad RAM</label><br>
        <input type="number" id="ram_capacity" name="ram_capacity" min="0" step="any" required
            value="<?= htmlspecialchars($old['ram_capacity'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="storage_technology">Tecnología de almacenamiento</label><br>
        <input type="text" id="storage_technology" name="storage_technology" required
            value="<?= htmlspecialchars($old['storage_technology'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="storage_capacity">Capacidad de almacenamiento</label><br>
        <input type="number" id="storage_capacity" name="storage_capacity" min="0" step="any" required
            value="<?= htmlspecialchars($old['storage_capacity'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="usb_ports">Puertos USB</label><br>
        <input type="number" id="usb_ports" name="usb_ports" min="0" step="1" required
            value="<?= htmlspecialchars($old['usb_ports'] ?? '0', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="hdmi_ports">Puertos HDMI</label><br>
        <input type="number" id="hdmi_ports" name="hdmi_ports" min="0" step="1" required
            value="<?= htmlspecialchars($old['hdmi_ports'] ?? '0', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="monitor_brand">Marca del monitor</label><br>
        <input type="text" id="monitor_brand" name="monitor_brand" required
            value="<?= htmlspecialchars($old['monitor_brand'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="screen_size_inches">Tamaño de pantalla (pulgadas)</label><br>
        <input type="number" id="screen_size_inches" name="screen_size_inches" min="0" step="any" required
            value="<?= htmlspecialchars($old['screen_size_inches'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="form-group">
        <label for="price">Precio</label><br>
        <input type="number" id="price" name="price" min="0" step="0.01" required
            value="<?= htmlspecialchars($old['price'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <button type="submit" class="btn btn-primary">Registrar computador</button>
    &nbsp;
    <a class="btn" href="?route=computers.index">Cancelar</a>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
