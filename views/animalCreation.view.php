<?php ob_start();?>
<div class="container">
    <form method="POST" action="<?= URL?>back/animaux/creationValidation" enctype="multipart/form-data">
        <div class="form-group">
          <label for="animal_nom" class="form-label mt-4">Animal :</label>
          <input type="text" class="form-control" id="animal_nom" name="animal_nom" placeholder="nom animal">
            </div>
        <div class="form-group">
          <label for="animal_description" class="form-label mt-4">Description :</label>
          <textarea class="form-control" id="animal_description" rows="3" name="animal_description" placeholder="description animal"></textarea>
            </div>
        <div class="form-group">
          <label for="image" class="form-label mt-4">Image : </label>
          <input class="form-control-file" type="file" id="image" name="image">
        </div>
        <div class="form-group">
          <label for="famille" class="form-label mt-4">familles : </label>
          <select  class="form-select" id="famille_id" name="famille_id">
            <option></option>
            <?php foreach($familles as $famille) : ?>
            <option value="<?= $famille['famille_id']?>"><?= $famille['famille_libelle']?></option>
            <?php endforeach;?>
          </select>
        </div>
        <fieldset class="form-group">
          <legend class="mt-4">continents : </legend>
          <?php foreach($continents as $continent) :?>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="continent-<?= $continent["continent_id"]?>" >
              <label class="form-check-label" for="flexCheckDefault">
                <?= $continent["continent_libelle"]?>
              </label>
            </div>
          <?php endforeach;?>
        </fieldset>
      <button type="submit" class="btn btn-primary mt-2">Créer</button>
    </form>
</div>
<?php
$content = ob_get_clean();
$titre = "Page Création animal";
require "views/commons/template.php";