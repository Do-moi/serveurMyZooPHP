<?php ob_start();?>

<div class="container">
    <form method="POST" action="<?= URL ?>back/connexion">
      <fieldset>
        <div class="form-group">
          <label for="login" class="form-label mt-4">Login</label>
          <input type="text" class="form-control" id="login" name="login" aria-describedby="loginHelp" placeholder="Enter login" required>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
          <input type="password" class="form-control" id="Password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Valider</button>
      </fieldset>
    </form>
</div>
<?php
$content = ob_get_clean();
$titre = "Login";
require "views/commons/template.php";