<?php

/* Import */
require_once __DIR__ . "/lib/db.php";

/* Si le verbe HTTP est différent de POST */
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    die();
}

/* Récupération de l'id */
$id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

/* Préparation de la requête */
$query = $dbh->prepare("SELECT * FROM ad WHERE id = ?;");

/* Exécution de la requête */
$result = $query->execute([$id]);
$ad = $query->fetch();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Détail de l'annonce</title>
</head>

<body>
    <h2>Annonce n° <?= $ad["id"] ?></h2>
    <ul>
        <!-- Photo de la voiture -->
        <li><?= $ad["title"] ?></li>
        <li><?= $ad["description"] ?></li>
        <li><?= $ad["brand"] ?></li>
        <li><?= $ad["model"] ?></li>
        <li><?= $ad["year"] ?></li>
        <li><?= $ad["power"] ?></li>
        <li><?= $ad["enddate"] ?></li>
        <!-- Montant enchère en cours -->
        <!-- Input type number saisi d'enchère -->
        <!-- button ENCHERIR -->

    </ul>

    <a href="index.php">Revenir à la liste des annonces</a>
</body>

</html>