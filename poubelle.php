<div>
    <label for="couleur">Couleur du vin </label>
    <select name="couleur" id="couleur">

        <?php while ($couleur = $req->fetchObject()) {
            echo '<option value="' . $couleur->id . '">' . mb_ucfirst($couleur->type) . '</option>';
        }
        ?>
</div>