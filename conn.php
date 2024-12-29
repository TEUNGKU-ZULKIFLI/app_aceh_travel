<?php
$connect = new mysqli("localhost", "root", "", "aceh_travel");

if ($connect->connect_error) {
    echo "Connection Failed: " . $connect->connect_error;
    exit();
}
?>
