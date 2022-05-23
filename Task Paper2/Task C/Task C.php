<?php
    $con =  mysqli_connect('localhost','root');
    mysqli_select_db($con, 'restaurants_task');
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task C</title>
    <style>

    input[type=text], select {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      text-align: center;
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


    <label for="food">Choose a Categories of Food:</label> <br><br>
    <input type="radio" name="food" value="Sweet" required/> Sweet    
    <input type="radio" name="food" value="Salty" required/> Salty <br/>   

    <br> <br> 

    <label> Rate:   </label> 
    <input type="range" min="50" max="120" name="Rate" value="1" id="myRange" required>
    <p>Value: <span id="demo"></span></p>

    <br> <br> 


    <label for="fname">Description </label> <br><br>
    <textarea  name="description" rows="auto" cols="auto" > </textarea>


    <input type="submit" value="Submit">

  </form>
</div>

<?php

class Restaurants{
  public $name;
  public $food_ch;
  public $Rate;
  public $Description;
  public $num;
  public $result;
  public function __construct($name,$food_ch,$Rate,$Description){
    $this->name = $name;
    $this->food_ch = $food_ch;
    $this->Rate = $Rate;
    $this->Description = $Description;
  }
  public function where(){
    $con =  mysqli_connect('localhost','root');
    mysqli_select_db($con, 'restaurants_task');

  }
}

class Food extends Restaurants{
    public function add(){
      $con =  mysqli_connect('localhost','root');
      mysqli_select_db($con, 'restaurants_task');
      
      $q = "SELECT * FROM food_items WHERE name ='$this->name' and categories ='$this->food_ch' and rate ='$this->Rate' and description ='$this->Description'";
      $result = mysqli_query($con,$q);
      $this->num = mysqli_num_rows($result);

          if($this->num == 0){
                if($this->name != "" && $this->food_ch != "" && $this->Rate != ""  &&  $this->Description != ""){
                  if($this->food_ch == "Sweet"){
                      if(100>=$this->Rate){
                        $qb = "insert into food_items(name, categories, rate, description) values ('$this->name', '$this->food_ch', '$this->Rate', '$this->Description')";
                        mysqli_query($con,$qb);
                       
                    }else{
                      $alert = "<script>alert('Sweet Rate is 50$ to 100$');</script>";
                        echo $alert;
                    }
                }else{
                    if(70>$this->Rate){
                      $alert = "<script>alert('Salty Rate is 70$ to 120$');</script>";
                      echo $alert;
                  }else{
                    $qb = "insert into food_items(name, categories, rate, description) values ('$this->name', '$this->food_ch', '$this->Rate', '$this->Description')";
                    mysqli_query($con,$qb);
                  }
                }
              }
        }else{
            $alert = "<script>alert('Data is already!');</script>";
            echo $alert;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(!empty($_POST['food'])){
      
      $name = $_POST['firstname'];
      $food_ch= $_POST['food'];
      $Rate =  $_POST['Rate'];
      $Description =  $_POST['description'];

    
      if($name != "" && $food_ch != "" && $Rate != ""  &&  $Description != ""){
      $user = new Food($name,$food_ch,$Rate,$Description);
      $user->add();
      $user->where();
      }else{
        $alert = "<script>alert('Some Data is null !');</script>";
        echo $alert;
      }
  }else{
    $alert = "<script>alert('Plz Select Food !');</script>";
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


<table>
  <tr>
    <th>Name</th>
    <th>Categories</th>
    <th>Rate</th>
    <th>Description</th>
  </tr>

  <?php
    $q1 = "SELECT * FROM food_items WHERE categories='Sweet' ORDER BY rate ASC ";
    $result1 = mysqli_query($con,$q1);
    $num1 = mysqli_num_rows($result1);

    if($num1>0){
      while($row1 = mysqli_fetch_array($result1)){
        echo "<tr>";
        echo "<td>" . $row1['name'] . "</td>";
        echo "<td>" . $row1['categories'] . "</td>";
        echo "<td>" . $row1['rate'] . "</td>";
        echo "<td>" . $row1['description'] . "</td>";
        echo "</tr>";
      }
    }

  ?>

   <?php

    $q = "SELECT * FROM food_items WHERE categories='Salty' ORDER BY rate ASC ";
    $result = mysqli_query($con,$q);
    $num = mysqli_num_rows($result);

    if($num>0){
      while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['categories'] . "</td>";
        echo "<td>" . $row['rate'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "</tr>";
      }
    }

  ?>
</table>
</body>
</html>