<?php

if(isset($_SESSION['_ccgim_202']) and isset($_POST['libelle']) and isset($_POST['montant']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){
    extract($_POST);

    $libelle = htmlentities(trim(addslashes(strip_tags($libelle))));
    $montant = htmlentities(trim(addslashes(strip_tags($montant))));
    $lgt_id = 6;
    $locataire = 1;
    $type_transac = 2;
    $debit = 0;
    $credit = $montant;

    $solde = $tresorerie->getSoldeTotalByProprietaire($_SESSION['_ccgim_202']['id_utilisateur'])->fetch();

    if($montant <= $solde['solde']){
        $save = $tresorerie->RetraitOperation($dateGmt,$locataire,$lgt_id,$type_transac,$libelle,$debit,$credit,$_SESSION['_ccgim_202']['id_utilisateur']);
        if($save > 0){
            echo 'ok';
        }
    }else{
        echo 'solde';
    }

}