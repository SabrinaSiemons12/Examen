                        <?php
 require_once("connect_db.php");
 require_once("./classes/SpeciaalClass.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Orchids</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script src="js/jquery.min.js"></script> 
	<!-- start gallery_sale -->
	<script type="text/javascript" src="js/jquery.easing.min.js"></script>	
	<script type="text/javascript" src="js/jquery.mixitup.min.js"></script>
	<script type="text/javascript">
	$(function () {
		
		var filterList = {
		
			init: function () {
			
				// MixItUp plugin
				// http://mixitup.io
				$('#portfoliolist').mixitup({
					targetSelector: '.portfolio',
					filterSelector: '.filter',
					effects: ['fade'],
					easing: 'snap',
					// call the hover effect
					onMixEnd: filterList.hoverEffect()
				});				
			
			},
			
			hoverEffect: function () {
			
				// Simple parallax effect
				$('#portfoliolist .portfolio').hover(
					function () {
						$(this).find('.label').stop().animate({bottom: 0}, 50, 'easeOutQuad');
						$(this).find('img').stop().animate({top: -30}, 50, 'easeOutQuad');				
					},
					function () {
						$(this).find('.label').stop().animate({bottom: -40}, 50, 'easeInQuad');
						$(this).find('img').stop().animate({top: 0}, 50, 'easeOutQuad');								
					}		
				);				
			
			}

		};
		
		// Run the show!
		filterList.init();
		
		
	});	
	</script>
<!-- start top_js_button -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
   <script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},20);
			});
		});
	</script>
</head>
<body>
<!-- start header -->


<!-- start main -->
<div class="main_bg">
<div class="wrap">	
	<div class="main">
	<!-- start gallery_sale  -->
			<div class="gallery1">
					<div class="container">
			
                        
			<div id="portfoliolist">
                   <?php
                    
                  
                
            $query = $db->query("SELECT * FROM `product` WHERE `dayProduct` = 1 ");
                while($query->fetch_assoc()){
                echo "<b> Dit product is tot 1 uur in de middag met korting beschikbaar <br></b>";
                    
           
    
        $query = $db->query("SELECT * FROM product ORDER BY id ");
        if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){
              
        ?>
			<div class="portfolio logo" data-cat="logo">
							<div class="portfolio-wrapper">	
                               
						   <img src="images/<?php echo $row['picture']?>.jpg" class="productImage">
					<div class="label">
						<div class="label-text">
						   <h4 class="list-group-item-heading"><?php echo $row["name"]; ?></h4>
                    <p class="list-group-item-text"><?php echo $row["price"]; ?></p>  
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>				
		    <div class="row">
                        <div class="col-md-6">
                            <p class="lead"><?php echo 'Naam: '.$row["name"]; ?></p>
                             <p class="lead"><?php echo 'Beschrijving: '.$row["description"]; ?></p>
                             <p class="lead"><?php echo 'Hoogte: '.$row["hight"]; ?></p>
                             <p class="lead"><?php echo 'Kleur: '.$row["color"]; ?></p>
                             <p class="lead"><?php echo 'Aantal takken: '.$row["branch"]; ?></p>
                             <p class="lead"><?php echo 'Potgrootte: '.$row["potsize"]; ?></p>
                             <p class="lead"><?php echo 'Prijs: € '.$row["price"]; ?></p>
                 <?php          
                $query = $db->query("SELECT *, format(`price`,1) * `procentKortingDagProduct`as priceDayProduct FROM `product` WHERE `dayProduct` = '1'");
                    while($row = $query->fetch_assoc()){ 
             
                            ?>
                            <p class="lead"><?php echo 'Prijs: € '.$row["priceDayProduct"]; ?></p>

                        
                        </div>
                        <div class="col-md-6">
                            <a class="button" href="cartAction.php?action=addToCartDiscount&id=<?php echo $row["id"]; ?>">In winkelwagen</a>
                            
                        </div>
                    </div>
                     <?php } ?>
                  <?php } }else{ ?>
        <p>Geen producten gevonden....</p>
        <?php } ?>
           <?php } ?>
   
     
   
        
       
       
                </div>
            </div>
        </div>
      
    </div>
                
            
		</div>	</div><!-- container -->
	<script type="text/javascript" src="js/fliplightbox.min.js"></script>
	<script type="text/javascript">$('body').flipLightBox()</script>
	<div class="clear"> </div>		
<!-- start footer -->

</body>
</html>