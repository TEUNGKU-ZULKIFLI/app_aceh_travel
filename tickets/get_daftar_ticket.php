<?php
include '../conn.php';

// Ambil parameter dari URL
$kotaAsal = $_GET['kota_asal'] ?? '';
$kotaTujuan = $_GET['kota_tujuan'] ?? '';
$tanggal = $_GET['tanggal'] ?? '';
$waktuBerangkat = $_GET['waktu_berangkat'] ?? '';

// Validasi input parameter
if (empty($kotaAsal) || empty($kotaTujuan) || empty($tanggal) || empty($waktuBerangkat)) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Semua parameter harus diisi']);
    exit;
}

// Siapkan query
$sql = "SELECT * FROM tickets WHERE kota_asal = ? AND kota_tujuan = ? AND tanggal = ? AND waktu_berangkat = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param('ssss', $kotaAsal, $kotaTujuan, $tanggal, $waktuBerangkat);

// Eksekusi query
$stmt->execute();
$result = $stmt->get_result();

// Ambil hasil pencarian
$tickets = [];
while ($row = $result->fetch_assoc()) {
    $tickets[] = $row;
}

// Kembalikan hasil dalam format JSON
header('Content-Type: application/json');
if (count($tickets) > 0) {
    echo json_encode($tickets);
} else {
    echo json_encode(['message' => 'Tidak ada tiket ditemukan']);
}

?>
