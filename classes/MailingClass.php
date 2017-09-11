<?php
	require_once('MySqlDatabaseClass.php');
	
	class MailingClass
	{
		//Fields
		private $email;
		
		//Properties
		//getters
		public function getEmail() { return $this->email; }
		//setters
		public function setEmail($value) { $this->email = $value; }
		
		
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
				$object = new MailingClass();
				
				// Stop de gevonden recordwaarden uit de database in de fields van een UsersClass-object
				$object->email	= $row['email'];
			
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		public static function insert_into_database($post)
		{
			global $database;
			$query = "INSERT INTO `mailinglist` (`email`)
					  VALUES			  ('".$post['email']."')";
            
            // echo $query;
			
			$database->fire_query($query);
            
            self::send_email($post);
		}
        
        private static function send_email($post)
		{
			$to = $post['email'];
			$subject = "Mailinglist Orchids.";
			$message = "<b>Geachte heer/mevrouw <br>";
												
			$message .= '<style>a { color:red;}</style>';
			$message .= "Hartelijk dank voor het inschrijven op de mailinglist van mijn projectwebsite"."<br>";	
			$message .= "Met vriendelijke groet,"."<br>";
			$message .= "Sabrina Siemons"."<br></b>";
		
			$headers = 'From: no-reply@project.nl'."\r\n";
			$headers .= 'Reply-To: info@project.nl'."\r\n";
			$headers .= 'Cc: admin@project.nl'."\r\n";
			$headers .= 'Bcc: accountant@project.nl'."\r\n";
			//$headers .= "MIME-version: 1.0"."\r\n";
			//$headers .= "Content-type: text/plain; charset=iso-8859-1"."\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1"."\r\n";		
			$headers .= 'X-Mailer: PHP/' . phpversion();
			
			
			mail( $to, $subject, $message, $headers); 
		}
        
        public static function check_if_email_exists($email)
		{
			global $database;
			
			$query = "SELECT `email`
					  FROM	 `mailinglist`
					  WHERE	 `email` = '".$email."'";
					  
			$result = $database->fire_query($query);
			
			//ternary operator
			return (mysqli_num_rows($result) > 0) ? true : false;	
		}
}
?>