<?php


namespace Controller\Classes;

use Controller\Traits\BaseViewTrait;
use Model\Manager\ArticleManager;
use Model\Manager\CommentManager;
use Model\Entity\Comment;

class PageController{

    use BaseViewTrait;

    public function homePage(){
        $date = new \DateTime();

        $articleManager = new ArticleManager();
        $article = $articleManager->getLast();
        $commentManager = new CommentManager();
        $comment = $commentManager->getAllByArticle($article->getId());
        $date->setTimestamp(intval($article->getDate()));
        $var['title'] = $article->getTitle();
        $var['content'] = $article->getContent();
        $var['image'] = $article->getImage();
        $var['date'] = $date->format("d/m/Y \à H\hi");
        $var['user'] = $article->getUser()->getUsername();
        $i = 0;
        foreach ($comment as $com){
            $date->setTimestamp(intval($com->getDate()));
            $var['comment'][$i]['user'] = $com->getUser()->getUsername();
            $var['comment'][$i]['date'] = $date->format("d/m/Y \à H\hi");
            $var['comment'][$i]['content'] = $com->getContent();
            $i++;
        }

        $this->render('home',"Page d'accueil",$var);
    }

    public function connectPage() {
        $this->render('connect','Page de connection');
    }
}