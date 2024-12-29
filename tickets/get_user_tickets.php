<?php
include '../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];

    $query = "SELECT t.kota_asal, t.kota_tujuan, t.tanggal, t.waktu_berangkat, t.harga, utt.seat_number 
              FROM user_ticket_transactions utt
              JOIN tickets t ON utt.ticket_id = t.id
              WHERE utt.user_id = ? AND utt.status = 'completed'";

    $stmt = $connect->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode(['status' => 'success', 'data' => $data]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>