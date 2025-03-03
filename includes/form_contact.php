<?php

$connexion = new Connexion();
$pdo = $connexion->getObjetPDO();
$sql = "SELECT * FROM login";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$visiteurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['name']) && isset($_POST['subject']) && isset($_POST['message'])){
    
    $name = htmlspecialchars($_POST['name']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : htmlspecialchars($_POST['email']);
    $sql = "INSERT INTO messagerie (nom, email, titre, message) VALUES (:name, :email, :subject, :message)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name, 'email' => $email, 'subject' => $subject, 'message' => $message]);
    
    // Redirection pour éviter la soumission multiple
    header("Location: " . $_SERVER['PHP_SELF']);
    
    exit();
}

if(isset($_SESSION['user'])){
    echo '<div class="contact-container">
            <div class="contact-form">
                <h2>Formulaire de contact</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="name">Nom :</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="email" name="email" class="form-control" value="' . htmlspecialchars($_SESSION['email']) . '" disabled>
                    </div>
                    <div class="form-group">
                        <label for="subject">Sujet :</label>
                        <input type="text" id="subject" name="subject" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message :</label>
                        <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
            <div class="contact-info">
                <h3>Ou alors par : </h3>
                <p>Téléphone : 0698778757 ou 0668762229</p>
                <p>Email : nosenfantssoleil@free.fr</p>
                <p>Adresse : 610 Chemin du bief de l\'étang neuf, 01960 Péronnas</p>

            </div>
        </div>';
} else {
    echo '<div class="contact-container">
            <div class="contact-form">
                <h2>Formulaire de contact</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="name">Nom :</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="text" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Sujet :</label>
                        <input type="text" id="subject" name="subject" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message :</label>
                        <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
            <div class="contact-info">
                <h3>Ou alors par : </h3>
                <p>Téléphone : 0698778757 ou 0668762229</p>
                <p>Email : nosenfantssoleil@free.fr</p>
                <p>Adresse : 610 Chemin du bief de l\'étang neuf, 01960 Péronnas</p>
            </div>
        </div>';
}
?>

<style>
.contact-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.contact-form {
    width: 45%;
}

.contact-info {
    margin-top: 25px;
    width: 55%;
    padding-left: 20px;
    border-left: 1px solid #ccc;
    text-transform: uppercase;
}
</style>