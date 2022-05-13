<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://bootswatch.com/5/spacelab/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once("views/commons/menu.php") ;?>
    <h1 class="rounded border border-dark m-2 p-2 text-white text-center bg-info"><?= $titre?></h1>
    <?php if(!empty($_SESSION['alert'])) :?>
        <div class="container">  
            <div class="alert <?= $_SESSION['alert']['type']?>">
                <?= $_SESSION['alert']['message'] ?>
            </div>
        </div>
        <?php unset($_SESSION['alert']) ;?>
    <?php endif;?>
    <?= $content?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>