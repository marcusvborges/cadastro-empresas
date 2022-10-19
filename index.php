<?php 
  
    require __DIR__.'/vendor/autoload.php';

    //use App\Controller\LoginController;
    require_once 'app/Controller/GenericController.php';
    require_once 'app/UrlConfig/Url.php';
    require_once 'app/Controller/LoginController.php';
    require_once 'app/Controller/CadastroController.php';

    $url = new Url;
    $url->start($_GET);
?>