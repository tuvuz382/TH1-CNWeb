<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Tài Khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<div class="container mt-5">
    <h1 class = "text-center">Danh Sách Sinh viên</h1>
    <form action="process.php" method="POST">
        <button type="submit">Load CSV</button>
    </form>
    <table class = "table table-bordered table-striped allign-center">
        <thead class="table-dark text-black">
            <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Họ</th>
                <th>Tên</th>
                <th>Thành phố</th>
                <th>Email</th>
                <th>Khóa học</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Kết nối CSDL
            $conn = new mysqli("localhost", "root", "", "qlsv");
            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            // Lấy dữ liệu từ CSDL
            $sql = "SELECT * FROM sv";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['username']}</td>
                            <td>{$row['password']}</td>
                            <td>{$row['lastname']}</td>
                            <td>{$row['firstname']}</td>
                            <td>{$row['city']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['course1']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Chưa có dữ liệu</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
