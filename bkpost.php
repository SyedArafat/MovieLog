<?php
session_start();
function getMovieData($strng){
$strng=urlencode($strng);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/movie/$strng?api_key=a9255275ff1fa91165b424e7721a7e6a",
  
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{}",
));
//$url="https://api.themoviedb.org/3/search/movie?query=$strng&page=1&language=en-US&api_key=a9255275ff1fa91165b424e7721a7e6a";

//print_r($url);
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
	return $response;
  //$jsonData2 = json_decode($response, true);
  //print_r($jsonData2);
  //print_r($jsonData2['total_results']);

  //print $obj->{'total_results'};

  //echo $response;
}
}

function getMovieCredit($strng){
$strng=urlencode($strng);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/movie/$strng/credits?api_key=a9255275ff1fa91165b424e7721a7e6a",
  
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{}",
));
$url="https://api.themoviedb.org/3/search/movie?query=$strng&page=1&language=en-US&api_key=a9255275ff1fa91165b424e7721a7e6a";

//print_r($url);
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
	return $response;
  //$jsonData2 = json_decode($response, true);
  //print_r($jsonData2);
  //print_r($jsonData2['total_results']);

  //print $obj->{'total_results'};

  //echo $response;
}
}

function getTVData($strng){
	$strng=urlencode($strng);
    $curl = curl_init();
	curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.themoviedb.org/3/tv/$strng?api_key=a9255275ff1fa91165b424e7721a7e6a",
  
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "{}",
));
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
	return $response;
  //$jsonData2 = json_decode($response, true);
  //print_r($jsonData2);
  //print_r($jsonData2['total_results']);

  //print $obj->{'total_results'};

  //echo $response;
}
	
}

function getTVCredit($strng){
	$strng=urlencode($strng);
    $curl = curl_init();
	curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.themoviedb.org/3/tv/$strng/credits?api_key=a9255275ff1fa91165b424e7721a7e6a&language=en-US",
  
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "{}",
));
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
	return $response;
  //$jsonData2 = json_decode($response, true);
  //print_r($jsonData2);
  //print_r($jsonData2['total_results']);

  //print $obj->{'total_results'};

  //echo $response;
}
	
}

function getTVSeasonData($strng,$season){
	$strng=urlencode($strng);
    $curl = curl_init();
	curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.themoviedb.org/3/tv/$strng/season/$season?api_key=a9255275ff1fa91165b424e7721a7e6a",
  
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "{}",
));
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
	return $response;
  //$jsonData2 = json_decode($response, true);
  //print_r($jsonData2);
  //print_r($jsonData2['total_results']);

  //print $obj->{'total_results'};

  //echo $response;
}
	
}

?>