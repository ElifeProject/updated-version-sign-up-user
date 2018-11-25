<?php
//object:user
 class User{
 	//data base connection and user name
 	 private $conn;
 	 private $table_name = "users";
 	 //properties of object
 	 public $id;
 	 public $firstname;
 	 public $lastname;
 	 public $email;
 	 public $password;
 	 public $phone;
 	 public $access_level;
 	 public $status;

   //constructor
 	 public function __construct($db){
 	 	$this->conn = $db;
 	 }

 	  function emailExists(){
 	 	//query to check if email exists
 	 	$query = "SELECT id, firstname, lastname,  access_level , password,status FROM " . $this->table_name ." WHERE email =? LIMIT 0, 1";

 	 	//prepare query 
 	 	$stmt = $this->conn->prepare($query);
 	 	$this->email = htmlspecialchars(strip_tags($this->email));

        //bind email
        $stmt->bindParam(1, $this->email);
        //execute query
        $stmt->execute();
        // getting numer of rows
        $num = $stmt->rowCount();

        //if email exists
        if($num>0){

        	//get records details / values
        	$row= $stmt->fetch(PDO::FETCH_ASSOC);
            //print_r($row);

        	//assign values to properties of object
        	$this->id = $row['id'];
        	$this->firstname = $row['firstname'];
        	$this->latstname = $row['lastname'];
        	$this->access_level = $row['access_level'];
        	$this->password = $row['password'];
        	$this->status = $row['status'];
             
            //return true if email  exists in database
            return true ;
        }
         //return false if email  does not exists in database
            return false ;
 	 }

 	 public function create(){
 	 	$query = "INSERT INTO  
 	 	            " . $this->table_name .  "
 	 	        SET 
 	 	            firstname = :firstname,
 	 	            lastname = :lastname,
 	 	            email = :email,
 	 	            password = :password,
 	 	            phone = :phone,
 	 	            access_level = :access_level,
 	 	            status = :status";

                //preparing query
 	 	$stmt = $this->conn->prepare($query);

 	 	$this->firstname=htmlspecialchars(strip_tags($this->firstname));
 	 	$this->lastname=htmlspecialchars(strip_tags($this->lastname));
 	 	$this->email=htmlspecialchars(strip_tags($this->email));
 	 	$this->password=htmlspecialchars(strip_tags($this->password));
 	 	$this->phone=htmlspecialchars(strip_tags($this->phone));
 	 	$this->access_level=htmlspecialchars(strip_tags($this->access_level));
 	 	$this->status=htmlspecialchars(strip_tags($this->status));

        //biind values
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':email', $this->email);
        
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':access_level', $this->access_level);
        $stmt->bindParam(':status', $this->status);
                 
        //execute query
       if($stmt->execute()){
            return true;
        }
        else{
            $this->showError($stmt);
            return false;
        }
 	 }

 	 public function showError($stmt){
 	 	echo "<pre>";
 	 	    print_r($stmt->errorInfo());
 	 	echo "</pre>";
 	 }
 }
?>