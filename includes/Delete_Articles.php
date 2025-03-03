<?php
require_once './classes/Ccard.php';
$lesCards = new Ccards();
$oCard = $lesCards->GetAllCard();

?>

<div class="container">
    <h2 class="allActualite">Selectionnez un article à supprimer </h2>
    <div class="row">
        <?php
        if (!empty($oCard)) {
            foreach ($oCard as $uneCard) {
                $photos = $uneCard->getPhotos($uneCard->id);
                $photo = !empty($photos) ? $photos[0] : 'default.jpg';
                echo
                '<div class="col-md-4 mb-4 mt-3"> 
                    <div class="card" data-id="' . htmlspecialchars($uneCard->id) . '" data-photo="' . htmlspecialchars($photo) . '"> 
                        <img src="' . htmlspecialchars($photo) . '" alt="' . htmlspecialchars($uneCard->titre) . '" class="product-image card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column"> 
                            <h5 class="card-title">' . htmlspecialchars($uneCard->titre) . '</h5>
                            <p class="card-description" style="display: none;">' . htmlspecialchars($uneCard->description) . '</p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteArticleModal" data-id="' . htmlspecialchars($uneCard->id) . '">Supprimer l\'article</a>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Aucun article trouvé !</div>';
        }
        ?>
    </div>

    <!-- Modal -->
    <form id="deleteArticleForm" method="POST" action="includes/function.php" enctype="multipart/form-data">
    <div class="modal fade" id="deleteArticleModal" tabindex="-1" aria-labelledby="deleteArticleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteArticleModalLabel">Supprimer l'article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer cet article ? Cette action est irréversible.</p>
                    <input type="hidden" name="action" value="deleteArticle">
                    <input type="hidden" name="id" id="deleteArticleId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var deleteArticleModal = document.getElementById('deleteArticleModal');
    deleteArticleModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');

        var modalBodyInputId = deleteArticleModal.querySelector('#deleteArticleId');
        modalBodyInputId.value = id;
    });
});
</script>