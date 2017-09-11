<?php
	//session_start();
	class SessionClass
	{
		//Fields
		private $email;
		private $role;
		
		//Properties
		public function getRole() { return $this->role; }
	
		//Constructor
		public function ___construct() {}
	
		public function login($loginObject)
		{
			$this->email = $_SESSION['email'] = $loginObject->getEmail();
			$this->role = $_SESSION['role'] = $loginObject->getRole();
			
			// $usersObject = UsersClass::find_info_by_id($_SESSION['idKlant']);
			// $_SESSION['naam'] = $usersObject->getNaam();
		}
		public function logout()
		{
			session_unset('email');
			session_unset('role');		
			session_destroy();
			unset($this->email);
			unset($this->role);
		}
	}
	
	$session = new SessionClass();
?>