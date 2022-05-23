<?php
    $con =  mysqli_connect('localhost','root');
    mysqli_select_db($con, 'student');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

    input[type=text], select {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    input[type=number], select {
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

    table, td, th {  
  border: 1px solid #ddd;
  text-align: center;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 15px;
}


#num_1:hover{
    background-color: #66ff99;  
}
#num_2:hover{
    background-color: #ff6699;
}
#num_3:hover{
    background-color: #8080ff;
}
.num:hover {background-color: #ffffcc;}

.table, td, th {  
  border: 1px solid #ddd;
  text-align: center;
}

.table {
  border-collapse: collapse;
  width: 50%;
}

th, td {
  padding: 15px;
}
</style>
</head>
<body>


<div>
  <form method="post"  action="<?php echo $_SERVER['PHP_SELF'];?>">

    <label for="fname">First Name</label>
    <input type="text" name="firstname" placeholder="Your name.." required>

    <br> <br> 

    <label for="fname">Subject</label>
   <table>
       <tr>
           <th>English</th>
           <th>Maths</th>
           <th>Science</th>
           <th>Hindi</th>
           <th>Drawing</th>
       </tr>
       <tr>
           <td> <input type="number" name="english" required> </td>
           <td> <input type="number" name="maths" required> </td>
           <td> <input type="number" name="science" required> </td>
           <td> <input type="number" name="hindi" required> </td>
           <td> <input type="number" name="drawing" required> </td>
       </tr>
   </table>

   <br><br>

    <label>  Standard :   </label> 
    <input type="range" min="1" max="12" value="1" id="myRange" required>
    <input type="number" id="demo"  name="standard" required>

    <input type="submit" value="Submit">

  </form>
</div>

<?php

class student{
  public $name;
  public $English;
  public $Maths;
  public $Science;
  public $Hindi;
  public $Drawing;
  public $Standard;
  public $num;
  public $result;

  public function __construct($name, $English, $Maths, $Science, $Hindi, $Drawing, $Standard){
    $this->name = $name;
    $this->English = $English;
    $this->Maths = $Maths;
    $this->Science = $Science;
    $this->Hindi = $Hindi;
    $this->Drawing = $Drawing;
    $this->Standard = $Standard;
  }
  public function where(){
    $con =  mysqli_connect('localhost','root');
    mysqli_select_db($con, 'student');
  }
}

class studentsub extends student{
  public function add(){
    $con =  mysqli_connect('localhost','root');
    mysqli_select_db($con, 'student');

    $q = "SELECT * FROM student WHERE name='$this->name' and English='$this->English' and Maths='$this->Maths' and Science='$this->Science' and Hindi='$this->Hindi' and Drawing='$this->Drawing' and Standard='$this->Standard'";
    $result = mysqli_query($con,$q);
    $this->num = mysqli_num_rows($result);

    if($this->num == 0){
      $Marks = $this->English + $this->Maths + $this->Science + $this->Hindi + $this->Drawing;
      $Percentage = $Marks / 5; 

        $qb = "insert into student(name, English, Maths , Science, Hindi, Drawing, Standard, Marks, Percentage) values ('$this->name', '$this->English', '$this->Maths','$this->Science', '$this->Hindi', '$this->Drawing', '$this->Standard', '$this->Marks', '$this->Percentage')";
        mysqli_query($con,$qb);

      }else{

      $alert = "<script>alert('Data is Already Register!');</script>";

      echo $alert;
      
    }
  }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['firstname'];
  $English = $_POST['english'];
  $Maths = $_POST['maths'];
  $Science = $_POST['science'];
  $Hindi = $_POST['hindi'];
  $Drawing = $_POST['drawing'];
  $Standard = $_POST['standard'];

  if(12 >= $Standard && $English <= 100 && $Maths <= 100 && $Science <= 100 && $Hindi <= 100 && $Drawing <= 100 && $Standard != " " && $English != " " && $Maths != " " && $Science != " " && $Hindi != " " && $Drawing != " "){
    $user = new studentsub($name, $English, $Maths, $Science, $Hindi, $Drawing, $Standard);
    $user->add();
    $user->where();
  }else{
    $alert = "<script>alert('Wrong Data !');</script>";
        echo $alert;
  }
}
?>

<br><br>

 <table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>English</th>
    <th>Maths</th>
    <th>Science</th>
    <th>Hindi</th>
    <th>Drawing</th>
    <th>Standard</th>
    <th>Marks</th>
    <th>Percentage</th>
    <th>Grad</th>
  </tr> 


  <?php
    $q = "SELECT * FROM student ORDER BY Percentage DESC";
    $result = mysqli_query($con,$q);
    $num = mysqli_num_rows($result);
    $id = 1;

    if($num>0){
        while($row = mysqli_fetch_array($result)){
        echo "<tr class='num' id = 'num_". $id . "' >";
        echo "<td>" . $id. "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['English'] . "</td>";
        echo "<td>" . $row['Maths'] . "</td>";
        echo "<td>" . $row['Science'] . "</td>";
        echo "<td>" . $row['Hindi'] . "</td>";
        echo "<td>" . $row['Drawing'] . "</td>";
        echo "<td>" . $row['Standard'] . "</td>";
        echo "<td>" . $row['Marks'] . "</td>";
        echo "<td>" . $row['Percentage'] . " % </td>";
         if($row['Percentage'] >= 80){
             echo "<td> A </td>";
         }else if($row['Percentage'] < 80 && $row['Percentage'] >= 60){
            echo "<td> B </td>";
         }else if($row['Percentage'] < 60 && $row['Percentage'] >= 35){
            echo "<td> C </td>";
         }else{
            echo "<td> D </td>";
         }
        echo "</tr>";
        $id++;
        }
    }
  ?>
  </table>

<script>

  var slider = document.getElementById("myRange");
  var output = document.getElementById("demo");

  output.innerHTML = slider.value;

  slider.oninput = function() {
    output.value = this.value;

}
</script>

<script>

  var slider = document.getElementById("myRange");
  var output = document.getElementById("demo");

  slider.innerHTML = output.value;

  output.oninput = function() {
    slider.value = this.value;
}
</script>

<br><br>

<table class="table">
  <tr>
    <th>Percentage</th>
    <th>Grad</th>
  </tr>
  <tr>
    <td>80% Up</td>
    <td> A </td>
  </tr>
  <tr>
    <td>80% - 60%</td>
    <td>B</td>
  </tr>
  <tr>
    <td>60% - 35%</td>
    <td>C</td>
  </tr>
  <tr>
    <td>Below 35%</td>
    <td>D</td>
  </tr>
</table>


</body>
</html>