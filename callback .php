<?php
require_once 'config.php';
$access_token = "";
$response = "";
$html = "";
$authorization = CLIENT_ID.":".CLIENT_SECRET;
	//get token
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.fitbit.com/oauth2/token");
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query (array(
	'grant_type' => 'authorization_code',
	'code' => $_GET['code'],
	'client_id' => CLIENT_ID,
	'client_secret' => CLIENT_SECRET,
	'redirect_uri' => REDIRECT_URI
	)));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Authorization: Basic '.base64_encode($authorization),
		'Content-Type: application/x-www-form-urlencoded'
	));
	$data = curl_exec($ch);
	$response = json_decode($data);
	$access_token = $response->access_token;
	curl_close($ch);
	//get user profile
	if(!empty($access_token)) {
		$oauth_profile_header = ["Authorization: Bearer ".$access_token]; 
		$url = "https://api.fitbit.com/1/user/-/profile.json";
		$cu = curl_init($url);
		curl_setopt($cu, CURLOPT_HTTPHEADER, $oauth_profile_header);
		curl_setopt($cu, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($cu, CURLOPT_SSL_VERIFYPEER, false);
		$result_profile = curl_exec($cu);
		$result_profile = json_decode($result_profile);
		curl_close($cu);
		//get user heart rate
		$url_heartrate = "https://api.fitbit.com/1/user/-/activities/heart/date/today/1d.json";
		$cu_heartrate = curl_init($url_heartrate);
		curl_setopt($cu_heartrate, CURLOPT_HTTPHEADER, $oauth_profile_header);
		curl_setopt($cu_heartrate, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($cu_heartrate, CURLOPT_SSL_VERIFYPEER, false);
		$result_heartrate = curl_exec($cu_heartrate);
		$result_heartrate = json_decode($result_heartrate);
		$res = (array)$result_heartrate;
		$heartRateZones = $res['activities-heart'][0]->value->heartRateZones;
		curl_close($cu_heartrate);
		
		
	}
	
	
	
	


