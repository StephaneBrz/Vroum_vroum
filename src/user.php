<?php
require_once __DIR__ . "/lib/db.php";

function Afficher_formulaire_inscription_newuser () { ?>
    <h1>Formulaire d'Inscription</h1>
    <form action="user.inscription.php" method="post">

        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" id="firstname" />

        <label for="lastname">Nom</label>
        <input type="text" name="lastname" id="lastname" />

        <label for="email">Email</label>
        <input type="email" name="email" id="email" />

        <label for="phone">Mot de passe</label>
        <input type="password" name="password" id="password" />

        <input type="submit" value="S'inscrire">
    </form>
<?php } ?>
<?php

?>