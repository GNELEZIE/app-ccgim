<?php

if(isset($_SESSION['_ccgim_201']) and isset($_POST['lgt']) and isset($_POST['noms']) and isset($_POST['prenom']) and isset($_POST['phone']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){
    extract($_POST);

    $slug = create_slug($_POST['noms']);
    $lgt = htmlentities(trim(addslashes(strip_tags($lgt))));
    $noms = htmlentities(trim(addslashes(strip_tags($noms))));
    $prenom = htmlentities(trim(addslashes(strip_tags($prenom))));
    $phone = htmlentities(trim(addslashes(strip_tags($phone))));
    $isoPhone = htmlentities(trim(addslashes(strip_tags($isoPhone))));
    $dialPhone = htmlentities(trim(addslashes(strip_tags($dialPhone))));
    $email = htmlentities(trim(addslashes(strip_tags($email))));
    $propriety = 'nom';

    $verifSlug = $utilisateur->verifUtilisateur($propriety,$noms);

    $rsSlug = $verifSlug->fetch();
    $nbSlug =$verifSlug->rowCount();
    $typeCompte = 1;
    $password = '123456789';

    $options = ['cost' => 12];
    $mdpCript = password_hash($password, PASSWORD_BCRYPT, $options);

    if($nbSlug > 0 ){
        $slug = $slug.'-'.$nbSlug;
    }

    $user = $utilisateur->getUtilisateurByEmail($email);

    if($user > 0){
        echo '1';
    }else{

        $save = $utilisateur->addLocataire($dateGmt,$email,$slug,$lgt,$noms,$prenom,$isoPhone,$dialPhone,$phone,$mdpCript,$typeCompte);
        echo 'ok';
        exit;
        if($save > 0){
            echo 'ok';
        }
    }

}
