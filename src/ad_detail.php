<?php

/* Import */
require_once __DIR__ . "/lib/db.php";
require_once __DIR__ . "/bid_on_ad.php";
require_once __DIR__ . "/bid_histo_on_ad_detail.php";

/* Si le verbe HTTP est différent de POST */
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    die();
}

/* Récupération de l'id */
$id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

/* Préparation de la requête */
$query = $dbh->prepare(" SELECT ad.*,b.*,u.lastname,u.firstname FROM `ad` left JOIN bids b on b.id_ad=ad.id left JOIN users u on b.id_user=u.id WHERE
ad.id = ? ORDER by b.price DESC");

/* Exécution de la requête */
$result = $query->execute([$id]);
$ad = $query->fetch();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Détail de l'annonce</title>
    <title><?php echo $id ?></title>
</head>

<body>
    <h2>Annonce n° <?= $ad["id"] ?></h2>
    <ul>


        <li><img src="<?php echo "../upload/" . $ad["fileimage"]; ?>"></li>
        <li><?= $ad["title"] ?></li>
        <li><?= $ad["description"] ?></li>
        <li><?= $ad["brand"] ?></li>
        <li><?= $ad["model"] ?></li>
        <li><?= $ad["year"] ?></li>
        <li><?= $ad["power"] ?></li>
        <li><?= $ad["enddate"] ?></li>
        <li><?= "price: " . $ad["price"] ?></li>
        <td><?= $ad["firstname"] ?></td>
        <!-- Montant enchère en cours -->
        <?php if ($ad["enddate"] > $date = date('Y-m-d H:i:s')) {
            Afficher_encherir($ad["id"]);
        }
        if ($ad["enddate"] < $date = date('Y-m-d H:i:s')) {
            echo "pas d'enchere possible";
        }  ?>
    </ul>

    <?php showBidHisto($ads); ?>

    <a href="index.php">Revenir à la liste des annonces</a>

</body>

</html>