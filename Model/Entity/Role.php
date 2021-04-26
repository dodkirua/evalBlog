<?php

namespace Model\Entity;

class Role
{
    private ?int $id;
    private ?string $name;

    /**
     * Role constructor.
     * @param string|null $name
     * @param int|null $id
     */
    public function __construct( int $id = null, string $name = null)    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * return the id
     * @return int|null
     */
    public function getId(): ?int    {
        return $this->id;
    }

    /**
     * set the id
     * @param int $id
     * @return Role
     */
    public function setId(int $id): Role    {
        $this->id = $id;
        return $this;
    }

    /**
     * return the name
     * @return string
     */
    public function getName(): string    {
        return $this->name;
    }

    /**
     * set the name
     * @param string $name
     * @return Role
     */
    public function setName(string $name): Role    {
        $this->name = $name;
        return $this;
    }


}