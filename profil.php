    <!-- header des pages -->
    <?php
        session_start();
        require 'include/header.php';
        // verif s'il y a une connexion
        if(!$player->isConnected()){
            header('Location: index.php');
        }
    ?>

    <!-- contenu de la page -->
    <main>
        <div class="container">
            <div class="profil">
                <h1>Profil</h1>
                <p>Voici vos informations:</p>
                <?php
                    $player->getAllInfos();
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