<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    echo "Input:";
    echo "<br/>";
    
    echo "<br/>";
    $A = array(1, 10, 2, 3, 5, 6, 7);
    $B = array(2, 4, 6, 8, 1, 0, 2);
    for ($i = 0; $i < count(($A)); $i++) {
        echo $A[$i] . ", ";
    }
    echo "<br/>";
    for ($i = 0; $i < count(($B)); $i++) {
        echo $B[$i] . ", ";
    }

    echo "<br/>";
    echo "<br/>";
    echo "Oputput";

    echo "<br/>";
    
    echo "<br/>";
    for ($i = 0; $i < count(($A)); $i++) {
        echo $A[$i] * $B[$i] . ", ";
    }




    ?>
</body>

</html>