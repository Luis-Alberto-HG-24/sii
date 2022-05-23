<?php error_reporting(E_ALL ^ E_NOTICE);?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        session_start();
        require_once 'app/config.app.php';
        require_once 'app/dependencias.app.php';
        require_once 'app/router.app.php';    
        require_once 'model/token/token.model.php'; 
    ?>
</head>
<body>
    <?php require_once 'view/main/loader.view.php';?>
    <div class="min-vh-100 d-flex flex-column justify-content-between">
        <div>
            <?php 
                require_once 'view/main/header.view.php';
                Router::direccion();
            ?>
        </div>
        <?php require_once 'view/main/footer.view.php';?>
    </div>
</body>
</html>