<?php

namespace Model\Manager;

use Model\DB;
use Model\Manager\Traits\ManagerTrait;
use Model\Entity\Role;

class RoleManager{

    use ManagerTrait;

    /**
     * return a Role by id
     * @param int $id
     * @return Role
     */
    public function getById(int $id): Role {
        $class = new Role();
        $request = DB::getInstance()->prepare("SELECT * FROM role where id = :id");
        $request->bindValue(":id",$id);
        $result = $request->execute();

        if ($result){
            $data = $request->fetch();
            if ($data) {
                $class->setId($id);
                $class->setName($data['name']);
            }
        }
        return $class;
    }

    /**
     * return a array with all the role
     * @return array
     */
    public function getAll() : array {
        $classes = [];
        $request = DB::getInstance()->prepare("SELECT * FROM role");
        $result = $request->execute();

        if ($result){
            $data = $request->fetchAll();
            if ($data) {
                foreach ($data as $item) {
                    $class = new Role(intval($item['id']),$item['name']);
                    $classes[] = $class;
                }
            }
        }
        return $classes;
    }

    /**
     * update on DB by id
     * @param int $id
     * @param string|null $name
     * @return bool
     */
    public function update(int $id, string $name = null): bool    {
        // modify the not null values
        if (is_null($name)){
            $data = $this->getById($id);
            $name = $data->getName();
        }
        $request = DB::getInstance()->prepare("UPDATE role 
                    SET name = :name 
                    WHERE id = :id
                    ");
        $request->bindValue(":id",$id);
        $request->bindValue(":name",mb_strtolower($name));
        return $request->execute();
    }

    public function insert(string $name) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO role 
                    (name)
                    VALUES (:name)
                    ");
        $request->bindValue(":name",mb_strtolower($name));
        return $request->execute();
    }
}