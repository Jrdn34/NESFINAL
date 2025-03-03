<?php
session_start();
$backgroundImage = true;
require_once './includes/head.php';
?>

<body class="body">
    <div class="form">
        <?php
        require_once './includes/navbar.php';
        require_once './includes/form_login.php';
        ?>
    </div>