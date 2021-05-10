<?php


namespace Model\Manager;


class Manager{

    private static $manager = null;

    /**
     * get the Manager
     * @return self
     */
    public static function getManager() : self    {
        if (is_null(self::$manager)){
            self::$manager = new self();
        }
        return self::$manager;
    }


}