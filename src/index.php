<?php
require_once __DIR__ . "/nav.php";
require_once __DIR__ . "/lib/db.php";
// if ($_SERVER["REQUEST_METHOD"] = "POST") {

//     if (isset($_POST["champ_tri_annonce"])) {}
// };


if (isset($_GET["champ_tri_annonce"])) {

    $champ_tri_annonce = $_GET["champ_tri_annonce"];
} else {
    $champ_tri_annonce = "id";
}


//require_once __DIR__ . "/creat_ad.php";
$queryads = $dbh->prepare(" SELECT ad.*,b.*,u.lastname,u.firstname FROM `ad` left JOIN bids b on b.id_ad=ad.id left JOIN users u on b.id_user=u.id WHERE
b.price = (SELECT MAX(price) FROM bids WHERE bids.id_ad = ad.id) OR b.id_bid IS null  ORDER by $champ_tri_annonce ");
$resultads = $queryads->execute([]);
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
    <h2>Creation Annonce id:<?php if (isset($_SESSION["user_id"])) {
                                echo   $_SESSION["user_id"];
                            } ?></h2>
    <form action="creat_ad.php" method="POST" enctype="multipart/form-data">
        <label>title</label>
        <input type=" text" name="title" value="title">

        <label>description</label>
        <input type="text" name="description" value="description">

        <label>beginprice</label>
        <input type="number" name="beginprice" step="0.01" value="10">
        <label>reserveprice</label>
        <input type="number" name="reserveprice" step=" 0.01" value="20">
        <label>enddate</label>
        <input type="date" name="enddate" value="2021-01-01">
        <label>model</label>
        <input type="text" name="model" value="model">
        <label>brand</label>
        <input type="text" name="brand" value="brand">
        <label>power</label>
        <input type="text" name="power" value=100>
        <label>year</label>
        <input type="number" name="year" min="1910" max="2022" value=2000>
        <label>ID utilisateur</label>

        <input type="hidden" name="id_user" value="<?php if (isset($_SESSION['user_id'])) {
                                                        $_SESSION['user_id'];
                                                    } ?>
                
            } ?>">
        <label>Fichier</label>
        <input type="file" name="fileimage">


        <input type="submit" value="Register">
    </form>

    <h2>Veuillez taper le champs pour effectier le tri des annonce</h2>
    <form action="" method="get">
        <input type="text" name="champ_tri_annonce" />
        <input type="submit" value="search">
    </form>
    <h2>derniere annonce cree</h2>

    <img src="/src/upload/FB_IMG_1512716286635.jpg">


    <table>


        <thead>
            <tr>
                <th>image </th>
                <th>image test </th>
                <th>image test</th>
                <th>title</th>
                <th>model</th>
                <th>year</th>
                <th>beginprice</th>
                <th>enddate</th>

                <th>enchere max en cours</th>
                <th>nom enchere max en cours</th>
                <th>Detail AD </th>
                <th>montant à encherir </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ads as  $ad) { ?>
                <tr>
                    <td><?= $ad["fileimage"] ?></td>
                    <td><img src="/upload/<?php $ad["fileimage"] ?>"></td>
                    <td><img src="/src/upload/IMG_20171022_123147.jpg"></td>
                    <td><?= $ad["title"] ?></td>
                    <td><?= $ad["model"] ?></td>
                    <td><?= $ad["year"] ?></td>
                    <td><?= $ad["beginprice"] ?></td>
                    <td><?= $ad["enddate"] ?></td>
                    <td><?= $ad["price"] ?></td>
                    <td><?= $ad["firstname"] ?></td>

                    <td>
                        <form action="ad_detail.php" method="post">
                            <input type="hidden" name="id" value="<?= $ad["id"] ?>">
                            <input type="submit" value="detail ad">
                        </form>
                    </td>
                    <td>
                        <?php if ($ad["enddate"] > $date = date('Y-m-d H:i:s')) { ?>
                            <form action="bid_on_ad_result.php" method="post">
                                <input type="hidden" name="id_ad" value="<?= $ad["id"] ?>">
                                <input type="number" name="price">
                                <input type="submit" value="encherir ad">
                            </form>
                        <?php  } ?>
                        <?php if ($ad["enddate"] < $date = date('Y-m-d H:i:s')) { ?>
                            <p>enchere termineé</p><?php  } ?>
                    </td>
                </tr>
            <?php } ?>

</body>