    <!-- header des pages -->
    <?php
        session_start();
        require 'include/header.php';
        require 'class/Card.php' ;
        $plateau = new Card();
        $plateau->addTour();
        $user = new User();
        $paire = $_SESSION['nb_paires'];
        if(isset($_SESSION['player'])){
            // verif si le compte "anonyme" a déjà été créé
            if(!$user->isUserExist($_SESSION['player'])){
                $user->createAnonyme();
            }
            else{
                $user->connectAnonyme();
            }
        }
        $login = $user->getLogin();
    ?>

    <!-- contenu de la page -->
    <main>
        <div class="container">
            <div id="plateau">
                <H2>Memory</H2>
                <p>Nombre de paires: <?= $paire; ?></p>
                <?php $plateau->displayTour(); ?>
            </div>
        </div>
    </main>