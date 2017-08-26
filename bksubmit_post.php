<?php
$sql;
include("download_image.php");
include("database.php");
$strp=$_REQUEST['tmdb_id']." poster.jpg";
$strc=$_REQUEST['tmdb_id']." cover.jpg";

$strp=str_replace(':', '',$strp);
$strc=str_replace(':', '',$strc);

if(downloadFile ($_REQUEST['poster'], "images/$strp"))
{
	//echo "good";
}
else{
	//echo "false";
}
downloadFile ($_REQUEST['cover_photo'], "images/$strc");
$text=$_REQUEST['overview'];
$text=str_replace('"', "'", $text);
if($_REQUEST['watchDate']=="Some Time Ago"){
    $watchDate='sysdate()';
	$sql='INSERT INTO movielist (id, tmdb_id, imdb_link, title, year, poster_path, user_rating,'.
' cover_path, overview, language, release_date, director, production, runtime, budget, box_office, personal_rating, personal_comment, tagline, added_date) VALUES'.
' (NULL, "'.$_REQUEST["tmdb_id"].'", "'.$_REQUEST["imdb_link"].'", "'.$_REQUEST["title"].'", "'.$_REQUEST["year"].'", "images/'.$strp.'",'.
' "'.$_REQUEST["user_rating"].'", "images/'.$strc.'", "'.$text.'", "'.$_REQUEST["language"].'", "'.$_REQUEST["release_date"].'",'.
' "'.$_REQUEST["director"].'", "'.$_REQUEST["production"].'", "'.$_REQUEST["duration"].'", "'.$_REQUEST["budget"].'", "'.$_REQUEST["box_office"].'", "'.$_REQUEST["rating"].'", "'.$_REQUEST["comment"].'", "'.$_REQUEST["tagline"].'", '.$watchDate.' );';
}
else if($_REQUEST['watchDate']=="Can't Remember")
{
	$watchDate=$_REQUEST["release_date"]." 00:00:00";
	$sql='INSERT INTO movielist (id, tmdb_id, imdb_link, title, year, poster_path, user_rating,'.
' cover_path, overview, language, release_date, director, production, runtime, budget, box_office, personal_rating, personal_comment, tagline, added_date) VALUES'.
' (NULL, "'.$_REQUEST["tmdb_id"].'", "'.$_REQUEST["imdb_link"].'", "'.$_REQUEST["title"].'", "'.$_REQUEST["year"].'", "images/'.$strp.'",'.
' "'.$_REQUEST["user_rating"].'", "images/'.$strc.'", "'.$text.'", "'.$_REQUEST["language"].'", "'.$_REQUEST["release_date"].'",'.
' "'.$_REQUEST["director"].'", "'.$_REQUEST["production"].'", "'.$_REQUEST["duration"].'", "'.$_REQUEST["budget"].'", "'.$_REQUEST["box_office"].'", "'.$_REQUEST["rating"].'", "'.$_REQUEST["comment"].'", "'.$_REQUEST["tagline"].'", "'.$watchDate.'" );';
}

//print_r($GLOBALS);

$res=insertDataId($sql);
if(!$res){
	
	//echo "I m the Boss";
	
}

//$sql="INSERT INTO `genre_table` (`id`, `genre`) VALUES ('1', 'Action');";
//$sql="INSERT INTO 'genre_table' ('id', 'genre') VALUES('1','$_REQUEST['genre']')"
else{
    for($i=0;$i<$_REQUEST['genre_count'];$i++)
    {
	    $sql="INSERT INTO genre_table (id, genre) VALUES(".$res.", '". $_REQUEST['genre'.$i]."')";
	    insertData($sql);
    }
	
	for($i=0;$i<4;$i++){
		if(isset($_REQUEST['cast'.$i])){
			$sql="INSERT INTO cast_table (id, cast) VALUES ('".$res."', '".$_REQUEST['cast'.$i]."');";
			insertData($sql);
			
		}
		
		
		
	}
}

//$sql="INSERT INTO `movielist` (`id`, `tmdb_id`, `imdb_link`, `title`, `year`, `poster_path`, `user_rating`, `cover_path`, `overview`, `language`, `release_date`, `director`, `production`, `runtime`, `budget`, `box_office`) VALUES (NULL, 'asdasdasd', '112312', 'asd', '2015', 'asdasdasdasd', '4.7', 'asdasdasdasd', 'sadasdasdasd', 'en', '1-2-3', 'asdasd', 'asdasd', '120', '123', '120');";
//print_r($GLOBALS);

$tt=$_REQUEST['tmdb_id'];
header("Location:in_post.php?ttitle=".$tt);

?>

</pre>