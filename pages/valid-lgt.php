<?php
if(isset($doc[1]) and !isset($doc[2])){
    $lgt = $logement->getLgtsSlug($doc[1]);
    if($DataLg = $lgt->fetch()){
        $gals = $galerie->getGalerieByLgtId($DataLg['id_logement']);
        $gals2 = $galerie->getGalerieByLgtId($DataLg['id_logement']);
    }else{
        header('location:'.$domaine.'/error');
        exit();
    }
}else{
    header('location:'.$domaine.'/error');
    exit();
}
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['myformkey'] = $token;
include_once $layout.'/header.php'?>
<div class="container-fuild bg-lgts">
    <div class="container">
        <h2 class="title-search" data-in="slideDown" data-out="slideUp" data-duration="500" data-delay="200">
            <?=html_entity_decode(stripslashes($DataLg['nom_lgt']))?>
        </h2>
        <p class="text-center text-white font-17 m-0"><i class="fa fa-map-marker"></i><?=html_entity_decode(stripslashes($DataLg['ville_lgt'])) .', '.html_entity_decode(stripslashes($DataLg['quartier_lgt']))?></p>
    </div>
</div>
<div class="apartment-single-area">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="corousel-gallery-content">
                    <div class="gallery">
                        <div class="full-view owl-carousel">
                            <?php
                            while($galDatas = $gals->fetch()){
                                ?>
                                <a class="item image-pop-up" href="<?=$cdn_domaine?>/media/lgts/<?=$galDatas['photo']?>">
                                    <img src="<?=$cdn_domaine?>/media/lgts/<?=$galDatas['photo']?>" alt="corousel">
                                </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="family-apartment-content mobile-extend">
                    <p class=" rent">Montant/mois: <?=number_format($DataLg['tarif'],0,',',' ') ?> CFA</p>
                    <p class=" rent">Description</p>
                    <p class="apartment-description default-gradient-before">
                        <?=html_entity_decode(stripslashes($DataLg['description']))?>
                    </p>
                    <p class=" rent">Informations supplémentaires</p>
                    <p class="apartment-description default-gradient-before">
                        <?=html_entity_decode(stripslashes($DataLg['infos_sup']))?>
                    </p>
                    <div class="price-details">
                        <h3>Autre details</h3>
                        <ul>
                            <li>Chamebre:  <span><?=$DataLg['chambres']?></span></li>
                            <li>Superficie : <span><?=$DataLg['superficie']?> m <sup>2</sup></span></li>
                            <li>Salles De Bain : <span><?=$DataLg['bain']?></span></li>
                            <li>Nombre de lits  :<span> <?=$DataLg['lit']?></span></li>
                        </ul>
                    </div>
                </div>
                <div class="hidden-md hidden-lg text-center extend-btn">
                        <span class="extend-icon">
                            <i class="fa fa-angle-down"></i>
                        </span>
                </div>
            </div>

            <div class="col-md-3 text-center">
                <a href="javascript:void(0);" class=" btn-valider button-radius" onclick="validLgt(<?=$DataLg['id_logement']?>)" >Valider le logement</a>
            </div>
        </div>
    </div>
</div>
<?php include_once $layout.'/footer.php'?>
<script>


    function validLgt(id = null){
        if(id){
            swal({
                title: 'Souhaitez-vous mettre cette commande en livrée ?',
                text: "L'action mettra l'élément sélectionné en livrée.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#2ab57d",
                confirmButtonText: 'Oui',
                cancelButtonText: "Non",
                reverseButtons: true
            }).then(function(result){
                if (result.value){
                    $.post('<?=$domaine?>/controle/commande.livree', {id : id, token : '<?=$token?>'}, function (data) {
                        if(data == "ok"){
                            swal("Opération effectuée!","", "success");
                        }else{
                            swal("Impossible de supprimer!", "Une erreur s'est produite lors du traitement des données.", "error");
                        }
                    });
                }
            });
        }else{
            alert('actualise');
        }
    }









    $(document).ready(function() {

        var owl = $('.owl-carousel');
        owl.owlCarousel({
            loop: true,
            nav:true,
            autoplay: true,
            autoplayTimeout: 4000,
            smartSpeed:3000,
            autoplayHoverPause: true,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }

        });

        $("#phone").keyup(function (event) {
            if (/\D/g.test(this.value)) {
                //Filter non-digits from input value.
                this.value = this.value.replace(/\D/g, '');
            }
        });

        var inputPhone = document.querySelector("#phone");
        window.intlTelInput(inputPhone, {
            initialCountry: 'ci',
            utilsScript: "<?=$cdn_domaine?>/assets/libs/intltelinput/js/utils.js"
        });
        var iti = window.intlTelInputGlobals.getInstance(inputPhone);
        var countryData = iti.getSelectedCountryData();
        $('#isoPhone').val(countryData["iso2"]);
        $('#dialPhone').val(countryData["dialCode"]);
        inputPhone.addEventListener("countrychange", function() {
            var iti = window.intlTelInputGlobals.getInstance(inputPhone);
            var countryData = iti.getSelectedCountryData();
            $('#isoPhone').val(countryData["iso2"]);
            $('#dialPhone').val(countryData["dialCode"]);
        });

    })
</script>
