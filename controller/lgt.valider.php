<?php
if(isset($_POST['id']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']) {

    extract($_POST);
    $id = htmlentities(trim(addslashes(strip_tags($id))));
    $propriete =  'pub';
    $eta = 1;
    $upd = $logement->updateData($propriete,$eta,$id);
    if($upd > 0){
        echo 'ok';
    }

}