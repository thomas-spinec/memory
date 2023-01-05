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
        <div class="container">
            <div class="flex">
                <div id="left">
                    <h3>Memory</h3>
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
                <div class='center'>
                    <h3>Bonjour <?=$user?></h3>
                    <a href='index.php?deconnexion=true'><button>Déconnexion</button></a>
                </div>

                <?php
                        if ($user == 'admin') {
                            $_SESSION['admin'] = true;
                ?>
                <!-- ////////////////////////////////////////////////////////
                /////////////////  ADMIN  //////////////////////////////////
                //////////////////////////////////////////////////////// -->
                <nav class="ordi">
                    <ul>
                        <li><a class='a_head'href='index.php'>Accueil</a></li>
                        <li><a class='a_head' href='profil.php'>Profil</a></li>
                        <li><a class='a_head' href='classement.php'>Meilleurs joueurs</a></li>
                        <li><a class='a_head' href='admin.php'>Info Utilisateurs</a></li>
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
                                <a class='a_head'href='index.php'>Accueil</a>
                            </li>
                            <li>
                                <a class='a_head' href='profil.php'>Profil</a>
                            </li>
                            <li>
                                <a class='a_head' href='classement.php'>Meilleurs joueurs</a>
                            </li>
                            <li>
                                <a class='a_head' href='admin.php'>Info Utilisateurs</a>
                            </li>
                        </ul>
                    </li>
                </ul>



                <?php
                        }
                        else {
                ?>
                <!-- //////////////////////////////////////////////////////////
                /////////////////  UTILISATEURS  ////////////////////////////
                ////////////////////////////////////////////////////////// -->
                <nav class="ordi">
                    <ul>
                        <li><a class='a_head' href='index.php'>Accueil</a></li>
                        <li><a class='a_head' href='profil.php'>Profil</a></li>
                        <li><a class='a_head' href='classement.php'>Meilleurs joueurs</a></li>
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
                                <a class='a_head'href='index.php'>Accueil</a>
                            </li>
                            <li>
                                <a class='a_head' href='profil.php'>Profil</a>
                            </li>
                            <li>
                                <a class='a_head' href='classement.php'>Meilleurs joueurs</a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <?php
                        }
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
                        <li><a class='a_head' href='index.php'>Accueil</a></li>
                        <li><a class='a_head' href='classement.php'>meilleurs joueurs</a></li>
                    </ul>
                </nav>

                <?php
                    }
                ?>
            </div>
        </div>
    </header>
