<?php
$resultsFile = 'results.json';

// Загружаем данные из файла
$results = file_exists($resultsFile) ? json_decode(file_get_contents($resultsFile), true) : [];

if (!is_array($results)) {
    $results = [];
}

// Сортируем данные по проценту баллов от большего к меньшему
usort($results, fn($a, $b) => $b['score'] <=> $a['score']);

// Ограничиваем вывод до 10 результатов
$results = array_slice($results, 0, 10);

require_once('finish_index.php');