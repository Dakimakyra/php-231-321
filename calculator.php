<!DOCTYPE html>
<html>
<head>
    <title>Калькулятор</title>
</head>
<body>
    <input type="text" id="display" readonly><br><br>

    <button onclick="addToDisplay('7')">7</button>
    <button onclick="addToDisplay('8')">8</button>
    <button onclick="addToDisplay('9')">9</button>
    <button onclick="addToDisplay('+')">+</button><br>

    <button onclick="addToDisplay('4')">4</button>
    <button onclick="addToDisplay('5')">5</button>
    <button onclick="addToDisplay('6')">6</button>
    <button onclick="addToDisplay('-')">-</button><br>

    <button onclick="addToDisplay('1')">1</button>
    <button onclick="addToDisplay('2')">2</button>
    <button onclick="addToDisplay('3')">3</button>
    <button onclick="addToDisplay('*')">*</button><br>

    <button onclick="addToDisplay('(')">(</button>
    <button onclick="addToDisplay('0')">0</button>
    <button onclick="addToDisplay(')')">)</button>
    <button onclick="addToDisplay('/')">/</button><br><br>
    <button onclick="addToDisplay('sin(')">sin</button>
    <button onclick="addToDisplay('cos(')">cos</button>
    <button onclick="addToDisplay('tan(')">tan</button>

    <button onclick="clearDisplay()">Очистить</button>
    <button onclick="calculate()">Вычислить</button>

    <script>
        function addToDisplay(value) {
            document.getElementById('display').value += value;
        }

        function clearDisplay() {
            document.getElementById('display').value = '';
        }

        function calculate() {
            let expression = document.getElementById('display').value;

            if (!isValidExpression(expression)) {
                alert('Некорректное выражение');
                return;
            }

            fetch('process.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    expression: expression
                })
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('display').value = data;
            });
        }

        function isValidExpression(expression) {
            // Проверка на корректность выражения перед отправкой на сервер
            // Можно добавить свою логику проверки здесь
            return true;
        }
    </script>
</body>
</html>