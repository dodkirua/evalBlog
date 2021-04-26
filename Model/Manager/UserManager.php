<?php

namespace Model\Manager;

use Model\DB;
use Model\Entity\Role;
use Model\Manager\RoleManager;
use Model\Manager\Traits\ManagerTrait;
use Model\Entity\User;

class UserManager{

    use ManagerTrait;

    /**
     * return a User by id
     * @param int $id
     * @param bool $pass
     * @return User
     */
    public function getById(int $id,bool $pass = false): User {

        $request = DB::getInstance()->prepare("SELECT * FROM user where id = :id");
        $request->bindValue(":id",$id);
        return $this->getOne($request,$pass);
    }

    /**
     * return User by username
     * @param string $username
     * @return User
     */
    public function getByUsername(string $username): User {

        $request = DB::getInstance()->prepare("SELECT * FROM user where username = :username");
        $request->bindValue(":username",$username);
        return $this->getOne($request,true);
    }

    /**
     * return a array with all the user
     * @return array
     */
    public function getAll() : array {
        $classes = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user");
        $result = $request->execute();

        if ($result){
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $item) {
                    $manager = new RoleManager();

                    $class = new User(intval($item['id']),$item['username'],$item['mail'],'',$manager->getById($data['role_id']));
                    $classes[] = $class;
                }
            }
        }
        return $classes;
    }

    /**
     * update on DB by id
     * @param int $id
     * @param string|null $username
     * @param string|null $mail
     * @param string|null $pass
     * @param int|null $roleId
     * @return bool
     */
    public function update(int $id, string $username = null, string $mail = null, string $pass = null, int $roleId = null): bool    {
        // modify the not null values
        if (is_null($username) || is_null($mail) || is_null($pass) || is_null($roleId) ){
            if (is_null($pass)){
                $data = $this->getById($id,true);
                $pass = $data->getPass();
            }
            else {
                $data = $this->getById($id);

                if (is_null($username)){
                    $username = $data->getUsername();
                }

                if (is_null($mail)){
                    $mail = $data->getMail();
                }

                if (is_null($roleId)) {
                    $roleId = $data->getRole()->getId();
                }
            }
        }
        $request = DB::getInstance()->prepare("UPDATE user 
                    SET username = :name, mail = :mail, pass = :pass, role_id = :role 
                    WHERE id = :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":username",mb_strtolower($username));
        $request->bindValue(":mail",mb_strtolower($mail));
        $request->bindValue(":pass",$pass);
        $request->bindValue(":role",$roleId);

        return $request->execute();
    }

    /**
     * insert data in DB
     * @param string $username
     * @param string $mail
     * @param string $pass
     * @param int $roleId
     * @return bool
     */
    public function insert(string $username, string $mail,string $pass,int $roleId) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO user 
                    (username, mail, pass, role_id)
                    VALUES (:username, :mail, :pass, :role)
                    ");
        $request->bindValue(":username",mb_strtolower($username));
        $request->bindValue(":mail",mb_strtolower($mail));
        $request->bindValue(":pass",$pass);
        $request->bindValue(":role",$roleId);
        return $request->execute();
    }

    /**
     * delete a article by id
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool {
        // update the article and comment for this user and replace by casper
        $CommentManager = new CommentManager();
        $array = $CommentManager->getAllByUser($id);
        foreach ($array as $item){
            $CommentManager->update($item['id'],'','',4);
        }

        $articleManager = new ArticleManager();
        $array = $articleManager->getAllByUserId($id);
        foreach ($array as $item){
            $articleManager->update($item['id'],'','','',4);
        }

        $request = DB::getInstance()->prepare("DELETE FROM user WHERE id = :id");
        $request->bindValue(':id',$id);
        return $request->execute();
    }

    /**
     * private request for the getBy
     * @param $request
     * @param bool $pass
     * @return User
     */
    private function getOne($request ,bool $pass = false) : User {
        $class = new User();
        $result = $request->execute();

        if ($result){
            $data = $request->fetch();
            if ($data) {
                $manager = new RoleManager();

                $class->setId($data['id'])
                    ->setUsername($data['username'])
                    ->setMail($data['mail'])
                    ->setRole($manager->getById($data['role_id']))
                ;
                if ($pass){
                    $class->setPass($data['pass']);
                }
                else {
                    $class->setPass('');
                }
            }
        }
        return $class;
    }
}