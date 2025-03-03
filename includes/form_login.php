<?php

require_once './classes/connexion.php';

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $connect = new Connexion();
    $query = 'SELECT * FROM login WHERE login = :username';
    $user = $connect->VerifInfoConnexion($query, ['username' => $username]);
    $password_hashed = hash('sha512', $password);
if($user && $password_hashed === $user->pass) {
        $_SESSION['email'] = $user->email;
        $_SESSION['user'] = $user;
        $_SESSION['role'] = $user->role;
        header('Location: index.php');
        exit();
    } else {
        echo '<div class="alert alert-danger" role="alert">Nom d\'utilisateur ou mot de passe incorrect !</div>';
    }
}
?>

<div class="login-container">
    <h2>Connexion</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button class="button-87" type="submit">Connexion</button>
    </form>
    <p>Vous n'avez pas de compte ? <a href="Register.php" id="show-register">Inscrivez vous</a></p>
</div>
