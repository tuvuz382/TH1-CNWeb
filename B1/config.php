<?php
$host = 'localhost';
$dbname = 'flower_db';
$username = 'root'; // Đổi username nếu cần
$password = ''; // Đổi password nếu cần

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
?>
