<?php
require_once './includes/head.php';
require_once './classes/connexion.php';

$navbarClass = isset($backgroundImage) ? 'navbar-text-white' : 'navbar-text-black';

function isActive($page) {
    return basename($_SERVER['PHP_SELF']) == $page ? 'active' : '';
}

if(!isset($_SESSION['role'])){
echo '<nav class="navbar navbar-expand-lg bg-body-tertiary custom-navbar ' . $navbarClass . '">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
        <img src="./img/logo.jpg" alt="Logo" width="200" height="200">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link ' . isActive('index.php') . '" aria-current="page" href="index.php">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle ' . isActive('association.php') . '" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        L\'association
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="Historique.php">Historique</a></li>
                        <li><a class="dropdown-item" href="Equipe.php">L\'équipe</a></li>
                        <li><a class="dropdown-item" href="Machine.php">Les Machines</a></li>
                        
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link ' . isActive('Soutien.php') . '" href="Soutien.php">Nous soutenir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ' . isActive('Contact.php') . '" href="Contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ' . isActive('Login.php') . '" href="Login.php">
                        <i class="bi bi-person-circle navbar-icon"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>';
}elseif($_SESSION['role'] == 'Admin'){
    echo '<nav class="navbar navbar-expand-lg bg-body-tertiary custom-navbar ' . $navbarClass . '">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="./img/logo.jpg" alt="Logo" width="200" height="200">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link ' . isActive('index.php') . '" aria-current="page" href="index.php">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle ' . isActive('association.php') . '" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        L\'association
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="Historique.php">l\'histoire</a></li>
                        <li><a class="dropdown-item" href="Equipe.php">L\'équipe</a></li>
                        <li><a class="dropdown-item" href="Machine.php">Les Machines</a></li>
                        
                    </ul>
                </li>                
                
                <li class="nav-item">
                    <a class="nav-link ' . isActive('Soutien.php') . '" href="Soutien.php">Nous soutenir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ' . isActive('Contact.php') . '" href="Contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ' . isActive('Administration.php') . '" href="Administration.php">Administration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ' . isActive('Login.php') . '" href="Deconnexion.php" style="font-size: 1.5em;">
                        <i class="bi bi-person-dash"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>';
}elseif($_SESSION['role'] == 'Créateur'){
    echo '<nav class="navbar navbar-expand-lg bg-body-tertiary custom-navbar ' . $navbarClass . '">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="./img/logo.jpg" alt="Logo" width="200" height="200">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link ' . isActive('index.php') . '" aria-current="page" href="index.php">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle ' . isActive('association.php') . '" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        L\'association
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="Historique.php">Historique</a></li>
                        <li><a class="dropdown-item" href="Equipe.php">L\'équipe</a></li>
                        <li><a class="dropdown-item" href="Machine.php">Les Machines</a></li>
                        
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link ' . isActive('Soutien.php') . '" href="Soutien.php">Nous soutenir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ' . isActive('Contact.php') . '" href="Contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ' . isActive('GestionArticle.php') . '" href="GestionArticle.php">Publication</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ' . isActive('Login.php') . '" href="Deconnexion.php" style="font-size: 1.5em;">
                        <i class="bi bi-person-dash"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>';
}else{
    echo '<nav class="navbar navbar-expand-lg bg-body-tertiary custom-navbar ' . $navbarClass . '">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="./img/logo.jpg" alt="Logo" width="200" height="200">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link ' . isActive('index.php') . '" aria-current="page" href="index.php">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle ' . isActive('association.php') . '" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        L\'association
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="Historique.php">Historique</a></li>
                        <li><a class="dropdown-item" href="Equipe.php">L\'équipe</a></li>
                        <li><a class="dropdown-item" href="Machine.php">Les Machines</a></li>
                        
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link ' . isActive('Soutien.php') . '" href="Soutien.php">Nous soutenir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ' . isActive('Contact.php') . '" href="Contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ' . isActive('Login.php') . '" href="Deconnexion.php" style="font-size: 1.5em;">
                        <i class="bi bi-person-dash"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>';
}
?>