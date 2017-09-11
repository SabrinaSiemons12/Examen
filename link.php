      <ul class="navbar-nav">
          <a class="login"  href='index.php?content=account'>
              <i class="user"> </i> 
              <li class="user_desc">Account</li>
          </a>
<?php

	if (isset($_SESSION['role']))
	{
		echo "<li><a href='index.php?content=logout'>Logout</a></li>";
		switch ($_SESSION['role'])
		{  
            	case "admin":
				echo "<li><a href='index.php?content=adminHomepage'>
                       Gegevens
                      </a>
                      </li>
                    ";
                break;
				case "root":
				echo "<li><a href='index.php?content=rootHomepage'>
                        Gegevens
                        </a>
                      </li>";
                 break;
                case "customer":
               		echo "<li><a href='index.php?content=customerHomepage'>
                        Gegevens
                        </a>
                      </li>
                      <li><a href='index.php?content=favorieten'>
                        Favorieten
                        </a>
                      </li>";
			break;
            	case "verkoppleidster":
				echo "<li><a href='index.php?content=verkoopleidsterHomepage'>
                        Gegevens
                        </a>
                      </li>"; 
		}
	}
	else
	{
	 echo "";
	}
?>
          
          
          
          
</ul>