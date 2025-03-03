<?php
require_once './classes/Ccard.php';
$lesCards = new Ccards();
$oCard = $lesCards->GetAllCard();

?>

<div class="container">
    <h2 class="allActualite">Selectionnez un article à modifier </h2>
    <div class="row">
        <?php
        if (!empty($oCard)) {
            $i = 0;
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
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editArticleModal" data-id="' . htmlspecialchars($uneCard->id) . '">Modifier l\'article</a>
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

    <!-- Modal -->
    <form id="editArticleForm" method="POST" action="includes/function.php" enctype="multipart/form-data">
        <div class="modal fade" id="editArticleModal" tabindex="-1" aria-labelledby="editArticleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editArticleModalLabel">Modifier l'article</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="action" value="updateArticle">
                        <input type="hidden" name="id" id="articleId">
                        <div class="mb-3">
                            <label for="articleTitle" class="form-label">Titre</label>
                            <input type="text" class="form-control" id="articleTitle" name="titre" required>
                        </div>
                        <div class="mb-3">
                            <label for="articleDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="articleDescription" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="articleImages" class="form-label">Images</label>
                            <input type="file" class="form-control" id="articleImages" name="images[]" multiple>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Images existantes</label>
                            <div id="existingImages" class="d-flex flex-wrap"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var editArticleModal = document.getElementById('editArticleModal');
        editArticleModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var title = button.closest('.card').querySelector('.card-title').textContent;
            var description = button.closest('.card').querySelector('.card-description').textContent;
            var photo = button.closest('.card').getAttribute('data-photo');

            var modalTitle = editArticleModal.querySelector('.modal-title');
            var modalBodyInputId = editArticleModal.querySelector('#articleId');
            var modalBodyInputTitle = editArticleModal.querySelector('#articleTitle');
            var modalBodyInputDescription = editArticleModal.querySelector('#articleDescription');
            var existingImagesContainer = editArticleModal.querySelector('#existingImages');

            modalTitle.textContent = 'Modifier ' + title;
            modalBodyInputId.value = id;
            modalBodyInputTitle.value = title;
            modalBodyInputDescription.value = description;

            // Clear existing images
            existingImagesContainer.innerHTML = '';

            // Add existing image
            if (photo) {
                var imgElement = document.createElement('img');
                imgElement.src = photo;
                imgElement.alt = title;
                imgElement.classList.add('img-thumbnail', 'm-1');
                imgElement.style.width = '100px';
                existingImagesContainer.appendChild(imgElement);
            }
        });
    });
    </script>
</div>