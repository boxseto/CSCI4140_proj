<!-- PROGRAM ALLMENU - Program to show all the menu of the restaurants in CUHK
     PROGRAMMER: Vincent Chow
     CALLING SEQUENCE: <a class="nav-link" href="allmenu.php">Menu</a>
      when the Menu button is clicked, the page will be redirected to allmenu.php 
     VERSION 1: written 17-3-2018
     PURPOSE: let user see all the menu of the restaurants in CUHK
     ALGORITHM: Connect to SQL server, retrieve all the data (menu) from the database, then list them by each restsurant.
-->

<?php
session_start();

if(isset($_GET['signout'])){
	session_destroy();
	unset($_SESSION['name']);
		unset($_SESSION['email']);
			unset($_SESSION['sucess']);
	
		header('location:index.php');
	
}
?>




<!DOCTYPE html>
<html>
<head>
	<title>Menu of All Restaurants in CUHK</title>
	
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="index_styles1.css" rel="stylesheet">
    <style>
	table {
		border-collapse: collapse;
		width: 80%;
		color: #588c7e;
		font-family: monospace;
		font-size: 14px;
		text-align: left;
	}
	th {
		background-color: #588c7e;
		color: white;
    width: 80%;
	}
	tr: nth-child(even){
		background-color: $f2f2f2
	}
  td {
    width: 80%;
  }
</style>
</head>
<body>
   <!--create header-->
         <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">CUHEAT</a>
	  

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="restaruant.php">Restaurant</a>
          </li>
		  <?php if(isset($_SESSION['name'])):?>
		  		  <li class="nav-item">
            <a class="nav-link" href="comment.php">Comment and rating</a>
          </li>
		  <?php endif?>
		  		  		  <li class="nav-item">
            <a class="nav-link" href="allmenu.php">Menu</a>
          </li>
		  
		  <?php if($_SESSION['type']=="Staff"):?>
		  		  		  <li class="nav-item">
            <a class="nav-link" href="Menu.php">Insert menu</a>
          </li>
		  		  		  <li class="nav-item">
            <a class="nav-link" href="delmenu.php">Delete menu</a>
          </li>
		  
		  <?php endif?>
          <li class="nav-item">
            <a class="nav-link" href="About Us.php">About us</a>

          </li>
        </ul>
		
		<?php if (isset($_SESSION['name'])):?>
		<font color="white">
		<p>Welcome  <?php echo $_SESSION['name'],"  ","(" , $_SESSION['type'],")";?></p>
		</font>
		
		

		<li class="nav-item">
            <a class="nav-link" href="index.php?signout=1">Sign Out</a>
        </li>
		<?php else: ?>
        <li class="nav-item">
            <a class="nav-link" href="signin.php">Sign in</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="signup.php">Sign up</a>
        </li>
		<?php endif ?> 
      </div>
    </nav>
  <main role="main">
  <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-3">
            <nav id="navbar-example3" class="navbar navbar-light bg-light">
  
  <nav class="nav nav-pills flex-column">
    <p1 class= "nav-link"> </p1>
    <a class="nav-link" href="#item-1">Main Campus</a>
    <nav class="nav nav-pills flex-column">
      <a class="nav-link ml-3 my-1" href="#item-1-1">Basic Medical Sciences Building Snack Bar</a>
      <a class="nav-link ml-3 my-1" href="#item-1-2">Benjamin Franklin Centre Coffee Corner</a>
      <a class="nav-link ml-3 my-1" href="#item-1-3">Benjamin Franklin Centre Staff Canteen</a>
      <a class="nav-link ml-3 my-1" href="#item-1-4">Benjamin Franklin Centre Student Canteen</a>
      <a class="nav-link ml-3 my-1" href="#item-1-5">Benjamin Franklin Centre Vegetarian Food Shop</a>
      <a class="nav-link ml-3 my-1" href="#item-1-6">Lee Shau Kee Building Coffee Shop</a>
      <a class="nav-link ml-3 my-1" href="#item-1-7">Women Cooperative Store</a>
    </nav>


    <a class="nav-link" href="#item-2">Chung Chi College</a>
    <nav class="nav nav-pills flex-column">
      <a class="nav-link ml-3 my-1" href="#item-2-1">Chung Chi College Staff Club</a>
      <a class="nav-link ml-3 my-1" href="#item-2-2">Chung Chi College Student Canteen</a>
      <a class="nav-link ml-3 my-1" href="#item-2-3">Li Wai Chun Building Coffee Shop</a>
      <a class="nav-link ml-3 my-1" href="#item-2-4">Orchid Lodge</a>
      <a class="nav-link ml-3 my-1" href="#item-2-5">Ebeneezer's Kebabs and Pizzeria</a>
      <a class="nav-link ml-3 my-1" href="#item-2-6">Staff Common Room Clubhouse</a>
      <a class="nav-link ml-3 my-1" href="#item-2-7">The Stage</a>
      <a class="nav-link ml-3 my-1" href="#item-2-8">Cafe 330</a>
    </nav>

    <a class="nav-link" href="#item-3">United College</a>
    <nav class="nav nav-pills flex-column">
      <a class="nav-link ml-3 my-1" href="#item-3-1">United College Staff Canteen</a>
      <a class="nav-link ml-3 my-1" href="#item-3-2">United College Staff Common Room</a>
      <a class="nav-link ml-3 my-1" href="#item-3-2">United College Student Canteen</a>
      <a class="nav-link ml-3 my-1" href="#item-3-2">United College Si Yuan Amenities Centre</a>
    </nav>

    <a class="nav-link" href="#item-4">Shaw College</a>
    <nav class="nav nav-pills flex-column">
      <a class="nav-link ml-3 my-1" href="#item-4-1">SeeYou@Shaw (with Cafe)</a>
    </nav>

    <a class="nav-link" href="#item-5">S.H. Ho College</a>
    <nav class="nav nav-pills flex-column">
      <a class="nav-link ml-3 my-1" href="#item-5-1">Canteen of S.H. Ho College (with Cafe)</a>
      <a class="nav-link ml-3 my-1" href="#item-5-2">Connexion, S.H. Ho College Staff Common Room</a>
    </nav>

    <a class="nav-link" href="#item-6">C.W. Chu College</a>
    <nav class="nav nav-pills flex-column">
      <a class="nav-link ml-3 my-1" href="#item-6-1">Canteen of C.W. Chu College</a>
    </nav>

    <a class="nav-link" href="#item-7">Lee Woo Sing College</a>
    <nav class="nav nav-pills flex-column">
      <a class="nav-link ml-3 my-1" href="#item-7-1">Lee Woo Sing College - WS Pavilion</a>
      <a class="nav-link ml-3 my-1" href="#item-7-2">Lee Woo Sing College - The Harmony</a>
      <a class="nav-link ml-3 my-1" href="#item-7-3">Lee Woo Sing College - Cafe Tolo</a>
      <a class="nav-link ml-3 my-1" href="#item-7-4">Lee Woo Sing College - The Green</a>
    </nav>

    <a class="nav-link" href="#item-8">Wu Yee Sun College</a>
    <nav class="nav nav-pills flex-column">
      <a class="nav-link ml-3 my-1" href="#item-8-1">Wu Yee Sun College Student Canteen</a>
      <a class="nav-link ml-3 my-1" href="#item-8-2">Wu Yee Sun College Staff Dining Room</a>
    </nav>

    <a class="nav-link" href="#item-9">New Asia College</a>
    <nav class="nav nav-pills flex-column">
      <a class="nav-link ml-3 my-1" href="#item-9-1">New Asia College Staff Canteen</a>
      <a class="nav-link ml-3 my-1" href="#item-9-2">New Asia College Student Canteen</a>
      <a class="nav-link ml-3 my-1" href="#item-9-3">New Asia College Yun Chi Hsien</a>
    </nav>

    <a class="nav-link" href="#item-10">Morningside College</a>
    <nav class="nav nav-pills flex-column">
      <a class="nav-link ml-3 my-1" href="#item-10-1">Morningside College Dining Hall</a>
      <a class="nav-link ml-3 my-1" href="#item-10-2">Morningside College Cafe</a>
    </nav>

  </nav>
</nav>
</div>

    <div align="center" class="col-md-9">
      <div  data-spy="scroll" data-target="#navbar-example3" data-offset="0">
         <p1 class= "nav-link"> </p1>

<h1 id = "item-1" class="headingMCAM"><span>Main Campus</span></h1>
<br>
<br>
<h4 id = "item-1-1">Basic Medical Sciences Building Snack Bar</h4>
<table>
	<tr>
		<th>Dishes</th>
		<th>Price(HKD $)</th>
	</tr>
	<?php
  //connect to SQL server
		$con = mysqli_connect('localhost','root','root', 'menu', 3307);
		if ($con -> connect_error){
			die("Connection failed:". $con -> connect_error);
		}
    //retrieve data from SQL server
		$sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Basic Medical Sciences Building Snack Bar'";
		$result = $con -> query($sql);

		if ($result -> num_rows > 0){
			while ($row = $result -> fetch_assoc()){
				echo "<tr><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
			}
			echo "</table>";
		}
	?>
</table>
<br>
<h4 id ="item-1-2">Benjamin Franklin Centre Coffee Corner</h4>
<table>
	<tr>
		<th>Dishes</th>
		<th>Price(HKD $)</th>
	</tr>
	<?php
  $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Benjamin Franklin Centre Coffee Corner'";
		$result = $con -> query($sql);

		if ($result -> num_rows > 0){
			while ($row = $result -> fetch_assoc()){
				echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
			}
			echo "</table>";
		}
	?>
</table>
<br>
<h4 id = "item-1-3">Benjamin Franklin Centre Staff Canteen</h4><table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Benjamin Franklin Centre Staff Canteen'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id = "item-1-4">Benjamin Franklin Centre Student Canteen</h4><table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Benjamin Franklin Centre Student Canteen'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id = "item-1-5">Benjamin Franklin Centre Vegetarian Food Shop</h4><table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Benjamin Franklin Centre Vegetarian Food Shop'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id ="item-1-6">Lee Shau Kee Building Coffee Shop</h4><table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Lee Shau Kee Building Coffee Shop'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id = "item-1-7">Women Cooperative Store</h4><table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Women Cooperative Store'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h1 id = "item-2" class="headingCC"><span>Chung Chi College</span></h1>
<br>
<br>
<h4 id = "item-2-1">Chung Chi College Staff Club</h4><table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Chung Chi College Staff Club'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id ="item-2-2">Chung Chi College Student Canteen</h4><table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Chung Chi College Student Canteen'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id ="item-2-3">Li Wai Chun Building Coffee Shop</h4><table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Li Wai Chun Building Coffee Shop'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id = "item-2-4">Orchid Lodge</h4><table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Orchid Lodge'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id = "item-2-5">Ebeneezer's Kebabs and Pizzeria</h4><table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Ebeneezers Kebabs and Pizzeria'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id = "item-2-6">Staff Common Room Clubhouse</h4><table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Staff Common Room Clubhouse'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id = "item-2-7">The Stage</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'The Stage'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id = "item-2-8">Cafe 330</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Cafe 330'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h1 id = "item-3" class="headingUC"><span>United College</span></h1>
<br>
<br>
<h4 id ="item-3-1">United College Staff Canteen</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'United College Staff Canteen'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id ="item-3-2">United College Staff Common Room</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'United College Staff Common Room'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id ="item-3-2">United College Student Canteen</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'United College Student Canteen'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id = "item-3-3">United College Si Yuan Amenities Centre</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'United College Si Yuan Amenities Centre'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h1 id = "item-4" class="headingSC"><span>Shaw College</span></h1>
<br>
<br>
<h4 id ="item-4-1">SeeYou@Shaw (with Cafe)</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'SeeYou@Shaw (with Cafe)'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h1 id = "item-5" class="headingSHHO"><span>S.H. Ho College</span></h1>
<br>
<br>
<h4 id ="item-5-1">Canteen of S.H. Ho College (with Cafe)</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Canteen of S.H. Ho College (with Cafe)'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id = "item-5-2">Connexion, S.H. Ho College Staff Common Room</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Connexion, S.H. Ho College Staff Common Room'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h1 id = "item-6" class="headingCWC"><span>C.W. Chu College</span></h2>
  <br>
<br>
<h4 id = "item-6-1">Canteen of C.W. Chu College</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Canteen of C.W. Chu College'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h1 id = "item-7" class="headingLWS"><span>Lee Woo Sing College</span></h1>
<br>
<br>
<h4 id = "item-7-1">Lee Woo Sing College - WS Pavilion</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Lee Woo Sing College - WS Pavilion'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id = "item-7-2">Lee Woo Sing College - The Harmony</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Lee Woo Sing College - The Harmony'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id = "item-7-3">Lee Woo Sing College - Cafe Tolo</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Lee Woo Sing College - Cafe Tolo'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id = "item-7-4">Lee Woo Sing College - The Green</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Lee Woo Sing College - The Green'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h1 id = "item-8" class="headingWYS"><span>Wu Yee Sun College</span></h1>
<br>
<br>
<h4 id = "item-8-1">Wu Yee Sun College Student Canteen</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Wu Yee Sun College Student Canteen'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id = "item-8-2">Wu Yee Sun College Staff Dining Room</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Wu Yee Sun College Staff Dining Room'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h1 id = "item-9" class="headingNA"><span>New Asia College</span></h1>
<br>
<br>
<h4 id = "item-9-1">New Asia College Staff Canteen</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'New Asia College Staff Canteen'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id = "item-9-2">New Asia College Student Canteen</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'New Asia College Student Canteen'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id = "item-9-3">New Asia College Yun Chi Hsien</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'New Asia College Yun Chi Hsien'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h1 id = "item-10" class="headingMC"><span>Morningside College</span></h1>
<br>
<br>
<h4 id = "item-10-1">Morningside College Dining Hall</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Morningside College Dining Hall'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
<h4 id = "item-10-2">Morningside College Cafe</h4>
<table>
  <tr>
    <th>Dishes</th>
    <th>Price(HKD $)</th>
  </tr>
  <?php
    $sql = "SELECT Dishes, Price FROM menu WHERE Restaurant = 'Morningside College Cafe'";
    $result = $con -> query($sql);

    if ($result -> num_rows > 0){
      while ($row = $result -> fetch_assoc()){
        echo "</td><td>". $row["Dishes"] ."</td><td>". $row["Price"] ."</td></tr>";
      }
      echo "</table>";
    }
  ?>
</table>
<br>
          </div>
          
        </div>

        <hr>

      </div> <!-- /container -->

    </main>

</body>
</html>

	