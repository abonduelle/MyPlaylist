<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page d'accueil</title>
        <link rel="stylesheet" href="style.css">
    </head> 

    <body>
        <?php
        require('config.php');
        session_destroy();
        session_start();
        // Traitement de la requête
       if (isset($_REQUEST['username'], $_REQUEST['password'])){
        // récupérer l'identifiant
        $username = stripslashes($_REQUEST['username']);
        // récupérer le mot de passe 
        $password = stripslashes($_REQUEST['password']);
        $nom_table = 'users';
    // Requête SQL préparée
        $query = "SELECT `password`, `isAdmin`,`id` FROM $nom_table WHERE `username`=:username";
        $req = $conn->prepare($query);
        $req->execute(array(
           ":username" => $username
        ));
        
        $etat = $req->rowCount();
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        $resultat1 = $resultat[0]['password'];
        $resultat2 = $resultat[0]['isAdmin'];
        $resultat3 = $resultat[0]['id'];
            if(password_verify($password, $resultat1) & ($etat==1)){
                //récupérer l'userID et le placer dans la variable superglobale $_SESSION
                $_SESSION['userID'] = $resultat3;
                $_SESSION['isAdmin'] = $resultat2; //
                //rediriger selon que le user est admin ou simple user
                if($resultat2 == 'admin'){
                header('location: admin/home.php');
                
                }else{
                header('location: playlist.php');
                }
            }else{
                echo "<h3>Le nom d'utilisateur ou le mot de passe est incorrect.</h3>";
                header('location: index.php');
            }
        $req->closeCursor();
            
        }
        ?>
            <h1>Bienvenue sur le site de Ma playlist</h1>
            <h2>Connectez-vous</h2>
                <section>
                    <form action="accueil.php" method="post">
                        <div>
                            <label for="username">Identifiant</label>
                            <input type="text" name="username" id="username" required>
                        </div>
                        <div>
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" id="password" required>
                        </div>
                            <input type="submit" name="submit" value="Valider" class="box-button">
                    </form>
                </section>
            <h2>Ou inscrivez-vous</h2>
            <div id="lien">
            <h3><a href="ajoutenouveaumembre.php">s'inscrire</a></h3>
            </div>
    </body>
</html> 