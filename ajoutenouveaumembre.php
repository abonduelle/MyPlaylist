<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>
        <link rel="stylesheet" href="Style.css">
    </head>

    <body>
        <?php
        require('config.php');
        require('fonctions.php');

        // Traitement de l'enregistrement
        if (isset($_REQUEST['username'], $_REQUEST['password'], $_REQUEST['name'], $_REQUEST['firstname'])){
            // récupérer l'identifiant
            $username = stripslashes($_REQUEST['username']);
            // récupérer le mot de passe 
            $password = stripslashes($_REQUEST['password']);
                if(check_mdp_format($password)){
                    //echo 'Votre mot de passe est suffisamment fort';
                    $passwordcrypte = password_hash($password, PASSWORD_BCRYPT);
                    // récupérer le nom
                    $name = stripslashes($_REQUEST['name']);
                    // récupérer le prénom
                    $firstname = stripslashes($_REQUEST['firstname']);
                    $isAdmin = 'user';
                    $nom_table = 'users';
                   
                    // Requête SQL préparée
                    $query = "INSERT into $nom_table (username, password, name, firstname, isAdmin)
                    VALUES (:username, :passwordcrypte, :name, :firstname, :isAdmin)";
                    $req = $conn->prepare($query);
                    $req->execute(array(
                    ":username" => $username,
                    ":passwordcrypte" => $passwordcrypte,
                    ":name" => $name,
                    ":firstname" => $firstname,
                    ":isAdmin" => $isAdmin               
                    ));
                
                    if($req){
                        echo "<div class='success'>
                        <h3>Vous êtes inscrit avec succès.</h3>
                        <p><a href='accueil.php'>accéder au site</a></p>
                        </div>";
                    }else{
                        echo "<h3>Vous n'avez pas été enregistré.</h3>";
                    }
                    $req->closeCursor();
                }else{
                echo "<div class='success'>
                <h3>Il manque à votre mot de passe une minuscule, une majuscule ou un chiffre</h3>
                <p>Cliquez ici pour <a href='ajoutenouveaumembre.php'>recommencer votre inscription</a></p>
                </div>";
            }
        }else{
            ?>

        <h1>Inscrivez-vous sur le site</h1>
            <section>
                <form action="ajoutenouveaumembre.php" method="post">
                    <div>
                        <label for="firstname">Prénom</label>
                        <input type="text" name="firstname" id="firstname" required>
                    </div>
                    <div>
                        <label for="name">Nom</label>
                        <input type="text" name="name" id="name" required>
                    </div>
                    <div>
                        <label for="username">Identifiant</label>
                        <input type="text" name="username" id="username" required>
                    </div>
                    <div>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" minlength="17" 
                        title="au minimum: 17 caractères, une majuscule, une minuscule, un chiffre" required>
                        <input type="submit" name="submit" value="Valider" class="box-button" required>
                    </div>
                   <?php
                    ?>
                </form>
            </section>
            <footer>
                    <div id="lien">
                    <h3><a href="accueil.php">Retour page d'accueil</a></h3>
                    </div>
            </footer>
            <?php } ?>
    </body>
</html>