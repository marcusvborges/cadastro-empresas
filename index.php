<?php 
  
    require __DIR__.'/vendor/autoload.php';

    //use App\Controller\LoginController;
    require_once 'app/Data/Config.php';

    require_once 'app/Controller/GenericController.php';
    require_once 'app/Controller/LoginController.php';
    require_once 'app/Controller/CadastroEmpresasController ';
    require_once 'app/Controller/CadastroController.php';
    require_once 'app/Controller/HomeController.php';
    require_once 'app/UrlConfig/Url.php';   
    require_once 'app/Model/Usuario.php';
    require_once 'app/Model/Empresa.php';
    

    $url = new Url;
    $url->start($_GET);
?>