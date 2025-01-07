<?php
// Die URL der API
$api_url = "https://api.scplist.kr/api/servers/84658";

// Initialisiere cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Führe den API-Aufruf aus
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Fehlerbehandlung
if ($http_code !== 200 || $response === false) {
    http_response_code(500);
    echo json_encode(["error" => "Fehler beim Abrufen der API-Daten."]);
    exit;
}

// Schließe die cURL-Verbindung
curl_close($ch);

// Dekodiere die JSON-Antwort
$data = json_decode($response, true);

// Extrahiere den Servernamen und die Mods
$server_name = isset($data['info']) ? strip_tags($data['info']) : 'Unbekannt';
$modded = isset($data['modded']) && $data['modded'] ? "EXILED " . $data['techList'][0]['version'] : 'Nicht modifiziert';

// Bereite die Antwort mit den gewünschten Informationen vor
$server_info = [
    'serverId' => $data['serverId'] ?? 'N/A',
    'serverName' => $server_name,
    'online' => $data['online'] ?? false,
    'version' => $data['version'] ?? 'N/A',
    'players' => $data['players'] ?? '0/32',
    'modded' => $modded,
];

// Gebe die Daten als JSON zurück
header('Content-Type: application/json');
echo json_encode($server_info);
?>
