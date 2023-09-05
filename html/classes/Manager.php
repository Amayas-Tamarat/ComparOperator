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

    public function createTourOperator(TourOperator $tourOperator):TourOperator
    {

        return $tourOperator;
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

    public function getCertificate($idTourOperator)
    {

    }

    public function displayAllDestination():void
    {
        $destinations = $this->getAllDestination();

        foreach ($destinations as $destination) {
            echo '<div>';
            echo 'id =' . $destination->getId() . '<br>';
            echo 'location =' . $destination->getLocation() . '<br>';
            echo 'price =' . $destination->getPrice() . '<br>';
            echo '</div>';
        }
    }

    public function getOperatorByDestination(Destination $destination):array
    {
        $id= $destination->getId();
        $statement = $this->getDb()->prepare('SELECT * FROM destination JOIN tour_operator 
        ON destination.tour_operator_id = tour_operator.id  WHERE tour_operator_id = :id');
        $statement->bindParam('id', $id, PDO::PARAM_INT);
        $statement->execute();
        $operators = $statement->fetchAll();

        $listeOperators = [];
        foreach($operators as $operator){
            $listeOperators[] = $operator;
        }
        return $listeOperators;
    }
 
    public function addDestination(Destination $destination):void
    {
        $req = $this->getDb()->prepare("INSERT INTO destination (location, price, tour_operator_id) 
        VALUES (:location, :price, :tour_operator_id)");
        if($req->execute(array(
            'location'=>$destination->getLocation(),
            'price'=>$destination->getPrice(),
            'tour_operator_id'=>$destination->getId()
        )));
        
    }
    public function removeDestination($idDestination):void
    {
        $sql = "DELETE FROM destination WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    }
}