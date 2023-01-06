<?php
// Création de la classe

class User {
    /* Propriétés */
    private $id;
    private $login;
    private $password;
    private $firstname;
    private $lastname;
    private $bdd;

    /* Constructeur */
    public function __construct() 
    {
        // connection à la BDD avec PDO
        // en local ////////////////////
        $servername = 'localhost';
        $dbname = 'memory';
        $db_username = 'root';
        $db_password = '';

        // en ligne ///////////////////
        // $servername = 'localhost';
        // $dbname = 'thomas-spinec_memory';
        // $db_username = 'adminbdd';
        // $db_password = 'basededonnees';


        // essaie de connexion
        try {
            $this->bdd = new PDO("mysql:host=$servername;dbname=$dbname; charset=utf8", $db_username, $db_password);

            // On définit le mode d'erreur de PDO sur Exception
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connexion réussie"; 
        } 
        // si erreur, on capture les exceptions, s'il y en a une on affiche les infos
        catch(PDOException $e)
        {
            echo "Echec de la connexion : " . $e->getMessage();
            exit;
        }


        // Vérification de la connexion (profil)
        if (isset($_SESSION['user'])){
            $this->id = $_SESSION['user']['id'];
            $this->login = $_SESSION['user']['login'];
            $this->password = $_SESSION['user']['password'];
            $this->firstname = $_SESSION['user']['firstname'];
            $this->lastname = $_SESSION['user']['lastname'];
        }
    }

    /* Méthodes */
        // Enregistrement
    public function register($login, $password, $password2, $firstname, $lastname)
    {
        if($login !== "" && $password !== "" && $password2 !== "" && $firstname !=="" && $lastname !=="" ){
            if($this->isUserExist($login)){ // si true --> utilisateur disponible

                // vérification des mots de passe
                if($password === $password2){
                    // hachage du mot de passe
                    $password = password_hash($password, PASSWORD_DEFAULT);
    
                    // requête pour ajouter l'utilisateur dans la base de données
                    $requete2 = "INSERT INTO utilisateurs (login, password, firstname, lastname) VALUES (:login, :password, :firstname, :lastname)";
    
                    // préparation de la requête
                    $insert = $this->bdd -> prepare($requete2);
    
                    // exécution de la requête avec liaison des paramètres
                    $insert-> execute(array(
                        ':login' => $login,
                        ':password' => $password,
                        ':firstname' => $firstname,
                        ':lastname' => $lastname));
    
                    echo "Inscription réussie"; // inscription réussie

                    // redirection vers la page de connexion
                    header('Refresh: 3; URL="connexion.php"');
                }
                else{
                    $error = "Les mots de passe ne correspondent pas";
                    return $error; // mots de passe différents
                }
            }
            else{
                $error = "Utilisateur déjà existant";
                return $error; // utilisateur déjà existant
            }
        }
        else{
            $error = "Tous les champs ne sont pas renseignés, il faut le login, le mot de passe, le prénom et le nom";
            return $error; // utilisateur ou mot de passe vide
        }
        // fermer la connexion
        $this->bdd = null;
    }

        // Connexion
    public function connect($login, $password)
    {
        if(!$this->isConnected()){
            if($login !== "" && $password !== ""){
                // requête
                $requete = "SELECT * FROM utilisateurs where login = :login";

                // préparation de la requête
                $select = $this->bdd->prepare($requete);

                // exécution de la requête avec liaison des paramètres
                $select-> execute(array(':login' => $login));

                // récupération du tableau
                $fetch_all = $select->fetchAll();

                if(count($fetch_all) > 0){ // utilisateur existant
                    
                    // récupération du mot de passe avec ASSOC
                    $select-> execute(array(':login' => $login));
                    $fetch_assoc = $select->fetch(PDO::FETCH_ASSOC);
                    $password_hash = $fetch_assoc['password'];

                    if(password_verify($password, $password_hash)){
                        $error = "Connexion réussie";
                        // récupération des données pour les attribuer aux attributs
                        $this->id = $fetch_assoc['id'];
                        $this->login = $fetch_assoc['login'];
                        $this->password = $fetch_assoc['password']; 
                        $this->firstname = $fetch_assoc['firstname'];
                        $this->lastname = $fetch_assoc['lastname'];

                        $_SESSION['user']= [
                            'id' => $fetch_assoc['id'],
                            'login' => $fetch_assoc['login'],
                            'password' => $fetch_assoc['password'],
                            'firstname' => $fetch_assoc['firstname'],
                            'lastname' => $fetch_assoc['lastname']
                        ];
                        // connexion réussie
                        header('Location: index.php');
                    }
                    else{
                        $error = "Mot de passe incorrect";
                        return $error; // mot de passe incorrect
                    }
                }
                else{
                    $error = "Utilisateur inexistant";
                    return $error; // utilisateur inexistant
                }
            }
            else{
                $error = "Tous les champs ne sont pas renseignés, il faut le login et le mot de passe";
                return $error; // utilisateur ou mot de passe vide
            }
        }
        else{
            $error = "Un utilisateur est déjà connecté";
            return $error; // vous êtes déjà connecté
        }
        // fermer la connexion
        $this->bdd = null;
    }

        // Déconnexion
    public function disconnect()
    {
        // verifier la connexion
        if($this->isConnected()){
            // rendre les attributs null
            $this->id = null;
            $this->login = null;
            $this->password = null;
            $this->email = null;
            $this->firstname = null;
            $this->lastname = null;

            // détruire la session
            session_unset();
            session_destroy();
        }
        else{
            $error = "Vous n'êtes pas connecté";
            return $error; // vous n'êtes pas connecté
        }
    }

        // Suppression
    public function delete()
    {
        //vérification que la personne est connecté
        if($this->isConnected()){
            // requête pour supprimer l'utilisateur dans la base de données
            $requete = "DELETE FROM utilisateurs WHERE id = :id";
            // préparation de la requête
            $delete = $this->bdd->prepare($requete);
            // exécution de la requête avec liaison des paramètres
            $delete-> execute(array(':id' => $this->id));

            $this->disconnect();
            $error = "Suppression et deconnexion réussies";
            return $error; // suppression réussie
        }
        else{
            $error = "Vous n'êtes pas connecté, vous devez être connecté pour supprimer le compte";
            return $error; // utilisateur non connecté
        }
        // fermer la connexion
        $this->bdd = null;
    }

        // Modification
    public function update($login, $password, $firstname, $lastname)
    {
        //vérification que la personne est connecté
        if($this->isConnected()){
            //vérification que les champs ne sont pas vides
            if($login !== "" && $password !== "" && $firstname !=="" && $lastname !=="" ){

                $password = password_hash($password, PASSWORD_DEFAULT);

                // requête pour vérifier que le login choisi n'est pas déjà utilisé
                $requete = "SELECT * FROM utilisateurs where login = :login";

                // préparation de la requête
                $select = $this->bdd->prepare($requete);

                // exécution de la requête avec liaison des paramètres
                $select-> execute(array(':login' => $login));

                // récupération du tableau
                $fetch_all = $select->fetchAll();

                if(count($fetch_all) === 0){ // login disponible
                    // récupération des données pour les attribuer aux attributs
                    $_SESSION['user']= [
                        'id' => $this->id,
                        'login' => $login,
                        'password' => $password,
                        'firstname' => $firstname,
                        'lastname' => $lastname
                    ];

                    // requête pour modifier l'utilisateur dans la base de données
                    $requete2 = "UPDATE utilisateurs SET login = :login, password = :password, firstname = :firstname, lastname = :lastname WHERE id = :id";
                    // préparation de la requête
                    $update = $this->bdd->prepare($requete2);
                    // exécution de la requête avec liaison des paramètres
                    $update-> execute(array(
                        ':id' => $this->id,
                        ':login' => $login, 
                        ':password' => $password,
                        ':firstname' => $firstname, 
                        ':lastname' => $lastname));

                    $error = "Modification réussie";
                    return $error; // modification réussie
                }
                else{
                    $error = "Le login choisi n'est pas disponible";
                    return $error; // login indisponible
                }
            }
            else{
                $error = "Tous les champs ne sont pas renseignés, il faut le login, le mot de passe, le prénom et le nom";
                return $error; // utilisateur ou mot de passe vide
            }
        }
        else{
            $error = "Vous n'êtes pas connecté, vous devez être connecté pour modifier le compte";
            return $error; // utilisateur non connecté
        }
    }

        // Vérification de la connexion
    public function isConnected()
    {
        if($this->id !== null && $this->login !== null && $this->password !== null && $this->firstname !== null && $this->lastname !== null){
            return true; // utilisateur connecté
        }
        else{
            return false; // utilisateur non connecté
        }
    }

        // Récupération des données
    public function getAllInfos()
    {
        //vérification que la personne est connecté
        if($this->isConnected()){
            //affichage
            ?>
            <table>
                <thead>
                    <tr>
                        <th>login</th>
                        <th>firstname</th>
                        <th>lastname</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $this->login; ?></td>
                        <td><?= $this->firstname; ?></td>
                        <td><?= $this->lastname; ?></td>
                    </tr>
            </table>
            <?php
        }
        else{
            echo "Vous n'êtes pas connecté, vous devez être connecté pour voir les informations du compte";
        }
    }

        // Récupération du login
    public function getLogin()
    {
        //vérification que la personne est connecté
        if($this->isConnected()){
            return $this->login;
        }
        else{
            echo "Vous n'êtes pas connecté, vous devez être connecté pour voir le login du compte";
        }
    }

        // Récupération du prénom
    public function getFirstname()
    {
        //vérification que la personne est connecté
        if($this->isConnected()){
            ?>
            <p><strong>Votre prénom est: </strong><?= $this->firstname; ?></p>
            <?php
        }
        else{
            echo "Vous n'êtes pas connecté, vous devez être connecté pour voir le prénom du compte";
        }
    }

        // Récupération du nom
    public function getLastname()
    {
        //vérification que la personne est connecté
        if($this->isConnected()){
            ?>
            <p><strong>Votre nom est: </strong><?= $this->lastname; ?></p>
            <?php
        }
        else{
            echo "Vous n'êtes pas connecté, vous devez être connecté pour voir le nom du compte";
        }
    }

        // Utilisateur déjà existant?
    public function isUserExist($login)
    {
        // requête pour vérifier que le login choisi n'est pas déjà utilisé
        $requete = "SELECT * FROM utilisateurs where login = :login";

        // préparation de la requête
        $select = $this->bdd->prepare($requete);

        // exécution de la requête avec liaison des paramètres
        $select-> execute(array(':login' => $login));

        // récupération du tableau
        $fetch_all = $select->fetchAll();

        if(count($fetch_all) === 0){ // login disponible
            return false; // login disponible
        }
        else{
            return true; // login indisponible
        }
    }

        // Création utilisateur anonyme
    public function createAnonyme(){
        // requête pour créer un utilisateur anonyme
        $requete = "INSERT INTO utilisateurs (login, password, firstname, lastname) VALUES (:login, :password, :firstname, :lastname)";

        // préparation de la requête
        $insert = $this->bdd->prepare($requete);

        // hachage du mot de passe
        $password_A = password_hash('anonyme', PASSWORD_DEFAULT);

        // exécution de la requête avec liaison des paramètres
        $insert-> execute(array(
            ':login' => 'anonyme', 
            ':password' => $password_A,
            ':firstname' => 'anonyme', 
            ':lastname' => 'anonyme'));

        // appel de la fonction de connexion anonyme
        $this->connectAnonyme();
    }

        // connexion anonyme
    public function connectAnonyme(){
        $login_A = 'anonyme';
        $password_A = 'anonyme';

        // connexion
        $this->connect($login_A, $password_A);
    }

}

?>