<?php

function connexionBdd(){
    $db = new PDO('mysql:host=localhost;port=3306;dbname=maplaylist;charset=utf8','root','',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    return $db;
}

function check_mdp_format($password)
{
	$majuscule = preg_match('@[A-Z]@', $password);
	$minuscule = preg_match('@[a-z]@', $password);
	$chiffre = preg_match('@[0-9]@', $password);
	//$speciaux = preg_match('@!"[#$%&*+-.:;<=>?]@', $password);
	if(!$majuscule || !$minuscule || !$chiffre)
	{
		return false;
	}
	else 
		return true;
}


/* fonctions de connexion  /////////////////////////////////
/*function getUserToken($idToken){
    $db = connexionBdd();
    $sql = "SELECT c.TokenUtilisateur, c.IdUtilisateur, c.ExpirationDate, r.NomRole FROM connexionutilisateur c
    JOIN utilisateur u ON c.IdUtilisateur = u.IdUtilisateur
    JOIN roleutilisateur r ON r.IdRole = u.IdRole 
    WHERE c.IdConnexion=:idToken";
    
    $retour = $db->prepare($sql);
    
    $values = [
    ':idToken' => $idToken
    ];

    $retour->execute($values);

    $infosConnexion = $retour->fetchAll(PDO::FETCH_ASSOC);
    return $infosConnexion;
}


function addUserToken($idUser){
    $db = connexionBdd();
    $token = bin2hex(random_bytes(64));
    $listeToken = verificationToken();
    $listeTokenByUser = verificationTokenByUser($idUser);
    $expirationToken = date('Y-m-d H:i:s', strtotime('+2 hours'));

    while(in_array($token, $listeToken)){
            echo("Token déjà existant");
            $token = bin2hex(random_bytes(64));   
    }
    if(empty($listeTokenByUser)){
        $sql = "INSERT INTO connexionutilisateur (TokenUtilisateur, ExpirationDate, IdUtilisateur)
        VALUES (:userToken, :expirationToken, :idUser)";

        $retour = $db->prepare($sql);

        $values = [
        ':userToken' => $token,
        ':expirationToken' => $expirationToken,
        ':idUser' => $idUser
        ];

        $retour->execute($values);    

        $lastId = $db->lastInsertId();

        return $lastId;
        
    }else{
        $modif = updateToken($idUser, $token, $expirationToken);
        return $modif;
    }     
}



*/





