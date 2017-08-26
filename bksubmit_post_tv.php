<pre>
<?php
include("bkpost.php");
include("download_image.php");
include("database.php");
$strp=$_REQUEST['tmdb_id']." tv poster.jpg";
$strc=$_REQUEST['tmdb_id']." tv cover.jpg";

$strp=str_replace(':', '',$strp);
$strc=str_replace(':', '',$strc);

if(downloadFile ($_REQUEST['poster'], "images/$strp"))
{
	echo "good";
}
else{
	echo "false";
}
downloadFile ($_REQUEST['cover_photo'], "images/$strc");
$text=$_REQUEST['overview'];
$text=str_replace('"', "'", $text);
$watchedDate='';
$sql='INSERT INTO tvlist (id, tmdb_id, title, year, poster, user_rating,'.
' cover_photo, overview, language, production, first_air_date, last_air_date, duration, personal_comment, no_of_seasons, no_of_episodes, status, added_date) VALUES'.
' (NULL, "'.$_REQUEST["tmdb_id"].'", "'.$_REQUEST["title"].'", "'.$_REQUEST["year"].'", "images/'.$strp.'", "'.$_REQUEST["user_rating"].'",'.
' "images/'.$strc.'", "'.$text.'", "'.$_REQUEST["language"].'", "'.$_REQUEST["production"].'", "'.$_REQUEST["first_air_date"].'", "'.$_REQUEST["last_air_date"].'",'.
' "'.$_REQUEST["duration"].'", "'.$_REQUEST["comment"].'", "'.$_REQUEST["no_of_seasons"].'", "'.$_REQUEST["no_of_episodes"].'", "'.$_REQUEST["status"].'", sysdate() );';
//echo $sql;
//print_r($GLOBALS);

$res=insertDataId($sql);
//echo $res;

if(!$res){

}
else{
	
	for($i=0;$i<4;$i++)
    {
		if(isset($_REQUEST['created_by'.$i])){
	    $sql="INSERT INTO tv_creater_table (id, name) VALUES(".$res.", '". $_REQUEST['created_by'.$i]."')";
	    insertData($sql);
		}
    }
	
	
	for($i=0;$i<$_REQUEST['genre_count'];$i++)
    {
	    $sql="INSERT INTO tv_genre_table (id, genre) VALUES(".$res.", '". $_REQUEST['genre'.$i]."')";
	    insertData($sql);
    }
	
	for($i=0;$i<5;$i++){
		if(isset($_REQUEST['cast'.$i])){
			$sql="INSERT INTO tv_cast_table (id, cast, role) VALUES ('".$res."', '".$_REQUEST['cast'.$i]."', '".$_REQUEST['role'.$i]."' );";
			insertData($sql);
			
		}
		//
	}

    for($i=0;$i<$_REQUEST['no_of_seasons'];$i++){
		if(isset($_REQUEST['status_season_'.$i]))
		if($_REQUEST['status_season_'.$i]!="Haven't Watched"){
			
				$jsonData=getTVSeasonData($_REQUEST["tmdb_id"],$_REQUEST["seasons".$i]);
                $jsonData = json_decode($jsonData, true);
				$sql='INSERT INTO tv_season_table (id, season_no, personal_rating, no_of_episodes, air_date) VALUES ("'.$res.'", "'.$_REQUEST["seasons".$i].'", "'.$_REQUEST["rating_season_".$i].'", "'.sizeof($jsonData["episodes"]).'", "'.$jsonData['air_date'].'" );';
				$pid=insertDataId($sql);
				for($j=0;$j<sizeof($jsonData["episodes"]);$j++){
					$text=$jsonData['episodes'][$j]['overview'];
                    $text=str_replace('"', "'", $text);
				$sql='INSERT INTO tv_episode_detail (id, episode, name, release_date, overview) VALUES ("'.$pid.'", "'.$jsonData['episodes'][$j]['episode_number'].'", "'.$jsonData['episodes'][$j]['name'].'", "'.$jsonData['episodes'][$j]['air_date'].'", "'.$text.'" );';
				insertData($sql);
				
				
				/*if(!$pid){

                }
				
			    
			    else{
				
			    }*/
			    //echo $_REQUEST['seasons'.$i];
				//}
				
			
				
		}
		
	}
}

    $sql="SELECT AVG(personal_rating) AS rating FROM tv_season_table WHERE id=".$res;	
	$rating=getJSONFromDB($sql);
    $rating = json_decode($rating, true);
	
	$sql="UPDATE tvlist SET personal_rating = '".$rating[0]['rating']."' WHERE tvlist.id ='".$res."';";
	insertData($sql);
	
	//print_r($GLOBALS);
    //header("Location:in_post.php?ttitle=".$tt);
		
	
}


$tt=$_REQUEST['tmdb_id'];
header("Location:in_post.php?tv=1&ttitle=".$tt);


?>

</pre>