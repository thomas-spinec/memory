    <!-- header des pages -->
    <?php
        session_start();
        require 'include/header.php';
        require 'class/Card.php' ;
        $plateau = new Card();
        $user = new User();
        $paire = $_SESSION['nb_paires'];
        if($_SESSION['player']=="anonyme"){
            // verif si le compte "anonyme" a déjà été créé
            if(!$user->isUserExist($_SESSION['player'])){
                $user->createAnonyme();
            }
            else{
                $user->connectAnonyme();
            }
            $plateau -> init();
            $_SESSION['find']=[];
            $_SESSION['choice1'] = "";
            $_SESSION['choice2'] = "";
            $_SESSION['player'] = "ano";
        }
        elseif($_SESSION['player']== "NewGame"){
            $plateau -> init();
            $_SESSION['find']=[];
            $_SESSION['choice1'] = "";
            $_SESSION['choice2'] = "";
            $_SESSION['player'] = "Game";
        }
    ?>

    <!-- contenu de la page -->
    <main>
        <div class="container">
            <div id="plateau">
                <H2>Memory</H2>
                <p>Nombre de paires: <?= $_SESSION['nb_paires']; ?> </p>
                <?php $plateau->displayTour();
                var_dump($_SESSION['deck']);
                ?>
                <form action="verif_jeu.php" method="post">
                <?php
                for ($i=0; $i < $plateau->getNbCarte(); $i++) {
                    $plateau->displayPlateau($i);
                }
                ?>
                </form>

                <?php

                ?>
            </div>
        </div>
    </main>