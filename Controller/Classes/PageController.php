<?php


namespace Controller\Classes;


use DateTime;
use dev\Dev;
use Model\Manager\ArticleManager;
use Model\Manager\CommentManager;
use Model\Utility\Utility;


class PageController extends Controller {

    public static function homePage(){
        $date = new DateTime();

        /*$article = (new ArticleManager())->getLast()->getAll();
        Dev::pre($article);
        /*$comment = (new CommentManager())->getAllByArticle($article['id']);
        /*$date->setTimestamp($article['date']);
        $article['date'] = $date->format("d/m/Y \à H\hi");
        $article['user'] = $article['user']->getUsername();
        foreach ($comment as $com){
            $tab = $com->getAll();
            $date->setTimestamp(intval($com->getDate()));
            $tab['date'] = $date->format("d/m/Y \à H\hi");
            $article['comment'][] = $tab;

        }*/

        self::render('home',"Page d'accueil");
    }

    /**
     * Display connect page
     */
    public static function connectPage() {
       self::render('connect','Page de connection');
    }

    /**
     * display the registration page
     */
    public static function registrationPage(){
        self::render('registration','Enregistrez vous');
    }
}