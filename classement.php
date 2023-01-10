<!-- header des pages -->
<?php
    session_start();
    require 'include/header.php';
?>

<!-- contenu de la page -->
<main>
    <div class="container">
        <div class="profil">
            <h1>Hall of fame</h1>
            <p>Voici les meilleurs joueurs</p>
            <div class="centrage">
                <form action="" method="get">
                    <label for="nb_paires">Nombre de paires</label>
                    <select name="nb_paires" id="">
                        <option value=3 selected>3</option>
                        <option value=4 >4</option>
                        <option value=5 >5</option>
                        <option value=6 >6</option>
                        <option value=7 >7</option>
                        <option value=8 >8</option>
                        <option value=9 >9</option>
                        <option value=10>10</option>
                        <option value=11 >11</option>
                        <option value=12 >12</option>
                    <input type="submit" name="ano" value="Scores">
                </form>
                <?php
                    if(empty($_GET)){
                        $_GET['nb_paires']=3;
                    }
                    $player->getBestScores();
                ?>
            </div>
        </div>
    </div>
</main>

<!-- footer des pages -->
<?php
    require 'include/footer.php';
?>
