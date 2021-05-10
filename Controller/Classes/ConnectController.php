<?php


namespace Controller\Classes;

use Model\Entity\User;
use Model\Manager\UserManager;
use Model\Utility\Utility;


class ConnectController extends Controller {

    /**
     * test connection to a user
     * return :
     * 1 : ok
     * -1 : wrong password
     * -2 : $_POST variable problem
     * @return int
     */
    public static function connection() : int{
        if (isset($_POST['username']) && isset($_POST['pass'])){
            $username = mb_strtolower($_POST['username']);
            $pass = $_POST['pass'];
            $user = (new UserManager())->getByUsername($username);
            if (password_verify($pass,$user->getPass())){
                Utility::addToSession($user->getAll());
                return 1;
            }
            else {
                return -1;
            }
        }
        return -2;

    }
}


