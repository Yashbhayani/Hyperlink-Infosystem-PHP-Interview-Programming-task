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
$A = 7;
$B = 6;
$DD = 1;
for($i=0;$i<5;$i++){  
    for($j=0;$j<=$i;$j++){ 
        if($i % 2 == 0){
            echo $A * $DD." "; 
        }else{
            echo $B * $DD." ";
        } 
    }
    if($i % 2 != 0){
        $DD++; 
    }  
    echo "<br>";  
}  
?>  
</body>
</html>