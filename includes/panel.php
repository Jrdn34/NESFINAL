<?php
require_once './classes/Ccard.php';

$lesCards = new Ccards();
$oCard = $lesCards->GetAllCard();

if (!empty($oCard)) {
    $oCard = array_reverse($oCard);
}
?>

<h1 class="Actualite">Les derniers articles !</h1>

<div class="container">
    <div class="row">
        <?php
        if (!empty($oCard)) {
            $i = 0; 
            foreach ($oCard as $uneCard) {
                if ($i >= 3) break;
                // Récupérer la première photo de l'article
                $photos = $uneCard->getPhotos($uneCard->id);
                $photo = !empty($photos) ? $photos[0] : 'default.jpg'; // Utiliser une image par défaut si aucune photo n'est disponible
                echo
                '<div class="col-md-4"> 
                    <div class="card">
                        <img src="' . htmlspecialchars($photo) . '" alt="' . htmlspecialchars($uneCard->titre) . '" class="product-image card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column"> 
                            <h5 class="card-title">' . htmlspecialchars($uneCard->titre) . '</h5>
                            
                            <!-- Texte long caché par défaut -->
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <a href="Cards.php?id=' . htmlspecialchars($uneCard->id) . '" class="btn btn-success">Voir plus</a>
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
    <div class="voir_plus">
        <div class="mt-auto d-flex justify-content-between align-items-center">
            <a href="Articles.php" class="btn btn-primary">Voir tous les articles</a>
        </div>
    </div>
</div>