<?php
session_start();

$testFile = 'test.json';
$resultsFile = 'results.json';

// Загружаем тестовые данные
$testData = file_exists($testFile) ? json_decode(file_get_contents($testFile), true) : [];
if (!is_array($testData) || empty($testData['questions'])) {
    die('Ошибка загрузки теста: данные повреждены.');
}

// Проверка имени пользователя (только буквы и пробелы)
$username = $_SESSION['answers']['username'] ?? 'Аноним';
$username = trim($username);
if (!preg_match('/^[\p{L}\s]+$/u', $username)) {
    $username = 'Аноним';
}

// Проверка ответов
$answers = $_SESSION['answers']['answers'] ?? [];
if (!is_array($answers)) {
    $answers = [];
}

$correctCount = 0;
$totalQuestions = count($testData['questions']);
$totalCorrectAnswers = 0;
$userCorrectAnswers = 0;

// Обрабатываем каждый вопрос
foreach ($testData['questions'] as $index => $question) {
    if (!isset($question['question'], $question['answers'], $question['correct']) || !is_array($question['answers']) || !is_array($question['correct'])) {
        continue;
    }
    // Получаем правильные ответы и приравниваем их к числам
    $correctAnswers = array_map('intval', $question['correct']); // Приведение правильных ответов к числам
    $totalCorrectAnswers += count($correctAnswers);

    $userAnswers = $answers[$index] ?? [];

    // Если пользовательский ответ строка (единичный выбор), приводим к массиву
    if (!is_array($userAnswers)) {
        $userAnswers = [$userAnswers];
    }

    // Приводим ответы пользователя к числам и отфильтровываем невалидные значения
    $userAnswers = array_filter(array_map('intval', $userAnswers), fn($val) => in_array($val, array_keys($question['answers'])));

    sort($correctAnswers);
    sort($userAnswers);

    // Проверяем правильность ответа
    if ($correctAnswers === $userAnswers) {
        $correctCount++;
        $userCorrectAnswers += count($correctAnswers);
    } else {
        $userCorrectAnswers += count(array_intersect($correctAnswers, $userAnswers));
    }
}

// Подсчет итогового процента
$scorePercent = $totalCorrectAnswers > 0 ? round(($userCorrectAnswers / $totalCorrectAnswers) * 100, 2) : 0;

// Загружаем предыдущие результаты
$results = file_exists($resultsFile) ? json_decode(file_get_contents($resultsFile), true) : [];
if (!is_array($results)) {
    $results = [];
}

// Добавляем новый результат
$results[] = ['name' => htmlspecialchars($username, ENT_QUOTES, 'UTF-8'), 'score' => $scorePercent];

// Сортируем по убыванию процентов
usort($results, fn($a, $b) => $b['score'] <=> $a['score']);

// Ограничиваем до 10 результатов
$results = array_slice($results, 0, 10);

// Сохраняем результаты
file_put_contents($resultsFile, json_encode($results, JSON_PRETTY_PRINT));

require_once('result_index.php');
