<?php
session_start();
require_once './includes/head.php';
require_once './classes/connexion.php';
?>

<body class="body-contact">
    <div class="header">
        <?php
        require_once './includes/navbar.php';
        ?>
        </div>
    </div>

    <div class="content">
        <?php 
        require_once './includes/form_contact.php';
        ?>
    </div>

</body>