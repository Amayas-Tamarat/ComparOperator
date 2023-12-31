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
        $this->addDestinationToOperator($tourOperator);
        $this->addCertificateToOperator($tourOperator);
        $this->addScoreToOperator($tourOperator);
        $this->addReviewtoOperator($tourOperator);

        return $tourOperator;
    }
    public function createAllTourOperator(array $allTourOperators):array
    {
        $listTourOperator=[];
        foreach($allTourOperators as $tourOperator){
            $this->addDestinationToOperator($tourOperator);
            $this->addCertificateToOperator($tourOperator);
            $this->addScoreToOperator($tourOperator);
            $this->addReviewtoOperator($tourOperator);
            $listTourOperator[] = $tourOperator; 
        }
        return $listTourOperator;
    }

    public function findOperatorById($idOperator):TourOperator
    {
        $statement = $this->getDb()->prepare('SELECT * FROM tour_operator WHERE id = :id');
        $statement->bindParam('id', $idOperator, PDO::PARAM_INT);
        $statement->execute();
        $operators = $statement->fetch();
        $tourOperator = new TourOperator($operators);

        return $tourOperator;
    }
    public function findAllTourOperator():array
    {
        $statement = $this->getDb()->prepare('SELECT * FROM tour_operator');
        $statement->execute();
        $operators = $statement->fetchAll();
        
        $listTourOperators = [];
        foreach($operators as $operator)
        {
            $tourOperator = new TourOperator($operator);
            $listTourOperators[] = $tourOperator;
        }

        return $listTourOperators;
    }

    public function addCertificateToOperator(TourOperator $tourOperator):void
    {
        $id = $tourOperator->getId();
        $statement = $this->getDb()->prepare('SELECT * FROM certificate WHERE tour_operator_id = :id');
        $statement->bindParam('id', $id, PDO::PARAM_INT);
        $statement->execute();
        $operators = $statement->fetch();
        
        if($operators != ""){
            $certificate = new Certificate($operators);
            $tourOperator->setCertificate($certificate);
        }

        
    }

    public function addScoreToOperator(TourOperator $tourOperator):void
    {
        $id = $tourOperator->getId();
        $statement = $this->getDb()->prepare('SELECT * FROM score JOIN author 
        ON score.author_id = author.id WHERE tour_operator_id = :id');
        $statement->bindParam('id', $id, PDO::PARAM_INT);
        $statement->execute();
        $scores = $statement->fetchAll();

        $listScores = [];
        foreach($scores as $score)
        {
            $newScore = new Score($score);
            $listScores[] = $newScore;
        }
        $tourOperator->setScores($listScores);
    }

    public function addReviewtoOperator(TourOperator $tourOperator):void
    {
        $id = $tourOperator->getId();
        $statement = $this->getDb()->prepare('SELECT * FROM review JOIN author 
        ON review.author_id = author.id WHERE tour_operator_id = :id');
        $statement->bindParam('id', $id, PDO::PARAM_INT);
        $statement->execute();
        $reviews = $statement->fetchAll();

        $listReviews = [];
        foreach($reviews as $review)
        {
            $newreview = new Review($review);
            $listReviews[] = $newreview;
        }
        $tourOperator->setReviews($listReviews);
    }

    public function addDestinationToOperator(TourOperator $tourOperator):void
    {
        $id = $tourOperator->getId();
        $statement = $this->getDb()->prepare('SELECT * FROM destination WHERE tour_operator_id = :id');
        $statement->bindParam('id', $id, PDO::PARAM_INT);
        $statement->execute();
        $destinations = $statement->fetchAll();

        $listDestinations = [];
        foreach($destinations as $destination)
        {
            $newdestination = new Destination($destination);
            $listDestinations[] = $newdestination;
        }
        $tourOperator->setDestinations($listDestinations);
    }

    public function displayAllDestination():void
    {
        $destinations = $this->getAllDestination();

        foreach ($destinations as $destination) {
            echo '<div>';
            echo 'id =' . $destination->getId() . '<br>';
            echo 'location =' . $destination->getLocation() . '<br>';
            echo 'price =' . $destination->getPrice() . '<br>';
            echo 'images = ' . $destination->getImages() . '<br>';	
            echo '</div>';
        }
    }

    public function getOperatorByDestination(Destination $destination):int
    {
        $id= $destination->getId();
        $statement = $this->getDb()->prepare('SELECT tour_operator_id FROM destination 
        WHERE tour_operator_id = :id');
        $statement->bindParam('id', $id, PDO::PARAM_INT);
        $statement->execute();
        $idOperator = $statement->fetch();

        return $idOperator;
    }
 
    public function createDestination(Destination $destination,$tourOperatorId):void
    {
        $req = $this->getDb()->prepare("INSERT INTO destination (location, price, tour_operator_id) 
        VALUES (:location, :price, :tour_operator_id)");
        if($req->execute(array(
            'location'=>$destination->getLocation(),
            'price'=>$destination->getPrice(),
            'tour_operator_id'=>$tourOperatorId
        )));
        
    }
    public function removeDestination($idDestination):void
    {
        $sql = "DELETE FROM destination WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $idDestination, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            echo "Destination with ID $idDestination has been deleted.";
        } else {
            echo "Error deleting destination with ID $idDestination.";
        }
    }
//bien joué à tous

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

    public function createCertificate(Certificate $certificate, $tourOperatorId){
        $req = $this->getDb()->prepare("INSERT INTO certificate (tour_operator_id, expires_at, signatory) 
        VALUES (:tour_operator_id, :expire_at, :signatory)");
        if($req->execute(array(
            'tour_operator_id' => $tourOperatorId,
            'expire_at' => $certificate->getexpiresAt(),
            'signatory' => $certificate->getsignatory()
        ))) {
            echo "Certificate has been created.";
        } else {
            echo "Error creating certificate.";
        }
    }
    
    public function createTourOperatorDB(TourOperator $tourOperator) {
        $req = $this->getDb()->prepare("INSERT INTO tour_operator (name, link) 
        VALUES (:name, :link)");
        
        if($req->execute(array(
            'name' => $tourOperator->getName(),
            'link' => $tourOperator->getLink()
        ))) {
            echo "Tour Operator has been created.";
        } else {
            echo "Error creating Tour Operator.";
        }
    }

    public function displayReviews(TourOperator $tourOperator)
    {
        foreach($tourOperator->getReviews() as $review)
        {
            echo '<p>'. $review->getAuthor() .' : ' . $review->getMessage() . '</p>';
        }
    }

    public function insertReview(TourOperator $tourOperator, $name, $rate, $comments):void
    {
        $idTourOperator = $tourOperator->getId();
        if($this->getAuthorId($name) != ""){
            $idAuthor = $this->getAuthorId($name);
        }else{
            $idAuthor = $this->insertAuthor($name);
        }
        if(!$this->authorAlreadyPosted($idTourOperator,$idAuthor)){
            $this->insertMessage($idTourOperator,$comments,$idAuthor);
            $this->insertScore($idTourOperator,$rate,$idAuthor);
        }
        
    }

    public function getAuthorId($name):int|null
    {
        $statement = $this->getDb()->prepare('SELECT id FROM author WHERE name = :name');
        $statement->bindParam('name', $name, PDO::PARAM_STR);
        $statement->execute();
        
        $nombre = $statement->fetch();
        if($nombre!="" ){
            return $nombre[0];
        }else 
            return null;
    }

    public function insertAuthor($name):int
    {
        $req = $this->getDb()->prepare("INSERT INTO author (name) VALUES (:name)");
    
        if ($req->execute(array('name' => $name))) {
            return $this->getDb()->lastInsertId();
        }
    }

    public function insertMessage($idTourOperator, $message, $idAuthor):void
    {
        $req = $this->getDb()->prepare("INSERT INTO review (message,tour_operator_id, author_id) 
        VALUES (:message,:tour_operator_id,:author_id)");
    
        $req->execute(array(
            'message' => $message,
            'tour_operator_id' => $idTourOperator,
            'author_id'=>$idAuthor
        )) ; 
    }

    public function insertScore($idTourOperator, $score, $idAuthor):void
    {
        $req = $this->getDb()->prepare("INSERT INTO score (value,tour_operator_id, author_id) 
        VALUES (:value,:tour_operator_id,:author_id)");
    
        $req->execute(array(
            'value' => $score,
            'tour_operator_id' => $idTourOperator,
            'author_id'=>$idAuthor
        )) ; 
    }

    public function authorAlreadyPosted($idTourOperator, $idAuthor):bool
    {
        $statement = $this->getDb()->prepare('SELECT * FROM review 
        WHERE tour_operator_id = :tour_operator_id AND author_id = :author_id');
        $statement->bindParam('tour_operator_id', $idTourOperator, PDO::PARAM_INT);
        $statement->bindParam('author_id', $idAuthor, PDO::PARAM_INT);
        $statement->execute();
        
        $bool = $statement->fetch();

        if($bool){
            return true;
        }else
            return false;
    }

    public function tourNote(TourOperator $tourOperator):int
    {
        $id = $tourOperator->getId();
        $statement = $this->getDb()->prepare('SELECT AVG(value) FROM score WHERE tour_operator_id = :id');
        $statement->bindParam('id', $id, PDO::PARAM_INT);
        $statement->execute();

        $note = $statement->fetch();
        if($note[0] != ""){
            return round($note[0], 0, PHP_ROUND_HALF_UP);
        }else
            return 0;
    }
    public function countNote(TourOperator $tourOperator):int|null
    {
        $id = $tourOperator->getId();
        $statement = $this->getDb()->prepare('SELECT COUNT(*) FROM score WHERE tour_operator_id = :id');
        $statement->bindParam('id', $id, PDO::PARAM_INT);
        $statement->execute();

        $count = $statement->fetch();
        return $count[0];
    }

    public function removeTourOperator($idTourOperator):void
    {
        $sql = "DELETE FROM tour_operator WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $idTourOperator, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            echo "Tour Operator with ID $idTourOperator has been deleted.";
        } else {
            echo "Error deleting the Operator with ID $idTourOperator.";
        }
    }

    public function premium(TourOperator $tourOperator)
    {
        if($tourOperator->getIsPremium())
        {
            echo '<a class="redirect" href="'.$tourOperator->getLink().'">Our Website</a>';
        }
    }

    public function addPremium($idTourOperator)
    {

        $req = $this->getDb()->prepare("UPDATE  tour_operator SET  is_premium = 1 WHERE id = $idTourOperator");
        if ($req->execute(array()));
    }

    public function removePremium($idTourOperator)
    {
        $req = $this->getDb()->prepare("UPDATE  tour_operator SET is_premium = 0 WHERE id = $idTourOperator");
        if ($req->execute(array()));
    }
}