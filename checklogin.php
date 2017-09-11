 <?php
	require_once("./classes/LoginClass.php");
	require_once("./classes/SessionClass.php");
        
	
	if ( !empty($_POST['email']) && !empty($_POST['password']))
	{
		// Als email/password combi bestaat en geactiveerd....
		if (LoginClass::check_if_email_password_exists($_POST['email'], 
													   $_POST['password'],
													   '1'))
		{
			$session->login(LoginClass::find_login_by_email_password($_POST['email'], $_POST['password']));
			
			switch ($_SESSION['role'])
			{
				case 'customer':
					include('customerHomepage.php');
					break;
				case 'root':
					include('rootHomepage.php');
					break;
				case 'admin':
					include('adminHomepage.php');
					break;
                    case 'verkoopleidster':
					include('verkoopleidsterHomepage.php');
					break;
				default :
					include('account.php');			
			}
		}
		else
		{
			echo "Uw email/password combi bestaat niet of uw account is niet geactiveerd.";
				//  header("refresh:4;url=home.php");
		}	
	}
	else
	{
		echo "U heeft een van beide velden niet ingevuld, u wordt doorgestuurd<br>
		naar de inlogpagina. Of uw account is nog niet geactiveerd";
		//header("refresh:5;url=inloggen.php");
	}
?>

        