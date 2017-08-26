<!DOCTYPE html>

<html>
<head>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
</head>

<body style="height:100%;display: flex;flex-direction: column;">


<?php
include("header.php");
include("bksearch.php");
include("database.php");
if($_SERVER['REQUEST_METHOD']==='GET'){
	if(isset($_GET['tvSearch'])){
		$jsonData=getSearchDataTV($_REQUEST["search_field"]);
		$jsonData =json_decode($jsonData, true);
		//print_r($GLOBALS);
        //print_r($jsonData);
        //print_r($jsonData['total_results']);
        //print_r ($jsonData['results'][0]['title']);
        //print_r($GLOBALS);
		?>
		
		<div id="coming">
			<div class="head">
				<h3><strong></strong></h3>
				<p class="text-right"></p>
			</div>
			
		<!-- Online Search Result -->	
		<?php
		if(isset($jsonData['total_results'])){
		    if($jsonData['total_results']>0){
			    if ($jsonData['total_results']>10){$jsonData['total_results']=10;}
		        for($i=0;$i<$jsonData['total_results'];$i++){
		?>
			        <div id="sub-navigation">
			            <div class="content">
				            <a href="in_post.php?tv=1&ttitle=<?php echo $jsonData['results'][$i]['id']?>"><h4><?php echo $jsonData['results'][$i]['name'].
						    "  ( ".substr($jsonData['results'][$i]['first_air_date'],0,4)." )" ?> </h4></a>
					        <a><img src="http://image.tmdb.org/t/p/w154/<?php echo $jsonData['results'][$i]['poster_path']?>"  /></a>
				            <p><?php echo $jsonData['results'][$i]['overview'] ?></p>
				            <a>&nbsp;</a>
						    <div class ='add_button'>
					            <a href="in_post.php?tv=1&ttitle=<?php echo $jsonData['results'][$i]['id']?>"> Show Detail</a>
					        </div>
			            </div>
					
			        </div>
			<div class="cl">&nbsp;</div>
		<?php
		        }
		    }
			else if($jsonData['total_results']==0){
			$sql='SELECT * FROM movielist WHERE title like "%'.$_REQUEST["search_field"].'%"';
            $jsonData2=getJSONFromDB($sql);
            $jsonData2=json_decode($jsonData2, true);
			if(sizeof($jsonData2)==0){
			    echo "<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  No Result Found ! Try Again..</h2>";
				
			}
		    
		}
		}
		
		#offline Sesrch Result
		else{
			$sql='SELECT * FROM tvlist WHERE title like "%'.$_REQUEST["search_field"].'%"';
            $jsonData2=getJSONFromDB($sql);
            $jsonData2=json_decode($jsonData2, true);
		    //echo sizeof($jsonData2);
			if(sizeof($jsonData2)==0){
			    echo "<h1>&nbsp;&nbsp;&nbsp;&nbsp;  2 No Result Found ! Try Again..(or Movie Search)</h1>";
			}
			
			else{
			    if (sizeof($jsonData2)>10){}
		        for($i=0;$i<sizeof($jsonData2);$i++){?>
			        <div id="sub-navigation">
			            <div class="content">
				            <a href="in_post.php?tv=1&ttitle=<?php echo $jsonData2[$i]['tmdb_id']?>"><h4><?php echo $jsonData2[$i]['title'].
							"  (".substr($jsonData2[$i]['year'],0,4).")" ?> </h4></a>
					        <a><img src="<?php echo $jsonData2[$i]['poster']?>"  /></a>
				            <p><?php echo $jsonData2[$i]['overview'] ?></p>
				            <a>&nbsp;</a>
						    <div class ='add_button'>
					            <a href="in_post.php?tv=1&ttitle=<?php echo $jsonData2[$i]['tmdb_id']?>"> Show Detail</a>
					        </div>
			            </div>
					
			        </div>
			    <div class="cl">&nbsp;</div>
		    <?php
		        }
					
			}
		}
		?>
				
	    </div>
	
	
	<?php 
	}
	else{
		//print_r($GLOBALS);
        $jsonData=getSearchData($_REQUEST["search_field"]);
        $jsonData = json_decode($jsonData, true);
        
        //print_r($jsonData);
        //print_r($jsonData['total_results']);
        //print_r ($jsonData['results'][0]['title']);
        //print_r($GLOBALS);
		?>
		
		<div id="coming">
			<div class="head">
				<h3><strong></strong></h3>
				<p class="text-right"></p>
			</div>
			
		<!-- Online Search Result -->	
		<?php
		if(isset($jsonData['total_results'])){
		if($jsonData['total_results']>0){
			if ($jsonData['total_results']>10){$jsonData['total_results']=10;}
		    for($i=0;$i<$jsonData['total_results'];$i++){
		?>
			    <div id="sub-navigation">
			        <div class="content">
				        <a href="in_post.php?ttitle=<?php echo $jsonData['results'][$i]['id']?>"><h4><?php echo $jsonData['results'][$i]['title'].
						"  ( ".substr($jsonData['results'][$i]['release_date'],0,4)." )" ?> </h4></a>
					    <a><img src="http://image.tmdb.org/t/p/w154/<?php echo $jsonData['results'][$i]['poster_path']?>"  /></a>
				        <p><?php echo $jsonData['results'][$i]['overview'] ?></p>
				        <a>&nbsp;</a>
						<div class ='add_button'>
					        <a href="in_post.php?ttitle=<?php echo $jsonData['results'][$i]['id']?>"> Show Detail</a>
					    </div>
			        </div>
					
			    </div>
			<div class="cl">&nbsp;</div>
		<?php
		    }
		}
		
		else if($jsonData['total_results']==0){
			$sql='SELECT * FROM movielist WHERE title like "%'.$_REQUEST["search_field"].'%"';
            $jsonData2=getJSONFromDB($sql);
            $jsonData2=json_decode($jsonData2, true);
			if(sizeof($jsonData2)==0){
			    echo "<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    No Result Found ! Try Again..</h2>";
			}
		    
		}
		}
		
		#offline Sesrch Result
		else{
			$sql='SELECT * FROM movielist WHERE title like "%'.$_REQUEST["search_field"].'%"';
            $jsonData2=getJSONFromDB($sql);
            $jsonData2=json_decode($jsonData2, true);
			if(sizeof($jsonData2)==0){
			    echo "<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    No Result Found ! Try Again..</h2>";
			}
			else{
			    if (sizeof($jsonData2)>10){}
		        for($i=0;$i<sizeof($jsonData2);$i++){?>
			        <div id="sub-navigation">
			            <div class="content">
				            <a href="in_post.php?ttitle=<?php echo $jsonData2[$i]['tmdb_id']?>"><h4><?php echo $jsonData2[$i]['title'].
							"  (".substr($jsonData2[$i]['release_date'],0,4).")" ?> </h4></a>
					        <a><img src="<?php echo $jsonData2[$i]['poster_path']?>"  /></a>
				            <p><?php echo $jsonData2[$i]['overview'] ?></p>
				            <a>&nbsp;</a>
						    <div class ='add_button'>
					            <a href="in_post.php?ttitle=<?php echo $jsonData2[$i]['tmdb_id']?>"> Show Detail</a>
					        </div>
			            </div>
					
			        </div>
			    <div class="cl">&nbsp;</div>
		    <?php
		        }
					
			}
		}
		?>
				
	    </div>
	

		<?php
	}
}

?>

    <div style="float:left;padding-top:10px;padding-left:135px;">
	<div style="border-top:1px dashed #666;"></div>
  
	<?php
	
	include("footer.php");
	
	?>
    </div>
</div>
</body>
</html>
