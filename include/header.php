<!-- Partie PHP -->
<?php
    require './class/User.php';
    $player = new User();
?>
<!-- header des pages -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="site.css">
    <title>Memory</title>
</head>

<body>
    <header>
        <div class="container_header">
            <div class="flex">
                <div id="left">
                    <h2>Memory</h2>
                </div>
                <?php
                    // test si l'utilisateur a cliqué sur déconnexion
                    if (isset($_GET['deconnexion'])){
                        if($_GET['deconnexion']==true){
                            $player->disconnect();
                            header('Location: index.php');
                        }
                    }
                    // test si l'utilisateur a joué en anonyme
                    if(isset($_SESSION['anonyme'])){
                        if($_SESSION['anonyme']==true){
                            $player->disconnect();
                        }
                    }
                    // test si l'utilisateur est connecté
                    if($player->isConnected()){
                        $user = $player->getLogin();
                ?>
                <!-- //////////////////////////////////////////////////////////
                /////////////////  CONNECTE  ////////////////////////////
                ////////////////////////////////////////////////////////// -->
                <div class='center'>
                    <h3>Bonjour <?=$user?></h3>
                    <a href='index.php?deconnexion=true'><button>Déconnexion</button></a>
                </div>
                <nav class="ordi">
                    <ul>
                        <li><a href='index.php'><button>Accueil</button></a></li>
                        <li><a href='profil.php'><button>Profil</button></a></li>
                        <li><a href='classement.php'><button>Classement</button></a></li>
                    </ul>
                </nav>
                <!-- pour mobile -->

                <ul class="nav">
                    <li id="mobile">
                        <a href="#">
                            <img id="menu_img" src="./img/menu.png" alt="menu">
                        </a>
                        <ul id="menu_burger">
                            <li>
                                <a href='index.php'><button>Accueil</button></a>
                            </li>
                            <li>
                                <a href='profil.php'><button>Profil</button></a>
                            </li>
                            <li>
                                <a href='classement.php'><button>Classement</button></a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <?php
                    }
                    else{
                ?>
                <!-- //////////////////////////////////////////////////////////
                /////////////////  DECONNECTE  ///////////////////////////////
                ////////////////////////////////////////////////////////// -->
                <div class="center">
                    <a href='connexion.php'><button>Connexion</button></a>
                    <a href='inscription.php'><button>Inscription</button></a>
                </div>
                <nav>
                    <ul>
                        <li><a href='index.php'><button>Accueil</button></a></li>
                        <li><a href='classement.php'><button>Classement</button></a></li>
                    </ul>
                </nav>

                <?php
                    }
                ?>
            </div>
        </div>
    </header>
