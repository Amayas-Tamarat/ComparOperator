<?php

class TourOperator{
    private int $id;
    private string $name;
    private string $link;
    private array $destinations;
    private ?Certificate $certificate = null;
    private array $reviews;
    private array $scores;
    private bool $isPremium;


    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    public function hydrate($datas)
    {
        if (isset($datas["id"])) {
            $this->setId($datas["id"]);
        }
        if (isset($datas["name"])) {
            $this->setName($datas["name"]);
        }
        if (isset($datas["link"])) {
            $this->setLink($datas["link"]);
        }
        if (isset($datas["is_premium"])) {
            $this->setIsPremium($datas["is_premium"]);
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
     * Get the value of name
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of link
     */ 
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * Set the value of link
     *
     * @return  self
     */ 
    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get the value of destinations
     */ 
    public function getDestinations(): array 
    {
        return $this->destinations;
    }

    /**
     * Set the value of destinations
     *
     * @return  self
     */ 
    public function setDestinations(array $destinations): self
    {
        $this->destinations = $destinations;

        return $this;
    }

    /**
     * Get the value of certificate
     */ 
    public function getCertificate(): Certificate|null
    {
        return $this->certificate;
    }

    /**
     * Set the value of certificate
     *
     * @return  self
     */ 
    public function setCertificate(Certificate $certificate): self
    {
        $this->certificate = $certificate;

        return $this;
    }

    /**
     * Get the value of reviews
     */ 
    public function getReviews(): array
    {
        return $this->reviews;
    }

    /**
     * Set the value of reviews
     *
     * @return  self
     */ 
    public function setReviews(array $reviews): self
    {
        $this->reviews = $reviews;

        return $this;
    }

    /**
     * Get the value of scores
     */ 
    public function getScores(): array
    {
        return $this->scores;
    }

    /**
     * Set the value of scores
     *
     * @return  self
     */ 
    public function setScores(array $scores): self
    {
        $this->scores = $scores;

        return $this;
    }

    /**
     * Get the value of isPremium
     */ 
    public function getIsPremium()
    {
        return $this->isPremium;
    }

    /**
     * Set the value of isPremium
     *
     * @return  self
     */ 
    public function setIsPremium($isPremium)
    {
        $this->isPremium = $isPremium;

        return $this;
    }
}