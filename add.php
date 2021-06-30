<?php require 'connect.php'; ?>

<?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'administrateur') : ?>

	<?php require 'header.php'; ?>
	<?php
	mb_internal_encoding("UTF-8");
	function mb_ucfirst($s)
	{
		$s = mb_strtolower($s);
		return mb_strtoupper(mb_substr($s, 0, 1)) . mb_substr($s, 1);
	}

	$req = $db->query("
		SELECT *
		FROM couleur
		WHERE id
		ORDER BY id 
		DESC
	");
	$req->execute();
	var_dump($req->fetchObject());

	?>
	<h1>Création de bouteille</h1>
	<section id="register">
		<form action="add_post.php" method="POST" enctype="multipart/form-data">
			<div>
				<label for="nom">Nom de la bouteille</label>
				<input class="field" type="text" name="nom" id="nom">
			</div>
			<div>
				<label for="pays">Pays</label>
				<input class="field" type="text" name="pays" id="pays">
			</div>
			<div>
				<label for="region">Région</label>
				<input class="field" type="text" name="region" id="region">
			</div>
			<div>
				<label for="cepage">Cépage</label>
				<input class="field" type="text" name="cepage" id="cepage">
			</div>
			<div>
				<label for="annee">Année</label>
				<input class="field" type="text" name="annee" id="annee">
			</div>
			<div>
				<label for="description">description</label>
				<input class="field" type="text" name="description" id="description">
			</div>
			<div>
				<label for="file">Photo de la bouteille</label>
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
				<input class="field" type="file" name="image" id="image">
			</div>
			<div>
				<label for="couleur">Couleur du vin </label>
				<select name="couleur" id="couleur">
					<?php while ($option = $req->fetchObject()) {
						echo '<option value="' . $option->id . '">' . mb_ucfirst($option->type) . '</option>';
					} ?>
				</select>
			</div>
			<button type="submit">Créer la bouteille</button>
		</form>
		<div id="msg"></div>
	</section>


	<?php require 'footer.php'; ?>
<?php
else :
	header('Location: index.php');
endif;
