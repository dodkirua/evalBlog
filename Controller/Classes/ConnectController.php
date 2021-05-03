<?php


namespace Controller;

use Model\Entity\User;
use Model\Manager\UserManager;

require_once '../../dev/functionDev.php';


class ConnectController {

    public function connection() : void{
        if (isset($_POST['username']) && isset($_POST['pass'])){
            $manager = new UserManager();

            $username = mb_strtolower($_POST['username']);
            $pass = $_POST['pass'];
            $user = $manager->getByUsername($username);
            if (password_verify($pass,$user->getPass())){

            }
            else {
                header("/index.php?e=1");
            }
        }
        else {
            header("/index.php?e=0");
        }
    }
}


