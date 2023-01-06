<?php

    class Card{
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

            $this->choice1 = $_SESSION['choice1'];
            $this->choice2 = $_SESSION['choice2'];
            // Tableau contenant les cartes choisies
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
            $this->choice1= '';
            $this->choice2= '';
        }

        // affichage de l'avant de la carte
        public function displayFront($id){
            $TrueImg=str_replace("bis", "", $id)
            ?>
                <img src="<?= $TrueImg ?>.png" alt="carte">
            <?php
        }

        // affichage de l'arrière de la carte
        public function displayBack($id){
            ?>
                <button type="submit" name="<?= $id ?>"><img src="./img/back.png" alt="dos de carte"></button>
            <?php
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
                $deck[] = $this->AllCard[$rand_keys[$i]];
                $deck[] = $this->AllCard[$rand_keys[$i]]."bis";
            }

            // Mélange du deck
            shuffle($deck);

            $_SESSION['deck']=$deck;
            $this->Deck = $deck;
        }

        // affichage du plateau
        public function displayPlateau($i){
            ?>
                <div class="carte">
                    <?php
                        if($this->Deck[$i] == $this->choice1 || $this->Deck[$i] == $this->choice2 || in_array($this->Deck[$i], $this->find)){
                            $this->displayFront($this->Deck[$i]);
                        }
                        else{
                            $this->displayBack($i);
                        }
                    ?>
                </div>
            <?php
        }

        // stockage des cartes choisies
        public function choice($id){
            if($this->choice1 == ''){
                $_SESSION['choice1']= $id;
                $this->choice1 = $id;
            }
            else{
                $_SESSION['choice2']= $id;
                $this->choice2 = $id;
                $this->checkChoice();
            }
        }

        // vérification des cartes choisies
        public function checkChoice(){
            $this->choice1 = str_replace("bis", "", $this->choice1);
            $this->choice2 = str_replace("bis", "", $this->choice2);
            if($this->choice1 == $this->choice2){
                $this->find[] = $this->choice1;
                $this->choice1 = '';
                $this->choice2 = '';
            }
            else{
                $this->choice1 = '';
                $this->choice2 = '';
            }
        }
    }