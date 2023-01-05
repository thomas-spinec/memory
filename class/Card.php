<?php

    class Card{
            /* Propriétés */
        private $bdd;

        /* Constructeur */
        public function __construct() 
        {
            // connection à la BDD avec PDO
            $servername = 'localhost';
            $dbname = 'classes';
            $db_username = 'root';
            $db_password = '';
            
            // essaie de connexion
            try {
                $this->bdd = new PDO("mysql:host=$servername;dbname=$dbname; charset=utf8", $db_username, $db_password);

                // On définit le mode d'erreur de PDO sur Exception
                $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo "Connexion réussie"; 
            } 
            // si erreur, on capture les exceptions, s'il y en a une on affiche les infos
            catch(PDOException $e)
            {
                echo "Echec de la connexion : " . $e->getMessage();
                exit;
            }
        }

        /* Méthodes */


    }