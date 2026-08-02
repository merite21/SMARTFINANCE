<?php
require_once __DIR__ . '/config/connexion.php';
require_once __DIR__ . '/includes/header.php';

$pdo = init_database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $sujet = trim($_POST['sujet'] ?? '');
    $contenu = trim($_POST['contenu'] ?? '');

    $stmt = $pdo->prepare('INSERT INTO messages (nom, email, sujet, contenu) VALUES (?, ?, ?, ?)');
    $stmt->execute([$nom, $email, $sujet, $contenu]);
    $success = 'Message envoyé avec succès.';
}
?>
<div class="card">
    <h1>Contact</h1>
    <?php if (!empty($success)): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
    <form method="post">
        <input type="text" name="nom" placeholder="Nom complet" required>
        <input type="email" name="email" placeholder="Adresse e-mail" required>
        <input type="text" name="sujet" placeholder="Sujet" required>
        <textarea name="contenu" placeholder="Votre message" rows="5" required></textarea>
        <button type="submit">Envoyer</button>
    </form>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>