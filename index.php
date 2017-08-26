<?php
include("database.php");
$apage;
$tpage;
if(isset($_REQUEST['page'])){
	$apage=$_REQUEST['page'];

}
else{
	$apage=1;
	$_REQUEST['page']=1;
	
}
$dbstart=($apage-1)*15;
$sql="SELECT * FROM movietvlist ORDER BY RAND() LIMIT 5;";
$jsonData=getJSONFromDB($sql);
$jsonData = json_decode($jsonData, true);
//print_r($GLOBALS);

$sql="SELECT * FROM movietvlist ORDER BY movietvlist.added_date DESC LIMIT ".$dbstart.", 15";
$jsonData2=getJSONFromDB($sql);
$jsonData2 = json_decode($jsonData2, true);

$sql="SELECT * FROM movietvlist ORDER BY movietvlist.personal_rating DESC";
$jsonData3=getJSONFromDB($sql);
$jsonData3 = json_decode($jsonData3, true);

$sql="SELECT id FROM movietvlist ORDER BY movietvlist.id DESC";
$rowNo=getRowNo($sql);
$tpage=$rowNo/15;
$tpage=ceil($tpage);

?>



<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	<title>My Movie Collection</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!--[if IE 6]>
		<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
	<![endif]-->
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-func.js"></script>
	<script type="text/javascript" src="js/javascriptFunc.js"></script>
</head>
<body>
<!-- Shell -->
<div id="shell">
	<!-- Header -->
	<div style="position:relative">
		<h1 id="logo"><a href="index.php">Movie Hunter</a></h1>
		<div class="social">
			<span>FOLLOW ME ON:</span>
			<ul>
			    <li><a class="twitter" href="#">twitter</a></li>
			    <li><a class="facebook" href="#">facebook</a></li>
			    <li><a class="vimeo" href="#">vimeo</a></li>
			    <li><a class="rss" href="#">rss</a></li>
			</ul>
		</div>
		
		<!-- Navigation -->
		<div id="navigation">
			<ul>
			    <li><a class="active" href="index.php">HOME</a></li>
			    <li><a href="#">NEWS</a></li>
			    <li><a href="#">IN THEATERS</a></li>
			    <li><a href="#">COMING SOON</a></li>
			    <li><a href="#">CONTACT</a></li>
			    <li><a href="#">ADVERTISE</a></li>
			</ul>
		</div>
		<!-- end Navigation -->
		
		<!-- Sub-menu -->
		<div id="sub-navigation">
			<ul>
			    <li><a href="#">SHOW ALL</a></li>
			    <li><a href="#">LATEST TRAILERS</a></li>
			    <li><a href="#">TOP RATED</a></li>
			    <li><a href="#">MOST COMMENTED</a></li>
			</ul>
			<div id="search">
				<form action="in_search.php" method="get" accept-charset="utf-8">
					<label for="search-field">SEARCH</label>					
					<input type="text" name="search field" placeholder="Enter search here" title="Enter search here" class="blink search-field"  />
					<input type="submit" value="GO!" class="search-button" />
				</form>
			</div>
		</div>
		<!-- end Sub-Menu -->
		
	</div>
	<!-- end Header -->
	
	<!-- Main -->
	<div id="main">
		<!-- Content -->
		<div id="content">

			<!-- Box -->
			<div class="box">
				<div class="head">
					<h2>RANDOM PICKED</h2>
					<p class="text-right"><a style="text-decoration:none;">Random Picked</a></p>
				</div>

				<!-- Movie -->
				
				<?php 
				for($i=0;$i<5;$i++){
					if(isset($jsonData[$i])){
						if($jsonData[$i]['movie']=='movie'){
				?>
				<div class="movie">
					
					<div class="movie-image">
						
						<a href="in_post.php?ttitle=<?php echo $jsonData[$i]['tmdb_id'] ?>"><span class="play"><span class="name"><image src="css/images/starimage.png" style="width:30px;height:30px;"/>
						<p style="padding-top:10px;"><?php echo $jsonData[$i]['personal_rating'] ?> / 10</p>
						<p style="padding-top:25px;"><?php echo $jsonData[$i]['title']?></p> <p><?php echo $jsonData[$i]['year']?></p></span></span>
						<img src="<?php echo $jsonData[$i]['poster_path'] ?>" alt="movie" /></a>
					</div>
						
					<div style="text-align:center;font-size:16px; color:#fff; font-weight:bold; padding:10px;"><a style="color:white; text-decoration:none;"
					href="in_post.php?ttitle=<?php echo $jsonData[$i]['tmdb_id'] ?>">
					<?php echo $jsonData[$i]['title']." (".$jsonData[$i]['year'].")"?>
					</a> </div> 
				</div>
				<?php 
				}else{//tvvvvvvvvvvvvvvvvvv
				?>
                <div class="movie">
					
					<div class="movie-image">
						
						<a href="in_post.php?tv=1&ttitle=<?php echo $jsonData[$i]['tmdb_id'] ?>"><span class="play"><span class="name"><image src="css/images/starimage.png" style="width:30px;height:30px;"/>
						<p style="padding-top:10px;"><?php echo $jsonData[$i]['personal_rating'] ?> / 10</p>
						<p style="padding-top:25px;"><?php echo $jsonData[$i]['title']?></p> <p><?php echo $jsonData[$i]['year']?></p></span></span>
						<img src="<?php echo $jsonData[$i]['poster_path'] ?>" alt="movie" /></a>
					</div>
						
					<div style="text-align:center;font-size:16px; color:#fff; font-weight:bold; padding:10px;"><a style="color:white; text-decoration:none;"
					href="in_post.php?tv=1&ttitle=<?php echo $jsonData[$i]['tmdb_id'] ?>">
					<?php echo $jsonData[$i]['title']."</br><span style='color:red'> TV Series </span> (".$jsonData[$i]['year'].")"?>
					</a> </div> 
				</div>				

				
				<?php
                				
				} //tvvvvvvvvvvvvvvvendddddddddddddddddddd
				}
				}	
				?>
			
				<!-- Movie -->
				
				
				
				<!-- end Movie -->
				<div class="cl">&nbsp;</div>
			</div>
			<!-- end Box -->
			
			<!-- Box -->
			<div class="box">
				<div class="head">
					<h2>LATEST WATCHED</h2>
					<p class="text-right"><a href="#">See all (<?php echo $rowNo ?>) </a></p>
				</div>

				<!-- Movie -->
				
				<?php 
				for($i=0;$i<5;$i++){
					if(isset($jsonData2[$i])){
						if($jsonData2[$i]['movie']=='movie'){
				?>
				<div class="movie">
					
					<div class="movie-image">
						
						<a href="in_post.php?ttitle=<?php echo $jsonData2[$i]['tmdb_id'] ?>"><span class="play"><span class="name"><image src="css/images/starimage.png" style="width:30px;height:30px;"/>
						<p style="padding-top:10px;"><?php echo $jsonData2[$i]['personal_rating'] ?> / 10</p>
						<p style="padding-top:25px;"><?php echo $jsonData2[$i]['title']?></p> <p><?php echo $jsonData2[$i]['year']?></p></span></span>
						<img src="<?php echo $jsonData2[$i]['poster_path'] ?>" alt="movie" /></a>
					</div>
						
					<div style="text-align:center;font-size:16px; color:#fff; font-weight:bold; padding:10px;"><a style="color:white; text-decoration:none;"
					href="in_post.php?ttitle=<?php echo $jsonData2[$i]['tmdb_id'] ?>">
					<?php echo $jsonData2[$i]['title']." (".$jsonData2[$i]['year'].")"?>
					</a> </div> 
				</div>
				<?php 
				}else{//tvvvvvvvvvvvvvvvvvv
				?>
                <div class="movie">
					
					<div class="movie-image">
						
						<a href="in_post.php?tv=1&ttitle=<?php echo $jsonData2[$i]['tmdb_id'] ?>"><span class="play"><span class="name"><image src="css/images/starimage.png" style="width:30px;height:30px;"/>
						<p style="padding-top:10px;"><?php echo $jsonData2[$i]['personal_rating'] ?> / 10</p>
						<p style="padding-top:25px;"><?php echo $jsonData2[$i]['title']?></p> <p><?php echo $jsonData2[$i]['year']?></p></span></span>
						<img src="<?php echo $jsonData2[$i]['poster_path'] ?>" alt="movie" /></a>
					</div>
						
					<div style="text-align:center;font-size:16px; color:#fff; font-weight:bold; padding:10px;"><a style="color:white; text-decoration:none;"
					href="in_post.php?tv=1&ttitle=<?php echo $jsonData2[$i]['tmdb_id'] ?>">
					<?php echo $jsonData2[$i]['title']."</br><span style='color:red'> TV Series </span> (".$jsonData2[$i]['year'].")"?>
					</a> </div> 
				</div>				

				
				<?php
                				
				} //tvvvvvvvvvvvvvvvendddddddddddddddddddd
				}
				}	
				?>
			
				<!-- Movie -->
				
				<div class="cl">&nbsp;</div>
			</div>
			<!-- end Box -->
			
			<!-- Box -->
			<div class="box">
				<!-- Movie -->
				<?php 
				for($i=5;$i<10;$i++){
					if(isset($jsonData2[$i])){
						if($jsonData2[$i]['movie']=='movie'){
				?>
				<div class="movie">
					
					<div class="movie-image">
						
						<a href="in_post.php?ttitle=<?php echo $jsonData2[$i]['tmdb_id'] ?>"><span class="play"><span class="name"><image src="css/images/starimage.png" style="width:30px;height:30px;"/>
						<p style="padding-top:10px;"><?php echo $jsonData2[$i]['personal_rating'] ?> / 10</p>
						<p style="padding-top:25px;"><?php echo $jsonData2[$i]['title']?></p> <p><?php echo $jsonData2[$i]['year']?></p></span></span>
						<img src="<?php echo $jsonData2[$i]['poster_path'] ?>" alt="movie" /></a>
					</div>
						
					<div style="text-align:center;font-size:16px; color:#fff; font-weight:bold; padding:10px;"><a style="color:white; text-decoration:none;"
					href="in_post.php?ttitle=<?php echo $jsonData2[$i]['tmdb_id'] ?>">
					<?php echo $jsonData2[$i]['title']." (".$jsonData2[$i]['year'].")"?>
					</a> </div> 
				</div>
				<?php 
				}else{//tvvvvvvvvvvvvvvvvvv
				?>
                <div class="movie">
					
					<div class="movie-image">
						
						<a href="in_post.php?tv=1&ttitle=<?php echo $jsonData2[$i]['tmdb_id'] ?>"><span class="play"><span class="name"><image src="css/images/starimage.png" style="width:30px;height:30px;"/>
						<p style="padding-top:10px;"><?php echo $jsonData2[$i]['personal_rating'] ?> / 10</p>
						<p style="padding-top:25px;"><?php echo $jsonData2[$i]['title']?></p> <p><?php echo $jsonData2[$i]['year']?></p></span></span>
						<img src="<?php echo $jsonData2[$i]['poster_path'] ?>" alt="movie" /></a>
					</div>
						
					<div style="text-align:center;font-size:16px; color:#fff; font-weight:bold; padding:10px;"><a style="color:white; text-decoration:none;"
					href="in_post.php?tv=1&ttitle=<?php echo $jsonData2[$i]['tmdb_id'] ?>">
					<?php echo $jsonData2[$i]['title']."</br><span style='color:red'> TV Series </span> (".$jsonData2[$i]['year'].")"?>
					</a> </div> 
				</div>				

				
				<?php
                				
				} //tvvvvvvvvvvvvvvvendddddddddddddddddddd
				}
				}	
				?>
				<!-- end Movie -->
				
				<div class="cl">&nbsp;</div>
			</div>
			<!-- end Box -->
			
			<!-- Box -->
			<div class="box">
				<!-- Movie -->
				<?php 
				for($i=10;$i<15;$i++){
					if(isset($jsonData2[$i])){
						if($jsonData2[$i]['movie']=='movie'){
				?>
				<div class="movie">
					
					<div class="movie-image">
						
						<a href="in_post.php?ttitle=<?php echo $jsonData2[$i]['tmdb_id'] ?>"><span class="play"><span class="name"><image src="css/images/starimage.png" style="width:30px;height:30px;"/>
						<p style="padding-top:10px;"><?php echo $jsonData2[$i]['personal_rating'] ?> / 10</p>
						<p style="padding-top:25px;"><?php echo $jsonData2[$i]['title']?></p> <p><?php echo $jsonData2[$i]['year']?></p></span></span>
						<img src="<?php echo $jsonData2[$i]['poster_path'] ?>" alt="movie" /></a>
					</div>
						
					<div style="text-align:center;font-size:16px; color:#fff; font-weight:bold; padding:10px;"><a style="color:white; text-decoration:none;"
					href="in_post.php?ttitle=<?php echo $jsonData2[$i]['tmdb_id'] ?>">
					<?php echo $jsonData2[$i]['title']." (".$jsonData2[$i]['year'].")"?>
					</a> </div> 
				</div>
				<?php 
				}else{//tvvvvvvvvvvvvvvvvvv
				?>
                <div class="movie">
					
					<div class="movie-image">
						
						<a href="in_post.php?tv=1&ttitle=<?php echo $jsonData2[$i]['tmdb_id'] ?>"><span class="play"><span class="name"><image src="css/images/starimage.png" style="width:30px;height:30px;"/>
						<p style="padding-top:10px;"><?php echo $jsonData2[$i]['personal_rating'] ?> / 10</p>
						<p style="padding-top:25px;"><?php echo $jsonData2[$i]['title']?></p> <p><?php echo $jsonData2[$i]['year']?></p></span></span>
						<img src="<?php echo $jsonData2[$i]['poster_path'] ?>" alt="movie" /></a>
					</div>
						
					<div style="text-align:center;font-size:16px; color:#fff; font-weight:bold; padding:10px;"><a style="color:white; text-decoration:none;"
					href="in_post.php?tv=1&ttitle=<?php echo $jsonData2[$i]['tmdb_id'] ?>">
					<?php echo $jsonData2[$i]['title']."</br><span style='color:red'> TV Series </span> (".$jsonData2[$i]['year'].")"?>
					</a> </div> 
				</div>				

				
				<?php
                				
				} //tvvvvvvvvvvvvvvvendddddddddddddddddddd
				}
				}	
				?>
				<!-- end Movie -->
				
				
				
				
				<div class="cl">&nbsp;</div>
				<div class="pagination" <?php if ($apage==1 || $apage==$tpage){ ?> style="padding-left:280px;" <?php } else { ?> style="padding-left:200px;" <?php } ?>  >
				    <a>Pages:</a> 
                    
				    <?php
					    if($apage!=1){echo "<a href='?page=1'>First</a>";}
						if(($apage-1)>0){echo "<a href='?page=".($apage-1)."'>&laquo;</a>";}
						
						$n=1;
						if(($apage-4)>0 && $n<4){echo '<a href="?page='.($apage-4).'">'.($apage-4).'</a>';$n=($n+1);}
						if(($apage-3)>0 && $n<4){echo '<a href="?page='.($apage-3).'">'.($apage-3).'</a>';$n=($n+1);}
						if(($apage-2)>0 && $n<4){echo '<a href="?page='.($apage-2).'">'.($apage-2).'</a>';$n=($n+1);}
						if(($apage-1)>0 && $n<4){echo '<a href="?page='.($apage-1).'">'.($apage-1).'</a>';$n=($n+1);}
						
						echo '<a class="active">'.$apage.'</a>';
						
						if(($apage+1)<=$tpage && $n<7){echo '<a href="?page='.($apage+1).'">'.($apage+1).'</a>';$n=($n+1);}
						if(($apage+2)<=$tpage && $n<7){echo '<a href="?page='.($apage+2).'">'.($apage+2).'</a>';$n=($n+1);}
						if(($apage+3)<=$tpage && $n<7){echo '<a href="?page='.($apage+3).'">'.($apage+3).'</a>';$n=($n+1);}
						if(($apage+4)<=$tpage && $n<7){echo '<a href="?page='.($apage+4).'">'.($apage+4).'</a>';$n=($n+1);}
						if(($apage+5)<=$tpage && $n<7){echo '<a href="?page='.($apage+5).'">'.($apage+5).'</a>';$n=($n+1);}
                        if(($apage+1)<=$tpage){echo "<a href='?page=".($apage+1)."'>&raquo;</a>";}
						if($apage!=$tpage){echo "<a href='?page=".$tpage."'>Last</a>";}
					?>
                </div>
			</div>
			<!-- end Box -->
			
			
			
			<div class="box">
				<div class="head">
					<h2>TOP RATED</h2>
					<p class="text-right"><a href="#">See all</a></p>
				</div>
				<!-- Movie -->
				<?php 
				for($i=0;$i<5;$i++){
					if(isset($jsonData3[$i])){
						if($jsonData3[$i]['movie']=='movie'){
				?>
				<div class="movie">
					
					<div class="movie-image">
						
						<a href="in_post.php?ttitle=<?php echo $jsonData3[$i]['tmdb_id'] ?>"><span class="play"><span class="name"><image src="css/images/starimage.png" style="width:30px;height:30px;"/>
						<p style="padding-top:10px;"><?php echo $jsonData3[$i]['personal_rating'] ?> / 10</p>
						<p style="padding-top:25px;"><?php echo $jsonData3[$i]['title']?></p> <p><?php echo $jsonData3[$i]['year']?></p></span></span>
						<img src="<?php echo $jsonData3[$i]['poster_path'] ?>" alt="movie" /></a>
					</div>
						
					<div style="text-align:center;font-size:16px; color:#fff; font-weight:bold; padding:10px;"><a style="color:white; text-decoration:none;"
					href="in_post.php?ttitle=<?php echo $jsonData3[$i]['tmdb_id'] ?>">
					<?php echo $jsonData3[$i]['title']." (".$jsonData3[$i]['year'].")"?>
					</a> </div> 
				</div>
				<?php 
				}else{//tvvvvvvvvvvvvvvvvvv
				?>
                <div class="movie">
					
					<div class="movie-image">
						
						<a href="in_post.php?tv=1&ttitle=<?php echo $jsonData3[$i]['tmdb_id'] ?>"><span class="play"><span class="name"><image src="css/images/starimage.png" style="width:30px;height:30px;"/>
						<p style="padding-top:10px;"><?php echo $jsonData3[$i]['personal_rating'] ?> / 10</p>
						<p style="padding-top:25px;"><?php echo $jsonData3[$i]['title']?></p> <p><?php echo $jsonData3[$i]['year']?></p></span></span>
						<img src="<?php echo $jsonData3[$i]['poster_path'] ?>" alt="movie" /></a>
					</div>
						
					<div style="text-align:center;font-size:16px; color:#fff; font-weight:bold; padding:10px;"><a style="color:white; text-decoration:none;"
					href="in_post.php?tv=1&ttitle=<?php echo $jsonData3[$i]['tmdb_id'] ?>">
					<?php echo $jsonData3[$i]['title']."</br><span style='color:red'> TV Series </span>(".$jsonData3[$i]['year'].")"?>
					</a> </div> 
				</div>				

				
				<?php
                				
				} //tvvvvvvvvvvvvvvvendddddddddddddddddddd
				}
				}	
				?>
				<!-- end Movie -->	
		
				<div class="cl">&nbsp;</div>
			</div>
			
			
		</div>
		<!-- end Content -->

		<!-- end NEWS -->
		
		<!-- Coming -->
		
		<!-- end Coming -->
		<div class="cl">&nbsp;</div>
	</div>
	<!-- end Main -->

	<?php
	include("footer.php");
	?>
</div>
<!-- end Shell -->
</body>
</html>