<?php

    class Card{
            /* Propriétés */

        /* Constructeur */
        // public function __construct() 
        // {
        //     // connection à la BDD avec PDO
        //     // en local ////////////////////
        //     $servername = 'localhost';
        //     $dbname = 'memory';
        //     $db_username = 'root';
        //     $db_password = '';

        //     // en ligne ///////////////////
        //     // $servername = 'localhost';
        //     // $dbname = 'thomas-spinec_memory';
        //     // $db_username = 'adminbdd';
        //     // $db_password = 'basededonnees';


        //     // essaie de connexion
        //     try {
        //         $this->bdd = new PDO("mysql:host=$servername;dbname=$dbname; charset=utf8", $db_username, $db_password);

        //         // On définit le mode d'erreur de PDO sur Exception
        //         $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //         //echo "Connexion réussie"; 
        //     } 
        //     // si erreur, on capture les exceptions, s'il y en a une on affiche les infos
        //     catch(PDOException $e)
        //     {
        //         echo "Echec de la connexion : " . $e->getMessage();
        //         exit;
        //     }
        // }

        /* Méthodes */

        // affichage de l'avant de la carte
        public function displayFront($id){
            ?>
                <img src="img/<?= $id ?>" alt="carte">
            <?php
        }

        // affichage de l'arrière de la carte
        public function displayBack(){
            ?>
                <img src="img/back.png" alt="carte">
            <?php
        }

        // tour +1
        public function addTour(){
            if(isset($_SESSION['tour'])){
                $_SESSION['tour'] = 1;
            }
            else{
                $_SESSION['tour']++;
            }
        }

        // affichage du nombre de tours
        public function displayTour(){
            ?>
                <p>Nombre de tours : <?= $_SESSION['tour'] ?></p>
            <?php
        }

        // réinitialisation nbre tour
        public function resetTour(){
            unset($_SESSION['tour']);
        }



    }