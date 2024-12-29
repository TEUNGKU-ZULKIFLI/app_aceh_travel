<?php
include '../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $no_hp = $_POST['no_hp'];
    $role = $_POST['role']; // Menambahkan role

    // Validasi jika data tidak kosong
    if (empty($nama) || empty($email) || empty($password) || empty($no_hp) || empty($role)) {
        echo json_encode(["success" => false, "message" => "Semua field wajib diisi!"]);
        exit();
    }

    // Validasi nilai role (harus 'penumpang' atau 'sopir')
    if ($role !== 'penumpang' && $role !== 'sopir') {
        echo json_encode(["success" => false, "message" => "Role tidak valid!"]);
        exit();
    }

    // Query untuk menambahkan user dengan role
    $query = "INSERT INTO users (nama, email, password, no_hp, role) VALUES ('$nama', '$email', '$password', '$no_hp', '$role')";

    if ($connect->query($query) === TRUE) {
        echo json_encode(["success" => true, "message" => "REGISTER BERHASIL"]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal menambahkan data: " . $connect->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid Request"]);
}
?>
