<?php


namespace Controller\Classes;

use Model\Entity\User;
use Model\Manager\UserManager;



class ConnectController extends Controller {

    public static function connection() : void{
        if (isset($_POST['username']) && isset($_POST['pass'])){
            $manager = new UserManager();

            $username = mb_strtolower($_POST['username']);
            $pass = $_POST['pass'];
            $user = $manager->getByUsername($username);
            if (password_verify($pass,$user->getPass())){

            }
            else {

            }
        }
        else {

        }
    }
}


