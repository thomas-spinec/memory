<?php

    class Card{
            /* Propriétés */
        private $id;
        public $name;
        private $Card;
        private $choice1;
        private $choice2;
        private $find;

        /* Constructeur */
        public function __construct($id) 
        {
            $this->id = $id;
            $this->Card = $_SESSION['deck'][$this->id];
            $this->name = "carte".$this->id;
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
        }

        /* Méthodes */

        // affichage de l'avant de la carte
        public function displayFront(){
            $TrueImg=str_replace("bis", "", $this->Card)
            ?>
                <img src="<?= $TrueImg ?>" alt="carte">
            <?php
        }

        // affichage de l'arrière de la carte
        public function displayBack(){
            ?>
                <button type="submit" name="<?= $this->id?>" value="<?= $this->name ?>"><img src="./img/back.png" alt="dos de carte"></button>
            <?php
        }

        // affichage cartes
        public function displayCard(){
            ?>
            <div class="carte">
                <?php
                    if($this->isFind()){
                        $this->displayFront();
                    }
                    else{
                        $this->displayBack();
                    }
                ?>
            </div>
            <?php
        }

        // Vérification qi la carte est retournée
        public function isFind(){
            if($this->Card == $this->choice1 || $this->Card == $this->choice2 || in_array($this->Card, $this->find)){
                return true;
            }
            else{
                return false;
            }
        }

        // stockage des cartes choisies
        public function choice(){
            if($this->choice1 == ''){
                $_SESSION['choice1'] = $this->Card;
                $this->choice1 = $this->Card;
            }
            else{
                $_SESSION['choice2'] = $this->Card;
                $this->choice2 = $this->Card;
            }
        }
    }
?>