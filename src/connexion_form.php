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
        <section class="haut">
            <h1>Formulaire de connexion</h1>
            <form action="connexion.php" method="POST">
                <div id="blocinput">
                <label for="email" id="bloclabelinput">Email: </label>
                <input type="email" name="email" id="email" required id="bloclabelinput"/>

                <label for="password" id="bloclabelinput">Mot de passe: </label>
                <input type="text" name="password" id="password" required id="bloclabelinput"/>

                <input type="submit" value="SE CONNECTER" id="bloclabelinput" class="button">
                </div>
                <a href="connexion_form.php?name" id="bloclabelinput" class="bloclabelinputclass">Vous n'avez pas encore de compte, c'est le moment d'en créer un!</a>
            </form>
        </section>
        <section class="bas">
            <?php if (isset($_GET['name'])) {
                echo Afficher_formulaire_inscription_newuser ();
            }
            ?>
        </section>
    <footer>
        <?php echo Afficher_footer() ?>
    </footer>
        

</body>

</html>

<style scoped>
.haut{
    text-align: center;
    height: 450px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

h1{
    color: #c44646;
}

#blocinput {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.button{
    margin: 10px;
    padding:10px 18 px;
    background-color: #c44646;
    color: white;
}

.button:hover{
    background-color: white;
    color: #c44646;
    cursor: pointer;
    font-weight: bolder;
    border: 2px solid #c44646;
    font-weight: bolder;
}

#bloclabelinput{
    margin: 10px;
}

.bloclabelinputclass{
    margin-bottom: 20px, !important;
}

</style>