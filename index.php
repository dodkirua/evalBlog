<?php
session_start();

require_once 'import.php';

use Controller\Classes\HomeController;

if(isset($_GET['controller'])) {
    //with parameter controller
    switch ($_GET['controller']){
        case 'form'  :
            switch ($_GET['action']){
                case 'connect':

                    break;
                default :
                    break;
            }
            break;
        case 'passForgot' :
            pre("pass oublié");
            break;
        case 'e':
            switch ($_GET['e']){
                case '0':

                    break;
            }
            break;
        default:
            break;

    }
}
else {
    $controller = new HomeController();

    $controller->homePage();
}
