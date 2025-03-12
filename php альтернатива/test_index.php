<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Прохождение теста</title>
</head>
<body>
    <h1>Пройдите тест</h1>
    <form method="post">
        <label>Введите ваше имя:
            <input type="text" name="username" required>
        </label>
        <?php foreach ($testData['questions'] as $index => $question): ?>
            <fieldset>
                <legend><?= htmlspecialchars($question['question']) ?></legend>
                <?php
                $inputType = count($question['correct']) > 1 ? 'checkbox' : 'radio';
                ?>
                <?php foreach ($question['answers'] as $answerIndex => $answer): ?>
                    <label>
                        <input type="<?= $inputType ?>" name="answers[<?= $index ?>]<?= $inputType === 'radio' ? '' : '[]' ?>" value="<?= $answerIndex ?>">
                        <?= htmlspecialchars($answer) ?>
                    </label><br>
                <?php endforeach; ?>
            </fieldset>
        <?php endforeach; ?>
        <button type="submit">Завершить тест</button>
    </form>
</body>
</html>
