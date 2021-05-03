<?php

namespace Model\Manager;

use DateTime;
use Model\DB;
use Model\Entity\Comment;
use Model\Manager\ArticleManager;
use Model\Manager\UserManager;
use Model\Manager\Traits\ManagerTrait;
use Model\Entity\User;
use Model\Entity\Article;

class CommentManager{

    use ManagerTrait;

    /**
     * return a comment by id
     * @param int $id
     * @return Comment
     */
    public function getById(int $id): Comment {
        $class = new Comment();
        $request = DB::getInstance()->prepare("SELECT * FROM comment where id = :id");
        $request->bindValue(":id",$id);
        $result = $request->execute();

        if ($result){
            $data = $request->fetch();
            if ($data) {
                $articleManager = new ArticleManager();
                $userManager = new UserManager();

                $class->setId($id)
                    ->setContent($data['content'])
                    ->setDate($data['date'])
                    ->setArticle($articleManager->getById($data['article_id']))
                    ->setUser($userManager->getById($data['user_id']))
                ;

            }
        }
        return $class;
    }

    /**
     * return a array with all the comment
     * @return array
     */
    public function getAll() : array {
        $request = DB::getInstance()->prepare("SELECT * FROM user");
        return $this->getTmp($request);
    }

    /**
     * return all comment for a user
     * @param int $userId
     * @return array
     */
    public function getAllByUser(int $userId): array    {
        $request = DB::getInstance()->prepare("SELECT * FROM comment WHERE user_id = :user");
        $request->bindValue(":user",$userId);
        return $this->getTmp($request);
    }

    /**
     * return all comment for an article
     * @param int $articleId
     * @return array
     */
    public function getAllByArticle(int $articleId): array    {
        $request = DB::getInstance()->prepare("SELECT * FROM comment WHERE article_id = :article");
        $request->bindValue(":article",$articleId);
        return $this->getTmp($request);
    }

    /**
     * update on DB by id
     * @param int $id
     * @param string|null $content
     * @param int|null $articleId
     * @param int|null $userId
     * @return bool
     */
    public function update(int $id, string $content = null, int $articleId = null, int $userId = null): bool    {
        // modify the not null values
        if (is_null($content) || is_null($articleId) || is_null($userId) ){

            $data = $this->getById($id);

            if (is_null($content)){
                $content = $data->getContent();
            }

            if (is_null($articleId)){
                $articleId = $data->getArticle()->getId();
            }

            if (is_null($userId)) {
                $userId = $data->getUser()->getId();
            }

        }
        $request = DB::getInstance()->prepare("UPDATE comment 
                    SET content = :content, article_id = :article, user_id = :user 
                    WHERE id = :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":username",mb_strtolower($content));
        $request->bindValue(":article",$articleId);
        $request->bindValue(":user",$userId);

        return $request->execute();
    }

    /**
     * insert data in DB
     * @param string $content
     * @param int $articleId
     * @param int $userId
     * @return bool
     */
    public function insert(string $content , int $articleId , int $userId) : bool {
        $date = new DateTime();
        $request = DB::getInstance()->prepare("INSERT INTO comment 
                    (content, date, article_id, user_id)
                    VALUES (:content, :date, :article, :user)
                    ");
        $request->bindValue(":username",mb_strtolower($content));
        $request->bindValue(":article",$articleId);
        $request->bindValue(":user",$userId);
        $request->bindValue(':date',$date->getTimestamp());

        return $request->execute();
    }

    /**
     * delete a comment by id
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool {
        $request = DB::getInstance()->prepare("DELETE FROM comment WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }

    /**
     * return a array for use in other getAll
     * @param $request
     * @return array
     */
    private function getTmp($request) : array {
        $classes = [];
        $result = $request->execute();

        if ($result){
            $data = $request->fetchAll();
            if ($data) {

                foreach ($data as $item) {
                    $articleManager = new ArticleManager();
                    $userManager = new UserManager();
                    $article = $articleManager->getById(intval($item['article_id']));

                    $user = $userManager->getById(intval($item['user_id']));

                    $class = new Comment(intval($item['id']), $item['content'], $item['date'], $article , $user );
                    $classes[] = $class;
                }
            }
        }
        return $classes;
    }
}