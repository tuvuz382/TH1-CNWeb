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
    die("Lỗi kết nối CSDL: " . $e->getMessage()); // In thông báo lỗi nếu kết nối thất bại
}

// Đọc dữ liệu từ tệp questions.txt
$file = 'Quiz.txt';
if (!file_exists($file)) {
    die("Không tìm thấy tệp questions.");
}

$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); // Loại bỏ dòng trống


// Xử lý và lưu vào cơ sở dữ liệu
for ($i = 0; $i < count($lines); $i += 6) {
    // Kiểm tra xem có đủ dữ liệu cho câu hỏi không
    if (!isset($lines[$i], $lines[$i + 1], $lines[$i + 2], $lines[$i + 3], $lines[$i + 4], $lines[$i + 5])) {
        echo "Bỏ qua câu hỏi thiếu dữ liệu tại dòng " . ($i + 1) . ".<br>";
        continue;
    }

    $question = trim($lines[$i]);
    $optionA = trim($lines[$i + 1]);
    $optionB = trim($lines[$i + 2]);
    $optionC = trim($lines[$i + 3]);
    $optionD = trim($lines[$i + 4]);
    $answer = trim($lines[$i + 5]);

    // Kiểm tra các trường có rỗng không
    if (empty($question) || empty($optionA) || empty($optionB) || empty($optionC) || empty($optionD) || empty($answer)) {
        echo "Bỏ qua câu hỏi rỗng tại dòng " . ($i + 1) . ".<br>";
        continue;
    }

    // Lưu vào cơ sở dữ liệu
    $stmt = $pdo->prepare("INSERT INTO question (Question, OptionA, OptionB, OptionC, OptionD, Answer) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$question, $optionA, $optionB, $optionC, $optionD, $answer]);
}
echo "Lưu dữ liệu thành công vào bảng Question!";

