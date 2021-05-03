<?php


namespace Controller\Classes;

use Controller\Traits\BaseViewTrait;
use Model\Manager\ArticleManager;
use Model\Manager\CommentManager;
use Model\Entity\Comment;

class HomeController{

    use BaseViewTrait;

    public function homePage(){
        $articleManager = new ArticleManager();
        $article = $articleManager->getLast();
        $commentManager = new CommentManager();
        $comment = $commentManager->getAllByArticle($article->getId());
        $var['title'] = $article->getTitle();
        $var['content'] = $article->getContent();
        $var['image'] = $article->getImage();
        $var['date'] = $article->getDate();
        $var['user'] = $article->getUser()->getUsername();


        foreach ($comment as $com){

            $var['comment']['user'] = $com->getUser()->getUsername();
            $var['comment']['date'] = $com->getDate();
            $var['comment']['content'] = $com->getContent();
        }
        $this->render('home',"Page d'accueil",$var);
    }

    public function connectPage() {
        $this->render('connect','Page de connection');
    }
}