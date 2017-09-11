<?php
include_once 'common.php';
include_once 'connect_db.php';
include("./classes/CollectieClass.php");
// Check connection
?>    
<!DOCTYPE HTML>
<html>
<head>
<title>Orchids</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- start slider -->		
	<link href="css/slider.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript" src="js/modernizr.custom.28468.js"></script>
	<script type="text/javascript" src="js/jquery.cslider.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .container{padding: 50px;}
    input[type="number"]{width: 20%;}
    </style>
    <script>
    function updateCartItem(obj,id){
        $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
            if(data == 'ok'){
                location.reload();
            }else{
                alert('Cart update failed, please try again.');
            }
        });
    }
			</script>
</head>
<body>
<!-- start header -->
<div class="header_bg">
      <?php echo $_SERVER['SERVER_ADDR'];
            include("header.php");?>
           
</div>

<!-- start slider -->
    
    <div class="container">
         <div class="main_bg">
<div class="wrap">	
	<div class="main">
        
   
				
<?php


        
         $query = $db->query("SELECT * FROM product WHERE id = '".$_GET['action']."'");
        if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){
        echo " Naam: " . $row["name"]. "<br>";
        echo " Beschrijving: " . $row["description"]. "<br>";
        echo " Hoogte: " . $row["hight"]. "<br>";
        echo " Kleur: " . $row["color"]. "<br>";
        echo " Hoeveelheid takken: " . $row["branch"]. "<br>";
        echo " Pot grootte: " . $row["potsize"]. "<br>";
        echo " Prijs: " . $row["price"]. "<br>";
        echo " Foto: <img src='images/ ". $row["picture"]. ".jpg'>"."<br>";
    }
} else {
    echo "0 results";
}

?>
        <div class="col-md-6">
             
                            <a class="btn btn-success" href="cartAction.php?action=addToCart&id=<?php echo $row["id"]; ?>">In winkelwagen</a>
    </div>		
    </div>
        </div>
        </div></div>

 <div class="footer_bg">
<div class="wrap">	
	<div class="footer">
		<!-- start grids_of_4 -->	
		<div class="grids_of_4">
			<div class="grid1_of_4">
				<h4>over ons</h4>
				<ul class="f_nav">
					<li><a href="index.php?content=site_map"><?php echo $lang['TAB_SITE_MAP']; ?></a></li>
                    <li><a href="index.php?content=algemene_voorwaarden"><?php echo $lang['TAB_TERMS']; ?></a></li>
                    <li><a href="index.php?content=verzenden"><?php echo $lang['TAB_SENDING']; ?></a></li>
                    <li><a href="index.php?content=retouneren"><?php echo $lang['TAB_RETURN']; ?></a></li>
                    <li><a href="index.php?content=contact"><?php echo $lang['TAB_CONTACT']; ?></a></li>
				</ul>
			</div>
			<div class="grid1_of_4">
                	<h4><?php echo $lang['CONTACT']; ?></h4>
				<ul class="f_nav">
					<p style="color:white"><?php echo $lang['CONTACT_PHONE']; ?></p>
                    <p style="color:white"><?php echo $lang['CONTACT_EMAIL']; ?></p>
                    <p style="color:white"><?php echo $lang['CONTACT_ADDRESS']; ?></p>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
</div>	
<!-- start footer -->
<div class="footer_bg1">
<div class="wrap">
	<div class="footer">
		<!-- scroll_top_btn -->
	    <script type="text/javascript">
			$(document).ready(function() {
			
				var defaults = {
		  			containerID: 'toTop', // fading element id
					containerHoverID: 'toTopHover', // fading element hover id
					scrollSpeed: 1200,
					easingType: 'linear' 
		 		};
				
				
				$().UItoTop({ easingType: 'easeOutQuart' });
				
			});
		</script>
		 <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
		<!--end scroll_top_btn -->
		<div class="copy">
			<p> &copy; 2017 Orchids. All Rights Reserved | Design by Sabrina Siemons</p>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
</body>
</html>
