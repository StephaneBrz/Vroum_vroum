<?php
session_start();
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
$id_user = $_SESSION["user_id"];
if (isset($_FILES["fileimage"])) {

    $fileimage = $_FILES["fileimage"]["name"];
    $fileimagetemp = $_FILES["fileimage"]["tmp_name"];
    // echo "<script type='text/javascript'>alert( $fileimagetemp);</script>";
    $tabExtension = explode('.', $fileimage);
    $extension = strtolower(end($tabExtension));
    $extensions = ["jpg", "png", "jpeg", "gif"];
    if (in_array($extension, $extensions)) {

        move_uploaded_file($fileimagetemp . "/" . $fileimage,  __DIR__ . "/upload/" . $fileimage);
        //echo "ligne34" . $fileimagetemp;
        // copy(" /var/www/html/" . $fileimage,  " /var/www/html/test/" . $fileimage);
    } else {
        echo "mauvaise extension";
    }
}


//$dbh = new PDO("mysql:dbname=VROUM;host=mysql", "root", "root");
/* Préparation de la requête */
$query = $dbh->prepare("INSERT INTO ad (title,description,beginprice,	reserveprice ,enddate ,	model ,	brand ,	power, 	year,`id_user`,fileimage) VALUES (?, ?, ?, ?, ?,?,?,?,?,?,?);");

/* Exécution de la requête */
/* On obtient une valeur de résultat indiquant le nombre de lignes affectées par la requête */
$result = $query->execute([$title, $description, $beginprice, $reserveprice, $enddate, $model, $brand, $power, $year, $id_user, $fileimage]);
$ads = $query->fetchAll(PDO::FETCH_ASSOC);

//header('location:index.php');
//exit();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>annonce vue</title>
</head>

<body>
    <h4><?php
        if (isset($_FILES["fileimage"])) {
            var_dump($_FILES["fileimage"]["tmp_name"]);
        } ?></h4>
    <?php $showadcreat = function () use ($result, $title, $description, $beginprice, $reserveprice, $enddate, $model, $brand, $power, $year, $fileimage) {
        if ($result == 1) { ?>

            <p>Merci de votre message </p>
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

                    <tr>
                        <td><?= $title ?></td>
                        <td><?= $description ?></td>
                        <td><?= $beginprice ?></td>
                        <td><?= $reserveprice ?></td>
                        <td><?= $enddate ?></td>
                        <td><?= $model ?></td>
                        <td><?= $brand ?></td>
                        <td><?= $power ?></td>
                        <td><?= $year ?></td>
                        <td><?= $fileimage ?></td>

            </table>

        <?php } else { ?>

            <p>Une erreur s'est produite, veuillez réessayer</p>
        <?php } ?>


</body>
<?php };
    $showadcreat(); ?>