<?php


namespace Controller;

require_once '../dev/functionDev.php';

use \Model\Manager\UserManager;



if (isset($_POST['username']) && isset($_POST['pass'])){
    $manager = new UserManager();

    $username = mb_strtolower($_POST['username']);
    $pass = $_POST['pass'];
    $user = $manager->getByUsername($username);

}
else {
    echo "pas de POST";
}