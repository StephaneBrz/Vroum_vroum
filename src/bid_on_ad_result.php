<?php session_start();

/* Import */
require_once __DIR__ . "/lib/db.php";
// Traitement de la requête si le verbe HTTP est POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405); // Code HTTP Method Not Allowed (Verbe HTTP non autorisé)
    die(); // Arrêt du script
}

// Récupération des valeurs du formulaire de la requête
$price =  htmlspecialchars($_POST["price"]);

$id_user = $_SESSION["user_id"];
$id_ad = $_POST["id_ad"];

echo "coucou";

/* Préparation de la requête */
$query = $dbh->prepare('INSERT INTO bids (price,id_user,id_ad) VALUES (?,?,?)');
//Exécution de la requête
$resutl = $query->execute([$price, $id_user, $id_ad]);
$bid = $query->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


</body>

</html>