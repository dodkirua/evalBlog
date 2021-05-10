<?php

namespace Model\Entity;

class User extends Entity {
    private ?string $username;
    private ?string $mail;
    private ?string $pass;
    private ?Role $role;

    /**
     * User constructor.
     * @param string|null $username
     * @param string|null $mail
     * @param string|null $pass
     * @param Role|null $role
     * @param int|null $id
     */
    public function __construct( int $id = null, string $username = null, string $mail = null, string $pass = null, Role $role = null)    {
        parent::__construct($id);
        $this->username = $username;
        $this->mail = $mail;
        $this->pass = $pass;
        $this->role = $role;
    }

    /**
     * get the Username
     * @return string
     */
    public function getUsername(): string    {
        return $this->username;
    }

    /**
     * set the Username
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User    {
        $this->username = $username;
        return $this;
    }

    /**
     * get the Mail
     * @return string
     */
    public function getMail(): string    {
        return $this->mail;
    }

    /**
     * set the Mail
     * @param string $mail
     * @return User
     */
    public function setMail(string $mail): User    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * get the Pass
     * @return string
     */
    public function getPass(): string    {
        return $this->pass;
    }

    /**
     * set the Pass
     * @param string $pass
     * @return User
     */
    public function setPass(string $pass): User    {
        $this->pass = $pass;
        return $this;
    }

    /**
     * get the Role
     * @return Role
     */
    public function getRole(): Role   {
        return $this->role;
    }

    /**
     * set the Role
     * @param Role $role
     * @return User
     */
    public function setRole(Role $role): User    {
        $this->role = $role;
        return $this;
    }

    /**
     * return the value in array less pass for security
     * @return array
     */
    public function getAll() : array {
        $array['id'] = $this->getId();
        $array['username'] = $this->getUsername();
        $array['mail'] = $this->getMail();
        $array['pass'] = '';
        return $array['role'] = $this->getRole()->getAll();
    }

}