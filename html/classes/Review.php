<?php

class Review {
    private int $id;
    private string $message;
    private string $author;

    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    public function hydrate($datas)
    {
        if (isset($datas["id"])) {
            $this->setId($datas["id"]);
        }
        if (isset($datas["message"])) {
            $this->setMessage($datas["message"]);
        }
        if (isset($datas["name"])) {
            $this->setAuthor($datas["name"]);
        }
        
    }
    /**
     * Get the value of id
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of author
     */ 
    public function getAuthor(): string 
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @return  self
     */ 
    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }
}