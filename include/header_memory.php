<!-- Partie PHP -->
<?php
    require './class/User.php';
    $player = new User();
    require 'class/Board.php';
    $plateau = new Board();
    // vérification si le joueur a cliqué sur le bouton reset
    if (isset($_GET['reset'])){
        if($_GET['reset'] == true){
            $plateau->init();
            header('Location: jeu.php');
        }
    }
    // Partie USER et initialisation
    $paire = $_SESSION['nb_paires'];
    // Contrôle de l'affichage en fonction du nombre de carte

    if($_SESSION['player']=="anonyme"){
        // verif si le compte "anonyme" a déjà été créé
        if(!$player->isUserExist($_SESSION['player'])){
            $player->createAnonyme();
        }
        else{
            $player->connectAnonyme();
        }
    }
    if($_SESSION['player']== "NewGame" OR $_SESSION['player']=="anonyme"){
        $_SESSION['player'] = "Game";
        $plateau -> init();
    }
?>
<!-- header des pages -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="site.css">
    <?php if ($_SESSION['nb_paires'] <= 6){?>
        <style>
            .carte{
                margin-top: 15vh;
            }
        </style>
    <?php } ?>
    <title>Memory</title>
</head>

<body>
    <header id="header_jeu">
        <div class="container">
            <div class="flex">
                <div id="left">
                    <?php $plateau->displayTour();?>
                </div>
                <?php
                    // test si l'utilisateur est connecté
                    if (isset($_GET['deconnexion'])){
                        if($_GET['deconnexion']==true){
                            $player->disconnect();
                            header('Location: index.php');
                        }
                    }
                    else if($player->isConnected()){
                        $user = $player->getLogin();
                ?>
                <!-- //////////////////////////////////////////////////////////
                /////////////////  CONNECTE  ////////////////////////////
                ////////////////////////////////////////////////////////// -->
                <div class='center'>
                    <h3>Bonne chance <?=$user?></h3>

                    <a class="ordi" href='index.php?reset=true'><button>Reset</button></a>
                </div>
                <nav class="ordi">
                    <ul>
                        <li><a class='a_head' href='index.php'>Abandonner</a></li>
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
                                <a href='index.php'><button>Abandonner</button></a>
                            </li>
                            <li>
                                <a href='index.php?reset=true'><button>Reset</button></a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <?php
                    }
                ?>
            </div>
        </div>
    </header>
