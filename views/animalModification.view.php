<?php ob_start();?>
<div class="container">
    <form method="POST" action="<?= URL?>back/animaux/modificationValidation" enctype="multipart/form-data">
       <div class="form-group">
          <label for="animal_nom" class="form-label mt-4">Animal :</label>
          <input type="text" class="form-control" id="animal_nom" name="animal_nom" value="<?= $animal[0]['animal_nom']?>">
       </div>
       <div class="form-group">
          <label for="animal_description" class="form-label mt-4">Description :</label>
          <textarea class="form-control" id="animal_description" rows="3" name="animal_description" ><?= $animal[0]['animal_description']?></textarea>
        </div>
      <div class="form-group">
          <img src="<?= URL ?>public/images/<?= $animal[0]['animal_image']?>" alt="" style="width:50px;" class="mb-2"/>
          <label for="image" class="form-label mt-4">Image : </label>
          <input class="form-control" type="file" id="image" name="image">
      </div>
      <div class="form-group">
          <label for="famille" class="form-label mt-4">familles : </label>
          <select  class="form-select" id="famille_id" name="famille_id">
            <option></option>
            <?php foreach($familles as $famille) : ?>
            <option value="<?= $famille['famille_id']?>" <?php if($famille['famille_id'] === $animal[0]['famille_id']) echo "selected";?>>
            <?= $famille['famille_libelle']?>
            </option>
            <?php endforeach;?>
          </select>
      </div>
      <fieldset class="form-group">
          <legend class="mt-4">continents : </legend>
          <?php foreach($continents as $continent) :?>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="continent-<?= $continent["continent_id"]?>" 
            <?php if(in_array($continent['continent_id'] , $tabContinents)) echo "checked" ;?>>
            <label class="form-check-label" for="flexCheckDefault">
              <?= $continent["continent_id"]?>-<?= $continent["continent_libelle"]?>
            </label>
            </div>
          <?php endforeach;?>
      </fieldset>
      <input type="hidden" name="animal_id" value="<?= $animal[0]["animal_id"];?>"/>
      <button type="submit" class="btn btn-primary mt-2">Modifier</button>
    </form>
</div>
<?php
$content = ob_get_clean();
$titre = "Page modification animal : ".$animal[0]['animal_nom'];
require "views/commons/template.php";