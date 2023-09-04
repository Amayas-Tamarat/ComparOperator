<?php 

class Score{
    private int $id;
    private int $value;
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
        if (isset($datas["value"])) {
            $this->setValue($datas["value"]);
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
     * Get the value of value
     */ 
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @return  self
     */ 
    public function setValue(int $value): self
    {
        $this->value = $value;

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