<?php ob_start();?>
<div class="container">
    <form method="POST" action="<?= URL?>back/familles/creationValidation">
      <div class="form-group">
        <label for="famille_libelle" class="form-label mt-4">Libelle</label>
        <input type="text" class="form-control" id="famille_libelle" name="famille_libelle" placeholder="Libelle">
      </div>
      <div class="form-group">
        <label for="famille_description" class="form-label mt-4">Description</label>
        <textarea class="form-control" id="famille_description" rows="3" name="famille_description" placeholder="texte"></textarea>
      </div>
      <button type="submit" class="btn btn-primary mt-2">Valider</button>
    </form>
</div>
<?php
$content = ob_get_clean();
$titre = "Page Création famille";
require "views/commons/template.php";