<?php
include '../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mencari user berdasarkan email dan password
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $connect->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Cek role pengguna
        $role = $user['role']; // Dapatkan nilai role (penumpang atau sopir)
        
        // Set pesan dan data sesuai dengan role
        if ($role == 'penumpang') {
            $message = "Login Berhasil sebagai Penumpang";
        } elseif ($role == 'sopir') {
            $message = "Login Berhasil sebagai Sopir";
        } else {
            $message = "Login Berhasil, Role tidak dikenal";
        }

        // Kirimkan respons dengan informasi user dan role
        echo json_encode([
            "success" => true, 
            "message" => $message, 
            "user" => $user,
            "role" => $role // Sertakan role dalam respons untuk informasi lebih lanjut
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Email atau Password Salah"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid Request"]);
}
?>
