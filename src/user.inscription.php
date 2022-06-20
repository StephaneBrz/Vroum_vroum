<?php session_start();
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
$password = password_hash(($_POST["password"]), PASSWORD_DEFAULT);

// $query = $dbh->prepare("SELECT * FROM users WHERE email = ?");
// $result = $query->execute([$email]);
// $verifyemail = $query->fetch();

// function Afficher_phrase_email_utilisé ($firstname, $lastname, $email, $password, $dbh) {
// if (isset($verifyemail)) {
//     echo "Cet email est déjà utilisé";
// } 
// else {
//     echo "coucou";
/* Préparation de la requête */
    $query = $dbh->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?);");
    //if ($resultverifyemail == 1) {
//    $emailverif["email"];
//    echo "email deja existant";
//}
/* Exécution de la requête */
/* On obtient une valeur de résultat indiquant le nombre de lignes affectées par la requête */
//else {
    $result = $query->execute([$firstname, $lastname, $email, $password]);
    if ($result == 1) {
        $query = $dbh->prepare("SELECT * FROM users WHERE email = ?");
        $result = $query->execute([$_POST['email']]);
        $user = $query->fetch();
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_firstname"] = $user["firstname"];

        header("location:index.php");
        exit();
    }
// }
// }
?>
