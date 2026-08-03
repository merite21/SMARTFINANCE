<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/fonctions.php';

$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = securiser($_POST['nom'] ?? '');
    $email = securiser($_POST['email'] ?? '');
    $sujet = securiser($_POST['sujet'] ?? '');
    $contenu = securiser($_POST['contenu'] ?? '');

    $stmt = $pdo->prepare('INSERT INTO messages (nom, email, sujet, contenu) VALUES (?, ?, ?, ?)');
    $stmt->execute([$nom, $email, $sujet, $contenu]);
    $success = 'Message envoyé avec succès.';
}

require_once __DIR__ . '/includes/header.php';
?>
<div class="container py-5">
    <div class="auth-card shadow-sm col-md-7 mx-auto">
        <h2 class="text-center mb-4"><i class="fas fa-envelope text-primary"></i> Contactez-nous</h2>
        <?php if (!empty($success)): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
        <form method="post">
            <input type="text" name="nom" class="form-control mb-3" placeholder="Nom complet" required>
            <input type="email" name="email" class="form-control mb-3" placeholder="Adresse e-mail" required>
            <input type="text" name="sujet" class="form-control mb-3" placeholder="Sujet" required>
            <textarea name="contenu" class="form-control mb-3" placeholder="Votre message" rows="5" required></textarea>
            <button type="submit" class="btn btn-smart w-100">Envoyer le message</button>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
