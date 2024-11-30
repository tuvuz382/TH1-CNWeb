<?php
include 'config.php';

// Lấy danh sách hoa từ cơ sở dữ liệu
$stmt = $conn->prepare("SELECT * FROM flowers");
$stmt->execute();
$flowers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Kiểm tra xem người dùng là khách hay quản trị
$is_admin = isset($_GET['admin']); // Thêm `?admin` vào URL để vào giao diện quản trị
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách các loài hoa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .flower-list { display: flex; flex-wrap: wrap; gap: 20px; }
        .flower-item { border: 1px solid #ddd; border-radius: 8px; padding: 10px; width: 200px; text-align: center; }
        .flower-item img { width: 100%; border-radius: 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { border: 1px solid #ddd; padding: 8px; text-align: center; }
        td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .actions p { margin-right: 10px; }
    </style>
</head>
<body>
    <div class="text-center">
        <h1>Danh sách các loài hoa</h1>
    </div>
    <main class="container mt-4">
    <a href="add.php" button type="button" class="btn btn-success">Thêm mới</a>
        <table>
            <thead>
                <tr>
                    <th>Tên hoa</th>
                    <th>Mô tả</th>
                    <th>Ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flowers as $flower): ?>
                    <tr>
                        <td><?= htmlspecialchars($flower['name']) ?></td>
                        <td><?= htmlspecialchars($flower['description']) ?></td>
                        <td><img src="images/<?= htmlspecialchars($flower['image']) ?>" width="80"></td>
                        <td class="actions">
                            <a href="update.php?id=<?= $flower['id'] ?>" button type="button" class="btn btn-primary" >Sửa</a>
                            <a href="delete.php?id=<?= $flower['id'] ?>" button type="button" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </main>
</body>
</html>
