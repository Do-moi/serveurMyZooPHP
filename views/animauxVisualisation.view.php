<?php ob_start();?>
<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Animal</th>
                <th scope="col">Description</th>
                <th scope="col" colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($animaux as $animal) : ?>
            <tr>
                <td class="align-middle"><?= $animal['animal_id'] ?></td>
                <td>
                    <img src="<?= URL?>public/images/<?= $animal['animal_image'] ?>" alt="" style="width:50px;">
                </td>
                <td  class="align-middle"><?= $animal['animal_nom'] ?></td>
                <td  class="align-middle"><?= $animal['animal_description'] ?></td>
                <td  class="align-middle">
                    <form method="POST" action="<?= URL ?>back/animaux/modification">
                        <button type="submit" class="btn btn-success">Modifier</button>
                        <input type="hidden" name="animal_id"  value="<?= $animal["animal_id"]?>" />
                    </form>
                </td>
                <td class="align-middle">
                    <form method="post" action="<?= URL ?>back/animaux/validationSuppression" onsubmit="return confirm('Voulez-vous vraiment supprimer ?')">
                        <input type="hidden" name="animal_id" value="<?= $animal["animal_id"]?>" />
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php
$content = ob_get_clean();
$titre = "Page Animaux visualisation Admin";
require "views/commons/template.php";