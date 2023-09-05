<?php

class Certificate {
    private string $expiresAt ="";
    private  string $signatory = "";


    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    public function hydrate($datas)
    {
        if (isset($datas["expires_at"])) {
            $this->setExpiresAt($datas["expires_at"]);
        }
        if (isset($datas["signatory"])) {
            $this->setSignatory($datas["signatory"]);
        }
        
    }
    /**
     * Get the value of expiresAt
     */ 
    public function getExpiresAt(): string 
    {
        return $this->expiresAt;
    }

    /**
     * Set the value of expiresAt
     *
     * @return  self
     */ 
    public function setExpiresAt(string $expiresAt): self 
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * Get the value of signatory
     */ 
    public function getSignatory(): string
    {
        return $this->signatory;
    }

    /**
     * Set the value of signatory
     *
     * @return  self
     */ 
    public function setSignatory(string $signatory): self
    {
        $this->signatory = $signatory;

        return $this;
    }
}