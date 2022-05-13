<?php ob_start();?>


<?php
$content = ob_get_clean();
$titre = "Page Admin";
require "views/commons/template.php";