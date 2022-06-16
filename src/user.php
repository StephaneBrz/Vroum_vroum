<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Vroum vroum</title>
</head>


<body>
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
</body>

</html>