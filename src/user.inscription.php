<?php

/* Import */
require_once __DIR__ . "/lib/db.php";

/* Si le verbe HTTP est différent de POST */
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    die();
}

/* Récupération des données du formulaire */
$firstname = htmlspecialchars($_POST["firstname"]);
$lastname = htmlspecialchars($_POST["lastname"]);
$email = htmlspecialchars(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
$password = htmlspecialchars($_POST["password"]);

/* Préparation de la requête */
$query = $dbh->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?);");

/* Exécution de la requête */
/* On obtient une valeur de résultat indiquant le nombre de lignes affectées par la requête */
$result = $query->execute([$firstname, $lastname, $email, $password]);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Formulaire d'Inscription</title>
</head>

<body>
    <?php if ($result == 1) { ?>
        <p>Votre inscription est validée</p>
    <?php } else { ?>
        <p>Une erreur s'est produite, veuillez réessayer</p>
    <?php } ?>
</body>

</html>