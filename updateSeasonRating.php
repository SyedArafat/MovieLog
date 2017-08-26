<?php

print_r($GLOBALS);
include("database.php");
$sql='UPDATE tv_season_table SET personal_rating = "'.$_REQUEST['rating_season'].'" WHERE tv_season_table.pid ='.$_REQUEST['pid'].';';
//print_r($GLOBALS);/*
if(insertData($sql)){
	if($_REQUEST["rating_season"]-$_REQUEST["this_season_rating"]!=0){
		$sql="select id from tv_season_table where id=".$_REQUEST['id'];
		$seasonNo=getRowNo($sql);
		//echo $seasonNo;
		$newrating=($_REQUEST["rating_season"]-$_REQUEST["this_season_rating"])/$seasonNo;
		$newrating=$_REQUEST['rating']+$newrating;
		echo $newrating;
		$sql='UPDATE tvlist SET personal_rating='.$newrating." WHERE tvlist.id=".$_REQUEST['id'];
		insertData($sql);
		header("Location:in_post.php?tv=1&ttitle=".$_REQUEST['tmdb_id']);
	}
	//$sql='UPDATE tv_season_table SET personal_rating = "'.$_REQUEST['rating_season'].'" WHERE tv_season_table.pid ='.$_REQUEST['pid'].';';
	header("Location:in_post.php?tv=1&ttitle=".$_REQUEST['tmdb_id']);
}
else{
	
	
}

?>