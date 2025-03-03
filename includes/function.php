<?php

require_once __DIR__ . '/../classes/connexion.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action == 'updateUser') {
        $id = $_POST['id'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        
        updateUser($id, $prenom, $nom, $email, $role);
    } elseif ($action == 'updateArticle') {
        $id = $_POST['id'];
        $title = $_POST['titre'];
        $description = $_POST['description'];
        $images = $_FILES['images'];
        
        updateArticle($id, $title, $description, $images);
    } elseif ($action == 'deleteArticle') {
        $id = $_POST['id'];
        deleteArticle($id);
    }
}

function updateUser($id, $prenom, $nom, $email, $role) {
    $connexion = new Connexion();
    $pdo = $connexion->getObjetPDO();

    $sql = "UPDATE login SET prenom = :prenom, nom = :nom, email = :email, role = :role WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':prenom' => $prenom,
        ':nom' => $nom,
        ':email' => $email,
        ':role' => $role,
        ':id' => $id
    ]);
    header('Location: ./../Liste_Inscription.php');
    exit();
}

function updateArticle($id, $title, $description, $images) {
    $connexion = new Connexion();
    $pdo = $connexion->getObjetPDO();

    // Récupérer les valeurs actuelles si les champs sont vides
    $sql = "SELECT title, description FROM articles WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($title)) {
        $title = $article['title'];
    }
    if (empty($description)) {
        $description = $article['description'];
    }

    $sql = "UPDATE articles SET title = :title, description = :description WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title' => $title,
        ':description' => $description,
        ':id' => $id
    ]);

    // Vérifier si le répertoire uploads/ existe, sinon le créer
    $uploadDirectory = __DIR__ . '/../uploads/';
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    // Ajouter les nouvelles images
    foreach ($images['name'] as $index => $name) {
        if (!empty($name)) {
            $fileName = basename($name);
            $targetFilePath = $uploadDirectory . $fileName;
            if (move_uploaded_file($images['tmp_name'][$index], $targetFilePath)) {
                $sql = "INSERT INTO photos (article_id, photo_url) VALUES (:article_id, :photo_url)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':article_id' => $id, ':photo_url' => 'uploads/' . $fileName]);
            } else {
                error_log("Failed to move uploaded file: " . $images['tmp_name'][$index]);
            }
        } else {
            error_log("Empty file name for index: " . $index);
        }
    }
    header('Location: ./../UpdateArticle.php');
    exit();
}

function deleteArticle($id){
    $connexion = new Connexion();
    $pdo = $connexion->getObjetPDO();

    $sql = "DELETE FROM articles WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    header('Location: ./../deleteArticle.php');

}
?>