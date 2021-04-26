<?php

require_once 'import.php';

use Controller\Classes\HomeController;

if(isset($_GET['controller'])) {
    //with parameter controller
}
else {
    $controller = new HomeController();
    $controller->connectPage();
}
