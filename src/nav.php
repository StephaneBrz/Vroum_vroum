<?php session_start();
function Afficher_nav()
{ ?>
    <nav>
        <?php if (isset($_SESSION["user_id"])) { ?>
            <h1>Vroum vroouuuuummmmmm</h1>
            <a href="edit_profil.php"><button>Modifier votre Prodil</button></a>
            <a href="my_profil.php"><button>Mon Profil</button></a>
            <a href="deconnection.php"><button>Deconnexion</button></a>
            <a href="index.php"><button>Retour à l'accueil</button></a>
            <?php if (isset($_SESSION["user_firstname"])) { ?>
                <h4>Bienvenue <?= $_SESSION["user_firstname"];
                            } ?>

            <?php } else { ?>
                <h1>Vroum vroouuuuummmmmm</h1>
                <div id="blocnavdroit">
                <a href="connexion_form.php" id="liendroit">Se connecter</a>
                <a href="index.php" id="liendroit"><img src="" alt="">Home</a>
                </div>
                

    </nav>
<?php }
    } ?>


<style>

nav {
    background: black;
    color: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 2%;
    border-bottom: 4px solid #c44646;;
}

#blocnavdroit {
display: flex;
color: white;
}

#liendroit{
    color: white;
    margin: 10px;   
} 

</style>