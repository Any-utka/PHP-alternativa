# Отчет, альтернативаная работа по PHP
## Тема: *"Разработка веб-приложения для создания и прохождения тестов"*
> *Доцен Анна, группа IA2303*
### Описание выполнения работы:
#### Инструкции по запуску проекта:
1. Открываем терминал и вводим команду для запуска проекта в барузере: ```php -S localhost:8080```, после этого переходим по предложенной ссылке.
#### Краткое описание функционала приложения:
1. Создаем стартовую страницу *index.php*, с кнопкой *начать*, после нажатия на которуй пользователь переходит на страницу с тестом;
2. Создаем файл *test.php*, в котором прописываем логику работы теста:
- ```php
     error_reporting(E_ALL);
     ini_set('display_errors', 1);
     ```
   Эти две строки служат для обработки ошибок, ```error_reporting(E_ALL);``` — устанавливает уровень отчёта об ошибках, включающий все ошибки и предупреждения, а
```ini_set('display_errors', 1);``` — включает отображение ошибок на экране.
 - ```php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['answers'] = $_POST;
    header('Location: result.php');
    exit();
   }
   ```
   - *$_SERVER['REQUEST_METHOD'] === 'POST'* - проверяет, отправлен ли POST-запрос, если да, то *$_POST* (массив с ответами пользователя) сохраняется в сессии *($_SESSION['answers'] = $_POST;)*.
   - Затем выполняется *header('Location: result.php');* — перенаправление на страницу *result.php*, где будут обработаны результаты теста.
   - *exit();* - останавливает выполнение кода после перенаправления.
3. Создаем файл *test_index.php*, нужен, чтобы создать страницу с тестом и вывести ее пользователю
4. Создаем файл *result.php*, который обрабатывает результаты теста и сохраняет их.
  - ```php
      $answers = $_SESSION['answers']['answers'] ?? [];
      if (!is_array($answers)) {
      $answers = [];
      }
      ```
    Благодаря этому получаем массив ответов *$_SESSION['answers']['answers']*, если данные не являются массивом, то моздаем пустой *$answers = [];*.
- ```php
  foreach ($testData['questions'] as $index => $question) {
    if (!isset($question['question'], $question['answers'], $question['correct']) || !is_array($question['answers']) || !is_array($question['correct'])) {
        continue;
    }
  ```
  Обрабатываем каждый вопрос, происходит перебор вопросов, далее проверяем есть ли у вопросов *question, answers, correct* и являются ли они массивом. Если данных нет или они повреждены, то пропускаем вопрос при помощи *continue*.
- ```php
     $userAnswers = array_filter(array_map('intval', $userAnswers), fn($val) => in_array($val, array_keys($question['answers'])));
    ```
  Проверяем валидность ответов, то есть приводим ответы пользователя к числам и фильтруем, осттавляя только верные индексы.
5. Создаем файл *results_index.php*, который выведет информацию с результатами, сколько верныйх отвоетов, имя и процент.
6. Создаем файл *finish_data.php*, в котором прописываем логику вывода 10 результатов на экран.
7. Создаем файл *finish_index.php*, он выводит информацию с 10 результатами в таблице.
#### Примеры тестов и результаты работы
1. Тесты хранятся в файле *test.json*
   ```json
   {
         "questions": [
             {
                 "question": "Какой язык программирования самый крутой?",
                 "answers": ["PHP", "JavaScript", "Python"],
                 "correct": [0],
                 "type": "single"
             },
             {
                 "question": "Выберите фреймворки для PHP",
                 "answers": ["Laravel", "Django", "Symfony"],
                 "correct": [0, 2],
                 "type": "multiple"
             },
             {
                 "question": "Какой из языков является интерпретируемым?",
                 "answers": ["PHP", "Java", "Python", "C++"],
                 "correct": [0, 2],
                 "type": "multiple"
             },
             {
                 "question": "Какие фреймворки существуют для Python?",
                 "answers": ["Django", "Laravel", "Flask", "Symfony"],
                 "correct": [0, 2],
                 "type": "multiple"
             },
             {
                 "question": "Для чего нужна функция arsort()?",
                 "answers": ["Сортирует массив с использованием пользовательской функции", "Сортирует элементы по убыванию с сохранением ключей", "Сортирует элементы массива по возрастанию"],
                 "correct": [1],
                 "type": "single"
             }
         ]
   }
    ```
   <img src="https://imgur.com/e45ZOpG.png" width="500" height="400">  
   <img src="https://imgur.com/dDgkiIj.png" width="500" height="400">
   <img src="https://imgur.com/mjgh5b5.png" widtht="500" height="400">
  

  
