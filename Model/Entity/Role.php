<?php

namespace Model\Entity;

class Role extends Entity {
    private ?string $name;

    /**
     * Role constructor.
     * @param string|null $name
     * @param int|null $id
     */
    public function __construct( int $id = null, string $name = null)    {
        parent::__construct($id);
        $this->name = $name;
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