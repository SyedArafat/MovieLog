<?php
function getJSONFromDB($sql){
	$conn = mysqli_connect("localhost", "root", "","mymovielist");
	$result = mysqli_query($conn, $sql) or die(mysqli_error());
	if (mysqli_num_rows($result)==0){
		
		
	}
	else{
	    while($row = mysqli_fetch_assoc($result)) {
		    $arr[]=$row;
	    }
	//print_r($arr);
	    return json_encode($arr);
	}
}

function getRowNo($sql){
	$conn = mysqli_connect("localhost", "root", "","mymovielist");
	$result = mysqli_query($conn, $sql) or die(mysqli_error());
	if (mysqli_num_rows($result)==0){
		
		
	}
	else{
	    return mysqli_num_rows($result);
	}
}

function insertData($sql){
	$conn = mysqli_connect("localhost", "root", "","mymovielist");
	if ($conn->query($sql) === TRUE) {
		return true;
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
	return false;
}

$conn->close();
	
}

function insertDataId($sql){
	$conn = mysqli_connect("localhost", "root", "","mymovielist");
	if ($conn->query($sql) === TRUE) {
		$last_id = $conn->insert_id;
    return $last_id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
	return false;
}

$conn->close();
	
}

?>