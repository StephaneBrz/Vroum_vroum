<?php

/* Import */
//require_once __DIR__ . "/lib/db.php";

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


$dbh = new PDO("mysql:dbname=VROUM;host=mysql", "root", "root");
/* Préparation de la requête */
$query = $dbh->prepare("INSERT INTO ad (title,description,beginprice,	reserveprice ,enddate ,	model ,	brand ,	power, 	year,`id_user`) VALUES (?, ?, ?, ?, ?,?,?,?,?,?);");

/* Exécution de la requête */
/* On obtient une valeur de résultat indiquant le nombre de lignes affectées par la requête */
$result = $query->execute([$title, $description, $beginprice, $reserveprice, $enddate, $model, $brand, $power, $year, $id_user]);
$ad = $query->fetchAll()
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Contact Form</title>
</head>

<body>
    <?php if ($result == 1) { ?>
        <p>Merci de votre message</p>
    <?php } else { ?>
        <p>Une erreur s'est produite, veuillez réessayer</p>
    <?php } ?>
</body>

</html>