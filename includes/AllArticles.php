<?php

$lesCards = new Ccards();
$oCard = $lesCards->GetAllCard();

if (!empty($oCard)) {
    $oCard = array_reverse($oCard);
}
?>

<div class="container">
<h2 class="allActualite">Liste de tous les articles </h2>
    <div class="row">
        <?php
        if (!empty($oCard)) {
            $i = 0; 
            foreach ($oCard as $uneCard) {
                $photos = $uneCard->getPhotos($uneCard->id);
                $photo = !empty($photos) ? $photos[0] : 'default.jpg';
                echo
                '<div class="col-md-4 mb-4 mt-3"> 
                    <div class="card"> 
                        <img src="' . htmlspecialchars($photo) . '" alt="' . htmlspecialchars($uneCard->titre) . '" class="product-image card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column"> 
                            <h5 class="card-title">' . htmlspecialchars($uneCard->titre) . '</h5>
                            
                            
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <a href="Cards.php?id=' . htmlspecialchars($uneCard->id) . '" class="btn btn-success">Voir sa fiche</a>
                            </div>
                        </div>
                    </div>
                </div>';
                $i++;
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Aucun article trouvé !</div>';
        }
        ?>
    </div>
</div>