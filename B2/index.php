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

// Lấy câu hỏi từ cơ sở dữ liệu
$stmt = $pdo->query("SELECT * FROM question");
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz App</title>
</head>
<body>
    <h1>Bài trắc nghiệm</h1>
    <form method="POST" action="answer.php">
        <?php foreach ($questions as $question): ?>
            <div>
                <p><strong><?= $question['question'] ?></strong></p>
                <label><input type="radio" name="<?= $question['ID'] ?>" value="A" required> <?= $question['OptionA'] ?></label><br>
                <label><input type="radio" name="<?= $question['ID'] ?>" value="B"> <?= $question['OptionB'] ?></label><br>
                <label><input type="radio" name="<?= $question['ID'] ?>" value="C"> <?= $question['OptionC'] ?></label><br>
                <label><input type="radio" name="<?= $question['ID'] ?>" value="D"> <?= $question['OptionD'] ?></label><br>
            </div>
            <hr>
        <?php endforeach; ?>
        <button type="submit">Nộp bài</button>
    </form>
</body>
</html>
