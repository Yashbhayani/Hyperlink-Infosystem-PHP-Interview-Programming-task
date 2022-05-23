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
    $k=1;
    $s = 2;
    for($i=01; $i<=5; $i++){
        for($j=1; $j<=$i; $j++){
          
            if($i%2 != 0){
                if($k%2 != 0){
                echo $k." ";
                $k +=2;
            }
            }

            if($i%2 == 0){
                if($k%2 != 0){
               echo $s." ";
                $s +=2;
            }
            }

        }
        echo "<br/>";
    }

    ?>
</body>
</html>