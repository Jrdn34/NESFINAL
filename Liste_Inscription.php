<?php
session_start();
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['Admin'])) {
    header('Location: index.php');
    exit();
}
require_once './includes/head.php';
require_once './classes/connexion.php';
?>

<body class="body">
    <div class="header">
        <?php
        require_once './includes/navbar.php';
        ?>
    </div>

    <div class="content">
        <?php 
        require_once './includes/tableau.php';
        ?>
    </div>

</body>