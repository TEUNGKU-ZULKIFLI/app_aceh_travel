<?php
include '../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticket_id = $_POST['ticket_id'];

    // Validasi jika ticket_id kosong
    if (empty($ticket_id)) {
        echo json_encode(["success" => false, "message" => "Ticket ID diperlukan"]);
        exit();
    }

    // Query untuk mendapatkan jumlah kursi tiket
    $query = "SELECT jumlah_kursi FROM tickets WHERE id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        echo json_encode(["success" => false, "message" => "Tiket tidak ditemukan"]);
        exit();
    }

    $jumlah_kursi = $data['jumlah_kursi'];

    // Query untuk mendapatkan kursi yang sudah dipesan
    $query_reserved = "SELECT seat_number FROM user_ticket_transactions WHERE ticket_id = ?";
    $stmt_reserved = $connect->prepare($query_reserved);
    $stmt_reserved->bind_param("i", $ticket_id);
    $stmt_reserved->execute();
    $result_reserved = $stmt_reserved->get_result();

    $reserved_seats = [];
    while ($row = $result_reserved->fetch_assoc()) {
        $reserved_seats[] = $row['seat_number'];
    }

    // Hitung kursi yang tersedia
    $available_seats = [];
    for ($i = 1; $i <= $jumlah_kursi; $i++) {
        if (!in_array($i, $reserved_seats)) {
            $available_seats[] = $i;
        }
    }

    echo json_encode(["success" => true, "available_seats" => $available_seats]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid Request"]);
}

$connect->close();
?>
