<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Таблица результатов</title>
</head>
<body>
    <h1>Таблица результатов</h1>
    <?php if (empty($results)): ?>
        <p>Нет результатов.</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>Имя</th>
                <th>Процент набранных баллов</th>
            </tr>
            <?php foreach ($results as $result): ?>
                <tr>
                    <td><?= htmlspecialchars($result['name']) ?></td>
                    <td><?= $result['score'] ?>%</td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <a href="index.php">На главную</a>
</body>
</html>
