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
    $cars=array(1,29,50,27,2,5,3);
    $odd=array();
    $even=array();
    $o= 0; $e = 0;
    for($i=0;$i<sizeof($cars);$i++){
        if($cars[$i] % 2 != 0){
            $odd[$o] = $cars[$i];
            $o++;
        }else{
            $even[$e] = $cars[$i];
            $e++;
        }
    }

    echo "Odd :- " ;

    for($i=0;$i<sizeof($odd);$i++){
       echo $odd[$i]." "; 
    }

    echo "<br>";
    echo "Even :- " ;

    for($i=0;$i<sizeof($even);$i++){
        echo $even[$i]." ";
    }
?>  
</body>
</html>