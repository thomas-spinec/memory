    <!-- header des pages -->
    <?php
        session_start();
        require 'include/header.php';
        // verif s'il y a une connexion
        if($player->isConnected()){
            header('Location: index.php');
        }
    ?>

    <!-- contenu de la page -->
    <main>
        <div class="container">
            <div class="background_form">
                <h1>Connexion</h1>
                <form action="" method="post">
                    <label for="login">login</label>
                    <input type="text" name="login" id="login" placeholder="login" required>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                    <input type="submit" value="Se connecter">
                </form>

                <?php
                    // appel de la class si le formulaire est remplie
                    if(!empty($_POST)){
                        $player = new User();
                        ?>
                        <p><?= $player->connect($_POST['login'], $_POST['password']); ?></p>
                        <?php
                        header('Location: index.php');
                    }
                ?>
            </div>
        </div>
    </main>

    <!-- footer des pages -->
    <?php
        require 'include/footer.php';
    ?>
</body>
</html>