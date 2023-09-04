<?php 

class Manager{
    private PDO $db;


    public function __construct(PDO $db) {
        $this->db = $db;
    }
    /**
     * Get the value of db
     */ 
    public function getDb(): PDO
    {
        return $this->db;
    }

    /**
     * Set the value of db
     *
     * @return  self
     */ 
    public function setDb(PDO $db): self
    {
        $this->db = $db;

        return $this;
    }

    public  function getAllDestination():array
    {
        $statement = $this->getDb()->prepare('SELECT * FROM destination');
        $statement->execute();
        $destinations = $statement->fetchAll();
        $listeDestinations = [];

        foreach($destinations as $destination){
            $desti = new Destination($destination);
            $listeDestinations[] = $desti;
        }
        return $listeDestinations;
    }

 
}