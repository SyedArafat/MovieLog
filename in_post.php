<?php
$watchstatus;
include("bkpost.php");
include("database.php");

if(isset($_REQUEST["tv"])){
	$sql="SELECT * FROM tvlist WHERE tmdb_id=".$_REQUEST['ttitle'];
    $jsonData3=getJSONFromDB($sql);
    $jsonData3 = json_decode($jsonData3, true);
	if(sizeof($jsonData3)==0){
	    $watchstatus=0;
        $jsonData=getTVData($_REQUEST["ttitle"]);
        $jsonData = json_decode($jsonData, true);
        //print_r($GLOBALS);
        $creditData=getTVCredit($_REQUEST["ttitle"]);
        $creditData=json_decode($creditData, true);
		//print_r($GLOBALS);
		


    }
	else{
		if(isset($_REQUEST["edit"])){
			$jsonData=getTVData($_REQUEST["ttitle"]);
            $jsonData = json_decode($jsonData, true);
		}
	$watchstatus=1;
	$sql="SELECT * FROM tv_genre_table WHERE id=".$jsonData3[0]['id'];
	$genreData=getJSONFromDB($sql);
	$genreData=json_decode($genreData,true);
	$sql="SELECT * FROM tv_cast_table WHERE id=".$jsonData3[0]['id'];
	$castData=getJSONFromDB($sql);
	$castData=json_decode($castData,true);
	$sql="SELECT * FROM tv_season_table WHERE id=".$jsonData3[0]['id'];
	$seasonData=getJSONFromDB($sql);
	$seasonData=json_decode($seasonData,true);
	
	$sql="SELECT * FROM tv_creater_table WHERE id=".$jsonData3[0]['id'];
	$creatorData=getJSONFromDB($sql);
	$creatorData=json_decode($creatorData,true);
	
	//print_r($GLOBALS);
		
	}
	
}
else{
$sql="SELECT * FROM movielist WHERE tmdb_id=".$_REQUEST['ttitle'];
$jsonData3=getJSONFromDB($sql);
$jsonData3 = json_decode($jsonData3, true);
//print_r($GLOBALS);
if(sizeof($jsonData3)==0){
	$watchstatus=0;
    $jsonData=getMovieData($_REQUEST["ttitle"]);
    $jsonData = json_decode($jsonData, true);
    //print_r($GLOBALS);
    $jsonData2=getMovieCredit($_REQUEST["ttitle"]);
    $jsonData2 = json_decode($jsonData2, true);


}
else{
	$watchstatus=1;
	$sql="SELECT * FROM genre_table WHERE id=".$jsonData3[0]['id'];
	$genreData=getJSONFromDB($sql);
	$genreData=json_decode($genreData,true);
	$sql="SELECT * FROM cast_table WHERE id=".$jsonData3[0]['id'];
	$castData=getJSONFromDB($sql);
	$castData=json_decode($castData,true);
    
	
	}
}

//print_r($jsonData2);
//print_r($jsonData['total_results']);
//print_r ($jsonData['results'][0]['title']);
//print_r($GLOBALS);
//
?>

<!DOCTYPE html>

<html>
<head>

<link rel="stylesheet" href="css/astyle.css" type="text/css" media="all" />

</head>

<script>
function showUpdate(){
	//alert("dsadas");
	document.getElementById("rating").style.display="none";
	document.getElementById("editRating").style.display="block";
	//alert("dsadas");
}

function myFunction() {
	 var yes=0;
	 //alert(yes);
     for(i=1;i<11;i++)
	 if(document.getElementById('star'+i).checked){
		 yes=1;
	 }

	if(yes==0){
    document.getElementById('myPopup').style.display="block";}
	else{
		document.getElementById('post').type="submit";
		
	}
}

function myAnFunction() {
	 var yes=1;
	 //alert(yes);
     //for(i=1;i<11;i++)
	 //if(document.getElementById('star'+i).checked){
	 //	 yes=1;
	 //}

	if(yes==0){
    document.getElementById('myPopup').style.display="block";}
	else{
		document.getElementById('post').type="submit";
		
	}
}

function secFunction(){
	document.getElementById('myPopup').style.display="none";

}

function editFunction(){
	document.getElementById('comment_box').style.display='block';
	document.getElementById('watchDate').style.display='block';
	document.getElementById('edit').style.display='none';
	document.getElementById('update').style.display='block';

}

function updateFunction(){
	var e = document.getElementById("Date");
    var str = e.options[e.selectedIndex].text;
	if(str=="Select Watch Date")
	{
		document.getElementById("popupSelect").style.display='block';
		
	}
	else{
		document.getElementById('update').type="submit";
		
	}
	
}

function starFunction(obj){
	obj.disabled=true;
	
}


</script>

<?php
include("header.php");

?>


	
	
	
	<!--Contentttt Unwatched Movie -->
	
	<?php if(!isset($_REQUEST["tv"])) {if($watchstatus==0){ ?>
	<form action="bksubmit_post.php" method="post">
	<div id="content">
		<div class="line-hor"></div>
     		<div class="box">
			
				<div class="border-right">
					<div class="border-left">
					<div class="bkboximage">
						<div class="inner">
							<h3><?php echo $jsonData['title']." "?> <span>(<?php echo  substr($jsonData['release_date'],0,4) ?>)</span></h3>
							<input type="hidden" name="title" value="<?php echo $jsonData['title']?>"/>
							<input type="hidden" name="year" value="<?php echo  substr($jsonData['release_date'],0,4) ?>"/>
							<div class="img-box1 alt"><img src="http://image.tmdb.org/t/p/w300/<?php echo $jsonData['poster_path']?>" alt="" />
							<input type="hidden" name="poster" value="http://image.tmdb.org/t/p/w300/<?php echo $jsonData['poster_path']?>"/>
							
							<div style="position:absolute;top:176px;left:73%;height:60px;width:140px;background-color:#32CD32;text-align: center;vertical-align: middle;line-height: 60px;color:white;font-size:20px;font-weight:bold;" title="Haven't Watched">Not Yet</div>
							
							<p>User Rating:<?php echo $jsonData['vote_average']?></p>
                            <input type="hidden" name="user_rating" value="<?php echo $jsonData['vote_average']?>"/>							
							<p class="p3">
								    <div class="rating">
                                        <legend>My Personal Rating:</legend>
	                                    <input type="radio" id="star10" name="rating" value="10" onclick="secFunction()"/><label for="star10" title="Rocks!">10 stars</label>
                                        <input type="radio" id="star9" name="rating" value="9" onclick="secFunction()"/><label for="star9" title="Very good">9 stars</label>
                                        <input type="radio" id="star8" name="rating" value="8" onclick="secFunction()"/><label for="star8" title="good">8 stars</label>
                                        <input type="radio" id="star7" name="rating" value="7" onclick="secFunction()"/><label for="star7" title="Pretty good">7 stars</label>
                                        <input type="radio" id="star6" name="rating" value="6" onclick="secFunction()"/><label for="star6" title="So So">6 star</label>
                                        <input type="radio" id="star5" name="rating" value="5" onclick="secFunction()"/><label for="star5" title="not bad">5 stars</label>
                                        <input type="radio" id="star4" name="rating" value="4" onclick="secFunction()" /><label for="star4" title="Meh">4 stars</label>
                                        <input type="radio" id="star3" name="rating" value="3" onclick="secFunction()"/><label for="star3" title="Kinda bad">3 stars</label>
                                        <input type="radio" id="star2" name="rating" value="2" onclick="secFunction()"/><label for="star2" title="Very bad">2 stars</label>
                                        <input type="radio" id="star1" name="rating" value="1" onclick="secFunction()"/><label for="star1" title="Sucks big time">1 star</label>
										
                                    </div>
								
								
								</p>
							
							    <div style="margin-top:120px"><img src="http://image.tmdb.org/t/p/w500/<?php echo $jsonData['backdrop_path']?>"/></div>
                             <input type="hidden" name="cover_photo" value="http://image.tmdb.org/t/p/w500/<?php echo $jsonData['backdrop_path']?>"/> 
							</div>
							
							
							<p class="p1"><?php echo $jsonData['overview']?> </p>
							<input type="hidden" name="overview" value="<?php echo $jsonData['overview']?>"/>
							<?php if($jsonData['tagline']!=''){?>
							<p class="p2"><b>Tag Line:</b><?php echo " ".$jsonData['tagline']?> </p>
							<input type="hidden" name="tagline" value="<?php echo $jsonData['tagline']?>">
							<?php } else{?>
							<input type="hidden" name="tagline" value='' ">
							
							<?php } ?>
							<p class="p2"><b>Genre: </b>
							<?php 
							    for($i=0;$i<sizeof($jsonData['genres']);$i++)
							    {
								    echo "<input type='hidden' name='genre".$i."' value='".$jsonData['genres'][$i]['name']."'/>";
								    if($i==sizeof($jsonData['genres'])-1)
								    {
									    echo" ". $jsonData['genres'][$i]['name'];
								    } 
								    else
								    {
									    echo" ". $jsonData['genres'][$i]['name'].",";
								    }
							    } 
							?> 
							
							</p>
					        
							<p class="p2"><b>Release Date:</b><?php echo" ". $jsonData['release_date']?> </p>
							<input type="hidden" name="release_date" value="<?php echo $jsonData['release_date']?>"/>
							<p class="p2"><b>Language:</b><?php echo" ". $jsonData['original_language']?> </p>
							<input type="hidden" name="language" value="<?php echo $jsonData['original_language']?>"/>
							<p class="p2"><b>Top Cast: </b>
							
							<?php 
							    for($i=0;$i<4;$i++)
								{
									if(isset($jsonData2['cast'][$i]['name']))
										echo "<input type='hidden' name='cast".$i."' value='".$jsonData2['cast'][$i]['name']."'/>";
									if($i==3)
									{
										if(isset($jsonData2['cast'][$i]['name']))
											echo" ". $jsonData2['cast'][$i]['name'];
									} 
									else
									{
										if(isset($jsonData2['cast'][$i]['name']))
											echo" ". $jsonData2['cast'][$i]['name'].",";
									}
								} 
							?> 
							</p>
							
							<p class="p2"><b>Director: </b>
							
							<?php 
							    for($i=0;$i<sizeof($jsonData2['crew']);$i++)
								{
									if($jsonData2['crew'][$i]['job']=="Director")
									{
										echo "<input type='hidden' name='director' value='".$jsonData2['crew'][$i]['name']."'/>";
										echo " ".$jsonData2['crew'][$i]['name'];
										break;
									}
								}
							?>
							</p>
							
							<?php if(isset($jsonData["production_companies"]['0'])){ ?>
							<p class="p2"><b>Production: </b><?php echo" ". $jsonData['production_companies'][0]['name']?> </p>
							<input type="hidden" name="production" value="<?php echo $jsonData['production_companies'][0]['name']?>"/><?php } 
							
							else {
							?>
							<input type="hidden" name="production" value=""/>
							
							<?php
							} ?>
							
							<p class="p2"><b>Runtime:</b><?php echo" ". $jsonData['runtime']." minutes"?> </p>
							<input type="hidden" name="duration" value="<?php echo $jsonData['runtime']." minutes"?>"/>
							<input type="hidden" name="tmdb_id" value="<?php echo $jsonData['id']?>"/>
							<input type="hidden" name="genre_count" value="<?php echo sizeof($jsonData['genres'])?>"/>
							<p class="p2"><b>Budget:</b>
							
							<?php 
							    if($jsonData['budget']!=0)
								{ 
							        echo" $". $jsonData['budget'];
									echo '<input type="hidden" name="budget" value="'.$jsonData["budget"].'"/>';
								} 
								else
								{
									echo " Unknown";
									echo '<input type="hidden" name="budget" value="unknown"/>';
								}
							?> 
							
							</p>
							
							<p class="p2"><b>Box Office:</b>
							
							<?php 
							    if($jsonData['revenue']!=0)
								{ 
							        echo" $". $jsonData['revenue'];
									echo '<input type="hidden" name="box_office" value="'.$jsonData["revenue"].'"/>';
								} 
								else
								{
									echo " Unknown";
									echo '<input type="hidden" name="box_office" value="unknown"/>';
								}
								
							?> 
							
							</p>
							<p class="p2">Watched Date:
							<span  class="styled-select" style="padding-left:5px;">
							<select style="background:#687d7f;width:150px" name='watchDate'>
							
							<option selected>Some Time Ago</option>
							<option>Can't Remember</option>
							
							</select>
							</span>
							</p>
							<p class="p2"><textarea name="comment" placeholder="Add personal comment about the movie (If any)"></textarea></p>
							<p class="p2"><input type="button" class="button button4" onclick="myFunction()" name="watch_status" id="post" value="Watched"/></p>
							
							
							
							<p class="p2"><a href="http://www.imdb.com/title/<?php echo $jsonData['imdb_id']?>"><img src="css/images/imdb_logo.png" width="100px" height="50px"/></a></p>
						    <input type="hidden" name="imdb_link" value="http://www.imdb.com/title/<?php echo $jsonData['imdb_id']?>"/>
							<p style="display:none;font-size:14px;font-weight:bold;float:right;color:#FF0000;"  id="myPopup">Add Personal Rating</p>
						</div>
						
						
						
					</div>
				    </div>
			    </div>
		    </div>
	</div>
	</form>
	
	<!-- End of unwatched Movie content -->
	
	
	<?php } else {?>
	
	
	<!--Content for watched Movie -->
	<form action="bkpostUpdate.php" method="post">
	<div id="content">
		<div class="line-hor"></div>
     		<div class="box">
			
				<div class="border-right">
					<div class="border-left">
					<div class="bkboximage">
						<div class="inner">
							<h3><?php echo $jsonData3[0]['title']." "?> <span>(<?php echo $jsonData3[0]['year'] ?>)</span></h3>
							<div class="img-box1 alt"><img src="<?php echo $jsonData3[0]['poster_path'] ?>" alt="" />				
							<div style="position:absolute;top:176px;left:73%;height:60px;width:140px;background-color:#32CD32;text-align: center;vertical-align: middle;line-height: 60px;color:white;font-size:20px;font-weight:bold;" title="Inlist">Watched</div>
							<p><b>User Rating:<span style="color:#7FFFD4"><?php echo " ". $jsonData3[0]['user_rating']?></span></b></p>						
							
							<p class="p3"><b>
								    <div id='rated' class="rating">
                                        <legend>My Personal Rating:<span style="color:#7FFFD4"><?php echo " ". $jsonData3[0]['personal_rating']?></span></legend></b>
	                                    <input type="radio" id="star10"name="rating" value="10"<?php if($jsonData3[0]['personal_rating']==10){?> checked="true" <?php } ?> /><label for="star10" title="Rocks!">10 stars</label>
                                        <input type="radio" id="star9" name="rating" value="9" <?php if($jsonData3[0]['personal_rating']==9) {?> checked="true" <?php } ?> /><label for="star9" title="Very good">9 stars</label>
                                        <input type="radio" id="star8" name="rating" value="8" <?php if($jsonData3[0]['personal_rating']==8) {?> checked="true" <?php } ?> /><label for="star8" title="good">8 stars</label>
                                        <input type="radio" id="star7" name="rating" value="7" <?php if($jsonData3[0]['personal_rating']==7) {?> checked="true" <?php } ?> /><label for="star7" title="Pretty good">7 stars</label>
                                        <input type="radio" id="star6" name="rating" value="6" <?php if($jsonData3[0]['personal_rating']==6) {?> checked="true" <?php } ?> /><label for="star6" title="So So">6 star</label>
                                        <input type="radio" id="star5" name="rating" value="5" <?php if($jsonData3[0]['personal_rating']==5) {?> checked="true" <?php } ?> /><label for="star5" title="not bad">5 stars</label>
                                        <input type="radio" id="star4" name="rating" value="4" <?php if($jsonData3[0]['personal_rating']==4) {?> checked="true" <?php } ?> /><label for="star4" title="Meh">4 stars</label>
                                        <input type="radio" id="star3" name="rating" value="3" <?php if($jsonData3[0]['personal_rating']==3) {?> checked="true" <?php } ?> /><label for="star3" title="Kinda bad">3 stars</label>
                                        <input type="radio" id="star2" name="rating" value="2" <?php if($jsonData3[0]['personal_rating']==2) {?> checked="true" <?php } ?> /><label for="star2" title="Very bad">2 stars</label>
                                        <input type="radio" id="star1" name="rating" value="1" <?php if($jsonData3[0]['personal_rating']==1) {?> checked="true" <?php } ?> /><label for="star1" title="Sucks big time">1 star</label>
										
                                    </div>
								
								
							</p>
							
							
							    <div style="margin-top:120px"><img src="<?php echo $jsonData3[0]['cover_path'] ?>"/></div>
                             
							</div>
							
							
							<p class="p1"><?php echo $jsonData3[0]['overview']?> </p>
							<?php if($jsonData3[0]['tagline']!=''){?>
							<p class="p2"><b>Tag Line:</b><?php echo " ".$jsonData3[0]['tagline']?> </p>
							
							<?php } ?>
							
							<p class="p2"><b>Genre: </b>
							<?php 
							    for($i=0;$i<sizeof($genreData);$i++)
							    {
								    
								    if($i==sizeof($genreData)-1)
								    {
									    echo" ". $genreData[$i]['genre'];
								    } 
								    else
								    {
									    echo" ". $genreData[$i]['genre'].",";
								    }
							    } 
							?> 
							
							</p>
					        
							<p class="p2"><b>Release Date:</b><?php echo" ". $jsonData3[0]['release_date']?> </p>
							<input type='hidden' name='release_date' value='<?php echo" ". $jsonData3[0]['release_date']?>'>
							<p class="p2"><b>Language:</b><?php echo" ". $jsonData3[0]['language']?> </p>
							<p class="p2"><b>Top Cast: </b>
							
							<?php 
							    for($i=3;$i>=0;$i--)
								{
									if($i==0)
									{
										if(isset($castData[$i]['cast']))
											echo" ". $castData[$i]['cast'];
									} 
									else
									{
										if(isset($castData[$i]['cast']))
											echo" ". $castData[$i]['cast'].",";
									}
									
								} 
							?> 
							</p>
							
							<p class="p2"><b>Director: </b>
							
							<?php echo " ".$jsonData3[0]['director'];?>
							</p>
							
							
							<p class="p2"><b>Production: </b><?php echo" ". $jsonData3[0]['production']?> </p>
							<p class="p2"><b>Runtime:</b><?php echo" ". $jsonData3[0]['runtime']?> </p>
							<p class="p2"><b>Budget:</b>
							
							<?php 
							    if($jsonData3[0]['budget']!=0)
								{ 
							        echo" $". $jsonData3[0]['budget'];
								} 
								else
								{
									echo " Unknown";
								}
							?> 
							
							</p>
							
							<p class="p2"><b>Box Office:</b>
							
							<?php 
							    if($jsonData3[0]['box_office']!=0)
								{ 
							        echo" $". $jsonData3[0]['box_office'];
									
								} 
								else
								{
									echo " Unknown";
									
								}
								
							?> 
							
							</p>
							<?php if($jsonData3[0]['personal_comment']!='' && $jsonData3[0]['personal_comment']!=' '){?>
							<p class="p2"><b>Comment:</b><?php echo" ". $jsonData3[0]['personal_comment']?> </p>
							<?php } ?>
							
							<p style="display:none" id="watchDate" class="p2">Watched Date:
							<span  class="styled-select" style="padding-left:5px;">
							<select name="watchDate" style="background:#687d7f;width:150px" id='Date'>
							<option value="none">Select Watch Date</option>
							<option value="none" selected>No Change</option>
							<option>Some Time Ago</option>
							<option>Can't Remember</option>
							
							</select>
							</span>
							</p>
							
							
							<p class="p2"><textarea style="display:none;" name="comment" id="comment_box"><?php echo" ". $jsonData3[0]['personal_comment']?></textarea></p>
							<p class="p2"><input type="button" style="display:block;"class="button button4" name="watch_status" onclick="editFunction()" id="edit" value="Edit"/></p>
							<input type="hidden" name="id" value="<?php echo $jsonData3[0]['id']?>"/>
							<input type="hidden" name="tmdb_id" value="<?php echo $jsonData3[0]['tmdb_id']?>"/>
							<p class="p2"><input type="button" style="display:none" class="button button4" name="watch_status" onclick="updateFunction()" id="update" value="Update"/></p>
							</form>
							<p class="p2" style="margin-top:20px;"><a href="<?php echo $jsonData3[0]['imdb_link']?>"><img src="css/images/imdb_logo.png" width="100px" height="50px"/></a></p>
						    <p style="display:none;font-size:14px;font-weight:bold;float:right;color:#FF0000;"  id="popupSelect">Select Watch Date</p>
						</div>
						
						
						
					</div>
				    </div>
			    </div>
		    </div>
	</div>
	
	<!--End of Content for watched Movie -->
	
	
	<!-- Start of unwatched tv show -->
	
	<?php } } else{ if($watchstatus==0){ ?>
	
	<form action="bksubmit_post_tv.php" method="post">
	<div id="content">
		<div class="line-hor"></div>
     		<div class="box">
			
				<div class="border-right">
					<div class="border-left">
					<div class="bkboximage">
						<div class="inner">
							<h3><?php echo $jsonData['name']." TV Series "?> <span>(<?php echo  substr($jsonData['first_air_date'],0,4) ?>)</span></h3>
							<input type="hidden" name="title" value="<?php echo $jsonData['name']?>"/>
							<input type="hidden" name="year" value="<?php echo  substr($jsonData['first_air_date'],0,4) ?>"/>
							<div class="img-box1 alt"><img src="http://image.tmdb.org/t/p/w300/<?php echo $jsonData['poster_path']?>" alt="" />
							<input type="hidden" name="poster" value="http://image.tmdb.org/t/p/w300/<?php echo $jsonData['poster_path']?>"/>
							
							<div style="position:absolute;top:176px;left:73%;height:60px;width:140px;background-color:#32CD32;text-align: center;vertical-align: middle;line-height: 60px;color:white;font-size:20px;font-weight:bold;" title="Haven't Watched">Not Yet</div>
							
							<p>User Rating:<?php echo $jsonData['vote_average']?></p>
                            <input type="hidden" name="user_rating" value="<?php echo $jsonData['vote_average']?>"/>							
							
								
							    <div style="margin-top:120px"><img src="http://image.tmdb.org/t/p/w500/<?php echo $jsonData['backdrop_path']?>"/></div>
                             <input type="hidden" name="cover_photo" value="http://image.tmdb.org/t/p/w500/<?php echo $jsonData['backdrop_path']?>"/> 
							</div>
							
							
							<p class="p1"><?php echo $jsonData['overview']?> </p>
							<input type="hidden" name="overview" value="<?php echo $jsonData['overview']?>"/>
							<input type="hidden" name="no_of_seasons" value="<?php echo sizeof($jsonData['seasons'])?>"/>
							<p class="p2"><b>Seasons: </b>
							<?php 
							    for($i=0;$i<sizeof($jsonData['seasons']);$i++)
							    {
								    echo "<input type='hidden' name='seasons".$i."' value='".$jsonData['seasons'][$i]["season_number"]."'/>";
								    if($i==sizeof($jsonData['seasons'])-1)
								    {?>
										
									    <a href='in_seasons.php?tv=1&season=<?php echo $jsonData['seasons'][$i]['season_number'] ?>&ttitle=<?php echo $jsonData['id']?>'> <?php echo $jsonData['seasons'][$i]['season_number']." (". substr($jsonData['seasons'][$i]['air_date'],0,4).")"."</a>";
								    } 
								    else
								    {
								        if($jsonData['seasons'][$i]['season_number']==0){?> <a href='in_seasons.php?tv=1&season=<?php echo $jsonData['seasons'][$i]['season_number'] ?>&ttitle=<?php echo $jsonData['id']?>'> <?php echo "Specials </a>, "; } else {?>   
									    <a href='in_seasons.php?tv=1&season=<?php echo $jsonData['seasons'][$i]['season_number'] ?>&ttitle=<?php echo $jsonData['id']?>'> <?php echo $jsonData['seasons'][$i]['season_number']." (". substr($jsonData['seasons'][$i]['air_date'],0,4).")</a>, ";}
								    }
							    } 
							?> 
							
							</p>
							
							<p class="p2"><b>No Of Episode: </b><?php echo '<span style="font-weight:bold;color:red;">'. $jsonData['number_of_episodes']?></span></p>
							<input type="hidden" name="no_of_episodes" value="<?php echo $jsonData['number_of_episodes']?>"/>
							<p class="p2"><b>Creators: </b>
							<?php 
							    for($i=0;$i<sizeof($jsonData['created_by']);$i++)
							    {
								    echo "<input type='hidden' name='created_by".$i."' value='".$jsonData['created_by'][$i]['name']."'/>";
								    if($i==sizeof($jsonData['created_by'])-1)
								    {
									    echo" ". $jsonData['created_by'][$i]['name'];
								    } 
								    else
								    {
									    echo" ". $jsonData['created_by'][$i]['name'].",";
								    }
							    } 
							?> 
							
							</p>
							
							<p class="p2"><b>Genre: </b>
							<?php 
							    for($i=0;$i<sizeof($jsonData['genres']);$i++)
							    {
								    echo "<input type='hidden' name='genre".$i."' value='".$jsonData['genres'][$i]['name']."'/>";
								    if($i==sizeof($jsonData['genres'])-1)
								    {
									    echo" ". $jsonData['genres'][$i]['name'];
								    } 
								    else
								    {
									    echo" ". $jsonData['genres'][$i]['name'].",";
								    }
							    } 
							?> 
							
							</p>
					        
							<p class="p2"><b>First Air Date:</b><?php echo" ". $jsonData['first_air_date']?> </p>
							<input type="hidden" name="first_air_date" value="<?php echo $jsonData['first_air_date']?>"/>
							<p class="p2"><b>Last Air Date:</b><?php echo" ". $jsonData['last_air_date']?> </p>
							<input type="hidden" name="last_air_date" value="<?php echo $jsonData['last_air_date']?>"/>
							<p class="p2"><b>Language:</b><?php echo" ". $jsonData['original_language']?> </p>
							<input type="hidden" name="language" value="<?php echo $jsonData['original_language']?>"/>
							<p class="p2"><b>Top Cast: </b>
							
							<?php 
							    for($i=0;$i<5;$i++)
								{
									if(isset($creditData['cast'][$i]['name'])){
										echo "<input type='hidden' name='cast".$i."' value='".$creditData['cast'][$i]['name']."'/>";
									echo "<input type='hidden' name='role".$i."' value='".$creditData['cast'][$i]['character']."'/>";
									if($i==4)
									{
										if(isset($creditData['cast'][$i]['name']))
											echo" ". $creditData['cast'][$i]['name']." (".$creditData['cast'][$i]['character'].")";
									} 
									else
									{
										if(isset($creditData['cast'][$i]['name']))
											echo" ". $creditData['cast'][$i]['name']." (".$creditData['cast'][$i]['character']."),";
									}
									}
								} 
							?> 
							</p>
							
							
							
							<?php if(isset($jsonData["production_companies"]['0'])){ ?>
							<p class="p2"><b>Production: </b><?php echo" ". $jsonData['production_companies'][0]['name']?> </p>
							<input type="hidden" name="production" value="<?php echo $jsonData['production_companies'][0]['name']?>"/><?php } 
							
							else {
							?>
							<input type="hidden" name="production" value=""/>
							
							<?php
							} ?>
							
							<p class="p2"><b>Episode Runtime:</b><?php echo" ". $jsonData['episode_run_time'][0]." minutes"?> </p>
							<input type="hidden" name="duration" value="<?php echo $jsonData['episode_run_time'][0]." minutes"?>"/>
							<p class="p2"><b>Status:</b><?php echo" ". $jsonData['status']?> </p>
							<input type="hidden" name="status" value="<?php echo $jsonData['status']?>"/>
							<input type="hidden" name="tmdb_id" value="<?php echo $jsonData['id']?>"/>
							<input type="hidden" name="genre_count" value="<?php echo sizeof($jsonData['genres'])?>"/>
							
							
							<?php 
							    for($i=0;$i<sizeof($jsonData['seasons']);$i++)
							    {
									
								    echo "<input type='hidden' name='seasons".$i."' value='".$jsonData['seasons'][$i]["season_number"]."'/>";
								    echo "<p class='p2'>"; 
								    if($jsonData['seasons'][$i]['season_number']==0){} else {?>   
									<a style='color:#2464ad;' href='in_seasons.php?tv=1&season=<?php echo $jsonData['seasons'][$i]['season_number'] ?>&ttitle=<?php echo $jsonData['id']?>'> <?php echo "Season: ".$jsonData['seasons'][$i]['season_number']." (". substr($jsonData['seasons'][$i]['air_date'],0,4).")</a> ";?>
								    <span style="padding-left:20px">
									Status:
									<span style="padding-left:5px"class="styled-select">
                                      <select name='status_season_<?php echo $i; ?>'>
                                            <option>Haven't Watched</option>
                                            <option>Watched</option>
                                       </select>
                                    </span>
									</span>
									
									<span style="padding-left:70px">
									Rating:
									<span style="padding-left:5px;" class="styled-select-rating">
                                      <select name='rating_season_<?php echo $i; ?>'>
                                            <option>1</option>
                                            <option>2</option>
											<option>3</option>
                                            <option>4</option>
											<option>5</option>
                                            <option>6</option>
											<option>7</option>
                                            <option>8</option>
											<option>9</option>
                                            <option>10</option>
                                       </select>
                                    </span>
									</span>
									<span>
									<img style="position:relative;top:10px;padding-left:10px;padding-top:5px;" src="css/images/starimage.png" width="34px" height="34px">
									
									</span>
									
									
									
									</p>	
									<?php
								}
							    } 
							?> 
							
							<p class="p2"><textarea style="padding-bottom:10px;" name="comment" placeholder="Add personal comment about the movie (If any)"></textarea></p>
							<p class="p2"><input type="button" class="button button4" onclick="myAnFunction()" name="watch_status" id="post" value="Watched"/></p>
													
							<p class="p2">Watched Date:
							<span  class="styled-select" style="padding-left:5px;">
							<select style="background:#687d7f;width:150px" name='watchDate'>
							
							<option selected>Some Time Ago</option>
							<option>Can't Remember</option>
							
							</select>
							</span>
							</p>
							
							<p style="display:none;font-size:14px;font-weight:bold;float:right;color:#FF0000;"  id="myPopup">Add Personal Rating</p>
						</div>
						
						
						
					</div>
				    </div>
			    </div>
		    </div>
	</div>
	</form>
	<!-- End of unwatched tv show -->
	
	
	
	<!-- Start of watched tv show -->
	
	
	<?php }
    else{ ?>
	
	<div id="content">
		<div class="line-hor"></div>
     		<div class="box">
			
				<div class="border-right">
					<div class="border-left">
					<div class="bkboximage">
						<div class="inner">
							<h3><?php echo $jsonData3[0]['title']."<span> TV Series "?> (<?php echo $jsonData3[0]['year'] ?>)</span></h3>
							<div class="img-box1 alt"><img src="<?php echo $jsonData3[0]['poster']?>" alt="" />
							<div style="position:absolute;top:176px;left:73%;height:60px;width:140px;background-color:#32CD32;text-align: center;vertical-align: middle;line-height: 60px;color:white;font-size:20px;font-weight:bold;" title="Haven't Watched">Watched</div>
							
							<p>User Rating:<?php echo $jsonData3[0]['user_rating']?></p>
							<p style="margin-top:20px;">Personal Rating:<?php echo $jsonData3[0]['personal_rating']?></p>		
							<div style="margin-top:80px"><img src="<?php echo $jsonData3[0]['cover_photo']?>"/></div>  
							</div>
							
							
							<p class="p1"><?php echo $jsonData3[0]['overview']?> </p>
							<input type="hidden" name="no_of_seasons" value="<?php echo sizeof($jsonData['seasons'])?>"/>
							<p class="p2"><b>Seasons Watched: </b>
							<?php 
							    for($i=0;$i<sizeof($seasonData);$i++)
							    { 
								    if($i==sizeof($seasonData)-1)
								    {
								        if($seasonData[$i]['season_no']==0){?> <a href='in_seasons.php?tv=1&season=<?php echo $seasonData[$i]['season_no'] ?>&ttitle=<?php echo $jsonData3[0]['tmdb_id']?>'> <?php echo "Specials </a>, "; } else {?>
										
									    <a href='in_seasons.php?tv=1&season=<?php echo $seasonData[$i]['season_no'] ?>&ttitle=<?php echo $jsonData3[0]['tmdb_id']?>'> <?php echo $seasonData[$i]['season_no']." (". substr($seasonData[$i]['air_date'],0,4).")</a> ";}
								    } 
								    else
								    {
								        if($seasonData[$i]['season_no']==0){?> <a href='in_seasons.php?tv=1&season=<?php echo $seasonData[$i]['season_no'] ?>&ttitle=<?php echo $jsonData3[0]['tmdb_id']?>'> <?php echo "Specials </a>, "; } else {?>   
									    <a href='in_seasons.php?tv=1&season=<?php echo $seasonData[$i]['season_no'] ?>&ttitle=<?php echo $jsonData3[0]['tmdb_id']?>'> <?php echo $seasonData[$i]['season_no']." (". substr($seasonData[$i]['air_date'],0,4).")</a>, ";}
								    }
							    } 
							?> 
							
							</p>
							
							<p class="p2"><b>No Of Episode: </b><?php echo '<span style="font-weight:bold;color:red;">'. $jsonData3[0]['no_of_episodes']?></span></p>
							<input type="hidden" name="no_of_episodes" value="<?php echo $jsonData['number_of_episodes']?>"/>
							<p class="p2"><b>Creators: </b>
							<?php 
							    for($i=0;$i<sizeof($creatorData);$i++)
							    {
								    if($i==sizeof($creatorData)-1)
								    {
									    echo" ". $creatorData[$i]['name'];
								    } 
								    else
								    {
									    echo" ". $creatorData[$i]['name'].",";
								    }
							    } 
							?> 
							
							</p>
							
							<p class="p2"><b>Genre: </b>
							<?php 
							    for($i=0;$i<sizeof($genreData);$i++)
							    {
								  
								    if($i==sizeof($genreData)-1)
								    {
									    echo" ". $genreData[$i]['genre'];
								    } 
								    else
								    {
									    echo" ". $genreData[$i]['genre'].",";
								    }
							    } 
							?> 
							
							</p>
					        
							<p class="p2"><b>First Air Date:</b><?php echo" ". $jsonData3[0]['first_air_date']?> </p>
							
							<p class="p2"><b>Last Air Date:</b><?php echo" ". $jsonData3[0]['last_air_date']?> </p>
							
							<p class="p2"><b>Language:</b><?php echo" ". $jsonData3[0]['language']?> </p>
							
							<p class="p2"><b>Top Cast: </b>
							
							<?php 
							    for($i=0;$i<5;$i++)
								{
									if(isset($castData[$i]['cast'])){
									
									if($i==4)
									{
										
											echo" ". $castData[$i]['cast']." (".$castData[$i]['role'].")";
									} 
									else
									{
										
											echo" ". $castData[$i]['cast']." (".$castData[$i]['role']."),";
									}
									}
								} 
							?> 
							</p>
							
							
							
							<?php if(isset($jsonData3[0]["production"])){ ?>
							<p class="p2"><b>Production: </b><?php echo" ". $jsonData3[0]["production"]?> </p>
							<?php } 
							
							?>
							
							<p class="p2"><b>Episode Runtime:</b><?php echo" ". $jsonData3[0]["duration"]?> </p>
							
							<p class="p2"><b>Status:</b><?php echo" ". $jsonData3[0]["status"]?> </p>
							
							<?php if($jsonData3[0]['personal_comment']!=''){?>
							<p class="p2"><b>Comment:</b><?php echo" ". $jsonData3[0]['personal_comment']?> </p>
							<?php } ?>
							
							
							<?php 
							    $k=6;
								$z=0;
								$a=0;
							    if(!isset($_REQUEST['edit'])){
									
							    for($i=0;$i<=$jsonData3[0]["no_of_seasons"];$i++)
                     		    {
									//echo "sss<br/>";
								    for($j=0;$j<sizeof($seasonData)+1;$j++){
                                    if(isset($seasonData[$j]))										
									if($i==$seasonData[$j]['season_no'])
									{
										$k=1;
								
									}
									else {
										
									}
									
									}
									if($k==1){
										//echo "sdasd".$z;
									echo "<p class='p2'>"; 
								    if($seasonData[$z]['season_no']==0){?> <a style='color:#2464ad;' href='in_seasons.php?tv=1&season=<?php echo $seasonData[$z]['season_no'] ?>&ttitle=<?php echo $jsonData3[0]['tmdb_id']?>'> <?php echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSpecials </a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp "; } else {?>   
									<a style='color:#2464ad;' href='in_seasons.php?tv=1&season=<?php echo $seasonData[$z]['season_no'] ?>&ttitle=<?php echo $jsonData3[0]['tmdb_id']?>'> <?php echo "Season: ".$seasonData[$z]['season_no']." (". substr($seasonData[$z]['air_date'],0,4).")</a> ";}?>
								    <span style="padding-left:20px">
									Status:
									<span style="padding-left:5px">
                                        <label style="background-color:#4CAF50;color:black;width:130px;font-size:15px;padding:5px;display:inline-block;border: 1px solid #000000;height: 22px;">Watched<label>
                                    </span>
									</span>
									
									<span style="padding-left:50px">
									Rating:
									<span style="padding-left:5px;" >
									
									   <label style="background-color:#e8de27;color:black;width:80px;font-size:15px;padding:5px;display:inline-block;border: 1px solid #000000;"> <?php echo $seasonData[$z]['personal_rating'] ?> <label>
									
									</span>
									
									</span>
									
									<span>
									<img style="position:relative;top:10px;padding-left:10px;padding-top:5px;" src="css/images/starimage.png" width="34px" height="34px">
									
									</span>
									<span style="padding-left:30px">
									
									<span>
									<a href='in_seasons.php?tv=1&edit=1&season=<?php echo $seasonData[$z]['season_no'] ?>&ttitle=<?php echo $jsonData3[0]['tmdb_id']?>'>
									<label onclick="showUpdate()" style="background-color:#c14d05;color:black;width:100px;font-size:15px;padding:5px;display:inline-block;border: 1px solid #000000;cursor:pointer;height: 22px;">Edit Rating<label>
									</a>
									</span>
									
									
									
									
									
									</p>
									<?php
									
									$k=0;
									$z++;
									}
									
									else{
										
									
										//echo "SEASON".$i ."<br/>";
									}
									
							    }
								?>
								<p class="p2" style="padding-top:15px;"><a href="in_post.php?tv=1&edit=1&ttitle=<?php echo $jsonData3[0]['tmdb_id']?>"><input type="button" class="button button4" onclick="myAnFunction()" onclick="showUpdate()" name="watch_status" id="tvbtn1" value="Add Season"/></a></p>
								<?php }
                                else { 
                                ?> 
								<form action="tvpostupdate.php" method="post">
								<?php
								
					            
								for($i=$jsonData['seasons'][0]['season_number'];$i<=$jsonData3[0]["no_of_seasons"];$i++)
                     		    {
								
								    for($j=0;$j<sizeof($seasonData)+1;$j++){
                                    if(isset($seasonData[$j]))										
									if($i==$seasonData[$j]['season_no'])
									{
										$k=1;
										break;
								
									}
									else {
										
									}
										
						             }
									if($k==1){
									$k=0;
									$a++;
                        			}
									
									else{
									if(isset($jsonData['seasons'][$a]['season_number']))
									echo "<input type='hidden' name='seasons".$a."' value='".$jsonData['seasons'][$a]["season_number"]."'/>";
									echo "<p class='p2'>";
                                    if(isset($jsonData['seasons'][$a]['season_number'])) 									
								    if($jsonData['seasons'][$a]['season_number']==0 ){} else {?>   
									<a style='color:#2464ad;' href='in_seasons.php?tv=1&season=<?php echo $jsonData['seasons'][$a]['season_number'] ?>&ttitle=<?php echo $jsonData['id']?>'> <?php echo "Season: ".$jsonData['seasons'][$a]['season_number']." (". substr($jsonData['seasons'][$a]['air_date'],0,4).")</a> ";?>
								    <span style="padding-left:20px">
									Status:
									<span style="padding-left:5px"class="styled-select">
                                      <select name='status_season_<?php echo $i; ?>'>
                                            <option selected>Haven't Watched</option>
                                            <option >Watched</option>
                                       </select>
                                    </span>
									</span>
									
									<span style="padding-left:70px">
									Rating:
									<span style="padding-left:5px;" class="styled-select-rating">
                                      <select name='rating_season_<?php echo $i; ?>'>
                                            <option>1</option>
                                            <option>2</option>
											<option>3</option>
                                            <option>4</option>
											<option>5</option>
                                            <option>6</option>
											<option>7</option>
                                            <option>8</option>
											<option>9</option>
                                            <option>10</option>
                                       </select>
                                    </span>
									</span>
									<span>
									<img style="position:relative;top:10px;padding-left:10px;padding-top:5px;" src="css/images/starimage.png" width="34px" height="34px">
									
									</span>
									
	
									
									</p>
									<?php
									}
									
										//echo "SEASON".$i ."<br/>";
										$a++;
									
									}
									
							    }
								?>
								
								<?php
									
							    
																
							?> 
							
							<p class="p2"><textarea name="comment" ><?php echo" ". $jsonData3[0]['personal_comment']?></textarea></p>
							
							<input type="hidden" name="first" value="<?php echo $jsonData['seasons'][0]['season_number']?>"/>
							<input type="hidden" name="no_of_seasons" value="<?php echo sizeof($jsonData['seasons'])?>"/>
							<input type="hidden" name="tmdb_id" value="<?php echo $_REQUEST["ttitle"]?>"/>
							<input type="hidden" name="id" value="<?php echo $jsonData3[0]["id"]?>"/>
							<p class="p2"><input type="submit" class="button button4" onclick="myAnFunction()" name="watch_status" id="tvbtn2" value="UPDATE"/></a></p>
                
                            </form>							
								<?php } ?>
							
							
							<p class="p2"><img src="css/images/imdb_logo.png" width="100px" height="50px"/></p>
						    
							<p style="display:none;font-size:14px;font-weight:bold;float:right;color:#FF0000;"  id="myPopup">Add Personal Rating</p>
						</div>
						
						
						
					</div>
				    </div>
			    </div>
		    </div>
	</div>
		
		
		
	<?php
	}

	?>
	
	
	<?php }
	
	?>
	
	
	<!--Footer -->
	<?php
	
	include("footer.php");
	
	?>
	<!-- Footer end-->


	
</div>
</body>

</html>