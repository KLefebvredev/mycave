<?php
session_start();

require __DIR__ . '/header.php';

require_once('connect.php');
require_once('bottles.php');
?>

<?php
// je vérifie si l'id dans l'url est bien un id, sinon, on essaie de me niquer
$mille_id = is_numeric($_GET['id']) ? intval($_GET['id']) : FALSE;

if ($mille_id) :
    $req = $db->prepare("
    SELECT * 
    FROM mille m
    LEFT JOIN couleur c 
    ON m.couleur_id = c.id
    WHERE m.id = :id
    ");
    $req->bindValue(':id', $mille_id, PDO::PARAM_INT);
    $req->execute();
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
    echo '<section id="details">';
    foreach ($results as $result) {
        var_dump($result);
?>
        <h1>Détails de la Bouteille : <?= $result['nom']; ?></h1>
        <section class="bottle-list row justify-content-center text-center mb-5">
            <div class="card bottle-item col-6 p-2 m-3">
                <div class="details">
                    <img src="assets/img/<?= $result['image'] ?>" alt="Photo de la bouteille<?= $result['nom'] ?>">
                    <p><span>Appelation : </span><?= $result['nom']; ?></p>
                    <p><span>Pays : </span><?= $result['pays']; ?></p>
                    <p><span>Région : </span><?= $result['region']; ?></p>
                    <p><span>Année : </span><?= $result['annee']; ?></p>
                    <p><span>Cépage : </span><?= $result['cepage']; ?></p>
                    <p><span>Couleur : </span><?= $result['type']; ?></p>
                    <p><span>Description : </span><?= $result['description'] ?></p>
                </div>

            <?php
        }
            ?>
        </section>
    <?php
else : // Si soucis
    echo '<h1>Un problème est survenu </h1>';
endif;
require __DIR__ . '/footer.php';
