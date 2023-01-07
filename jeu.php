    <!-- header des pages -->
    <?php
        session_start();
        require 'include/header.php';
        require 'class/Board.php';
        require 'class/Card.php' ;
        $plateau = new Board();
        // vérification si le joueur a cliqué sur le bouton reset
        if(isset($_POST['reset'])){
            $plateau->init();
            header('Location: jeu.php');
        }
        // Partie USER et initialisation
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
        // création de tous les objets
        for ($i=0; $i < $plateau->getNbCarte(); $i++){
            ${'carte'.$i} = new Card($i);
        }

        // Vérification quand deux cartes ont été choisies
        if($_SESSION['choice2'] != ""){
            $plateau->checkChoice();
            header('Refresh: 1.5; URL=jeu.php');
        }
    ?>
        <!-- fin partie header -->

    <!-- contenu de la page -->
    <main>
        <div class="container">
            <div id="plateau">
                <H2>Memory</H2>
                <p>Nombre de paires: <?= $_SESSION['nb_paires']; ?> </p>
                <?php $plateau->displayTour();?>
                <form action="verif_jeu.php" method="post" id="form_plateau">
                    <?php
                    for ($i=0; $i < $plateau->getNbCarte(); $i++) {
                        ${'carte'.$i}->displayCard();
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
                var_dump($_SESSION['choice1']);
                var_dump($_SESSION['choice2']);
            ?>
        </div>
    </main>