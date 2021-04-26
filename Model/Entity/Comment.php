<?php


namespace Model\Entity;


class Comment{
    private ?int $id;
    private ?string $content;
    private ?int $date;
    private ?User $user;
    private ?Article $article;

    /**
     * Comment constructor.
     * @param int|null $id
     * @param string|null $content
     * @param int|null $date
     * @param Article|null $article
     * @param User|null $user
     */
    public function __construct(int $id = null, string $content = null, int $date = null,Article $article = null, User $user = null)    {
        $this->id = $id;
        $this->content = $content;
        $this->date = $date;
        $this->article = $article;
        $this->user = $user;
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
     * @param int|null $id
     * @return Comment
     */
    public function setId(?int $id): Comment    {
        $this->id = $id;
        return $this;
    }

    /**
     * return the content
     * @return string
     */
    public function getContent(): string    {
        return $this->content;
    }

    /**
     * set the content
     * @param string $content
     * @return Comment
     */
    public function setContent(string $content): Comment    {
        $this->content = $content;
        return $this;
    }

    /**
     * return the date
     * @return int
     */
    public function getDate(): int    {
        return $this->date;
    }

    /**
     * set the date
     * @param int $date
     * @return Comment
     */
    public function setDate(int $date): Comment    {
        $this->date = $date;
        return $this;
    }

    /**
     * get the User
     * @return User|null
     */
    public function getUser(): ?User    {
        return $this->user;
    }

    /**
     * set the User
     * @param User|null $user
     * @return Comment
     */
    public function setUser(User $user): Comment    {
        $this->user = $user;
        return $this;
    }

    /**
     * get the Article
     * @return Article|null
     */
    public function getArticle(): ?Article    {
        return $this->article;
    }

    /**
     * set the Article
     * @param Article|null $article
     * @return Comment
     */
    public function setArticle(Article $article): Comment    {
        $this->article = $article;
        return $this;
    }
}