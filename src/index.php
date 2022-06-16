<?php
require_once __DIR__ . "/nav.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VRoum VRoum</title>
</head>



<body>
    <?php Afficher_nav(); ?>
    <h2>Creation Annonce</h2>
    <form action="ad.php" method="POST">
        <label>title</label>
        <input type=" text" name="title">

        <label>description</label>
        <input type="text" name="description">

        <label>beginprice</label>
        <input type="number" name="beginprice" step="0.01">
        <label>reserveprice</label>
        <input type="number" name="reserveprice" step=" 0.01">
        <label>enddate</label>
        <input type="text" name="enddate">
        <label>model</label>
        <input type="text" name="model">
        <label>brand</label>
        <input type="text" name="brand">
        <label>power</label>
        <input type="text" name="power">
        <label>year</label>
        <input type="number" name="year" min="1910" max="2022">
        <label>ID utilisateur</label>
        <input type="number" name="id_user">


        <input type="submit" value="Register">
    </form>

    <h2>Search annonce</h2>
    <form action="customer-info.php" method="post">
        <input type="text" name="email" />
        <input type="submit" value="search">
    </form>
</body>

</html>