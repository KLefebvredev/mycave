<?php
session_start();

require_once('connect.php');
require_once('bottles.php');
?>
<?php require 'header.php'; ?>
<?php
mb_internal_encoding("UTF-8");
function mb_ucfirst($s)
{
    $s = mb_strtolower($s);
    return mb_strtoupper(mb_substr($s, 0, 1)) . mb_substr($s, 1);
} ?>
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
?>
        <h1 class="m-3">Détails de la Bouteille : <?= $result['nom']; ?></h1>
        <section class="bottle-list row justify-content-center text-center mb-5">
            <div class="card bottle-item col-6 p-2 m-3">
                <div class="details">
                    <img class="mt-2" src="assets/img/<?= $result['image'] ?>" alt="Photo de la bouteille<?= $result['nom'] ?>">
                    <p class="mt-3"><span>Appelation : </span><?= $result['nom']; ?></p>
                    <p><span>Pays : </span><?= $result['pays']; ?></p>
                    <p><span>Région : </span><?= $result['region']; ?></p>
                    <p><span>Année : </span><?= $result['annee']; ?></p>
                    <p><span>Cépage : </span><?= $result['cepage']; ?></p>
                    <p><span>Couleur : </span><?= mb_ucfirst($result['type']); ?></p>
                    <p><span>Description : </span><?= $result['description'] ?></p>
                </div>

            <?php
        }
            ?>
        </section>
        <a href="index.php">
            <p class="text-center"><button class="btn btn-primary m-4">Revenir à l'index</button></p>
        </a>
    <?php
else : // Si soucis
    $_SESSION['erreur'] = "Un problème est survenu !";
    header('Location: index.php');

endif;
require __DIR__ . '/footer.php';
