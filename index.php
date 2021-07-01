<?php

require __DIR__ . '/header.php';


require_once('connect.php');
require_once('bottles.php');
?>
<?php
if (!empty($_SESSION['erreur'])) {
    echo '<div class="alert alert-danger mt-2 text-center m-auto w-25 fs-2" role="alert">
                        ' . $_SESSION['erreur'] . '
                        </div>';
    $_SESSION['erreur'] = "";
}
?>
<?php
if (!empty($_SESSION['message'])) {
    echo '<div class="alert alert-success mt-2 text-center m-auto w-25 fs-2" role="alert">
                        ' . $_SESSION['message'] . '
                        </div>';
    $_SESSION['message'] = "";
}
?>
<?php if (isset($_SESSION['id'])) : ?>
    <div id="to_disconnect" class="text-end m-3"><a href="disconnect.php">Se déconnecter</a></div>
<?php else : ?>
    <div id="to_connect" class="text-end m-3">
        <p>Se connecter</p>
        <div id="connect"><?php require 'login.php'; ?></div>
    </div>
<?php endif; ?>

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
                <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Confirmation de suppression</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <p>Cette procédure est irréversible !!!</p>
                                <p>Êtes-vous certain de vouloir supprimer cette bouteille définitivement ?</p>
                                <p class="debug-url"></p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <a class="btn btn-danger btn-ok">Supprimer</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'administrateur') : ?>
                        <li class="nav-item">
                            <a href="<?= "./update.php?id={$bottle['id']}"; ?>" class="btn btn-warning m-2">Modifier cette bouteille</a>

                            <a href="#" data-bs-toggle="modal" data-bs-target="#confirm-delete" data-href="<?= "./delete_post.php?id={$bottle['id']}"; ?>">
                            </a>
                            <button class="btn btn-danger" data-href="<?= "./delete_post.php?id={$bottle['id']}"; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete">
                                Supprimer cette bouteille
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="confirm-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
