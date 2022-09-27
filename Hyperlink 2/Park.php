<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        input[type=text],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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

        input[type=submit]:hover {
            background-color: #45a049;
        }

        div {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <?php
    $con =  mysqli_connect('localhost', 'root');
    mysqli_select_db($con, 'park');
    ?>

    <div>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <label for="fname">Vehical No</label>
            <input type="text" name="VehicalNo" placeholder="Your name..">

            <br> <br>

            <label> Vehical type: </label>
            <input type="radio" name="Vehicaltype" value="TW" /> TW
            <input type="radio" name="Vehicaltype" value="FW" /> FW <br />

            <br> <br>

            <label> Basement : </label>
            <input type="range" min="1" max="4" name="Basement" value="1" id="myRange1">
            <p>Value: <span id="demo1"></span></p>

            <input type="submit" value="Submit">

        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $con =  mysqli_connect('localhost', 'root');
        mysqli_select_db($con, 'park');

        if (!empty($_POST['Vehicaltype'])) {
            $VehicalNo = strtoupper($_POST['VehicalNo']);
            $Vehicaltype = strtoupper($_POST['Vehicaltype']);
            $Basement =  $_POST['Basement'];

            $q = "SELECT * FROM `parkmana` WHERE VehicalNo='$VehicalNo'";
            $result = mysqli_query($con, $q);
            if (mysqli_num_rows($result) == 0) {
                if ($VehicalNo != "" && $Vehicaltype != "" && $Basement != "") {
                    $q2 = "SELECT COUNT(`Basement`) FROM `parkmana` WHERE `Basement`= '$Basement'";
                    $result2 = mysqli_query($con, $q2);
                    $num = mysqli_num_rows($result2);
                    // $row = mysqli_fetch_array($result2);
                    while ($row = mysqli_fetch_array($result2)) {
                        $k= $row[0];
                    }
                    if ((int)$k< 4) {
                        $qb = "INSERT INTO `parkmana`(`VehicalNo`, `Vehicaltype`, `Basement`) VALUES ('$VehicalNo', '$Vehicaltype', '$Basement')";
                        mysqli_query($con, $qb);
                    } else {
                        $alert = "<script>alert('Basement Full');</script>";
                        echo $alert;
                    }
                }
            } else {
                $alert = "<script>alert('Vehical No is Already Added!');</script>";
                echo $alert;
            }
        } else {
            $alert = "<script>alert('Select Vehical Type!');</script>";
            echo $alert;
        }
    }
    ?>

    <script>
        var slider1 = document.getElementById("myRange1");
        var output1 = document.getElementById("demo1");

        output1.innerHTML = slider1.value;

        slider1.oninput = function() {
            output1.innerHTML = this.value;

        }
    </script>

    <table>
        <tr>
            <th>Vehical No</th>
            <th>Vehical type</th>
            <th>Basement</th>
        </tr>

        <?php
        $q1 = "SELECT * FROM parkmana ORDER BY Vehicaltype DESC";
        $result1 = mysqli_query($con, $q1);
        $num1 = mysqli_num_rows($result1);

        if ($num1 > 0) {
            while ($row1 = mysqli_fetch_array($result1)) {
                echo "<tr>";
                echo "<td>" . $row1['VehicalNo'] . "</td>";
                echo "<td>" . $row1['Vehicaltype'] . "</td>";
                echo "<td>" . $row1['Basement'] . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>

</body>

</html>