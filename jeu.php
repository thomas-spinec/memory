    <!-- header des pages -->
    <?php
        session_start();
        require 'include/header_memory.php';
        require 'class/Card.php' ;
        
        // création de tous les objets
        for ($i=0; $i < $plateau->getNbCarte(); $i++){
            ${'carte'.$i} = new Card($i);
        }

        // Vérification quand deux cartes ont été choisies
        if($_SESSION['choice2']['id'] != ""){
            $plateau->checkChoice();
        }
    ?>
        <!-- fin partie header -->

    <!-- contenu de la page -->
    <main id="jeu">
        <div class="container">
            <div id="plateau">
                <form action="verif_jeu.php" method="post" id="form_plateau">
                    <?php
                    for ($i=0; $i < $plateau->getNbCarte(); $i++) {
                        ${'carte'.$i}->displayCard();
                    }
                    ?>
                </form>
            </div>

            <?php
                if( $plateau->checkEnd()){
                    $score = $_SESSION['nb_paires']/$_SESSION['tour'];
                    $player->saveScore();

                ?>
            <div id="fin">
                <H2>Partie terminée!</H2>
                <h3>Votre score*: <?= $score ?></h3>
                <p>*Score = nombre paires (<?=$_SESSION['nb_paires']?>) &divide; nombre coups (<?=$_SESSION['tour']?>)</p>
                <!-- réinitialisation variable de jeu -->
                <?php
                    $_SESSION['player']== "NewGame";
                    $plateau->init();
                ?>
                <ul>
                    <?php 
                        if(isset($_SESSION['anonyme'])){
                            if($_SESSION['anonyme'] == false){
                                ?>
                                <li><a class="a_fin" href="profil.php">Profil</a></li>
                                <?php
                            }
                        }
                    ?>
                    <li><a class="a_fin" href="classement.php">Les meilleurs</a></li>
                    <li><a class="a_fin" href="index.php">Accueil</a></li>
                </ul>
                <a href='jeu.php?reset=true'><button>Relancer</button></a>
            </div>
            <?php
                }
            ?>
        </div>
    </main>