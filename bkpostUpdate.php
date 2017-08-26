<?php

print_r($GLOBALS);
include("database.php");
$sql='UPDATE movielist SET personal_rating = "'.$_REQUEST['rating'].'", personal_comment = "'.$_REQUEST['comment'].'" WHERE movielist.id ='.$_REQUEST['id'].';';
print_r($GLOBALS);
if(insertData($sql)){
	if($_REQUEST['watchDate']=="Can't Remember"){
		$date=$_REQUEST["release_date"]." 00:00:00";
		$sql='UPDATE movielist SET added_date = "'.$date.'" WHERE movielist.id ='.$_REQUEST['id'].';';
		insertData($sql);
		
	}
	else if($_REQUEST['watchDate']=="Some Time Ago") {
		$date='sysdate()';
		$sql='UPDATE movielist SET added_date = '.$date.' WHERE movielist.id ='.$_REQUEST['id'].';';
		insertData($sql);
		
	}
	header("Location:in_post.php?ttitle=".$_REQUEST['tmdb_id']);
}
else{
	
	
}
?>