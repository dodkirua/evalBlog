<?php
session_start();

require_once 'import.php';

use Controller\Classes\ConnectController;
use Controller\Classes\PageController;
use Controller\Classes\RegistrationController;
use dev\Dev;

if(isset($_GET['controller'])) {
    //with parameter controller
    switch ($_GET['controller']){
        case 'form'  :
            switch ($_GET['action']){
                case 'connect':
                    ConnectController::connection();
                    break;
                case 'registration':
                    RegistrationController::registration();
                    break;
                default :
                    break;
            }
            break;
        case 'passForgot' :
            echo Dev::pre("pass oublié");
            break;
        case 'connect' :
           PageController::connectPage();
            break;
        case 'registration':
            PageController::registrationPage();
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
    PageController::homePage();
}
