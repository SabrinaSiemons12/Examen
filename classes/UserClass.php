<?php
	require_once('MySqlDatabaseClass.php');
	
	class UsersClass
	{
		//Fields
		private $email;
		private $surname;
		private $prefix;
		private $lastname;
        private $address;
        private $zipcode;
        private $residence;
        private $activated;
        private $role;
        private $password;
        
		//Properties
		//getters
		public function getEmail() { return $this->email;}
        public function getSurname() { return $this->surname;}
        public function getPrefix() { return $this->prefix;}
        public function getLastname() { return $this->lastname;}
        public function getAddress() { return $this->address;}
        public function getZipcode() { return $this->zipcode;}
        public function getResidence() { return $this->residence;}
        public function getActivated() { return $this->activated;}
        public function getRole() { return $this->role;}
        public function getPassword() { return $this->password;}
        

		public function setEmail($value) { $this->email = $value;}
		public function setSurname($value) { $this->setSurname = $value; }
		public function setPrefix($value) { $this->setPrefix = $value; }
		public function setLastname($value) { $this->setLastname = $value;}
        public function setAddress($value) { $this->setAddress = $value; }
        public function setZipcode($value) { $this->setZipcode = $value; }
        public function setResidence($value) { $this->setResidence = $value; }
        public function setActivated($value) { $this->activated = $value; }
        public function setRole($value) { $this->role = $value; }
        public function setPassword($value) { $this->setPassword = $value; }
		
		//Constuctor
		public function __construct() {}
		
		//Methods
		public static function find_by_sql($query)
		{
			// Maak het $database-object vindbaar binnen deze method
			global $database;
			
			// Vuur de query af op de database
			$result = $database->fire_query($query);
			
			// Maak een array aan waarin je UsersClass-objecten instopt
			$object_array = array();
			
			// Doorloop alle gevonden records uit de database
			while ( $row  = mysqli_fetch_array($result))
			{
				// Een object aan van de UsersClass (De class waarin we ons bevinden)
				$object = new UsersClass();
				
				// Stop de gevonden recordwaarden uit de database in de fields van een UsersClass-object
				$object->email			= $row['email'];
                $object->surname		= $row['surname'];
                $object->prefix			= $row['prefix'];
                $object->lastname		= $row['lastname'];
                $object->address		= $row['address'];
                $object->zipcode		= $row['zipcode'];
                $object->residence		= $row['residence'];
                $object->activated		= $row['activated'];
                $object->role  			= $row['role'];
                $object->password		= $row['password'];
                
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		public static function find_info_by_email($email)
		{
			$query = "SELECT 	*
					  FROM 		`user`
					  WHERE		`email`	=	".$email;
			$object_array = self::find_by_sql($query);
			$usersclassObject = array_shift($object_array);
			//var_dump($usersclassObject); exit();
			return $usersclassObject;			
		}
		
		public static function insert_into_database($email, $post)
		{
			global $database;
			$query = "INSERT INTO `user` (`email`,
										   `surname`,
										   `prefix`,
                                           `lastname`,
                                           `address`, 
                                           `zipcode`,
                                           `residence`, 
                                           `activated`,
                                           `role`,
                                           `password`)
					  VALUES			  ('".$email."',
										   '".$post['surname']."',
										   '".$post['prefix']."',
                                           '".$post['lastname']."',
                                           '".$post['address']."',
                                           '".$post['zipcode']."',
                                           '".$post['residence']."',
                                           '".$post['activated']."',
                                           '".$post['role']."',
                                           '".$post['password']."')";
			
			$database->fire_query($query);
		}
        
      
}
?>