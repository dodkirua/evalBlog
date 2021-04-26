<?php

namespace Model\Manager;

use DateTime;
use Model\DB;
use Model\Entity\Article;
use Model\Manager\UserManager;
use Model\Manager\Traits\ManagerTrait;
use Model\Entity\User;

class ArticleManager
{

    use ManagerTrait;

    /**
     * return a Article by id
     * @param int $id
     * @return Article
     */
    public function getById(int $id): Article
    {
        $class = new Article();
        $request = DB::getInstance()->prepare("SELECT * FROM article where id = :id");
        $request->bindValue(":id", $id);
        $result = $request->execute();

        if ($result) {
            $data = $request->fetch();
            if ($data) {
                $manager = new UserManager();

                $class->setId($id)
                    ->setTitle($data['title'])
                    ->setContent($data['content'])
                    ->setDate($data['date'])
                    ->setImage($data['image'])
                    ->setUser($manager->getById($data['user_id']));
            }
        }
        return $class;
    }

    /**
     * return a array with all the article
     * @return array
     */
    public function getAll(): array
    {
        $request = DB::getInstance()->prepare("SELECT * FROM article");
        return $this->getTmp($request);
    }

    /**
     * return a array with all the article
     * @param int $userId
     * @return array
     */
    public function getAllByUserId(int $userId): array
    {
        $request = DB::getInstance()->prepare("SELECT * FROM article WHERE user_id = :user");
        $request->bindValue(":user_id", $userId);
        return $this->getTmp($request);
    }

    /**
     * update on DB by id
     * @param int $id
     * @param string|null $title
     * @param string|null $content
     * @param string|null $image
     * @param int|null $userId
     * @return bool
     */
    public function update(int $id, string $title = null, string $content = null, string $image = null, int $userId = null): bool
    {
        // modify the not null values
        if (is_null($content) || is_null($userId)) {
            $data = $this->getById($id);

            if (is_null($content)) {
                $content = $data->getContent();
            }

            if (is_null($userId)) {
                $userId = $data->getUser()->getId();
            }

        }
        $request = DB::getInstance()->prepare("UPDATE article 
                    SET content = :content, image = :img, user_id = :user, title = :title
                    WHERE id = :id
                    ");
        $request->bindValue(":id", $id);
        $request->bindValue(":content", mb_strtolower($content));
        $request->bindValue(":img", mb_strtolower($image));
        $request->bindValue(":title", mb_strtolower($title));
        $request->bindValue(":user", $userId);

        return $request->execute();
    }

    /**
     * insert data in DB
     * @param string $content
     * @param int $userId
     * @param string|null $image
     * @param string|null $title
     * @return bool
     */
    public function insert(string $content, int $userId, string $image = null, string $title = null): bool
    {
        $date = new DateTime();
        $request = DB::getInstance()->prepare("INSERT INTO article 
                    (title, content, date, image, user_id)
                    VALUES (:title, :content, :date, :img, :user)
                    ");
        $request->bindValue(":title", mb_strtolower($title));
        $request->bindValue(":content", mb_strtolower($content));
        $request->bindValue(":img", mb_strtolower($image));
        $request->bindValue(":date", $date->getTimestamp());
        $request->bindValue(":user", $userId);

        return $request->execute();
    }

    /**
     * delete a article by id
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool {
        // delete the comment of this article
        $manager = new CommentManager();
        $array = $manager->getAllByArticle($id);
        foreach ($array as $item){
            $manager->delete($item['id']);
        }
        $request = DB::getInstance()->prepare("DELETE FROM article WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }

    /**
     * return a array for use in other getAll
     * @param $request
     * @return array
     */
    private function getTmp($request): array
    {
        $classes = [];
        $result = $request->execute();

        if ($result) {
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $item) {
                    $manager = new RoleManager();

                    $class = new Article(intval($item['id']), $item['title'], $item['content'], $item['date'], $item['image'], $manager->getById($data['role_id']));
                    $classes[] = $class;
                }
            }
        }
        return $classes;
    }
}