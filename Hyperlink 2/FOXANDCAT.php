<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="FOXANDCAT.php" method="post">
        <label for="w3review">Enter input:</label>

        <textarea id="w3review" rows="4" cols="50" name="name"></textarea>
        <input type="submit">
    </form>

    <?php
    if ($_POST["name"] != null && $_POST["name"] != "") {
        $x = str_replace("fox", "Cat", strtolower($_POST["name"]));
        $y = strtolower(str_replace("cat", "fox", $x));
        echo ucfirst($y);
    } else {
    }
    ?>
</body>

</html>