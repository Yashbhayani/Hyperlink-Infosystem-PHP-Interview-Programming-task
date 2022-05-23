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
$cars = array(7,20,21,9,14,4,5);
$jio = array();
$j=0;
for($i=0; $i<sizeof($cars); $i++){
    if($cars[$i] % 7 == 0){
        $jio[$j] = $cars[$i];
        $j++;
    }
}

for($j=0; $j<sizeof($jio); $j++){
    echo "$jio[$j] <br> ";
}
    
?>
</body>
</html>