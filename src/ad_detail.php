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
$query = $dbh->prepare("SELECT FROM ad WHERE id = ?;");

/* Exécution de la requête */
$result = $query->execute([$id]);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Détail de l'annonce</title>
</head>

<body>
    <h2>Annonce n° <?= $id_ad ?></h2>
    <ul>
        <!-- Photo de la voiture -->
        <li><?= $title ?></li>
        <li><?= $description ?></li>
        <li><?= $brand ?></li>
        <li><?= $model ?></li>
        <li><?= $year ?></li>
        <li><?= $power ?></li>
        <li><?= $enddate ?></li>
        <!-- Montant enchère en cours -->
        <!-- Input type number saisi d'enchère -->
        <!-- button ENCHERIR -->

    </ul>

    <a href="index.php">Revenir à la liste des annonces</a>
</body>

</html>