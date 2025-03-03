<?php
session_start();
require_once './includes/head.php';
?>

<body class="body">
    <div class="header">
        <?php
        require_once './includes/navbar.php';
        ?>
        </div>
    </div>

    <div class="content">
        <?php 
        require_once './includes/form_soutien.php';
        ?>
    </div>

</body>