<?php 
include("bkpost.php");
include("database.php");

if(isset($_REQUEST["tv"])){
	$sql="SELECT * FROM tvlist WHERE tmdb_id=".$_REQUEST['ttitle'];
    $jsonData3=getJSONFromDB($sql);
    $jsonData3 = json_decode($jsonData3, true);
	
	if(sizeof($jsonData3)==0){
		//echo "LLLL";
	    $watchstatus=0;
		$tvShowData=getTVData($_REQUEST["ttitle"]);
        $tvShowData = json_decode($tvShowData, true);
        $jsonData=getTVSeasonData($_REQUEST["ttitle"],$_REQUEST["season"]);
        $jsonData = json_decode($jsonData, true);
        
        //$creditData=getTVCredit($_REQUEST["ttitle"]);
        //$creditData=json_decode($creditData, true);
		//print_r($GLOBALS);


    }
	
	else{
		//echo "LLLLsds";
		$watchstatus=1;
		
		$sql="SELECT * FROM tv_season_table WHERE id=".$jsonData3[0]['id']." and season_no=".$_REQUEST['season'];
		//print_r($GLOBALS);
		$seasonTable=getJSONFromDB($sql);
        $seasonTable = json_decode($seasonTable, true);
		if(sizeof($seasonTable)==0){
			$tvShowData['name']=$jsonData3[0]['title'];
			$jsonData=getTVSeasonData($_REQUEST["ttitle"],$_REQUEST["season"]);
            $jsonData = json_decode($jsonData, true);
			$watchstatus=0;
		}
		else{
		$sql='SELECT * FROM tv_episode_detail WHERE id='.$seasonTable[0]['pid'];
		$episodeTable=getJSONFromDB($sql);
        $episodeTable = json_decode($episodeTable, true);
		}
		//print_r($GLOBALS);
	}
	
}

?>

<!DOCTYPE html>

<html>
<head>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/astyle.css" type="text/css" media="all" />

</head>

<script>
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

function secFunction(){
	document.getElementById('myPopup').style.display="none";

}

function editFunction(){
	document.getElementById('comment_box').style.display='block';
	document.getElementById('edit').style.display='none';
	document.getElementById('update').style.display='block';

}

function starFunction(obj){
	obj.disabled=true;
	
}


</script>



<body>
<?php
include("header.php");

 if($watchstatus==0) {?>
	<form action="bksubmit_post.php" method="post">
	<div id="content">
		<div class="line-hor"></div>
     		<div class="box">
			
				<div class="border-right">
					<div class="border-left">
					<div class="bkboximage">
						<div class="inner">
							<a href="in_post.php?tv=1&ttitle=<?php echo $_REQUEST['ttitle']?>"><h3><?php echo $tvShowData['name']." "?><?php if($_REQUEST['season']!=0){ ?> <span> Season <?php echo $_REQUEST['season']." " ?> (<?php echo  substr($jsonData['air_date'],0,4) ?>)<?php } else {echo "<span>Specials</span>";}?></span> </h3></a>
							<input type="hidden" name="title" value="<?php echo $jsonData['name']?>"/>
							<input type="hidden" name="year" value="<?php echo  substr($jsonData['release_date'],0,4) ?>"/>
							<div class="img-box1 alt"><img src="http://image.tmdb.org/t/p/w300/<?php echo $jsonData['poster_path']?>" alt="" />
							<input type="hidden" name="poster" value="http://image.tmdb.org/t/p/w300/<?php echo $jsonData['poster_path']?>"/>
							
							<div style="position:absolute;top:176px;left:73%;height:60px;width:140px;background-color:#32CD32;text-align: center;vertical-align: middle;line-height: 60px;color:white;font-size:20px;font-weight:bold;" title="Haven't Watched">Not Yet</div>
							<div>				
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
							</div>
							<input type="hidden" name="overview" value="<?php echo $jsonData['overview']?>"/>
							
							    <div style="margin-top:120px;"><p><?php echo $jsonData['overview']?> </p></div>
                             
							</div>
							
					        
							<p class="p2"style="font-size:18px;color:red;" ><b>Total Episodes:</b><span><?php echo" ". sizeof($jsonData['episodes'])?></span> </p>
							<input type="hidden" name="total_episodes" value="<?php sizeof($jsonData['episodes'])?>"/>
							<?php for($i=0;$i<sizeof($jsonData['episodes']);$i++){?>
							<p class="p2" style="font-size:17px"><b>Episode:</b><span><?php echo" ".$jsonData['episodes'][$i]['episode_number']?></span> </p>
							<p class="p2" style="float:right;font-size:16px;color:#c1781f"><b>Release Date:</b><span><?php echo" ".$jsonData['episodes'][$i]['air_date']?></span> </p>
							<p class="p2" style="font-size:17px;color:#1fc1c1"><b><span><?php echo" ".$jsonData['episodes'][$i]['name']?></span></b> </p>
							
							<p class="p2" style="font-size:16px"><span><?php echo" ".$jsonData['episodes'][$i]['overview']?></span> </p>
							<?php } ?>
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
	<?php } else {
    		?>
	<div id="content">
		<div class="line-hor"></div>
     		<div class="box">
			
				<div class="border-right">
					<div class="border-left">
					<div class="bkboximage">
						<div class="inner">
							<a href="in_post.php?tv=1&ttitle=<?php echo $_REQUEST['ttitle']?>"><h3><?php echo $jsonData3[0]['title']." "?><?php if($_REQUEST['season']!=0){ ?> <span> Season <?php echo $_REQUEST['season']." " ?> (<?php echo  substr($seasonTable[0]['air_date'],0,4) ?>)<?php } else {echo "<span>Specials</span>";}?></span> </h3></a>
							
							<div class="img-box1 alt"><img src="<?php echo $jsonData3[0]['poster']?>" alt="" />
							
							<form action="updateSeasonRating.php" method="post">
							
							<div style="position:absolute;top:176px;left:73%;height:60px;width:140px;background-color:#32CD32;text-align: center;vertical-align: middle;line-height: 60px;color:white;font-size:20px;font-weight:bold;" title="Haven't Watched">Watched</div>
							<p>Overall Rating:<?php echo $jsonData3[0]['personal_rating']?></p>
							
							<?php if(isset ($_REQUEST["edit"])) {?>
							<p style="position:relative;left:-65px;margin-top:18px;" class="styled-select-rating">Season Rating:
							
                                      <select name='rating_season'>
                                            <option <?php if($seasonTable[0]['personal_rating']==1){echo "selected";} ?>>1</option>
                                            <option <?php if($seasonTable[0]['personal_rating']==2){echo "selected";} ?>>2</option>
											<option <?php if($seasonTable[0]['personal_rating']==3){echo "selected";} ?>>3</option>
                                            <option <?php if($seasonTable[0]['personal_rating']==4){echo "selected";} ?>>4</option>
											<option <?php if($seasonTable[0]['personal_rating']==5){echo "selected";} ?>>5</option>
                                            <option <?php if($seasonTable[0]['personal_rating']==6){echo "selected";} ?>>6</option>
											<option <?php if($seasonTable[0]['personal_rating']==7){echo "selected";} ?>>7</option>
                                            <option <?php if($seasonTable[0]['personal_rating']==8){echo "selected";} ?>>8</option>
											<option <?php if($seasonTable[0]['personal_rating']==9){echo "selected";} ?>>9</option>
                                            <option <?php if($seasonTable[0]['personal_rating']==10){echo "selected";} ?>> 10</option>
                                       </select>
									   <input type="hidden" name="pid" value="<?php echo $seasonTable[0]['pid'] ?>">
									   <input type="hidden" name="tmdb_id" value="<?php echo $_REQUEST['ttitle'] ?>">
									   <input type="hidden" name="rating" value="<?php echo $jsonData3[0]['personal_rating'] ?>">
									   <input type="hidden" name="this_season_rating" value="<?php echo $seasonTable[0]['personal_rating'] ?>">
									   <input type="hidden" name="id" value="<?php echo $seasonTable[0]['id'] ?>">
									   
									   
									   <img style="position:relative;top:0px;left:300px;" src="css/images/starimage.png" width="34px" height="34px">
									   
									   
									   <input type="submit" style="position:relative;left:-50px;top:-5px;" class="button button5" name="watch_status" onclick="editFunction()" id="update" value="Update"/>
									  </form>
							<?php } else{ ?>
							<p style="position:relative;margin-top:18px;" class="styled-select-rating">Season Rating:
							<?php echo $seasonTable[0]['personal_rating']; }?></p>		
							<div style="margin-top:80px"><img src="<?php echo $jsonData3[0]['cover_photo']?>"/></div> 
							
							</div>
							
					        
							<p class="p2"style="font-size:18px;color:red;" ><b>Total Episodes:</b><span><?php echo" ". $seasonTable[0]['no_of_episodes'] ?></span> </p>
							<?php for($i=0;$i<$seasonTable[0]['no_of_episodes'];$i++){?>
							<p class="p2" style="font-size:17px"><b>Episode:</b><span><?php echo" ".$episodeTable[$i]['episode']?></span> </p>
							<p class="p2" style="float:right;font-size:16px;color:#c1781f"><b>Release Date:</b><span><?php echo" ".$episodeTable[$i]['release_date']?></span> </p>
							<p class="p2" style="font-size:17px;color:#1fc1c1"><b><span><?php echo" ".$episodeTable[$i]['name']?></span></b> </p>
							
							<p class="p2" style="font-size:16px"><span><?php echo" ".$episodeTable[$i]['overview']?></span> </p>
							<?php } ?>
							
							<p class="p2"><input type="button" class="button button4" onclick="myFunction()" name="watch_status" id="post" value="Watched"/></p>
							
							
							
							<p class="p2"><a href="#"><img src="css/images/imdb_logo.png" width="100px" height="50px"/></a></p>
						    
						</div>
						
						
						
					</div>
				    </div>
			    </div>
		    </div>
	</div>
	
	<?php 
	}
	
	
	
	
	
	
include("footer.php");
	?>
	
	


	
</div>
</body>

</html>