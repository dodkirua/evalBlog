<?php


namespace Controller;

use dev\functionDev;


$dev = new functionDev();


if (isset($_POST)){
    $dev->pre($_POST);
}
