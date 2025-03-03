<?php
require_once './classes/Ccard.php';
// Créer une instance de la classe Connexion
$connexion = new Connexion();
$pdo = $connexion->getObjetPDO();

// Vérifier si un tri par nom est demandé
$orderBy = isset($_GET['order_by']) && $_GET['order_by'] == 'nom' ? 'nom' : 'id';

// Vérifier si une recherche par nom est demandée
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Préparer et exécuter la requête SQL pour récupérer les visiteurs
$sql = "SELECT * FROM login WHERE nom LIKE :search ORDER BY $orderBy";
$stmt = $pdo->prepare($sql);
$stmt->execute(['search' => "%$search%"]);

// Récupérer les résultats dans un tableau
$visiteurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Afficher le formulaire de filtre et le tableau des visiteurs
echo "
<h1 class='titre'>Liste des inscriptions</h1>
<form id='searchForm' method='get' action=''>
    <div class='form-group'>
        <label for='search'>Rechercher par nom :</label>
        <div class='input-group'>
            <input type='text' name='search' id='search' class='form-control' value='" . htmlspecialchars($search) . "' onkeyup='submitForm()'>
        </div>
    </div>
</form>
<div id='tableContainer'>
<table class='table'>
    <thead>
    <tr>
      <th scope='col'>ID</th>
      <th scope='col'>Prénom</th>
      <th scope='col'>Nom</th>
      <th scope='col'>Email</th>
      <th scope='col'>Rôle</th>
      <th scope='col'>Action</th>
    </tr>
  </thead>";
foreach ($visiteurs as $visiteur) {
    echo '<tr>
     <td>' . htmlspecialchars($visiteur['id']) . '</td>
    <td>' . htmlspecialchars($visiteur['prenom']) . '</td>
    <td>' . htmlspecialchars($visiteur['nom']) . '</td>
    <td>' . htmlspecialchars($visiteur['email']) . '</td>
    <td>' . htmlspecialchars($visiteur['role']) . '</td>
    <td>
        <div class="dropdown">
            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Action
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' . htmlspecialchars($visiteur['id']) . '" data-prenom="' . htmlspecialchars($visiteur['prenom']) . '" data-nom="' . htmlspecialchars($visiteur['nom']) . '" data-email="' . htmlspecialchars($visiteur['email']) . '" data-role="' . htmlspecialchars($visiteur['role']) . '">Modifier</a></li>
            </ul>
        </div>
    </td>
    </tr>';
}
echo "</table></div>";
?>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modifier Visiteur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="includes/function.php">
                    <input type="hidden" name="action" value="updateUser">
                    <input type="hidden" name="id" id="edit-id">
                    <input type="hidden" name="email" id="edit-hidden-email">
                    <div class="mb-3">
                        <label for="edit-prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="edit-prenom" name="prenom" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="edit-nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit-email" name="email" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="edit-role" class="form-label">Rôle</label>
                        <select class="form-select" id="edit-role" name="role" required>
                            <option value="Lecteur">Lecteur</option>
                            <option value="Créateur">Créateur</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var prenom = button.getAttribute('data-prenom');
            var nom = button.getAttribute('data-nom');
            var email = button.getAttribute('data-email');
            var role = button.getAttribute('data-role');

            var modalTitle = editModal.querySelector('.modal-title');
            var modalBodyInputId = editModal.querySelector('#edit-id');
            var modalBodyInputPrenom = editModal.querySelector('#edit-prenom');
            var modalBodyInputNom = editModal.querySelector('#edit-nom');
            var modalBodyInputEmail = editModal.querySelector('#edit-email');
            var modalBodyHiddenEmail = editModal.querySelector('#edit-hidden-email');
            var modalBodyInputRole = editModal.querySelector('#edit-role');

            modalTitle.textContent = 'Modifier ' + prenom + ' ' + nom;
            modalBodyInputId.value = id;
            modalBodyInputPrenom.value = prenom;
            modalBodyInputNom.value = nom;
            modalBodyInputEmail.value = email;
            modalBodyHiddenEmail.value = email;
            modalBodyInputRole.value = role;
        });
    });
</script>