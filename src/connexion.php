<?php session_start();

/* Import */
require_once __DIR__ . "/lib/db.php";

/* Si le verbe HTTP est différent de POST */
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    die();
}

/* Récupération des données du formulaire */
$email = htmlspecialchars(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
$password = htmlspecialchars($_POST["password"]);

/* Préparation de la requête */
$query = $dbh->prepare("SELECT * FROM users WHERE email = ?");

/* Exécution de la requête */
/* On obtient une valeur de résultat indiquant le nombre de lignes affectées par la requête */
$result = $query->execute([$_POST['email']]);
$user = $query->fetch();



if (!$user) {
    header('Location:user.inscription.php');
    exit();
} else if (password_verify($_POST['password'], $user['password'])) {
    //echo "Valid";
    $_SESSION['user_id'] = $user["id"];
    $_SESSION['user_firstname'] = $user["firstname"];
    header('Location:index.php');
    exit();
} else {
    echo "Invalid";
}
?>

<!DOCTYPE html>
<html lang="en">

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