<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Form</title>
</head>

<body>

        <h1>Formulaire de connexion</h1>
        <form action="connexion.php" method="POST">

            <label for="email">Email: </label>
            <input type="email" name="email" id="email" />

            <label for="password">Mot de passe: </label>
            <input type="text" name="password" id="password" />

            <input type="submit" value="Send message">

            <a href="user.php">Vous n'avez pas encore de compte, c'est le moment d'en créer un!</a>
        </form>

</body>

</html>