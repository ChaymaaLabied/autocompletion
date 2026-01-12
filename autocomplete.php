<?php
include 'db.php';

$search = $_GET['search'] ?? '';

// Résultats exacts (commencent par ce que l'utilisateur tape)
$exact = $pdo->prepare("SELECT * FROM elements WHERE name LIKE ?");
$exact->execute([$search . '%']);

// Résultats contenant (mais pas exacts)
$contain = $pdo->prepare("
    SELECT * FROM elements 
    WHERE name LIKE ? AND name NOT LIKE ?
");
$contain->execute(['%' . $search . '%', $search . '%']);

// Retour JSON
echo json_encode([
    'exact' => $exact->fetchAll(PDO::FETCH_ASSOC),
    'contain' => $contain->fetchAll(PDO::FETCH_ASSOC)
]);
