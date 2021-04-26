<?php

namespace Model\Entity;

class User{
    private ?int $id;
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
        $this->id = $id;
        $this->username = $username;
        $this->mail = $mail;
        $this->pass = $pass;
        $this->role = $role;
    }

    /**
     * get the Id
     * @return int|null
     */
    public function getId(): ?int    {
        return $this->id;
    }

    /**
     * set the Id
     * @param int|null $id
     * @return User
     */
    public function setId(?int $id): User    {
        $this->id = $id;
        return $this;
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


}