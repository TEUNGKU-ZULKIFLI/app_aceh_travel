<?php
require '../conn.php';

$user_id = $_POST['user_id'];
$ticket_id = $_POST['ticket_id'];
$seat_number = $_POST['seat_number'];

$sql = "INSERT INTO user_ticket_transactions (user_id, ticket_id, seat_number) VALUES (?, ?, ?)";
$stmt = $connect->prepare($sql);
$stmt->bind_param("iii", $user_id, $ticket_id, $seat_number);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Transaksi berhasil dibuat"]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal menyimpan transaksi"]);
}
$stmt->close();
$connect->close();
?>
