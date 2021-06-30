<?php
    class Tutorial{

        // Connection
        private $conn;

        // Table
        private $db_table = "tutorials";

        // Columns
        public $id;
        public $title;
        public $description;
    

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getTutorial(){
            $sqlQuery = "SELECT id, title, description FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createTutorials(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id= :id, 
                        title = :title, 
                        description = :description";
                    
        
            $stmt = $this->conn->prepare($sqlQuery);
            
        
            // sanitize
           // $this->id=htmlspecialchars(strip_tags($this->id));
            $this->title=htmlspecialchars(strip_tags($this->title));
            $this->description=htmlspecialchars(strip_tags($this->description));
            
        
            // bind data
           // $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":description", $this->description);
            
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleTutorial(){
            $sqlQuery = "SELECT
                        id, 
                        title, 
                        description
                        
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);
            

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->id = $dataRow['id'];
            $this->title = $dataRow['title'];
            $this->description = $dataRow['description'];
            
        }        

        // UPDATE
        public function updateTutorial(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        id= :id, 
                        title = :title, 
                    description = :description, 
                    
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            
            $this->title=htmlspecialchars(strip_tags($this->title));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":description", $this->description);
            
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteTutorial(){
            
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

