<aside class="sidebar">
    <h3>Menu</h3>
    <ul>
        <li><a href="<?= base_url('dashboard.php') ?>">Dashboard</a></li>
        <li><a href="<?= base_url('demande.php') ?>">Nouvelle demande</a></li>
        <li><a href="<?= base_url('profil.php') ?>">Profil</a></li>
        <li><a href="<?= base_url('contact.php') ?>">Contact</a></li>
        <?php if (is_admin()): ?>
            <li><a href="<?= base_url('admin/index.php') ?>">Administration</a></li>
        <?php endif; ?>
    </ul>
</aside>
