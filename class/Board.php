<?php

    class Board{
            /* Propriétés */
        private $AllCard;
        private $Card1;
        private $Card2;
        private $Card3;
        private $Card4;
        private $Card5;
        private $Card6;
        private $Card7;
        private $Card8;
        private $Card9;
        private $Card10;
        private $Card11;
        private $Card12;
        private $Deck;
        private $find;
        private $choice1;
        private $choice2;

        /* Constructeur */
        public function __construct() 
        {
            $this->Card1 = "./img/1";
            $this->Card2 = "./img/2";
            $this->Card3 = "./img/3";
            $this->Card4 = "./img/4";
            $this->Card5 = "./img/5";
            $this->Card6 = "./img/6";
            $this->Card7 = "./img/7";
            $this->Card8 = "./img/8";
            $this->Card9 = "./img/9";
            $this->Card10 = "./img/10";
            $this->Card11 = "./img/11";
            $this->Card12 = "./img/12";
            // Tableau contenant toutes les cartes
            $this->AllCard = array($this->Card1, $this->Card2, $this->Card3, $this->Card4, $this->Card5, $this->Card6, $this->Card7, $this->Card8, $this->Card9, $this->Card10, $this->Card11, $this->Card12);
            // variable contenant les cartes retournées
            if(isset($_SESSION['choice1'])){
                $this->choice1 = $_SESSION['choice1'];
            }
            else{
                $this->choice1 = "";
            }
            if(isset($_SESSION['choice2'])){
                $this->choice2 = $_SESSION['choice2'];
            }
            else{
                $this->choice2 = "";
            }
            // Tableau contenant les cartes choisies/trouvées
            if(isset($_SESSION['find'])){
                $this->find = $_SESSION['find'];
            }
            else{
                $this->find = [];
            }
            if(isset($_SESSION['deck'])){
                $this->Deck = $_SESSION['deck'];
            }

        }

        /* Méthodes */

        // initialisation
        public function init(){
            // initialisation du nombre de tours
            $this->resetTour();
            // initialisation du tableau de cartes
            $this->getCarte();
            // initialisation du tableau de cartes choisies
            $_SESSION['find']=[];
            $_SESSION['choice1'] = "";
            $_SESSION['choice2'] = "";
        }

        // tour +1
        public function addTour(){
            $_SESSION['tour']++;
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
            $_SESSION['tour'] = 1;
        }

        // récupération du nombre de carte
        public function getNbCarte(){
            $NbCarte = $_SESSION['nb_paires']*2;
            return $NbCarte;
        }

        // récupération des cartes voulue
        public function getCarte(){
            $rand_keys = array_rand($this->AllCard, $_SESSION['nb_paires']);
            // Récupération des cartes
            for ($i=0; isset($rand_keys[$i]); $i++) { 
                $deck[] = $this->AllCard[$rand_keys[$i]].".png";
                $deck[] = $this->AllCard[$rand_keys[$i]]."bis.png";
            }

            // Mélange du deck
            shuffle($deck);

            $_SESSION['deck']=$deck;
            $this->Deck = $deck;
        }

        // vérification des cartes choisies
        public function checkChoice(){
            $carte1 = str_replace("bis", "", $this->choice1);
            $carte2 = str_replace("bis", "", $this->choice2);
            if($carte1 == $carte2){

                $_SESSION['find'][] = $this->choice1;
                $this->find[] = $this->choice1;
                $_SESSION['find'][] = $this->choice2;
                $this->find[] = $this->choice2;
                $_SESSION['choice1'] = '';
                $_SESSION['choice2'] = '';
            }
            else{
                $_SESSION['choice1'] = '';
                $_SESSION['choice2'] = '';
            }
            if($this->checkEnd() == false){
                $this->addTour();
                header('Refresh: 1; URL=jeu.php');
            }
        }

        // vérification de la fin de partie
        public function checkEnd(){
            if(count($this->find) == $this->getNbCarte()){
                return true;
            }
            else{
                return false;
            }
        }
    }