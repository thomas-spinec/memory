    <!-- header des pages -->
    <?php
        session_start();
        require 'include/header.php';
    ?>

    <!-- contenu de la page -->
    <main>
        <div class="container">
            <div class="background_form">
                <h1>Inscription</h1>
                <?php
                    if(!empty($_POST)){
                        $player = new User();
                        ?>
                        <p><?= $player->register($_POST['login'], $_POST['password'], $_POST['password2'], $_POST['prenom'], $_POST['nom']); ?></p>
                        <?php
                    }

                ?>
                <div class="form">
                    <form action="" method="post">
                        <label for="login">login</label>
                        <input type="text" name="login" id="login" placeholder="login" required>
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" id="prenom" placeholder="Prénom" required>
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" placeholder="Nom" required>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                        <label for="password2">Confirmation du mot de passe</label>
                        <input type="password" name="password2" id="password2" placeholder="Confirmation du mot de passe" required>
                        <input type="submit" name="submit" value="S'inscrire">
                    </form>
                </div>
            </div>
        </div>

    </main>



    <!-- footer des pages -->
    <?php
        require 'include/footer.php';
    ?>

</body>
</html>