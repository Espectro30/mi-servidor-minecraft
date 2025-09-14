<?php

header('Content-Type: application/json');

$PTERODACTYL_URL_BASE = 'http://192.168.20.253:56304';
$PTERODACTYL_SERVER_UUID = 'cb2058b6-aab4-4861-ae4c-361943b01c43';
$PTERODACTYL_API_KEY = 'ptlc_orNRiKVnFWGIP8iQknQ0KZDX3os2sDDMfL5dg91j470';

$url = "{$PTERODACTYL_URL_BASE}/api/client/servers/{$PTERODACTYL_SERVER_UUID}/utilization";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $PTERODACTYL_API_KEY,
    'Accept: Application/vnd.pterodactyl.v1+json'
));

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode(['error' => 'Error al contactar con la API de Pterodactyl.']);
} else {
    echo $response;
}

curl_close($ch);

?>