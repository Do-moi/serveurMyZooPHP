<?php ob_start();?>
<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Famille</th>
                <th scope="col">Description</th>
                <th scope="col" colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($familles as $famille) : ?>
            <?php if(empty($_POST["famille_id"]) || $_POST["famille_id"] !== $famille['famille_id']) : ?>
                <tr>
                    <td><?= $famille['famille_id'] ?></td>
                    <td><?= $famille['famille_libelle'] ?></td>
                    <td><?= $famille['famille_description'] ?></td>
                    <td>
                        <form method="POST" action="">
                            <button type="submit" class="btn btn-success">Modifier</button>
                            <input type="hidden" name="famille_id" value="<?= $famille["famille_id"]?>" />
                        </form>
                    </td>
                    <td>
                        <form method="post" action="<?= URL ?>back/familles/validationSuppression" onsubmit="return confirm('Voulez-vous vraiment supprimer ?')">
                            <input type="hidden" name="famille_id" value="<?= $famille["famille_id"]?>" />
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php else : ?>
                <form method="POST" action="<?= URL ?>back/familles/validationModification">
                    <tr>
                        <td><?= $famille['famille_id'] ?></td>
                        <td><input type="text" name="famille_libelle" value="<?= $famille['famille_libelle'] ?>" class="form-control"/></td>
                        <td ><textarea  name="famille_description" value="<?= $famille['famille_description'] ?>" rows="3" class="form-control"><?= $famille['famille_description'] ?></textarea></td>
                        <td colspan="2">
                            <button type="submit" class="btn btn-warning">Valider</button>
                            <input type="hidden" name="famille_id" value="<?= $famille["famille_id"]?>" />
                        </td>
                    </tr>
                </form>
            <?php endif; ?>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php
$content = ob_get_clean();
$titre = "Page famille visualisation Admin";
require "views/commons/template.php";