<!-- PROGRAM MENU - Program to insert menu to SQL server
     PROGRAMMER: Vincent Chow
     CALLING SEQUENCE: <a class="nav-link" href="menu.php">Insert menu</a>
      when the Insert menu button is clicked, the page will be redirected to menu.php 
     VERSION 1: written 17-3-2018
     PURPOSE: let user insert the menu of the restaurant to the SQL server
     ALGORITHM: Read the inputs from user. Redirect the page to menu2.php.
-->

<?php
session_start();

if(isset($_GET['signout'])){
	session_destroy();
	unset($_SESSION['name']);
		unset($_SESSION['email']);
			unset($_SESSION['sucess']);
	
	
	
}

if($_SESSION['type']!="Staff"){
header('location:index.php');	
	
}

?>





<html>
<head>
<title>Today's Menu</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link href="menu_styles.css" rel="stylesheet">

  </head>
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
  <body class="text-center">
  	<div id="bg">
  <div class="module">
	<form action="Menu2.php" method="post">
		<font size = "3" face = "Comic Sans MS">
		<br/>
		<font size = "4">
		Please Input The Menu of Today :)
		<hr>
		</font>
    <br>
    <br>
		<!--Restaurant --> <select name="Restaurant" class="textbox">
      <option selected disabled>Please choose the restaurant name</option>
      <optgroup label="Main Campus">
        <option>Basic Medical Sciences Building Snack Bar</option>
        <option>Benjamin Franklin Centre Coffee Corner</option>
        <option>Benjamin Franklin Centre Staff Canteen</option>
        <option>Benjamin Franklin Centre Student Canteen</option>
        <option>Benjamin Franklin Centre Vegetarian Food Shop</option>
        <option>Lee Shau Kee Building Coffee Shop</option>
        <option>Women Cooperative Store</option>
      </optgroup> 
      <optgroup label="Chung Chi College">
        <option>Chung Chi College Staff Club</option>
        <option>Chung Chi College Student Canteen</option>
        <option>Li Wai Chun Building Coffee Shop</option>
        <option>Orchid Lodge</option>
        <option>Ebeneezers Kebabs and Pizzeria</option>
        <option>Staff Common Room Clubhouse</option>
        <option>The Stage</option>
        <option>Cafe 330</option>
      </optgroup> 
      <optgroup label="United College">
        <option>United College Staff Canteen</option>
        <option>United College Staff Common Room</option>
        <option>United College Student Canteen</option>
        <option>United College Si Yuan Amenities Centre</option>
      </optgroup> 
      <optgroup label="Shaw College">
        <option>SeeYou@Shaw (with Cafe)</option>
      </optgroup> 
      <optgroup label="S.H. Ho College">
        <option>Canteen of S.H. Ho College (with Cafe)</option>
        <option>Connexion, S.H. Ho College Staff Common Room</option>
      </optgroup> 
      <optgroup label="C.W. Chu College">
        <option>Canteen of C.W. Chu College</option>
      </optgroup> 
      <optgroup label="Lee Woo Sing College">
        <option>Lee Woo Sing College - WS Pavilion</option>
        <option>Lee Woo Sing College - The Harmony</option>
        <option>Lee Woo Sing College - Cafe Tolo</option>
        <option>Lee Woo Sing College - The Green</option>
      </optgroup> 
      <optgroup label="Wu Yee Sun College">
        <option>Wu Yee Sun College Student Canteen</option>
        <option>Wu Yee Sun College Staff Dining Room</option>
      </optgroup> 
      <optgroup label="New Asia College">
        <option>New Asia College Staff Canteen</option>
        <option>New Asia College Student Canteen</option>
        <option>New Asia College Yun Chi Hsien</option>        
      </optgroup> 
      <optgroup label="Morningside College">
        <option>Morningside College Dining Hall</option>
        <option>Morningside College Cafe</option>
      </optgroup> 
    </select>
		<!--Dishes-->  <input type="text" placeholder="Please input the dish" name="Dishes" class="textbox">
		<!--Price(HKD $)-->  <input type="text" placeholder="Please input the price(HKD $) of the dish" name="Price" class="textbox">
				<br>
				<button type="submit" class="btn btn-primary">Submit</button>
        
		</font>
	</form>

  </div>
</div>

</body>
</html>
