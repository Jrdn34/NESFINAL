<?php
session_start();
$backgroundImage = true;
require_once './includes/head.php';
require_once './classes/connexion.php';
?>

<body class="body">
    <div class="header">
        <div class="index">
        <?php
        require_once './includes/navbar.php';
        require_once './includes/intro.php';
        ?><br><br>
        </div>
    </div>

    <div class="content">
        <?php 
        require_once './includes/panel.php';
        ?>
    </div>

    <div class="footer">
        <?php
        require_once './includes/footer.php';
        ?>
    </div>

    <script src="./animation.js"></script>
</body>