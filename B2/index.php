<?php include "readFile.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Trả lời trắc nghiệm</title>
</head>
<body>
    <div class="container mt-5">
    <h2 class="fw-bold text-center">Kiểm tra trắc nghiệm</h2>
        <form action="nopbai.php" method="POST">
        <?php
            $c = 0;
            foreach ($questions as $line) {
                if (strpos($line, "Câu") === 0) {
                    if (!empty($current_question)) {
                        $question = $current_question;
                        $number++;
                        if($c === 6){?>
                        <?php
                            echo "<div class='card mb-4'>";
                            echo "<div class='card-header'><strong>{$question[0]}</strong></div>";
                            echo "<div class='card-body'>";
                            for ($i = 1; $i <= 4; $i++) {
                                $answer = substr($question[$i], 0, 1); // A, B, C, D
                                echo "<div class='form-check'>";
                                echo "<input class='form-check-input' type='radio' name='question{$number}' value='{$answer}' id='question{$number}{$answer}'>";
                                echo "<label class='form-check-label' for='question{$number}{$answer}'>{$question[$i]}</label>";
                                echo "</div>";
                            }
                            echo "</div>";
                            echo "</div>";
                        ?>
                        <?php $c=0;}
                    }
                    $current_question = [];
                }
                $current_question[] = $line;
                $c++;
            }
            if (!empty($current_question)) {
                $question = $current_question;
            }
            echo "<div class='card mb-4'>";
                            echo "<div class='card-header'><strong>{$question[0]}</strong></div>";
                            echo "<div class='card-body'>";
                            for ($i = 1; $i <= 4; $i++) {
                                $answer = substr($question[$i], 0, 1); // A, B, C, D
                                echo "<div class='form-check'>";
                                echo "<input class='form-check-input' type='radio' name='question{$number}' value='{$answer}' id='question{$number}{$answer}'>";
                                echo "<label class='form-check-label' for='question{$number}{$answer}'>{$question[$i]}</label>";
                                echo "</div>";
                            }
                            echo "</div>";
                            echo "</div>";

            ?>
            <div class="d-flex justify-content-center mb-4">
                <button type="submit" class="btn btn-primary">Nộp bài</button>
            </div>
        </form>
    </div>
</body>
</html>