<?php
session_start();

if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['Admin', 'Créateur'])) {
    header('Location: index.php');
    exit();
}
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
        require_once './includes/Update_Articles.php';
        ?>
    </div>

</body>