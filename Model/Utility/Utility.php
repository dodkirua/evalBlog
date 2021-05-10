<?php


namespace Model\Utility;


class Utility{

    /**
     * function for add a array in $_SESSION
     * @param array $array
     */
    public static function addToSession(array $array) : void{
        foreach ($array as $key => $data) {
            $tmp = null;
            if (is_array($data)){
                foreach ($data as $k =>$datum) {
                    $tmp[$k] = $datum;
                }
            }
            else {
                $tmp = $data;
            }
            $_SESSION[$key] = $tmp;
        }
    }
}