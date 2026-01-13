<?php
include 'db.php';
$search = $_GET['search'] ?? '';
$search = trim($search);

// Requête SQL
$stmt = $pdo->prepare("SELECT * FROM elements WHERE name LIKE ?");
$stmt->execute(['%' . $search . '%']);
$results = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Résultats pour "<?php echo htmlspecialchars($search); ?>"</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Résultats pour "<?php echo htmlspecialchars($search); ?>"</h1>
    <?php if (count($results) > 0): ?>
        <ul>
            <?php foreach ($results as $el): ?>
                <li onclick="window.location.href='element.php?id=<?php echo $el['id']; ?>'">
                    <?php echo htmlspecialchars($el['name']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun résultat trouvé.</p>
    <?php endif; ?>
    <a href="index.php">← Retour à la recherche</a>
</body>

</html>