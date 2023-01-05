    <!-- header des pages -->
    <?php
        session_start();
        require 'include/header.php';
    ?>

    <!-- contenu de la page -->
    <main>
        <div class="container">
            <div class="background_form">
                <h1>Bienvenue dans le jeu du Memory</h1>
                <p>Vous devez trouver toutes les paires de cartes pour gagner.</p>
                <p>Choisissez le nombre de paires que vous voulez pour cette partie</p>
                <form action="" method="post">
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
                    </select>
                    <input type="submit" value="Jouer">
                </form>

                <?php
                    // envoie vers la page de jeu si le formulaire est rempli
                    if(!empty($_POST)){
                        $_SESSION['nb_paires'] = $_POST['nb_paires'];
                        header('Location: jeu.php');
                    }
                ?>


    </main>

    <!-- footer des pages -->
    <?php
        require 'include/footer.php';
    ?>
</body>
</html>