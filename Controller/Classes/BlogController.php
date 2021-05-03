<?php


namespace Controller\Classes;

use Controller\Traits\BaseViewTrait;


class BlogController{

    use BaseViewTrait;

    public function connectPage() {
        $this->render('connect','Page de connection');
    }
}