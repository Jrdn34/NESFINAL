<?php
session_start();
require_once './includes/head.php';
require_once './classes/connexion.php';
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['Admin'])) {
    header('Location: index.php');
    exit();
}

        echo '<body class="body">
        <div class="header">';
        require_once './includes/navbar.php';
        echo '</div>
        <div class="content">';
        require_once './includes/Menu.php';
        echo '</div>
        </body>
        </html>';
    
?>