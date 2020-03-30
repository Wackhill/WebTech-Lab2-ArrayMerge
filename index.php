<!DOCTYPE html>
<html lang="en">
<head>

<style>

body {
    font-family: Arial;
    background-color: #f2f2f2;
}

textarea {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    resize: none;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}

</style>

    <?php 
        //Функция возвращает "истину", если входная строка состоит только из целых чисел, 
        //разделенных одиночным знаком пробела
        function is_input_correct($in_line) {
            $is_correct = true;
            $i = 0;
            $was_space = false;
            while ($is_correct == true && $i < strlen($in_line)) {
                if ($in_line[$i] >= '0' && $in_line[$i] <= '9') {
                    $was_space = false;
                }
                else if ($in_line[$i] == ' ' && $was_space == false) {
                    $was_space = true;
                }
                else if ($in_line[$i] == '-' && ($in_line[$i + 1] >= '0' && $in_line[$i + 1] <= '9') && $was_space == true) {
                    $was_space = false;
                }
                else {
                    $is_correct = false;
                }
                $i++;
            }

            if (strlen($in_line) == 0 || $was_space == true) {
                $is_correct = false;
            }

            return $is_correct;
        }

        //Функция объединяет два массива, добавляя элементы второго массива в конец первого
        function array_concat($array1, $array2) {
            $lenght_1 = count($array1);
            $lenght_2 = count($array2);
            for ($i = $lenght_1; $i < $lenght_1 + $lenght_2; $i++) {
                $array1[$i] = $array2[$i - $lenght_1]; 
            }
            return $array1;
        }
    ?>

</head>

<body>
    <div>
        <h3>На вход подаются целые числа, разделенные одиночным знаком пробела</h3>
        <br>
        <form method="POST">
        <label for="first_array">Первый массив</label>
        <textarea rows="1" name="first_array" placeholder="Первый массив..."><?php if (isset($_POST['execute'])) { echo $_POST['first_array'];}?></textarea>
        <label for="second_array">Второй массив</label>
        <textarea rows="1" name="second_array" placeholder="Второй массив..."><?php if (isset($_POST['execute'])) { echo $_POST['second_array'];}?></textarea>
        <input type="submit" name="execute" value="Выполнить">

        <?php
            if (isset($_POST['execute'])) {
                $first_array = $_POST['first_array'];   
                $second_array = $_POST['second_array'];
                //Проверка корректности ввода
                if (is_input_correct($first_array) == true && is_input_correct($second_array) == true) {
                    //Получение массивов чисел из строк
                    $first_array_numbers = explode(" ", $first_array);
                    $second_array_numbers = explode(" ", $second_array);
                    $result_array = array_concat($first_array_numbers, $second_array_numbers);
                    
                    echo "<br>";
                    echo "<br>";
                    echo "<br>";
                    echo "<p1>Объединенные массивы: ";
                    //Вывод элементов обьединенных массивов
                    echo implode(', ', $result_array); 
                    echo "</p1>";
                    echo "<br>";
                    echo "<br>";
                    //Вывод четных элементов
                    echo "<p1> Четные элементы: ";
                    $is_first_iteration = true;
                    for ($i = 0; $i < count($result_array); $i++) {
                        if ($result_array[$i] % 2 == 0) {
                            if ($is_first_iteration == false) {
                                echo ", ";
                            }
                            $is_first_iteration = false;    
                            echo "$result_array[$i]";
                        }
                    }
                    echo "</p1>";
                }
                else {
                    echo "<p1>Проверьте правильность ввода!</p1>";
                }
            }
        ?>
</form>
</div>
</body>
</html>