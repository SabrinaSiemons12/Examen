<div class="wrap">	
<div class="header">
      
          
		<div class="logo">
			<a href="index.php"><img src="images/logo.png" alt=""/> </a>
		</div>
		<div class="h_icon">
		<ul class="icon1 sub-icon1">
			<li><a class="active-icon c1" href="index.php?content=viewCart"></a>
			</li>
		</ul>
		</div>
		<div class="h_search">
    		 <form action="index.php?content=search" method="GET">
                    <input type="text" name="query" />
                 <input type="submit" value="" />
            </form>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="header_btm">
<div class="wrap">
	<div class="header_sub">
		<div class="h_menu">
			<ul>
				<li class="active"><a href="index.php?content=algemeneHomepage"><?php echo $lang['MENU_HOME']; ?></a></li> |
				<li><a href="index.php?content=winkel"><?php echo $lang['MENU_SHOP']; ?></a></li> |
				<li><a href="index.php?content=about_us"><?php echo $lang['MENU_ABOUT_US']; ?></a></li> |
                <li><a href="index.php?content=bestelprocedure"><?php echo $lang['MENU_ORDERING']; ?></a></li> |
				<li><a href="index.php?content=artikelvandedag"><?php echo $lang['MENU_ARTICLE_PAGE']; ?></a></li> |
                <li><a href="index.php?content=specialepagina"><?php echo $lang['MENU_SPECIAL_PAGE']; ?></a></li> |
				<li><a href="index.php?content=search"><?php echo $lang['MENU_SEARCH']; ?></a></li> |
                <li><a href="index.php?content=account"><?php include("link.php"); ?></a></li> | 
				<li><a href="index.php?content=contact"><?php echo $lang['MENU_CONTACT']; ?></a></li> |
                <br>
                <a href="index.php?lang=en"><img src="images/en.png" /></a>
                <a href="index.php?lang=nl"><img src="images/nl.png" /></a>
			</ul>

		</div>
		<div class="top-nav">
	          <nav class="nav">	        	
	    	    <a href="#" id="w3-menu-trigger"> </a>
	                  <ul class="nav-list" style="">
	            	        <li class="nav-item"><a class="active" href="index.php"><?php echo $lang['MENU_HOME']; ?></a></li>
							<li class="nav-item"><a href="collectie.php"><?php echo $lang['MENU_SHOP']; ?></a></li>
							<li class="nav-item"><a href="about_us.php"><?php echo $lang['MENU_ABOUT_US']; ?></a></li>
							<li class="nav-item"><a href="specialepagina.php"><?php echo $lang['MENU_SPECIAL_PAGE']; ?></a></li>
							<li class="nav-item"><a href="service.html"><?php echo $lang['MENU_SEARCH']; ?></a></li>
							<li class="nav-item"><a href="contact.php"><?php echo $lang['MENU_CONTACT']; ?></a></li>
	                 </ul>
	           </nav>
	             <div class="search_box">
				<form>
				   <input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}"><input type="submit" value="">
			    </form>
			</div>
	          <div class="clear"> </div>
	          <script src="js/responsive.menu.js"></script>
         </div>		  
	<div class="clear"></div>
</div>
</div>
</div>