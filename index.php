<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.hubapi.com/crm/v3/objects/contacts/search?hapikey=87b460ca-5d93-49e2-bb5d-cc78e5efbd7c");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n    \"limit\": 1,\n    \"properties\": [ \"firstname\", \"lastname\", \"email\", \"phone\",\"are_you_interested_to_study\",\"whats_your_last_qualification\",\"which_location_is_suitable_for_you\" ],\n    \"sorts\": [\n      {\n        \"propertyName\": \"createdate\",\n        \"direction\": \"DESCENDING\"\n      }\n    ]\n  }");

$headers = [];
$headers[] = 'Content-Type: application/json';

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$output = curl_exec($ch);
//$output = json_decode($output, true);whats_your_last_qualification,are_you_interested_to_study,which_location_is_suitable_for_you
var_dump($output);


?>