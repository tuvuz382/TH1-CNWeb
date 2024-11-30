<?php 
    $filename = "Quiz.txt";
    $questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $question = [];
    $current_question = [];
    $number = 0;
?>