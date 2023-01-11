<?php
    session_start();
    require 'class/Card.php';
    require 'class/Board.php';
    $id = (int)$_POST['id'];
    ${'carte'.$id} = new Card($id);
    
    // appel de la méthode choice lorsque qu'une carte est choisie
    ${'carte'.$id}->choice();

    header('Location: jeu.php');
?>