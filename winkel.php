<?php
 require_once("connect_db.php");
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
	<!-- start gallery  -->
			<div class="gallery1">
					<div class="container">
			
                        
			<div id="portfoliolist">
                   <?php
        //zorgt dat de gegevens uit de database terecht komen op de pagina
        $query = $db->query("SELECT * FROM product ORDER BY id ");
        if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){
        ?>
			<div class="portfolio logo" data-cat="logo">
							<div class="portfolio-wrapper">	
					<a  href="details.php?action=<?php echo $row["id"]; ?>">
						   <img src="images/<?php echo $row['picture']?>.jpg" class="productImage">
					</a>
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
                            <p class="lead"><?php echo '€ '.$row["price"]; ?></p>
                        </div>
                        <div class="col-md-6">
                            <a class="button" href="cartAction.php?action=addToCart&id=<?php echo $row["id"]; ?>">In winkelwagen</a>
                            
                        </div>
                    </div>
             
                  <?php } }else{ ?>
        <p>Geen producten gevonden....</p>
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