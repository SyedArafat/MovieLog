<?php
include("bkpost.php");
include("download_image.php");
include("database.php");
$tt=$_REQUEST['tmdb_id'];
//print_r($GLOBALS);

if($_REQUEST['first']==1){
for($i=0;$i<=$_REQUEST['no_of_seasons'];$i++){
	if(isset($_REQUEST['status_season_'.$i]))
	if($_REQUEST['status_season_'.$i]=="Watched"){
		        $jsonData=getTVSeasonData($_REQUEST["tmdb_id"],$_REQUEST["seasons".($i-1)]);
                $jsonData = json_decode($jsonData, true);
				$sql='INSERT INTO tv_season_table (id, season_no, personal_rating, no_of_episodes, air_date) VALUES ("'.$_REQUEST['id'].'", "'.$_REQUEST["seasons".($i-1)].'", "'.$_REQUEST["rating_season_".$i].'", "'.sizeof($jsonData["episodes"]).'", "'.$jsonData['air_date'].'" );';
				$pid=insertDataId($sql);
				for($j=0;$j<sizeof($jsonData["episodes"]);$j++){
				$sql='INSERT INTO tv_episode_detail (id, episode, name, release_date, overview) VALUES ("'.$pid.'", "'.$jsonData['episodes'][$j]['episode_number'].'", "'.$jsonData['episodes'][$j]['name'].'", "'.$jsonData['episodes'][$j]['air_date'].'", "'.$jsonData['episodes'][$j]['overview'].'" );';
				insertData($sql);
				
		}
	}
}}

else{
	for($i=0;$i<=$_REQUEST['no_of_seasons'];$i++){
	if(isset($_REQUEST['status_season_'.$i]))
	if($_REQUEST['status_season_'.$i]=="Watched"){
		        $jsonData=getTVSeasonData($_REQUEST["tmdb_id"],$_REQUEST["seasons".($i)]);
                $jsonData = json_decode($jsonData, true);
				$sql='INSERT INTO tv_season_table (id, season_no, personal_rating, no_of_episodes, air_date) VALUES ("'.$_REQUEST['id'].'", "'.$_REQUEST["seasons".($i)].'", "'.$_REQUEST["rating_season_".$i].'", "'.sizeof($jsonData["episodes"]).'", "'.$jsonData['air_date'].'" );';
				$pid=insertDataId($sql);
				for($j=0;$j<sizeof($jsonData["episodes"]);$j++){
				$sql='INSERT INTO tv_episode_detail (id, episode, name, release_date, overview) VALUES ("'.$pid.'", "'.$jsonData['episodes'][$j]['episode_number'].'", "'.$jsonData['episodes'][$j]['name'].'", "'.$jsonData['episodes'][$j]['air_date'].'", "'.$jsonData['episodes'][$j]['overview'].'" );';
				insertData($sql);
				
		}
	}
}
}


$sql="SELECT AVG(personal_rating) AS rating FROM tv_season_table WHERE id=".$_REQUEST['id'];	
	$rating=getJSONFromDB($sql);
    $rating = json_decode($rating, true);
	
	$sql="UPDATE tvlist SET personal_rating = '".$rating[0]['rating']."' WHERE tvlist.id ='".$_REQUEST['id']."';";
	insertData($sql);
	
	$sql='UPDATE tvlist SET personal_comment = "'.$_REQUEST['comment'].'" WHERE tvlist.id = '.$_REQUEST['id'];
    insertData($sql);
	


//print_r($GLOBALS);
header("Location:in_post.php?tv=1&ttitle=".$tt);

?>