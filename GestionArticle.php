<?php
session_start();
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['Admin', 'Créateur'])) {
    header('Location: index.php');
    exit();
}
require_once './includes/head.php';
require_once './classes/connexion.php';
    
    echo '<body class="body">
    <div class="header">';
    require_once './includes/navbar.php';
    echo '</div>
    <div class="content">';
    require_once './includes/MenuArticles.php';
    echo '</div>
    </body>
    </html>';



?>