<?php

require __DIR__ . '/header.php';


require_once('connect.php');
require_once('bottles.php');
?>
<?php
if (!empty($_SESSION['erreur'])) {
    echo '<div class="alert alert-danger" role="alert">
                        ' . $_SESSION['erreur'] . '
                        </div>';
    $_SESSION['erreur'] = "";
}
?>
<?php
if (!empty($_SESSION['message'])) {
    echo '<div class="alert alert-success" role="alert">
                        ' . $_SESSION['message'] . '
                        </div>';
    $_SESSION['message'] = "";
}
?>
<?php var_dump($_SESSION); ?>
<?php if (isset($_SESSION['id'])) : ?>
    <div id="to_disconnect"><a href="disconnect.php">Se déconnecter</a></div>
<?php else : ?>
    <div id="to_connect">
        <p>Se connecter</p>
        <div id="connect"><?php require 'login.php'; ?></div>
    </div>
<?php endif; ?>
<?php if (isset($_SESSION['id'])) : ?>
    <p class="md-visible">Bonjour <?php echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']; ?></p>
<?php endif ?>
<h2 class="text-center pb-2">Liste des bouteilles dans Mycave</h2>
<div class="container">
    <section class="bottle-list row justify-content-center text-center mb-5">
        <?php
        foreach ($result as $bottle) {
        ?>
            <div class="card bottle-item col-3 p-2 m-3">
                <img src="assets/img/<?= $bottle['image'] ?>" alt="Photo de la bouteille<?= $bottle['nom'] ?>" class="card-img-top pb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= $bottle['nom'] ?></h5>
                    <p class="card-text"><?= $bottle['pays'] ?></p>
                    <p class="card-text"><?= $bottle['annee'] ?></p>
                    <a href="<?= "./more.php?id={$bottle['id']}"; ?>" class="btn btn-primary">En savoir plus</a>
                </div>
                <div>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'administrateur') : ?>
                        <li class="nav-item">
                            <a href="<?= "./update.php?id={$bottle['id']}"; ?>" class="btn btn-warning m-2">Modifier cette bouteille</a>
                            <a href="<?= "./delete_post.php?id={$bottle['id']}"; ?>" class="btn btn-danger m-2">Supprimez cette bouteille</a>
                        </li>
                    <?php endif; ?>
                </div>
            </div>
        <?php
        }
        ?>
    </section>
</div>
<?php
require __DIR__ . '/footer.php';
