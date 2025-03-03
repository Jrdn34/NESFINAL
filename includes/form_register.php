<?php

require_once './classes/connexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inscription'])) {
    $new_prenom = isset($_POST['first-name']) ? htmlspecialchars($_POST['first-name']) : '';
    $new_nom = isset($_POST['last-name']) ? htmlspecialchars($_POST['last-name']) : '';
    $new_username = isset($_POST['new-username']) ? htmlspecialchars($_POST['new-username']) : '';
    $new_email = isset($_POST['new-email']) ? htmlspecialchars($_POST['new-email']) : '';
    $new_password = isset($_POST['new-password']) ? htmlspecialchars($_POST['new-password']) : '';
    $confirm_password = isset($_POST['confirm-password']) ? htmlspecialchars($_POST['confirm-password']) : '';

    if ($new_password === $confirm_password) {
        $new_password_hashed = hash('sha512', $new_password);
        $connect = new Connexion();
        $req = 'INSERT INTO login (prenom, nom, login, email, pass) VALUES (:prenom, :nom, :username, :email, :password)';
        $params = [
            'prenom' => $new_prenom,
            'nom' => $new_nom,
            'username' => $new_username,
            'email' => $new_email,
            'password' => $new_password_hashed
        ];
        $connect->Insertion($req, $params);
        header('Location: Login.php');
        exit();
    } else {
        $error_message = 'Les mots de passe ne correspondent pas !';
    }
}

?>

<div class="register-container">
    <h2>Inscription</h2>
    <form action="" method="POST">
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <div class="form-row">
            <div class="form-group">
                <label for="first-name">Prénom :</label>
                <input type="text" id="first-name" name="first-name" required>
            </div>
            <div class="form-group">
                <label for="last-name">Nom :</label>
                <input type="text" id="last-name" name="last-name" required>
            </div>
        </div>
        <div class="form-group">
            <label for="new-username">Nom d'utilisateur :</label>
            <input type="text" id="new-username" name="new-username" required>
        </div>
        <div class="form-group">
            <label for="new-email">Email :</label>
            <input type="email" id="new-email" name="new-email" required>
        </div>
        <div class="form-group">
            <label for="new-password">Mot de passe :</label>
            <input type="password" id="new-password" name="new-password" required>
        </div>
        <div class="form-group">
            <label for="confirm-password">Confirmer le mot de passe :</label>
            <input type="password" id="confirm-password" name="confirm-password" required>
        </div>
        <button class="button-87" type="submit" name="inscription">Inscription</button>
    </form>
    <p>Vous avez déjà un compte ? <a href="Login.php" id="show-login">Connectez-vous</a></p>
</div>