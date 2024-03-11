<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['expression'])) {
        $expression = $data['expression'];

        if (!isValidExpression($expression)) {
            echo 'Некорректное выражение';
            exit;
        }

        $result = customCalculate($expression);
        echo $result;
    } else {
        echo 'Параметр expression не найден';
    }
}

function customCalculate($expression) {
    $expression = str_replace('sin', 's', $expression);
    $expression = str_replace('cos', 'c', $expression);
    $expression = str_replace('tan', 't', $expression);
    
    $tokens = tokenizeExpression($expression);
    $output = [];
    $stack = [];

    $precedence = [
        '*' => 2,
        '/' => 2,
        '+' => 1,
        '-' => 1,
        's' => 3,
        'c' => 3,
        't' => 3,
    ];

    foreach ($tokens as $token) {
        if (is_numeric($token)) {
            $output[] = $token;
        } elseif ($token == '(') {
            array_push($stack, $token);
        } elseif ($token == ')') {
            while (($top = array_pop($stack)) != '(') {
                $output[] = $top;
            }
        } else {
            while (!empty($stack) && $precedence[end($stack)] >= $precedence[$token]) {
                $output[] = array_pop($stack);
            }
            array_push($stack, $token);
        }
    }

    while (!empty($stack)) {
        $output[] = array_pop($stack);
    }

    $result = [];
    foreach ($output as $token) {
        if (is_numeric($token)) {
            array_push($result, $token);
        } elseif ($token == 's') {
            $operand = array_pop($result);
            array_push($result, sin($operand));
        } elseif ($token == 'c') {
            $operand = array_pop($result);
            array_push($result, cos($operand));
        } elseif ($token == 't') {
            $operand = array_pop($result);
            array_push($result, tan($operand));
        } else {
            $operand2 = array_pop($result);
            $operand1 = array_pop($result);
            if ($token == '+') {
                array_push($result, $operand1 + $operand2);
            } elseif ($token == '-') {
                array_push($result, $operand1 - $operand2);
            } elseif ($token == '*') {
                array_push($result, $operand1 * $operand2);
            } elseif ($token == '/') {
                if ($operand2 == 0) {
                    return 'Деление на ноль';
                } else {
                    array_push($result, $operand1 / $operand2);
                }
            }
        }
    }

    return array_pop($result);
}

function tokenizeExpression($expression) {
    $expression = str_replace(' ', '', $expression);
    $expression = str_split($expression);
    $tokens = [];
    $currentNumber = '';

    foreach ($expression as $char) {
        if (is_numeric($char)) {
            $currentNumber .= $char;
        } else {
            if (!empty($currentNumber)) {
                $tokens[] = $currentNumber;
                $currentNumber = '';
            }
            $tokens[] = $char;
        }
    }

    if (!empty($currentNumber)) {
        $tokens[] = $currentNumber;
    }

    return $tokens;
}

function isValidExpression($expression) {
    // Проверка на корректность выражения перед вычислением
    // Можно добавить свою логику проверки здесь
    return true;
}
?>