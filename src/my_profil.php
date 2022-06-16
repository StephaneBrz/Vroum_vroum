<?php
require_once __DIR__ . "/nav.php";
require_once __DIR__ . "/lib/db.php";
// if (isset($_SESSION['user_id'])) {

$queryads = $dbh->prepare("SELECT ad.*,b.*,u.lastname,u.firstname FROM `ad` left JOIN bids b on b.id_ad=ad.id left JOIN users u on b.id_user=u.id WHERE
b.price = (SELECT MAX(price) FROM bids WHERE bids.id_ad = ad.id) OR b.id_bid IS null OR ad.id_user=?");
$resultads = $queryads->execute([$_SESSION['user_id']]);
$ads = $queryads->fetchall(PDO::FETCH_ASSOC);

$querybid = $dbh->prepare("SELECT * FROM `bids` b left JOIN ad on b.id_ad=ad.id left JOIN users u on u.id=ad.id_user WHERE
b.price = (SELECT MAX(price)  WHERE b.id_user = ?)  ");
$resultbids = $querybid->execute([$_SESSION['user_id']]);
$bids = $querybid->fetchall(PDO::FETCH_ASSOC);
?>
<h3>vente encours</h3>
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
                    <form action="bid_on_ad_result.php" method="post">
                        <input type="hidden" name="id_ad" value="<?= $ad["id"] ?>">
                        <input type="number" name="price">
                        <input type="submit" value="encherir ad">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<h3>Vos encheres</h3>
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
        <?php foreach ($bids as  $bid) { ?>
            <tr>
                <td><?= $bid["fileimage"] ?></td>
                <td><img src="/upload/<?php $bid["fileimage"] ?>"></td>
                <td><img src="/src/upload/IMG_20171022_123147.jpg"></td>
                <td><?= $bid["title"] ?></td>
                <td><?= $bid["model"] ?></td>
                <td><?= $bid["year"] ?></td>
                <td><?= $bid["beginprice"] ?></td>
                <td><?= $bid["enddate"] ?></td>
                <td><?= $bid["price"] ?></td>
                <td><?= $bid["firstname"] ?></td>

                <td>
                    <form action="ad_detail.php" method="post">
                        <input type="hidden" name="id" value="<?= $bid["id_ad"] ?>">
                        <input type="submit" value="detail ad">
                    </form>
                </td>
                <td>
                    <form action="bid_on_ad_result.php" method="post">
                        <input type="hidden" name="id_bid" value="<?= $bid["id_ad"] ?>">
                        <input type="number" name="price">
                        <input type="submit" value="encherir ad">
                    </form>
                </td>
            </tr>
        <?php
        } ?>
    </tbody>
</table>
</body>