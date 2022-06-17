<?php

/* Import */
require_once __DIR__ . "/lib/db.php";
require_once __DIR__ . "/ad_detail.php";
require_once __DIR__ . "/bid_on_ad.php";



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
$ads = $query->fetchAll();
function showBidHisto($ads)
{ ?>




    <body>
        <h2>Historique des enchères</h2>
        <table>
            <thead>
                <th>prix </th>
                <th>nom</th>
            </thead>
            <tbody>
                <?php foreach ($ads as $index => $ad) { ?>

                    <tr>
                        <td><?= "price: " . $ad["price"] ?> par <?= $ad["firstname"] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php          } ?>