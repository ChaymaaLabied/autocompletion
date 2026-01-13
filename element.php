<?php
include 'db.php';
$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM elements WHERE id = ?");
$stmt->execute([$id]);
$el = $stmt->fetch();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($el['name']); ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php if ($el): ?>
        <h1><?php echo htmlspecialchars($el['name']); ?></h1>
        <p><?php echo htmlspecialchars($el['description']); ?></p>
        <a href="index.php">← Retour à la recherche</a>
    <?php else: ?>
        <p>Élément introuvable.</p>
        <a href="index.php">← Retour à la recherche</a>
    <?php endif; ?>
</body>

</html>