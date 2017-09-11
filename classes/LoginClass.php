<?php
	require_once("MailingClass.php");
    require_once("connect_db.php");
	class LoginClass
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
		public function setSurname($value) { $this->setSurname = value; }
		public function setPrefix($value) { $this->setPrefix = value; }
		public function setLastname($value) { $this->setLastname = value;}
        public function setAddress($value) { $this->setAddress = value; }
        public function setZipcode($value) { $this->setZipcode = value; }
        public function setResidence($value) { $this->setResidence = value; }
        public function setActivated($value) { $this->activated = $value; }
        public function setRole($value) { $this->role = $value; }
        public function setPassword($value) { $this->password= value; }
		//Constructor
		public function __construct() {}
		//Methods
		/* Hier komen de methods die de informatie in/uit de database stoppen/halen
		*/
		public static function find_by_sql($query)
		{
			// Maak het $database-object vindbaar binnen deze method
			global $database;
			// Vuur de query af op de database
			$result = $database->fire_query($query);
			// Maak een array aan waarin je LoginClass-objecten instopt
			$object_array = array();
			// Doorloop alle gevonden records uit de database
			while ( $row  = mysqli_fetch_array($result))
			{
				// Een object aan van de LoginClass (De class waarin we ons bevinden)
				$object = new LoginClass();
				// Stop de gevonden recordwaarden uit de database in de fields van een LoginClass-object
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
        // Deze functie zorgt er voor dat de email met het wachtwoord van de klant gezocht wordt
		public static function find_login_by_email_password($email, $password)
		{
			$query = "SELECT *
					  FROM `user`
					  WHERE `email` 	= '".$email."'
					  AND	`password`	= '".$password."'";
			$loginClassObjectArray = self::find_by_sql($query);
			$loginClassObject = array_shift($loginClassObjectArray);
			return $loginClassObject;
		}
        // Deze functie zorgt er voor dat alle gegevens in de datbase terecht komen
		public static function insert_into_database($post)
		{
			global $database;
			date_default_timezone_set("Europe/Amsterdam");
			$datum = date('Y-m-d H:i:s');
			$wachtwoord = ($post['email'].date('Y-m-d H:i:s'));
			$query = "INSERT INTO `user`  (                                    `email`,
										   `surname`,
										   `prefix`,
										   `lastname`, 
                                           `address`,
                                            `zipcode`,
                                           `residence`,
                                            `activated`,
                                           `role`,
                                          `password`)
					  VALUES			  (  '".$post['email']."',
										 '".$post['surname']."',
                                         '".$post['prefix']."',
                                         '".$post['lastname']."',
                                         '".$post['address']."',
                                         '".$post['zipcode']."',
                                         '".$post['residence']."',
                                         FALSE,
                                         'customer',
                                         '".$post['password']."')";
			$database->fire_query($query);
			$last_id = mysqli_insert_id($database->getDb_connection());
			//self::send_email($email, $post, $password);
			echo "Uw gegevens zijn verwerkt.";
			 //header("refresh:3;url=index.php?content=algemeneHomepage");
		}
        // Deze functie zoekt of een email bestaat van de klant
		public static function check_if_email_exists($email)
		{
			global $database;
			$query = "SELECT `email`
					  FROM	 `user`
					  WHERE	 `email` = '".$email."'";
			$result = $database->fire_query($query);
			//ternary operator
			return (mysqli_num_rows($result) > 0) ? true : false;
		}
        // Deze functie zoekt of een email en het wachtwoord van de klant
		public static function check_if_email_password_exists($email, $password, $activated)
		{	
			var_dump($email);
			var_dump($password);
			var_dump($activated);
			global $database;
			$query = "SELECT `email`, `password`, `activated`
					  FROM	 `user`
					  WHERE	 `email` = '".$email."'
					  AND	 `password` = '".$password."'";
			$result = $database->fire_query($query);
			$record = mysqli_fetch_array($result);
			return (mysqli_num_rows($result) > 0 && $record['activated'] == $activated) ? true : false;
		}
        // Deze functie kijkt of het account bestaat
		public static function check_if_activated($email, $password)
		{	
			var_dump($email);
			var_dump($password);
			global $database;
			$query = "SELECT `activated`
					  FROM	 `user`
					  WHERE	 `email` = '".$email."'
					  AND	 `password` = '".$password."'";
			$result = $database->fire_query($query);
			$record = mysqli_fetch_array($result);
			return ( $record['activated']);
		}
        // Deze functie zorgt er voor dat de klant zijn of haar wachtwoord kan updaten
		public static function update_password($email, $password)
		{
			global $database;
			$query = "UPDATE `user`
					  SET	 `password` =	'".$password."'
					  WHERE	 `email`	=	'".$email."'";
			$database->fire_query($query);
			echo "Uw wachtwoord is succesvol gewijzigd.";
			header("refresh:4;url=index.php?content=login_form");
		}
        // Deze functie bekijkt de oude wachtwoorden
		public static function check_old_password($old_password)
		{
			$query = "SELECT *
					  FROM	 `customers`
					  WHERE	 `surname`	=	'".$_SESSION['surname']."'";
			$arrayLoginClassObjecten = self::find_by_sql($query);
			$loginClassObject = array_shift($arrayLoginClassObjecten);
			//var_dump($loginClassObject);
			//echo $loginClassObject->getPassword()."<br>";
			//echo ($old_password);
			if (!strcmp(($oldpassword),$loginClassObject->getPassword()))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
?>