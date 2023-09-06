<?php
class Destination {
    private int $id;
    private string $location;
    private int $price;
    private string $images;
    private int $tour_operator_id;


    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    public function hydrate($datas)
    {
        if (isset($datas["id"])) {
            $this->setId($datas["id"]);
        }
        if (isset($datas["location"])) {
            $this->setLocation($datas["location"]);
        }
        if (isset($datas["price"])) {
            $this->setPrice($datas["price"]);
        }
        if (isset($datas['images'])) {
            $this->setImages($datas['images']);
        }
        if (isset($datas['tour_operator_id'])) {
            $this->setTour_operator_id($datas['tour_operator_id']);
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
     * Get the value of location
     */ 
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @return  self
     */ 
    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of images
     */ 
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set the value of images
     *
     * @return  self
     */ 
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get the value of tour_operator_id
     */ 
    public function getTour_operator_id()
    {
        return $this->tour_operator_id;
    }

    /**
     * Set the value of tour_operator_id
     *
     * @return  self
     */ 
    public function setTour_operator_id($tour_operator_id)
    {
        $this->tour_operator_id = $tour_operator_id;

        return $this;
    }
}