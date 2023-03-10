<?php

if(isset($_SESSION['_ccgim_202']) and isset($_POST['userId']) and isset($_POST['libelle']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']){
    extract($_POST);

    $libelle = htmlentities(trim(addslashes(strip_tags($libelle))));
    $userId = htmlentities(trim(addslashes(strip_tags($userId))));
    $lgt_id = htmlentities(trim(addslashes(strip_tags($lgt_id))));

    $type_transac  = 1;
    $lgt = $logement->getLogementById($lgt_id);
    if($lgtDat = $lgt->fetch()){
        $debit = $lgtDat['tarif'];
        $credit = 0;
        $save = $tresorerie->addOperation($dateGmt,$userId,$lgt_id,$type_transac,$libelle,$debit,$credit,$_SESSION['_ccgim_202']['id_utilisateur']);
        if($save > 0){
            echo 'ok';
        }

    }

}