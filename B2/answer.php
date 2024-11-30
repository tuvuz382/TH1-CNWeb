<?php
// Kết nối cơ sở dữ liệu
$host = 'localhost';
$dbname = 'quiz';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối CSDL: " . $e->getMessage());
}

// Tính điểm và hiển thị kết quả
$score = 0;
$totalQuestions = 0;
$results = [];

foreach ($_POST as $id => $answer) {
    $stmt = $pdo->prepare("SELECT Answer FROM question WHERE ID = ?");
    $stmt->execute([$id]);
    $correctAnswer = $stmt->fetchColumn();
    $totalQuestions++;

    if ($correctAnswer === $answer) {
        $score++;
        $results[$id] = 'Đúng';
    } else {
        $results[$id] = 'Sai (Đáp án đúng: ' . $correctAnswer . ')';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kết quả bài làm</title>
</head>
<body>
    <h1>Kết quả bài làm</h1>
    <p>Bạn trả lời đúng <?= $score ?> trên tổng số <?= $totalQuestions ?> câu hỏi.</p>

    <h2>Chi tiết kết quả:</h2>
    <ul>
        <?php foreach ($results as $id => $result): ?>
            <li>Câu <?= $id ?>: <?= $result ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="index.php">Làm lại bài</a>
</body>
</html>
