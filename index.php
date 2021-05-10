<?php
session_start();

require_once 'import.php';

use Controller\Classes\ConnectController;
use Controller\Classes\PageController;
use Controller\Classes\RegistrationController;
use dev\Dev;

if(isset($_GET['ctrl'])) {
    //with parameter controller
    switch ($_GET['ctrl']){
        case 'form'  :
            switch ($_GET['action']){
                case 'connect':
                    ConnectController::connection();
                    break;
                case 'registration':
                   $return = RegistrationController::registration();
                   if ($return === 1){
                       $returnCon = ConnectController::connection();
                       if ($returnCon === 1) {
                           // retour sur l'espace principal mais connecte
                       }
                       else {
                           //message d'erreur
                       }

                   }
                   else{
                      //message d'erreur
                   }
                    break;
                default :
                    break;
            }
            break;
        case 'passforgot' :
            Dev::pre("pass oublié");
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
