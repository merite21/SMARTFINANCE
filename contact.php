<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/fonctions.php';
require_once __DIR__ . '/config/mail.php';

$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = securiser($_POST['nom'] ?? '');
    $email = securiser($_POST['email'] ?? '');
    $sujet = securiser($_POST['sujet'] ?? '');
    $contenu = securiser($_POST['contenu'] ?? '');

    $stmt = $pdo->prepare('INSERT INTO messages (nom, email, sujet, contenu) VALUES (?, ?, ?, ?)');
    $stmt->execute([$nom, $email, $sujet, $contenu]);
    $success = t('contact_succes');

    notifierProprietaire(
<<<<<<< HEAD
        "Nouveau message de contact - " . $sujet,
        "<h3>Nouveau message reçu</h3>
        <p><strong>De :</strong> " . e($nom) . " (" . e($email) . ")</p>
        <p><strong>Sujet :</strong> " . e($sujet) . "</p>
        <p><strong>Message :</strong><br>" . nl2br(e($contenu)) . "</p>"
    );
=======
    "Nouveau message de contact - " . html_entity_decode($sujet),
    "<h3>Nouveau message reçu</h3>
    <p><strong>De :</strong> " . $nom . " (" . $email . ")</p>
    <p><strong>Sujet :</strong> " . $sujet . "</p>
    <p><strong>Message :</strong><br>" . nl2br($contenu) . "</p>"
);
>>>>>>> 785691553ce273d604f66e7abf5d092c6e1f60b9
}

require_once __DIR__ . '/includes/header.php';
?>
<div class="container py-5">
    <div class="auth-card shadow-sm col-md-7 mx-auto">
        <h2 class="text-center mb-4"><i class="fas fa-envelope text-primary"></i> <?= t('contact_titre') ?></h2>
        <?php if (!empty($success)): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
        <form method="post">
            <input type="text" name="nom" class="form-control mb-3" placeholder="<?= e(t('contact_nom')) ?>" required>
            <input type="email" name="email" class="form-control mb-3" placeholder="<?= e(t('contact_email')) ?>" required>
            <input type="text" name="sujet" class="form-control mb-3" placeholder="<?= e(t('contact_sujet')) ?>" required>
            <textarea name="contenu" class="form-control mb-3" placeholder="<?= e(t('contact_message')) ?>" rows="5" required></textarea>
            <button type="submit" class="btn btn-smart w-100"><?= t('contact_envoyer') ?></button>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
