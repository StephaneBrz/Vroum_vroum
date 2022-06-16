<?php
require_once __DIR__ . "/nav.php";
require_once __DIR__ . "/lib/db.php";
if (isset($_SESSION['user_id'])) {

    $query = $dbh->prepare("SELECT * FROM users WHERE id = ?");
    $query->execute([$_SESSION['user_id']]);
    $user = $query->fetch();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $newlastname = htmlspecialchars($_POST['newlastname']);
        $newfirstname = htmlspecialchars($_POST['newfirstname']);
        $newemail = htmlspecialchars($_POST['newemail']);
        $newpassword = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);


        $editResult = true;


        if (isset($_POST['newlastname'])) {

            $insert_nom = $dbh->prepare("UPDATE users SET lastname = ? WHERE id = ?");
            $result = $insert_nom->execute([$newlastname, $_SESSION['user_id']]);
            $editResult = $result == false ? false : $editResult;
        }

        if (isset($_POST['newfirstname'])) {

            $insert_firstname = $dbh->prepare("UPDATE users SET firstname = ? WHERE id = ?");
            $result = $insert_firstname->execute([$newfirstname, $_SESSION['user_id']]);
            $_SESSION['user_firstname'] = $newfirstname;
            $editResult = $result == false ? false : $editResult;
        }

        if (isset($_POST['newemail'])) {

            if (filter_var($_POST['newemail'], FILTER_VALIDATE_EMAIL)) {
                $insertemail = $dbh->prepare("UPDATE users SET email = ? WHERE id = ?");
                $result = $insertemail->execute([$newemail, $_SESSION['user_id']]);
                $editResult = $result == false ? false : $editResult;
            }
        }

        if (isset($newpassword)) {
            $insertpassword = $dbh->prepare("UPDATE users SET password = ? WHERE id = ?");
            $result = $insertpassword->execute([$newpassword, $_SESSION['user_id']]);
            $editResult = $result == false ? false : $editResult;
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <!-- <link rel="stylesheet" href="style_edit_profil2.css"> -->
        <title>Document</title>
    </head>

    <body>

        <?php Afficher_nav(); ?>


        <div class="div_form ">
            <form method="POST" action="edit_profil.php">

                <h2>Nom :</h2>

                <label> Entrez votre nouveau nom : </label>
                <input type="text" name="newlastname" placeholder="<?= $user["lastname"]; ?>">

                <br />
                <hr />

                <h2>Prenom :</h2>
                <br />


                <label>Entrez votre nouveau prenom :</label>
                <input type="text" name="newfirstname" placeholder="<?= $user["firstname"]; ?>">

                <hr />



                <h2>Email :</h2>

                <br />

                <label for="email">Entrez votre nouvel email :</label>
                <input type="text" name="newemail" placeholder="<?= $user["email"]; ?>">

                <br />
                <hr />

                <label for="password">Entrez votre nouveau mdp :</label>
                <input type="text" name="newpassword" placeholder="<?= $user["password"]; ?>">


                <input type="submit" name="submit" value="Mettre à jour mon profil !" />
                <?php
                if (isset($editResult) && $result == true) {
                    echo "Vos données ont été mises à jour !"; ?>

                <?php } ?>

            </form>
        </div>
        <div id="retour">
            <a href="index.php"><button>Retour à l'accueil</button></a>

        </div>

    <?php }
    ?>
    </body>

    </html>