<?php

require "settings.php";

// Obtains and returns the value of a claim 
// $claim is the name of the claim to be read
// $data is the text to fetch the claim & value from
// $respIsString is whether or not the needed value is surrounded by quotes ""
function getClaim($claim, $data, $respIsString = true) {
		$value_array = array();
		if ($respIsString) preg_match('/.+"'.$claim.'":\W*"([^"]+)/', $data, $value_array);
		else preg_match('/.+"'.$claim.'":\W*([^,]+)/', $data, $value_array);
		return $value_array[1];
}

class EndpointHandler {
	
	private $metadata = "";
	
	public function __construct($policy_name) {
		$this->getMetadata($policy_name);
	}
	
	public function getEndpointData($uri) {

		$ch = curl_init($uri);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // option to return as a string
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$resp = curl_exec($ch);
		curl_close($ch);
		return $resp;
	}
	
	public function postEndpointData($uri, $fields) {
		//url-ify the data for the POST
		$fields_string = "";
		foreach ($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		$fields_string = rtrim($fields_string, '&');
					
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $uri);
		curl_setopt($ch,CURLOPT_POST, sizeof($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // option to return as a string
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$resp = curl_exec($ch);
		curl_close($ch);
		return $resp;
	}
	
	public function getMetadata($policy_name) {
		require "settings.php";
		$metadata_endpoint = $metadata_endpoint_begin . $policy_name;
		$this->metadata = $this->getEndpointData($metadata_endpoint);
	}
	
	public function getIssuer() {
		$iss = getClaim("issuer", $this->metadata);
		return $iss;	
	}
	
	public function getAuthorizationEndpoint() {
		require "settings.php";
		$authorization_endpoint = getClaim("authorization_endpoint", $this->metadata).
											'&response_type='.$response_type.
											'&client_id='.$clientID.
											'&redirect_uri='.$redirect_uri.
											'&response_mode='.$response_mode.
											'&scope='.$scope;
		return $authorization_endpoint;
	}
		
	public function getEndSessionEndpoint() {
		require "settings.php";
		$end_session_endpoint = getClaim("end_session_endpoint", $this->metadata).
																'&redirect_uri='.$redirect_uri;
		return $end_session_endpoint;
	}
		
	public function getTokenEndpoint() {
		$token_endpoint = getClaim("token_endpoint", $this->metadata);
		return $token_endpoint;
	}
	
	public function getJwksUri() {
		$jwks_uri = getClaim("jwks_uri", $this->metadata);
		return $jwks_uri;	
	}
	
	public function getJwksUriData() {
		$jwks_uri = $this->getJwksUri();
		$key_data = $this->getEndpointData($jwks_uri);
		return $key_data;
	}
}

?>