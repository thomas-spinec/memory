    <!-- header des pages -->
    <?php
        session_start();
        require 'include/header.php';
        require 'class/Card.php' ;
        $plateau = new Card();
        if(isset($_POST['reset'])){
            $plateau->init();
            header('Location: jeu.php');
        }
        // vérification des cartes choisies
        if($_SESSION['choice2'] != ""){
            $plateau->checkChoice();
            header('Refresh: 1; URL=jeu.php');
        }
    ?>

    <!-- contenu de la page -->
    <main>
        <!-- Partie qui ira dans le header des pages -->
        <?php
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
            }
            elseif($_SESSION['player']== "NewGame" OR $_SESSION['player']=="anonyme"){
                $_SESSION['player'] = "Game";
                $plateau -> init();
            }
            ?>
        <!-- fin partie header -->
        <div class="container">
            <div id="plateau">
                <H2>Memory</H2>
                <p>Nombre de paires: <?= $_SESSION['nb_paires']; ?> </p>
                <?php $plateau->displayTour();?>
                <form action="verif_jeu.php" method="post" id="form_plateau">
                    <?php
                    for ($i=0; $i < $plateau->getNbCarte(); $i++) {
                        $plateau->displayPlateau($i);
                    }
                    ?>
                </form>
            </div>
            <form action="" method="post" id="reset">
                <input type="submit" name="reset" value="Reset">
            </form>
            <?php
                var_dump($_SESSION['deck']);
                var_dump($_SESSION['find']);
            ?>
        </div>
    </main>