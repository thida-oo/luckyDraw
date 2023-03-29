<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://hr.oppo-aed-co.com/api/front/DashBoardMainFetchMenu',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "type" : "2"
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer OHQyNmV5TVMxdlBUdWVEd3lBUUtxOE0za043enRudUZJMTNCMi9vTURMVEJoQUhtaTBvZzB1R2Z3a1piQWFIVVN4RjFUVFlRaSsvNWkrR203cEIybHhIdXFuMDZEVW5xNFQ0THc3UURNOWkwUVpnMkkyREZlemJOSlpYVTRGQkFtUUNoYmtPMW1wSUptTSsxSW5pd1BZN3h4aExTc3A3L2RNMDhQSkxxK1IwNnNWSDBweU4yTm13THJvME9wUHVpbEVxQjJabVJWVGxHS3pjTDRJK1FZQ1YvWkQxQ3VYUzhjQ1lLa2hwa21vcjhCOC9EMFJwWmpGcngyTWpWUXJsa3N2OGRzWEk1QnhkMi9IWDhXbFZpL3c9PQ==',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>