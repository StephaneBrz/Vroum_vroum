<?php

/* Import */
require_once __DIR__ . "/lib/db.php";

/* Si le verbe HTTP est différent de POST */
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    die();
}

/* Récupération des données du formulaire */
$title = htmlspecialchars($_POST["title"]);
$description = htmlspecialchars($_POST["description"]);
$beginprice = htmlspecialchars($_POST["beginprice"]);
$reserveprice = htmlspecialchars($_POST["reserveprice"]);
$enddate = htmlspecialchars($_POST["enddate"]);
$model = htmlspecialchars($_POST["model"]);
$brand = htmlspecialchars($_POST["brand"]);
$power = htmlspecialchars($_POST["power"]);
$year = htmlspecialchars($_POST["year"]);
$id_user = htmlspecialchars($_POST["id_user"]);
if (isset($_FILES["file"])) {

    $namefile = $_FILES["file"]["name"];
    $tabExtension = explode('.', $namefile);
    $extension = strtolower(end($tabExtension));
    $extensions = ["jpg", "png", "jpeg", "gif"];
    if (in_array($extension, $extensions)) {

        move_uploaded_file($namefile, './upload/' . $namefile);
    } else {
        echo "mauvaise extension";
    }
}


//$dbh = new PDO("mysql:dbname=VROUM;host=mysql", "root", "root");
/* Préparation de la requête */
$query = $dbh->prepare("INSERT INTO ad (title,description,beginprice,	reserveprice ,enddate ,	model ,	brand ,	power, 	year,`id_user`) VALUES (?, ?, ?, ?, ?,?,?,?,?,?);");

/* Exécution de la requête */
/* On obtient une valeur de résultat indiquant le nombre de lignes affectées par la requête */
$result = $query->execute([$title, $description, $beginprice, $reserveprice, $enddate, $model, $brand, $power, $year, $id_user]);
$ads = $query->fetchAll(PDO::FETCH_ASSOC)
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>annonce vue</title>
</head>

<body>
    <?php if ($result == 1) { ?>
        <p>Merci de votre message</p>
    <?php } else { ?>
        <p>Une erreur s'est produite, veuillez réessayer</p>
    <?php } ?>
    <table>


        <thead>
            <tr>
                <th>title</th>
                <th>description</th>
                <th>beginprice</th>
                <th>reserveprice</th>
                <th>enddate</th>
                <th>model</th>
                <th>brand</th>
                <th>power</th>
                <th>year</th>
                <th>image</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ads as  $ad) { ?>
                <tr>
                    <td><?= $ad["title"] ?></td>
                    <td><?= $ad["description"] ?></td>
                    <td><?= $ad["beginprice"] ?></td>
                    <td><?= $ad["reserveprice"] ?></td>
                    <td><?= $ad["enddate"] ?></td>
                    <td><?= $ad["model"] ?></td>
                    <td><?= $ad["brand"] ?></td>
                    <td><?= $ad["power"] ?></td>
                    <td><?= $ad["year"] ?></td>
                    <td><?= $ad["fileimage"] ?></td>
                    <td>
                        <form action="detail-ad.php" method="post">
                            <input type="hidden" name="id" value="<?= $ad["id"] ?>">
                            <input type="submit" value="detail ad">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>