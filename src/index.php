<?php
require_once __DIR__ . "/nav.php";
require_once __DIR__ . "/lib/db.php";
$queryads = $dbh->prepare("SELECT * FROM ad LEFT JOIN bids b ON ad.id=b.id_ad ");
$resultads = $queryads->execute();
$ads = $queryads->fetchall(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VRoum VRoum</title>
</head>



<body>
    <?php Afficher_nav(); ?>
    <h2>Creation Annonce</h2>
    <form action="creat_ad.php" method="POST" enctype="multipart/form-data">
        <label>title</label>
        <input type=" text" name="title">

        <label>description</label>
        <input type="text" name="description">

        <label>beginprice</label>
        <input type="number" name="beginprice" step="0.01">
        <label>reserveprice</label>
        <input type="number" name="reserveprice" step=" 0.01">
        <label>enddate</label>
        <input type="text" name="enddate">
        <label>model</label>
        <input type="text" name="model">
        <label>brand</label>
        <input type="text" name="brand">
        <label>power</label>
        <input type="text" name="power">
        <label>year</label>
        <input type="number" name="year" min="1910" max="2022">
        <label>ID utilisateur</label>
        <input type="number" name="id_user">
        <label>Fichier</label>
        <input type="file" name="file">


        <input type="submit" value="Register">
    </form>

    <h2>Search annonce</h2>
    <form action="customer-info.php" method="post">
        <input type="text" name="email" />
        <input type="submit" value="search">
    </form>

    <h2>Annonce encours</h2>
    <table>
        <thead>
            <tr>
                <th>title</th>
                <th>description</th>
                <th>beginprice</th>

                <th>enddate</th>
                <th>model</th>
                <th>year</th>
            </tr>
        </thead>
        <tbody>
            <table>


                <thead>
                    <tr>
                        <th>title</th>
                        <th>model</th>
                        <th>year</th>
                        <th>beginprice</th>
                        <th>enddate</th>
                        <th>enchere en cours</th>
                        <th>montant à encherir </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ads as  $ad) { ?>
                        <tr>
                            <td><?= $ad["title"] ?></td>
                            <td><?= $ad["model"] ?></td>
                            <td><?= $ad["year"] ?></td>
                            <td><?= $ad["beginprice"] ?></td>
                            <td><?= $ad["enddate"] ?></td>
                            <td><?= $ad["price"] ?></td>
                            <td>
                                <form action="ad_detail.php" method="post">
                                    <input type="hidden" name="id" value="<?= $ad["id"] ?>">
                                    <input type="submit" value="detail ad">
                                </form>
                                <form action="ad_detail.php" method="post">
                                    <input type="hidden" name="id" value="<?= $ad["id"] ?>">
                                    <input type="number" name="price">
                                    <input type="submit" value="detail ad">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>

</body>