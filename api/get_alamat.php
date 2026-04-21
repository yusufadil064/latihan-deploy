<?php
header('Content-Type: application/json');
$apiKey = "63cd767ef7a24cd0782b015036fd6414"; // API key dari BPS

// Tangkap 'type' request dari URL
$type = isset($_GET['type']) ? $_GET['type'] : '';

// SAKLAR LOGIKA
if ($type === 'provinsi') {
    // API untuk mengambil semua Provinsi
    $url = "https://webapi.bps.go.id/v1/api/domain/type/all/prov/00000/key/" . $apiKey;
    $response = file_get_contents($url);
    echo $response;

} elseif ($type === 'kabupaten') {
    // Tangkap kode provinsi
    $prov_id = isset($_GET['prov_id']) ? $_GET['prov_id'] : '';
    
    if ($prov_id) {
        // API untuk mengambil Kab/Kota berdasarkan Provinsi
        $url = "https://webapi.bps.go.id/v1/api/domain/type/kabbyprov/prov/" . $prov_id . "/key/" . $apiKey;
        $response = file_get_contents($url);
        echo $response;
    } else {
        echo json_encode(["error" => "Kode provinsi tidak disertakan!"]);
    }

} else {
    // Jika type tidak valid atau kosong
    echo json_encode(["error" => "Tipe request tidak valid! Gunakan type=provinsi atau type=kabupaten."]);
}
?>