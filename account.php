<?php

// Hier wordt er verbinding gemaakt met de database, om gegevens er uit te halen.
	if (isset($_POST['submit']))
	{
		require_once("./classes/LoginClass.php");
		if (LoginClass::check_if_email_exists($_POST['email']))
		{
			//Zo ja, geef een melding dat het emailadres bestaat en stuur
			//door naar register_form.php
			echo "Het door u gebruikte emailadres is al in gebruik.<br>
				  Gebruik een ander emailadres. U wordt doorgestuurd naar<br>
				  het registratieformulier";
			header("refresh:2;url=index.php?content=account");
		}
		else
		{
			LoginClass::insert_into_database($_POST);
            // echo "Op naar de loginclass::insert into database!";
		}
        //echo "Er is op de submit knop gedrukt!";
	}
	else
	{
?>
<!DOCTYPE html>
<div class="main_bg">
<div class="wrap">	
	<div class="main">
	<!-- start service -->
        <!--Dit is de login form om als klant te kunnen inloggen -->
	  <div class="service">
		<div class="ser-main">
			<h4>Inloggen</h4>
            	 <form role="form" action='index.php?content=checklogin' method='post'>
				<div class="form-group">
                           
                 <label>Emailadres*</label> 
                 <input class="form-control" type='text' name='email' required="required" placeholder="Emailadres" />
            </div>
                
                <div class="form-group">
                           
                 <label>Wachtwoord*</label> 
                 <input class="form-control" type='password' name='password' required="required" placeholder="Wachtwoord" />
            </div>
                <input type="submit" value="Login"> 
		   </form>
        </div>          
		<div class="clear"></div>
        </div>       
	</div>
</div>
</div>
<div class="main_bg">
<div class="wrap">	
	<div class="main">
	<!-- start service -->
    <!--Dit is de register form om als bezoeker te kunnen aanmelden als klant -->
      <div class="service">
		<div class="ser-main">
			<h4>Registreren</h4>
            <form id="register" method='post'>	
            <div class="form-group">
                 <label>Emailadres*</label> 
                 <input class="form-control" type='text' name='email' required="required" />
            </div>
             <div class="form-group">
			     <label>Naam*</label>
                 <input class="form-control" type='text' name='surname' required="required" />
            </div>
             <div class="form-group">
                 <label>Tussenvoegsel</label>
                 <input class="form-control" type='text' name='prefix'/>
            </div>
             <div class="form-group">
                 <label>Achternaam*</label>
                 <input class="form-control" type='text' name='lastname' required="required" />
            </div>
             <div class="form-group">
                 <label>Wachtwoord*</label>
                 <input class="form-control" type='password' name='password' required="required"/>
            </div>
             <div class="form-group">
                 <label>Adres*</label>
                 <input class="form-control" type='text' name='address' required="required" />
            </div>
             <div class="form-group">
                 <label>Postcode*</label>
                 <input class="form-control" type='text' name='zipcode' required="required"/>
            </div>
             <div class="form-group">
                 <label>Woonplaats*</label>
                 <input class="form-control" type='text' name='residence' required="required" /><br>
            </div>
            <p>* Vereist</p>
			<input type='submit' name='submit' />
		  </form>
        </div>
		<div class="clear"></div>
    </div>
    </div>
    </div>
</div>

<?php
	}
?>

