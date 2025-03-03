<?php

require_once './classes/connexion.php';
require_once './includes/head.php';
require_once './includes/navbar.php';

$role = $_SESSION['role'];
if($role == 'Admin') {
    echo '
<div class="menu">
    <button type="button" class="btn btn-custom" onclick="redirect(\'CreateArticle.php\')">Ajout d\'un article</button>
    <button type="button" class="btn btn-custom" onclick="redirect(\'UpdateArticle.php\')">Modifier un article</button>
    <button type="button" class="btn btn-danger" onclick="redirect(\'DeleteArticle.php\')">Supprimer un article</button>
    </div>';
}elseif($role == 'Créateur') {
    echo '
    <div class="menu">
    <button type="button" class="btn btn-custom" onclick="redirect(\'CreateArticle.php\')">Ajout d\'un article</button>
    <button type="button" class="btn btn-custom" onclick="redirect(\'UpdateArticle.php\')">Modifier un article</button>
    </div>';
}

?>

<script>
function redirect(url) {
    fetch(url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (response.ok) {
            window.location.href = url;
        } else {
            console.error('Redirection failed:', response.statusText);
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>