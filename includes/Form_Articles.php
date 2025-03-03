<div class="container mt-5">
    <h1 class="mb-4">Créer un nouvel article</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Entrez le titre de l'article" >
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Entrez la description de l'article" ></textarea>
        </div>
        <div class="form-group">
            <label for="images">Images</label>
            <input type="file" class="form-control-file" id="images" name="images[]" multiple >
        </div>
        <div class="form-group">
            <label for="videos">Vidéos</label>
            <input type="file" class="form-control-file" id="videos" name="videos[]" multiple >
        </div>
        <button type="submit" class="btn btn-primary">Créer l'article</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $uploadDirectory = 'uploads/';
        $errors = [];

        // Vérifier les champs requis
        if (empty($title)) {
            $errors[] = "Le titre est requis.";
        }
        if (empty($description)) {
            $errors[] = "La description est requise.";
        }
        if (empty($_FILES['images']['name'][0])) {
            $errors[] = "Au moins une image est requise.";
        }

        if (empty($errors)) {
            // Créer le répertoire de téléchargement s'il n'existe pas
            if (!is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0777, true);
            }

            $connect = new Connexion();
            $pdo = $connect->getObjetPDO();

            // Insérer le titre et la description dans la table articles
            $stmt = $pdo->prepare("INSERT INTO articles (title, description) VALUES (:title, :description)");
            $stmt->execute(['title' => $title, 'description' => $description]);
            $articleId = $pdo->lastInsertId();

            // Gérer les images
            $fileCount = count($_FILES['images']['name']);
            for ($i = 0; $i < $fileCount; $i++) {
                $fileName = basename($_FILES['images']['name'][$i]);
                $targetFilePath = $uploadDirectory . $fileName;
                
                // Vérifier les erreurs de téléchargement
                if ($_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
                    // Déplacer le fichier téléchargé vers le répertoire de destination
                    if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $targetFilePath)) {
                        // Insérer le chemin du fichier dans la table photos
                        $stmt = $pdo->prepare("INSERT INTO photos (article_id, photo_url) VALUES (:article_id, :photo_url)");
                        $stmt->execute(['article_id' => $articleId, 'photo_url' => $targetFilePath]);
                        echo "<div class='alert alert-success'>Le fichier $fileName a été téléchargé avec succès.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Erreur lors du téléchargement du fichier $fileName.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Erreur lors du téléchargement du fichier $fileName : " . $_FILES['images']['error'][$i] . "</div>";
                }
            }

            // Gérer les vidéos
            if (!empty($_FILES['videos']['name'][0])) {
                $videoCount = count($_FILES['videos']['name']);
                for ($i = 0; $i < $videoCount; $i++) {
                    $videoName = basename($_FILES['videos']['name'][$i]);
                    $targetVideoPath = $uploadDirectory . $videoName;
                    
                    // Vérifier les erreurs de téléchargement
                    if ($_FILES['videos']['error'][$i] === UPLOAD_ERR_OK) {
                        // Déplacer le fichier téléchargé vers le répertoire de destination
                        if (move_uploaded_file($_FILES['videos']['tmp_name'][$i], $targetVideoPath)) {
                            // Insérer le chemin du fichier dans la table videos
                            $stmt = $pdo->prepare("INSERT INTO videos (article_id, video_url) VALUES (:article_id, :video_url)");
                            $stmt->execute(['article_id' => $articleId, 'video_url' => $targetVideoPath]);
                            echo "<div class='alert alert-success'>La vidéo $videoName a été téléchargée avec succès.</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Erreur lors du téléchargement de la vidéo $videoName.</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Erreur lors du téléchargement de la vidéo $videoName : " . $_FILES['videos']['error'][$i] . "</div>";
                    }
                }
            }
        } else {
            // Afficher les erreurs
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        }
    }
    ?>
</div>