<?php
require_once __DIR__ . "/lib/db.php";

function Afficher_formulaire_inscription_newuser () { ?>
<body>
    <h1>Formulaire d'inscription</h1>
    <form action="user.inscription.php" method="post">
        <div id="blocinput">
            <label for="firstname" id="bloclabelinput">Prénom:</label>
            <input type="text" name="firstname" id="firstname" required id="bloclabelinput"/>

            <label for="lastname" id="bloclabelinput">Nom:</label>
            <input type="text" name="lastname" id="lastname" required id="bloclabelinput"/>

            <label for="email" id="bloclabelinput">Email:</label>
            <input type="email" name="email" id="email" required id="bloclabelinput"/>

            <label for="phone" id="bloclabelinput">Mot de passe:    </label>
            <input type="password" name="password" id="password" required id="bloclabelinput"/>

        </div>

        <input type="submit" value="S'INSCRIRE" id="bloclabelinput" class="button">
    </form>
</body>
<?php } ?>
<?php

?>

<style scoped>
body{
    text-align: center;
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
    padding:10px 18px;
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

</style>