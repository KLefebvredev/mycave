<?php
session_start();

require __DIR__ . '/header.php';

require_once('connect.php');
require_once('bottles.php');
?>
<?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'administrateur') : ?>
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

    $req = $db->prepare("
    SELECT annee,description,image,nom,pays,region,cepage
    FROM mille m
    LEFT JOIN couleur c
    ON m.couleur_id = c.id
    WHERE m.id = :id
    ");
    $req->bindValue(':id', $mille_id, PDO::PARAM_INT);
    $req->execute();
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
    echo '<section id="details">';
    foreach ($results as $bouteille) {
        var_dump($bouteille);
        var_dump($mille_id);
    ?>
        <main class="container">
            <div class="row">
                <section class="col-12">
                    <h1>Modifier le produit</h1>
                    <form action="update_post.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nom">Nom de la bouteille</label>
                            <input type="text" id="nom" name="nom" class="form-control" value="<?= $bouteille['nom'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="annee">Annee</label>
                            <input type="number" id="annee" name="annee" class="form-control" value="<?= $bouteille['annee'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="pays">Pays</label>
                            <input type="text" id="pays" name="pays" class="form-control" value="<?= $bouteille['pays'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="region">region</label>
                            <input type="text" id="region" name="region" class="form-control" value="<?= $bouteille['region'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="cepage">cepage</label>
                            <input type="text" id="cepage" name="cepage" class="form-control" value="<?= $bouteille['cepage'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="description">description</label>
                            <input type="text" id="description" name="description" class="form-control" value="<?= $bouteille['description'] ?>">
                        </div>
                        <div>
                            <label for="file">Photo de la bouteille</label>
                            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                            <input class="field" type="file" name="image" id="image">
                        </div>
                        <input type="hidden" value="<?= $mille_id ?>" name="id"> <br>
                        <button class="btn btn-primary">Envoyer</button>
                    </form>
                <?php
            }
                ?>
                </section>
            </div>
        </main>
        <?php
        require __DIR__ . '/footer.php'; ?>
    <?php
else : // Si soucis
    header('Location: index.php');
endif;
