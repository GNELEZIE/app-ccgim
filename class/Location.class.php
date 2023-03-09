<?php
class Location
{

    public function __construct()
    {
        $this->bdd = bdd();
    }

    //Create

    public function addLocataire($userDate,$nom,$prenom,$slug,$bail,$isoPhone,$dialPhone,$phone,$lgtId){
        $query = "INSERT INTO locataire(date_locataire,nom,prenom,slug,bail,iso_phone,dial_phone,phone,lgt_id)
            VALUES (:userDate,:nom,:prenom,:slug,:bail,:isoPhone,:dialPhone,:phone,:lgtId)";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "userDate" => $userDate,
            "nom" => $nom,
            "prenom" => $prenom,
            "slug" => $slug,
            "bail" => $bail,
            "isoPhone" => $isoPhone,
            "dialPhone" => $dialPhone,
            "phone" => $phone,
            "lgtId" => $lgtId
        ));
        $nb = $rs->rowCount();
        if($nb > 0){
            $r = $this->bdd->lastInsertId();
            return $r;
        }
    }

//Read


    public function getLocationByAuthId($userId){
        $query = "SELECT * FROM location
                  INNER JOIN logement ON id_logement = lgt_id
                  WHERE utilisateur_id =:userId ORDER BY id_location DESC";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "userId" => $userId
        ));

        return $rs;
    }










    public function getAllLocataire(){
        $query = "SELECT * FROM locataire
          WHERE statut = 0 ORDER BY id_locataire DESC ";
        $rs = $this->bdd->query($query);
        return $rs;
    }
    public function getLocationByLgts($userId){
        $query = "SELECT * FROM location
        INNER JOIN logement ON id_logement = lgt_id
          WHERE user_id =:userId";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "userId" => $userId
        ));
        return $rs;
    }
    public function getLocationById($userId){
        $query = "SELECT * FROM location
          WHERE user_id =:userId";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "userId" => $userId
        ));
        return $rs;
    }

//Count
    public function getNbLocataire(){
        $query = "SELECT COUNT(*) as nb FROM locataire
          WHERE statut != 1";
        $rs = $this->bdd->query($query);
        return $rs;
    }
    // Verification valeur existant
    public function verifLocataire($propriete,$val){
        $query = "SELECT * FROM locataire WHERE $propriete = :val";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val" => $val
        ));
        return $rs;
    }









}

// Instance
$location = new Location();