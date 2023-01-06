<?php
    session_start();
    require 'class/Card.php';
    $plateau = new Card();

    // appel de la méthode choice lorsque qu'une carte est choisie
    for ($i=0; isset($_SESSION['deck'][$i]); $i++){
        if(isset($_POST[$i])){
            $plateau->choice($_SESSION['deck'][$i]);
        }
    }

    header('Location: jeu.php');
?>