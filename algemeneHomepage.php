<?php
// include database configuration file
//include 'dbConfig.php';
//include("./classes/CollectieClass.php");
?>


		<div id="da-slider" class="da-slider">
				<div class="da-slide">
					<h2><?php echo $lang['HEAD_WELCOME']; ?></h2>
					<p><?php echo $lang['TEXT_WELCOME']; ?></p>
					<a href="index.php?content=winkel" class="da-link"><?php echo $lang['SHOP']; ?></a>
					<div class="da-img"><img src="images/w1.png" alt="image01" /></div>
				</div>
				<div class="da-slide">
					<h2><?php echo $lang['HEAD_PLANTATION']; ?></h2>
					<p><?php echo $lang['TEXT_PLANTATION']; ?></p>
					<a href="index.php?content=winkel" class="da-link"><?php echo $lang['SHOP']; ?></a>
					<div class="da-img"><img src="images/w2.png" alt="image01" /></div>
				</div>
				<div class="da-slide">
					<h2><?php echo $lang['HEAD_SENDING']; ?></h2>
					<p><?php echo $lang['TEXT_SENDING']; ?></p>
					<a href="index.php?content=winkel" class="da-link"><?php echo $lang['SHOP']; ?></a>
					<div class="da-img"><img src="images/w3.png" alt="image01" /></div>
				</div>
				<div class="da-slide">
					<h2><?php echo $lang['HEAD_QUALITY']; ?></h2>
					<p><?php echo $lang['TEXT_QUALITY']; ?></p>
					<a href="index.php?content=winkel" class="da-link"><?php echo $lang['SHOP']; ?></a>
					<div class="da-img"><img src="images/w4.png" alt="image01" /></div>
				</div>
				<nav class="da-arrows">
					<span class="da-arrows-prev"></span>
					<span class="da-arrows-next"></span>
				</nav>
			</div>
        
<!----start-cursual---->
<div class="wrap">
<!----start-img-cursual---->
	<div id="owl-demo" class="owl-carousel">
		<div class="item" onclick="location.href='winkel.php';">
			<div class="cau_left">
				<img class="lazyOwl" data-src="images/c1.jpg" alt="Lazy Owl Image">
			</div>
			<div class="cau_left">
				<h4><a href="index.php?content=winkel"><?php echo $lang['OWL_WHITE']; ?></a></h4>
				<a href="index.php?content=winkel" class="btn"><?php echo $lang['SHOP']; ?></a>
			</div>
		</div>	
		<div class="item" onclick="location.href='winkel.php';">
			<div class="cau_left">
				<img class="lazyOwl" data-src="images/c2.jpg" alt="Lazy Owl Image">
			</div>
			<div class="cau_left">
				<h4><a href="index.php?content=winkel"><?php echo $lang['OWL_YELLOW']; ?></a></h4>
				<a href="index.php?content=winkel" class="btn"><?php echo $lang['SHOP']; ?></a>
			</div>
		</div>	
		<div class="item" onclick="location.href='winkel.php';">
			<div class="cau_left">
				<img class="lazyOwl" data-src="images/c3.jpg" alt="Lazy Owl Image">
			</div>
			<div class="cau_left">
				<h4><a href="index.php?content=winkel"><?php echo $lang['OWL_PINK']; ?></a></h4>
				<a href="index.php?content=winkel" class="btn"><?php echo $lang['SHOP']; ?></a>
			</div>
		</div>	
		<div class="item" onclick="location.href='winkel.php';">
			<div class="cau_left">
				<img class="lazyOwl" data-src="images/c4.jpg" alt="Lazy Owl Image">
			</div>
			<div class="cau_left">
				<h4><a href="index.php?content=winkel"><?php echo $lang['OWL_PURPLE']; ?></a></h4>
				<a href="index.php?content=winkel" class="btn"><?php echo $lang['SHOP']; ?></a>
			</div>
		</div>	
	</div>
	<!----//End-img-cursual---->
</div>
<!-- start main1 -->
<div class="main_bg1">
<div class="wrap">	
	<div class="main1">
		<h2><?php echo $lang['PRODUCTS']; ?></h2>
	</div>
</div>
</div>
<!-- start main -->
<div class="main_bg">
<div class="wrap">	
	<div class="main">
		<!-- start grids_of_3 -->
		<div class="grids_of_3">
			<div class="grid1_of_3">
				<a href="index.php?content=winkel">
					<img src="images/pic1.jpg" alt=""/>
					<h3><?php echo $lang['OWL_WHITE']; ?></h3>
					<div class="price">
						<h4><span><?php echo $lang['SHOP']; ?></span></h4>
					</div>
					<span class="b_btm"></span>
				</a>
			</div>
			<div class="grid1_of_3">
				<a href="index.php?content=winkel">
					<img src="images/pic2.jpg" alt=""/>
					<h3><?php echo $lang['OWL_YELLOW']; ?></h3>
					<div class="price">
						<h4><span><?php echo $lang['SHOP']; ?></span></h4>
					</div>
					<span class="b_btm"></span>
				</a>
			</div>
			<div class="grid1_of_3">
				<a href="index.php?content=winkel">
					<img src="images/pic3.jpg" alt=""/>
					<h3><?php echo $lang['OWL_PINK']; ?></h3>
					<div class="price">
						<h4><span><?php echo $lang['SHOP']; ?></span></h4>
					</div>
					<span class="b_btm"></span>
				</a>
			</div>
			<div class="clear"></div>
		</div>
		<div class="grids_of_3">
			<div class="grid1_of_3">
				<a href="index.php?content=winkel">
					<img src="images/pic4.jpg" alt=""/>
					<h3><?php echo $lang['OWL_PURPLE']; ?></h3>
					<div class="price">
						<h4><span><?php echo $lang['SHOP']; ?></span></h4>
					</div>
					<span class="b_btm"></span>
				</a>
			</div>
			<div class="grid1_of_3">
				<a href="index.php?content=winkel">
					<img src="images/pic5.jpg" alt=""/>
					<h3><?php echo $lang['OWL_SPECIAL']; ?></h3>
					<div class="price">
						<h4><span><?php echo $lang['SHOP']; ?></span></h4>
					</div>
					<span class="b_btm"></span>
				</a>
			</div>
			<div class="grid1_of_3">
				<a href="index.php?content=winkel">
					<img src="images/pic6.jpg" alt=""/>
					<h3><?php echo $lang['OWL_VANDA']; ?></h3>
					<div class="price">
						<h4><span><?php echo $lang['SHOP']; ?></span></h4>
					</div>
					<span class="b_btm"></span>
				</a>
			</div>
			<div class="clear"></div>
		</div>	
		<!-- end grids_of_3 -->
	</div>
</div>
</div>	