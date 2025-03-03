<?php

require_once './classes/connexion.php';
require_once './includes/head.php';
require_once './includes/navbar.php';

echo '
<div class="menu">
    <button type="button" class="btn btn-custom" onclick="redirect(\'Liste_Inscription.php\')">Liste des inscriptions</button>
    <button type="button" class="btn btn-custom" onclick="redirect(\'GestionArticle.php\')">Gestion des Articles</button>
    <button type="button" class="btn btn-custom" onclick="redirect(\'Liste_Message.php\')">Messagerie</button>
    </div>';

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