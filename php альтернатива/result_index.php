<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Результаты теста</title>
</head>
<body>
    <h1>Результаты теста</h1>
    <p>Имя: <?= htmlspecialchars($username) ?></p>
    <p>Правильных ответов: <?= $correctCount ?> из <?= $totalQuestions ?></p>
    <p>Процент набранных баллов: <?= $scorePercent ?>%</p>
    <a href="finish_data.php">Просмотреть таблицу результатов</a>
</body>
</html>
