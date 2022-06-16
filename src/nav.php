<?php session_start();
function Afficher_nav()
{ ?>
    <nav>
        <?php if (isset($_SESSION["user_id"])) { ?>
            <h1>Vroum vroouuuuummmmmm</h1>
            <a href="edit_profil.php"><button>Modifier votre Prodil</button></a>
            <a href="deconnection.php"><button>Deconnexion</button></a>
            <?php if (isset($_SESSION["user_firstname"])) { ?>
                <h4>Bienvenue <?= $_SESSION["user_firstname"];
                            } ?>

            <?php } else { ?>
                <h1>Vroum vroouuuuummmmmm</h1>
                <a href="connexion_form.php">Se connecter</a>
                <a href="index.php"><img src="" alt="">LOGO</a>

    </nav>
<?php }
    } ?>