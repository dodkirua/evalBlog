<?php


namespace Controller\Classes;

use Controller\Traits\BaseViewTrait;


class HomeController{

    use BaseViewTrait;

    public function connectPage() {
        $this->render('connect','Page de connection');
    }
}