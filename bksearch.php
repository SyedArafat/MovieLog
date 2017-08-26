<?php
function getSearchData($strng){
$strng=urlencode($strng);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/search/movie?query=$strng&page=1&language=en-US&api_key=a9255275ff1fa91165b424e7721a7e6a",
  
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
  //echo "cURL Error #:" . $err;
} else {
	return $response;
  //$jsonData2 = json_decode($response, true);
  //print_r($jsonData2);
  //print_r($jsonData2['total_results']);

  //print $obj->{'total_results'};

  //echo $response;
}
}




function getSearchDataTV($strng){
$strng=urlencode($strng);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/search/tv?api_key=a9255275ff1fa91165b424e7721a7e6a&language=en-US&query=$strng&page=1",
  
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{}",
));

//print_r($url);
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  //echo "cURL Error #:" . $err;
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