<?php
session_start();

require_once 'import.php';

use Controller\Classes\PageController;

if(isset($_GET['controller'])) {
    //with parameter controller
    switch ($_GET['controller']){
        case 'form'  :
            switch ($_GET['action']){
                case 'connect':

                default :
                    break;
            }
            break;
        case 'passForgot' :
            pre("pass oublié");
            break;
        case 'connect' :
            $controller = new PageController();
            $controller->connectPage();
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
    $controller = new PageController();

    $controller->homePage();
}
