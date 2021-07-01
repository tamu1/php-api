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
       // public $name;
        //public $email;
        //public $age;
       // public $designation;
        //public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getTutorial(){
            $sqlQuery = "SELECT id,title,description FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createTutorials(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET 
                        title = :title, 
                        description = :description";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->title));
            $this->email=htmlspecialchars(strip_tags($this->description));
           // $this->age=htmlspecialchars(strip_tags($this->age));
           // $this->designation=htmlspecialchars(strip_tags($this->designation));
           // $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":description", $this->description);
            //$stmt->bindParam(":age", $this->age);
            //$stmt->bindParam(":designation", $this->designation);
            //$stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
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
            
            $this->title = $dataRow['title'];
            $this->description = $dataRow['description'];
            //$this->age = $dataRow['age'];
            //$this->designation = $dataRow['designation'];
            //$this->created = $dataRow['created'];
        }        

        // UPDATE
        public function updateTutorial(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        title = :title, 
                        description = :description 
                
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->title));
            $this->email=htmlspecialchars(strip_tags($this->description));
            //$this->age=htmlspecialchars(strip_tags($this->age));
            //$this->designation=htmlspecialchars(strip_tags($this->designation));
            //$this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":description", $this->description);
            //$stmt->bindParam(":age", $this->age);
            //$stmt->bindParam(":designation", $this->designation);
           // $stmt->bindParam(":created", $this->created);
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