<?php
require_once __DIR__ ."/nav.php";
require_once __DIR__ ."/footer.php";
require_once __DIR__ ."/user.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Form</title>
</head>

<body>
    <header>
        <?php echo Afficher_nav() ?>
    </header>
        <h1>Formulaire de connexion</h1>
        <form action="connexion.php" method="POST">

            <label for="email">Email: </label>
            <input type="email" name="email" id="email" required/>

            <label for="password">Mot de passe: </label>
            <input type="text" name="password" id="password" required/>

            <input type="submit" value="Send message">

            <a href="connexion_form.php?name">Vous n'avez pas encore de compte, c'est le moment d'en créer un!</a>
        </form>

    <?php if (isset($_GET['name'])) {
         echo Afficher_formulaire_inscription_newuser ();
     }
     ?>

    <footer>
        <?php echo Afficher_footer() ?>
    </footer>
        

</body>

</html>