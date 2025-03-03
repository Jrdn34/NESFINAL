<?php
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['Admin'])) {
    header('Location: index.php');
    exit();
}
require_once './classes/connexion.php';

$connexion = new Connexion();
$pdo = $connexion->getObjetPDO();

$orderBy = isset($_GET['order_by']) && $_GET['order_by'] == 'nom' ? 'nom' : 'id';
$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM login WHERE nom LIKE :search ORDER BY $orderBy";
$stmt = $pdo->prepare($sql);
$stmt->execute(['search' => "%$search%"]);

$visiteurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<table class='table'>
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
                <li><a class="dropdown-item" href="#">Supprimer</a></li>
            </ul>
        </div>
    </td>
    </tr>';
}
echo "</table>";
?>