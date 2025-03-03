<?php
    $connexion = new Connexion();
    $pdo = $connexion->getObjetPDO();
    $sql = "SELECT * FROM messagerie";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST['supprimer'])){
        $sql = "DELETE FROM messagerie WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $_POST['message_id']]);
        header('Location: ./Liste_Message.php');	
    }
?>

<style>
    .modal-body {
        max-height: 600px; 
        overflow-y: auto;
        word-wrap: break-word;
        text-align: justify;
        padding-top: 0;
        margin-top: 10px; 
    }
    .modal-header {
        padding-bottom: 0; /* Reduce padding at the bottom */
    }
</style>

<div class="container">
    <h2>Messagerie</h2>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Titre</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $message): ?>
                        <tr>
                            <td class="text-wrap"><?php echo htmlspecialchars($message['id']); ?></td>
                            <td class="text-wrap"><?php echo htmlspecialchars($message['nom']); ?></td>
                            <td class="text-wrap"><?php echo htmlspecialchars($message['email']); ?></td>
                            <td class="text-wrap"><?php echo htmlspecialchars($message['titre']); ?></td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#messageModal<?php echo $message['id']; ?>">
                                    Voir Message
                                </button>
                            </td>
                        </tr>

                        <!-- Modal -->
<div class="modal fade" id="messageModal<?php echo $message['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel<?php echo $message['id']; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel<?php echo $message['id']; ?>">Message de <?php echo htmlspecialchars($message['nom']); ?> le : <?= htmlspecialchars($message['created_at']);?></h5>
            </div>
            <div class="modal-body">
                <?php echo nl2br(html_entity_decode(htmlspecialchars($message['message']))); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <form action="" method="POST">
                    <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                    <button type="submit" class="btn btn-danger" name="supprimer">Supprimer</button>
                </form>
                <a href="mailto:<?php echo htmlspecialchars($message['email']); ?>" class="btn btn-primary">Répondre</a>
            </div>
        </div>
    </div>
</div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
