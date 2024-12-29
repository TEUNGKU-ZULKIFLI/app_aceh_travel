<?php
include '../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticket_id = $_POST['ticket_id'];

    // Validasi jika ticket_id kosong
    if (empty($ticket_id)) {
        echo json_encode(["success" => false, "message" => "Ticket ID diperlukan"]);
        exit();
    }

    // Query untuk mendapatkan jumlah kursi
    $query = "SELECT jumlah_kursi FROM tickets WHERE id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $ticket_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            echo json_encode(["success" => true, "jumlah_kursi" => $data['jumlah_kursi']]);
        } else {
            echo json_encode(["success" => false, "message" => "Tiket tidak ditemukan"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Gagal mendapatkan data kursi"]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid Request"]);
}

$connect->close();
?>
