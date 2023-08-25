<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nouvelle musique</title>
        <link rel="stylesheet" href="Style.css">
    </head>

    <body>
        <?php
        require('config.php');
        require('fonctions.php');
        if(!isset($_SESSION['userID'])){
            header("Location:index.php");
            exit();
        }
        require('header.html');

        // Traitement de l'enregistrement
        if (isset($_REQUEST['title'], $_REQUEST['singer'])){
            // récupérer le titre
            $title = stripslashes($_REQUEST['title']);
            // récupérer l'interprète 
            $singer = stripslashes($_REQUEST['singer']);
            // récupérer l'id de l'utilisateur
            $userID = $_SESSION['userID'];
            $nom_table = 'musics';
            // Requête SQL préparée
            $querymusic = "INSERT into $nom_table (title, singer, userID)
            VALUES (:title, :singer, :userID)"; //userID et :userID
            $reqmusic = $conn->prepare($querymusic);
            $reqmusic->execute(array(
            ":title" => $title,
            ":singer" => $singer,
            ":userID" => $userID
            ));
            if($reqmusic){
                echo "<div class='success'>
                <h3>Votre musique a été ajoutée à la playlist.</h3>
                <p><a href='playlist.php'>Retourner à la liste</a></p>
                <p><a href='ajoutenouveautitre.php'>Rajouter une autre musique</a></p>
                </div>";
            }else{
                echo "<div class='success'>
                <h3>La musique n'a pas été enregistrée.</h3>
                <p><a href='ajoutenouveautitre.php'>Recommencer</a></p>
                </div>";
            }
            $reqmusic->closeCursor();

        }else{
        ?>
                <h1>Votre proposition musicale</h1>
                <section>
                    <form action="ajoutenouveautitre.php" method="post">
                        <div>
                            <input type="text" name="title" id="title" value="Titre" required>
                        </div>
                        <div>
                            <input type="text" name="singer" id="singer" value="Interprète" required>
                        </div>
                        <div>
                            <input type="submit" name="submit" value="Valider" class="box-button" required>
                        </div>
                    </form>
                </section>
                
        <?php } ?>
    </body>
</html>