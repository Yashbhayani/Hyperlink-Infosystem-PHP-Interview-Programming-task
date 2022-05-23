<?php
    $con =  mysqli_connect('localhost','root');
    mysqli_select_db($con, 'employee');
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

    th, td {
      padding: 8px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    tr:hover {background-color: coral;}
</style>
</head>

<body>


<div>
  <form method="post"  action="<?php echo $_SERVER['PHP_SELF'];?>">

    <label for="fname">First Name</label>
    <input type="text" name="firstname" placeholder="Your name.." required>

    <br> <br> 

    <label for="fname">  Gender :   </label>  <br><p>     </p> 
    <input type="radio" name="gender" value="male" required/> Male    
    <input type="radio" name="gender" value="female" required/> Female <br/>   

    <br> <br> 

    <label>  Job Hours :   </label> 
    <input type="range" min="1" max="10" name="JOBHOURS" value="1" id="myRange" required>
    <p>Value: <span id="demo"></span></p>

    <br> <br> 

    <label> Per Hours Salary :   </label> 
    <input type="range" min="70" max="150" name="PERJOBHOURS" value="70" id="myRange1" required>
    <p>Value: <span id="demo1"></span></p>

    <input type="submit" value="Submit">

  </form>
</div>

<?php

class Employee{
  public $name;
  public $Gender;
  public $JOBH;
  public $PJOBH;
  public $num;
  public $result;
  public function __construct($name,$Gender,$JOBH,$PJOBH){
    $this->name = $name;
    $this->Gender = $Gender;
    $this->JOBH = $JOBH;
    $this->PJOBH = $PJOBH;
  }
  public function where(){
    $con =  mysqli_connect('localhost','root');
    mysqli_select_db($con, 'employee');
  
  }
}

class User extends Employee{
    public function add(){
      $con =  mysqli_connect('localhost','root');
      mysqli_select_db($con, 'employee');
      
       $q = "SELECT * FROM users WHERE name='$this->name' and gender='$this->Gender' and job_hours='$this->JOBH' and per_hours_amount='$this->PJOBH'";
       $result = mysqli_query($con,$q);
       $this->num = mysqli_num_rows($result);

          if($this->num == 0){
              if($this->Gender == "female"){
                if(120>=$this->PJOBH){
                       $qb = "insert into users(name, gender, job_hours, per_hours_amount) values ('$this->name', '$this->Gender', '$this->JOBH', '$this->PJOBH')";
                       mysqli_query($con,$qb);
                }else{
                  $alert = "<script>alert('Femail user per hours mount size is 70$ to 120$');</script>";
                  echo $alert;
                } 
              }else if($this->Gender == "male"){
                if(100>$this->PJOBH){
                  $alert = "<script>alert('mail user per hours mount size is 100$ to 150$');</script>";
                  echo $alert;
                }else{
                      $qb = "insert into users(name, gender, job_hours, per_hours_amount) values ('$this->name', '$this->Gender', '$this->JOBH', '$this->PJOBH')";
                      mysqli_query($con,$qb);
                }
              }
        }else{
            $alert = "<script>alert('Data is already!');</script>";
            echo $alert;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(!empty($_POST['gender'])){
      
      $name = $_POST['firstname'];
      $Gender = $_POST['gender'];
      $JOBH =  $_POST['JOBHOURS'];
      $PJOBH =  $_POST['PERJOBHOURS'];

    
      if($name != "" && $Gender != "" && $JOBH != ""  &&  $PJOBH != ""){
      $user = new User($name,$Gender,$JOBH,$PJOBH);
      $user->add();
      $user->where();
      }else{
        $alert = "<script>alert('Some Data is null !');</script>";
        echo $alert;
      }
  }else{
    $alert = "<script>alert('Plz Select Gender !');</script>";
    echo $alert;
  }
}
?>

<script>
  var slider = document.getElementById("myRange");
  var output = document.getElementById("demo");

  output.innerHTML = slider.value;

  slider.oninput = function() {
    output.innerHTML = this.value;

}
</script>

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
      <th>Name</th>
      <th>Gender</th>
      <th>Job Hours</th>
      <th>Per Hours Salary</th>
    </tr> 

  <?php
    $q1 = "SELECT * FROM users WHERE gender='female' ORDER BY per_hours_amount ASC ";
    $result1 = mysqli_query($con,$q1);
    $num1 = mysqli_num_rows($result1);

    if($num1>0){
      while($row1 = mysqli_fetch_array($result1)){
        echo "<tr>";
        echo "<td>" . $row1['name'] . "</td>";
        echo "<td>" . $row1['gender'] . "</td>";
        echo "<td>" . $row1['job_hours'] . "</td>";
        echo "<td>" . $row1['per_hours_amount'] . "</td>";
        echo "</tr>";
      }
    }
  ?>

   <?php

    $q = "SELECT * FROM users WHERE gender='male' ORDER BY per_hours_amount ASC ";
    $result = mysqli_query($con,$q);
    $num = mysqli_num_rows($result);

    if($num>0){
      while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['gender'] . "</td>";
        echo "<td>" . $row['job_hours'] . "</td>";
        echo "<td>" . $row['per_hours_amount'] . "</td>";
        echo "</tr>";
      }
    }

   ?>
</table>

</body>
</html>