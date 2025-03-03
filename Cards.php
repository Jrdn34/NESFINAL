<?php
session_start();
require_once './includes/head.php';
require_once './classes/connexion.php';
require_once './classes/Ccard.php';
require_once './includes/navbar.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $lesCards = new Ccards();
    $oCard = $lesCards->GetAllCard();
    $article = null;

    foreach ($oCard as $uneCard) {
        if ($uneCard->id == $id) {
            $article = $uneCard;
            break;
        }
    }

    if ($article) {
        $photos = $article->getPhotos($id);
        $videos = $article->getVideos($id);

        // Combine photos and videos into a single array
        $media = array_merge(
            array_map(function($photo) { return ['type' => 'photo', 'url' => $photo]; }, $photos),
            array_map(function($video) { return ['type' => 'video', 'url' => $video]; }, $videos)
        );
        ?>
        <style>
            .carousel-control-prev, .carousel-control-next {
                width: auto;
                height: auto;
                top: 50%;
                transform: translateY(-50%);
            }
            .carousel-control-prev-icon, .carousel-control-next-icon {
                width: 30px;
                height: 30px;
            }
        </style>
        <body class="body_article">
            <div class="article-container">
                <h1><?= htmlspecialchars($article->titre); ?></h1>
                <p style="font-style:italic; font-size: 12px;">Article publié le <?= htmlspecialchars($article->date);?></p>
                <?php if (!empty($media)) { ?>
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <?php foreach ($media as $index => $item) { ?>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-current="true" aria-label="Slide <?php echo $index + 1; ?>"></button>
                            <?php } ?>
                        </div>
                        <div class="carousel-inner">
                            <?php foreach ($media as $index => $item) { ?>
                                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                    <?php if ($item['type'] === 'photo') { ?>
                                        <img src="<?php echo htmlspecialchars($item['url']); ?>" class="d-block w-100" alt="...">
                                    <?php } else if ($item['type'] === 'video') { ?>
                                        <video controls class="d-block w-100">
                                            <source src="<?php echo htmlspecialchars($item['url']); ?>" type="video/mp4">
                                            Votre navigateur ne supporte pas la balise vidéo.
                                        </video>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Précédente</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Suivante</span>
                        </button>
                    </div>
                <?php } ?>

                <p><?php echo htmlspecialchars($article->description); ?></p>
                <a href="javascript:history.back()" class="btn btn-secondary mt-3">Retour</a>
            </div>
        </body>
        <?php
    } else {
        echo "<div class=\"alert alert-danger\" role=\"alert\">Article non trouvé !</div>";
    }
} else {
    echo "<div class=\"alert alert-danger\" role=\"alert\">Article non trouvé !</div>";
}
?> 