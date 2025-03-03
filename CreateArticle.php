<?php
session_start();
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['Admin', 'Créateur'])) {
    header('Location: index.php');
    exit();
}
require_once './includes/head.php';
require_once './classes/connexion.php';
?>

<body class="body-article">
    <div class="header">
        <?php
        require_once './includes/navbar.php';
        ?>
        </div>
    </div>

    <div class="content">
        <?php 
        require_once './includes/Form_Articles.php';
        ?>
    </div>

</body>