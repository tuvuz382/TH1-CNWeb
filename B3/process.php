<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = "KTPM3_Danh_sach_diem_danh.csv";

    // Kết nối CSDL
    $conn = new mysqli("localhost", "root", "", "qlsv");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Đọc nội dung tệp CSV
    if (($handle = fopen($file, "r")) !== false) {
        $row = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            // Bỏ qua dòng tiêu đề
            if ($row == 0) {
                $row++;
                continue;
            }
            // Bỏ qua dòng username trống
            if (empty(trim($data[0]))) {
                continue;
            }

            // Gán dữ liệu vào biến
            $username = $data[0];
            $password = $data[1];
            $lastname = $data[2];
            $firstname = $data[3];
            $city = $data[4];
            $email = $data[5];
            $course1 = $data[6];

            // Lưu dữ liệu vào CSDL
            $sql = "INSERT INTO sv (username, password, lastname, firstname, city, email, course1)
                    VALUES ('$username', '$password', '$lastname', '$firstname', '$city', '$email', '$course1')";
            $conn->query($sql);
        }
        fclose($handle);
    }

    $conn->close();
    header("Location: index.php");
    exit();
} else {
    echo "Không có tệp CSV nào được tải lên.";
}
?>
