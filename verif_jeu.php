<?php
    session_start();
    require 'class/Card.php';
    require 'class/Board.php';
    $plateau = new Board();
    for ($i=0; $i < $plateau->getNbCarte(); $i++){
        ${'carte'.$i} = new Card($i);
    }

    // appel de la méthode choice lorsque qu'une carte est choisie
    for ($i=0; $i < $plateau->getNbCarte(); $i++){
        if(${'carte'.$i}->name == reset($_POST)){
            ${'carte'.$i}->choice();
            break;
        }
    }


    // appel de la méthode choice lorsque qu'une carte est choisie
    // for ($i=0; isset($_SESSION['deck'][$i]); $i++){
    //     if(isset($_POST[$i])){
    //         $plateau->choice($_SESSION['deck'][$i]);
    //         break;
    //     }
    // }

    header('Location: jeu.php');
?>