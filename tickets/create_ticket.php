<?php
include '../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kota_asal = $_POST['kota_asal'];
    $kota_tujuan = $_POST['kota_tujuan'];
    $tanggal = $_POST['tanggal'];
    $waktu_berangkat = $_POST['waktu_berangkat'];
    $harga = $_POST['harga'];
    $jumlah_kursi = $_POST['jumlah_kursi'];

    // Validasi jika data tidak kosong
    if (empty($kota_asal) || empty($kota_tujuan) || empty($tanggal) || empty($waktu_berangkat) || empty($harga) || empty($jumlah_kursi)) {
        echo json_encode(["success" => false, "message" => "Semua field wajib diisi!"]);
        exit();
    }

    // Query untuk menambahkan tiket
    $query = "INSERT INTO tickets (kota_asal, kota_tujuan, tanggal, waktu_berangkat, harga, jumlah_kursi) 
              VALUES ('$kota_asal', '$kota_tujuan', '$tanggal', '$waktu_berangkat', '$harga', '$jumlah_kursi')";

    if ($connect->query($query) === TRUE) {
        echo json_encode(["success" => true, "message" => "Tiket berhasil dibuat"]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal membuat tiket: " . $connect->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid Request"]);
}
?>
