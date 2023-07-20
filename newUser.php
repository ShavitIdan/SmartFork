<?php 
    include "config.php"; 
    include "db.php";
   

    session_start(); 

	// check if the user tring to get from url.
	if(!isset($_SESSION["user_id"])){
		header('Location: ' . URL . 'login.php');
	}

    if(isset($_SESSION["user_type"])){
        $user_type = $_SESSION["user_type"];
		if( $user_type == "admin"){
            if (isset($_POST["insert"])){
                    if(isset($_POST["fullName"]))
                    {
                        // form1 :  
                        $full_name = isset($_POST["fullName"]) ? $_POST["fullName"] : "";
                        $mail = isset($_POST["mail"]) ? $_POST["mail"] : "";
                        $BMI = isset($_POST["BMI"]) ? $_POST["BMI"] : "";
                        $diet = isset($_POST["diet"]) ? $_POST["diet"] : "";
                        $age = isset($_POST["age"]) ? $_POST["age"] : "";
                        $weight = isset($_POST["weight"]) ? $_POST["weight"] : "";
                        $height = isset($_POST["height"]) ? $_POST["height"] : "";
                        $pregnant = isset($_POST["flexRadioDefault"]) ? $_POST["flexRadioDefault"] : "";
                
                
                        $query  = "insert into  tbl_205_patients (patient_full_name,patient_email,patient_weight,patient_height,patient_age,patient_bmi,patient_diet,patient_pregnant,patient_sport_by_week)
                        values('$full_name','$mail','$weight','$height','$age','$BMI','$diet','$pregnant','0')";
                        $result4 = mysqli_query($connection, $query);
                        if(!$result4) {
                            die("DB query failed.");
                        }
                        $last_id = mysqli_insert_id($connection);
                        $query = "insert into tbl_205_nutritionist_patients (nutr_id,patient_id) values ('" . $_SESSION["nutr_id"] . "','$last_id')";
                        $result = mysqli_query($connection, $query);
                        if(!$result) {
                            die("DB query failed.");
                        }


                    }
                }
        }
        else{
            if (isset($_POST["insert"])){
                if(isset($_POST["dish_fullName"]))
                {
                    $Dish_name = isset($_POST["dish_fullName"]) ? $_POST["dish_fullName"] : "";
                    $food_type = isset($_POST["foodtype"]) ? $_POST["foodtype"] : "";
                    $food_cal = isset($_POST["food_cal"]) ? $_POST["food_cal"] : "";
                    
                    $query5  = "INSERT INTO  tbl_205_food (food_name,food_type,calories)
                    values('$Dish_name','$food_type','$food_cal')";
                    $result5 = mysqli_query($connection, $query5);
                    if(!$result5) {
                        die("DB query failed.");
                    }
    
                }
                else{
                    if(isset($_POST["dish_fullName2"]))
                    {
                        $Dish_name2 = isset($_POST["dish_fullName2"]) ? $_POST["dish_fullName2"] : "";
                        $food_type2 = isset($_POST["foodtype2"]) ? $_POST["foodtype2"] : "";
                        $food_cal2 = isset($_POST["food_cal2"]) ? $_POST["food_cal2"] : "";
                        
                        $query5  = "INSERT INTO  tbl_205_food (food_name,food_type,calories)
                        values('$Dish_name2','$food_type2','$food_cal2')";
                        $result5 = mysqli_query($connection, $query5);
                        if(!$result5) {
                            die("DB query failed.");
                        }

                    }
                }
                
            }
        }
    }
    $curUserQuery = mysqli_query($connection, "SELECT * FROM tbl_205_patients WHERE patient_email ='" . $_SESSION["user_email"] . "' LIMIT 1");
	$curUser = mysqli_fetch_assoc($curUserQuery);
   
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="images/fork.png" rel="icon">
	<title>SmartFork</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.css"rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=DM Sans">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<!--Main Navigation-->
	<header>
		<!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
			<div class="position-sticky">
				<div class="list-group list-group-flush mx-3 mt-4">
					<a href="index.php" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
						<img src="images/Home.png"><span class="ms-3">Home</span>
					</a>
					<a href="#" class="list-group-item list-group-item-action py-2 ripple">
						<img src="images/Vector.png"><span class="ms-3">Analytics</span>
					</a>
                    
					<a href="index.php" class="list-group-item list-group-item-action py-2 ripple active">
                        <?php
                                if($user_type == "admin"){
                                echo '<img src="images/Vector2.png"><span class="ms-3">Users</span>';}
                                else{
                                    echo '<img src="images/food_icon.png"><span class="ms-3">Foods</span>';
                                }
                        ?>
					</a>
					<a href="#" class="list-group-item list-group-item-action py-2 ripple">
						<img src="images/noun-shopping-bag-1092888 (1).png"><span class="ms-3">Restaurants</span>
					<a href="#" class="list-group-item list-group-item-action py-2 ripple">
						<img src="images/noun-fork-1819231 (1).png"><span class="ms-3">My fork</span>
					</a>
					<a href="#" class="list-group-item list-group-item-action py-2 ripple">
						<img src="images/noun-notebook-5715353 (1).png"><span class="ms-3">Recommended</span>
					<a href="#" class="list-group-item list-group-item-action py-2 ripple">
						<img src="images/meesage 2.png"><span class="fs-6 ms-3">Messeges</span>
					<a href="#" id="btnSwitch" class="list-group-item list-group-item-action my-5 rounded border py-2 ripple">
						<img id="themeIcon" src="images/sun.png"><span id="themeText" class="ms-3">Light</span>
					<a href="#" class="list-group-item list-group-item-action py-2 rounded ripple text-white bg-danger">
						<img src="images/Allert.png"><span class="ms-3">SOS</span>
					</a>
					
				</div>
			</div>
		</nav>
		<!-- Sidebar -->

		<!-- Navbar -->
		<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
			<!-- Container wrapper -->
			<div class="container-fluid">
				<!-- Toggle button -->
				<button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
					aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
				</button>

				<!-- Logo -->
				<a class="navbar-brand" id="logo" href="index.php"></a>
				<!-- Right links -->
				<ul class="navbar-nav ms-auto d-flex flex-row">
					<!-- Avatar -->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
							id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <?php
							if ($user_type == "admin"){
								echo "<img src='images/Yael pic.png' class='rounded-circle' height='35' alt='Avatar' loading='lazy' />";}
							else{
								echo "<img src='".$curUser["patient_img"]."' class='rounded-circle' height='35' alt='Avatar' loading='lazy' />";}
							?>
							
						</a>
						<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
							<li>
							<a class="dropdown-item" href="profile.php">My profile</a>
							</li>
							<li>
							<a class="dropdown-item" href="#">Settings</a>
							</li>
							<li>
							<a class="dropdown-item" href="login.php">Logout</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<!-- Container wrapper -->
		</nav>
		<!-- Navbar -->
	</header>
	<!--Main Navigation-->
	
	<!--Main layout-->
	<main>
        <div class="container pt-4">
            <div id="form" class="container-fluid col-10 light-blue">
                <div id="theSpinner">
                    <div id="spinner" class="d-flex align-items-center justify-content-center spinner" >
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <!-- desktop/ipad -->
                <div class="row p-2 d-none d-sm-block">
                    <!-- bread -->
                    <div class="col-4 my-2 d-none d-sm-block ">
                        <?php
						if($user_type == "admin"){
						echo '<a href="index.php" class="fs-6  d-none d-md-inline-block d-lg-none text-black">Home/</a>
							<a href="index.php" class="fs-6 d-none d-md-inline-block d-lg-none text-black">Users/</a>
                            <a href="#" class="fs-6 d-none d-md-inline-block d-lg-none selected">New User</a>

							<a href="index.php" class="fs-4 d-none d-lg-inline-block text-black">Home/</a>
							<a href="index.php" class="fs-4 d-none d-lg-inline-block text-black">Users/</a>
                            <a href="#" class="fs-4 d-none d-lg-inline-block selected">New User</a>';
						}else{
						echo '<a href="index.php" class="fs-6  d-none d-md-inline-block d-lg-none text-black">Home/</a>
							<a href="index.php" class="fs-6 d-none d-md-inline-block d-lg-none text-black">Foods/</a>
                            <a href="#" class="fs-6 d-none d-md-inline-block d-lg-none selected">New Dish</a>

							<a href="index.php" class="fs-4 d-none d-lg-inline-block text-black">Home/</a>
							<a href="index.php" class="fs-4 d-none d-lg-inline-block text-black">Foods/</a>
                            <a href="#" class="fs-4 d-none d-lg-inline-block selected">New Dish</a>';
						}
						
						?>
                    </div>
                    <div class="container-fluid border rounded mt-4 " id="formDiv">
                        <!-- top main -->
                        <form id="myForm" action="#" name="orderForm" method="post" class="d-none d-sm-block">
                            <input type="hidden" name="insert" value="1">
                            <div class="row p-4 d-none d-sm-block">
                                <div class="row">
                                    <div class="col-auto ">
                                        <?php
                                            if($user_type == "admin"){
                                                echo ' <span id="titleSize" class="text-dark">New User</span>';
                                            }
                                            else{
                                                echo ' <span id="titleSize" class="text-dark">New Dish</span>';
                                            }
                                        ?>
                                       
                                    </div>
                                    <div class="col-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="grey" class="bi bi-book" viewBox="0 0 16 16">
                                            <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                        </svg>    
                                        <a href="#" class="text-grey " style="font-size: 12px; ">How-To</a>  
                                    </div>
                                    <div class="col-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-laptop" viewBox="0 0 16 16">
                                            <path d="M13.5 3a.5.5 0 0 1 .5.5V11H2V3.5a.5.5 0 0 1 .5-.5h11zm-11-1A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2h-11zM0 12.5h16a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5z"/>
                                        </svg>
                                        <a href="#" class="text-grey " style="font-size: 12px; ">Tutorial</a> 
                                    </div>
                                    <div class="col-lg-6 col-md-9"></div>
                                    <div class="col-2">
                                        <button  id="submit" type="submit" class="btn btn strong-blue" >Generate</button>
                                    </div>
                                </div>
                            </div>
                            <!-- info person -->
                            <div  class=" container-fluid bg-light" > 

                                <!-- title -->
                                <div  class="row p-4 d-none d-sm-block">
                                    <?php
                                        if ($user_type == "admin"){
                                            echo '<div id="titleSize"class="col-auto">User information</div>';}
                                        else{
                                            echo '<div id="titleSize"class="col-auto">Dish information</div>';}
                                    ?>
                                    
                                </div>
                                <!-- desktop -->
                                <?php
                                    if ($user_type == "admin"){
                                        echo '<div class="row ">
                                        <div class="col-1 "></div>
                                        <div class="col-5 my-2 d-none d-sm-block">
                                            <!-- name -->
                                            <div class="row my-2 ">
                                                <div class="col-auto">
                                                    <label >Enter user fullname</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="text-danger">(required)</label>
                                                </div>
                                                <div class="row my-2">
                                                    <div class="col-auto">
                                                        <div class="input-group fullname">
                                                            <input type="text" class="form-control"  name="fullName"required>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <!-- email -->
                                            <div class="row my-2">
                                                <div class="col-auto">
                                                    <label >Enter user Email</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="text-danger">(required)</label>
                                                </div>
                                                <div class="row my-2">
                                                    <div class="col-auto">
                                                        <div class="input-group E-mail">
                                                            <input type="email" class="form-control"  name="mail" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <!-- BMI -->
                                            <div class="row my-2">
                                                <div class="col-auto">
                                                    <label >Enter user BMI</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="text-danger">(required)</label>
                                                </div>
                                                <div class="row my-2">
                                                    <div class="col-auto">
                                                        <div class="input-group BMI">
                                                            <input type="number" class="form-control"  step="0.1" min="1" name="BMI"required>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <!-- diet-type -->
                                            <div class="row my-2">
                                                <div class="col-auto">
                                                    <label >Enter client Diet</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="text-danger">(required)</label>
                                                </div>
                                                <div class="row my-2">
                                                    <div class="col-auto">
                                                        <div class="input-group Diet">
                                                            <input type="text" class="form-control"  name="diet"required>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="col-6 my-2 d-none d-sm-block">
                                            <!-- Age -->
                                            <div class="row my-2">
                                                <div class="col-auto">
                                                    <label >Enter user age</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="text-danger">(required)</label>
                                                </div>
                                                <div class="row my-2">
                                                    <div class="col-auto">
                                                        <div class="input-group Age">
                                                            <input type="number" class="form-control"  min="1" name="age"required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">years old</span>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <!-- Weight -->
                                            <div class="row my-2">
                                                <div class="col-auto">
                                                    <label >Enter user weight</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="text-danger">(required)</label>
                                                </div>
                                                <div class="row my-2">
                                                    <div class="col-auto">
                                                        <div class="input-group Weight">
                                                            <input type="number" class="form-control" min="1" name="weight"required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">kg</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <!-- Height -->
                                            <div class="row my-2">
                                                <div class="col-auto">
                                                    <label >Enter user height</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="text-danger">(required)</label>
                                                </div>
                                                <div class="row my-2">
                                                    <div class="col-auto">
                                                        <div class="input-group Height">
                                                            <input type="number" class="form-control"  min="1" name="height"required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">cm</span>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                </div>
                                                
                                            </div>
                                            
                                            <!-- Pregnant -->
                                            <div class="row my-2">
                                                <div class="col-auto">
                                                    <label >Is user pregnant</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="text-danger">(required)</label>
                                                </div>
                                                <div class="row my-2">
                                                    <div class="col-auto">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                Yes
                                                            </label>
                                                            </div>
                                                            <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                                            <label class="form-check-label" for="flexRadioDefault2">
                                                                No
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>      
                                    </div>';
                                    }
                                    else{
                                        echo '
                                        <div class="row  my-2 bg-light">
                                            <div class="col-5 my-2 ">
                                                <!-- name -->
                                                <div class="row my-2 ">
                                                    <div class="col-auto">
                                                        <label >Enter food name</label>
                                                    </div>
                                                    <div class="col-auto">
                                                        <label class="text-danger">(required)</label>
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col-auto">
                                                            <div class="input-group fullname">
                                                                <input type="text" class="form-control"  name="dish_fullName"required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="row my-2">
                                            <div class="col-auto">
                                                <label >Food type</label>
                                            </div>
                                            <div class="col-auto">
                                                <label class="text-danger">(required)</label>
                                            </div>
                                            <div class="row my-2">
                                                <div class="col-auto">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="foodtype" id="flexRadioDefault1" value="Italian">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Italian
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="foodtype" id="flexRadioDefault2" checked value="Japanese">
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            Japanese
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="foodtype" id="flexRadioDefault3" value="Mexican" >
                                                        <label class="form-check-label" for="flexRadioDefault3">
                                                            Mexican
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="foodtype" id="flexRadioDefault4" value="Thai">
                                                        <label class="form-check-label" for="flexRadioDefault4">
                                                            Thai
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="foodtype" id="flexRadioDefault5" value="American">
                                                        <label class="form-check-label" for="flexRadioDefault5">
                                                            American
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="foodtype" id="flexRadioDefault6" value="Indian">
                                                        <label class="form-check-label" for="flexRadioDefault6">
                                                            Indian
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="foodtype" id="flexRadioDefault7" value="Middle Eastern">
                                                        <label class="form-check-label" for="flexRadioDefault7">
                                                            Middle Eastern
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        </div>
                                        <div class="col-6 my-2">
                                        <!-- Age -->
                                        <div class="row my-2">
                                            <div class="col-auto">
                                                <label >Enter food calories</label>
                                            </div>
                                            <div class="col-auto">
                                                <label class="text-danger">(required)</label>
                                            </div>
                                            <div class="row my-2">
                                                <div class="col-auto">
                                                    <div class="input-group Age">
                                                        <input type="number" class="form-control"  min="1" name="food_cal"required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">kCal</span>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                        ';
                                    }
                                    
                                    
                                ?>

                            </div>
                            <!-- diet info -->
                            <div  class=" container-fluid my-3 bg-light">
                                <?php
                                    if ($user_type == "admin"){
                                        echo '
                                        
                                            <div class="row ">
                                            
                                                <!-- title -->
                                                <div  class="row p-4 d-none d-sm-block">
                                                    <div id="titleSize"class="col-auto">Diet menu</div>
                                                </div>
                                                
                                                <!-- date -->
                                                <div class="row my-3 ">
                                                    <div class="col-1 "></div>
                                                    <div class="col-5 my-2 d-none d-sm-block ">
                                                        <label >Choose a start date</label>
                                                        <div class="col-8">
                                                            <div class="input-group date" id="datepicker">
                                                                <input type="text" class="form-control" name="date">
                                                                <span class="input-group-append">
                                                                    <span class="input-group-text bg-white">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-1 "></div>
                                                <!-- 4 questions -->
                                                <div class="col-5 my-2 d-none d-sm-block">
                                                    <div class="row my-3">
                                                        <div class="col-auto">
                                                            <label >Calories per day</label>
                                                        </div>
                                                        <div class="col-auto">
                                                            <label  class="text-danger">(required)</label>
                                                        </div>  
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col-auto">
                                                            <div class="input-group Calories">
                                                                <input type="number" class="form-control" name="Calories"  >
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">kCal</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row my-3">
                                                        <div class="col-auto">
                                                            <label >Protein per day</label>
                                                        </div>
                                                        <div class="col-auto">
                                                            <label  class="text-danger">(required)</label>
                                                        </div>  
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col-auto">
                                                            <div class="input-group Protein">
                                                                <input type="number" class="form-control" name="Protein" >
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">grams</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row my-3">
                                                        <div class="col-auto">
                                                            <label >Health labels</label>
                                                        </div>
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col-auto p-1">
                                                            <input type="checkbox" class="btn-check" id="btncheck1" name="Health"autocomplete="off">
                                                            <label id="check" class="btn light-blue" for="btncheck1">Peanuts Free</label>
                                                        </div>
                                                        <div class="col-auto p-1">
                                                            <input type="checkbox" class="btn-check" id="btncheck2"name="Health" autocomplete="off">
                                                            <label id="check" class="btn light-blue" for="btncheck2">Pork Free</label>
                                                        </div>
                                                        <div class="col-auto p-1">
                                                            <input type="checkbox" class="btn-check"id="btncheck3" name="Health" autocomplete="off">
                                                            <label id="check" class="btn light-blue"for="btncheck3" >Gluten Free</label>
                                                        </div>
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col-auto p-1">
                                                            <input type="checkbox" class="btn-check" id="btncheck4" name="Health"autocomplete="off">
                                                            <label id="check" class="btn light-blue" for="btncheck4">Vegan</label>
                                                        </div>
                                                        <div class="col-auto p-1">
                                                            <input type="checkbox" class="btn-check"id="btncheck5"  name="Health"autocomplete="off">
                                                            <label  id="check" class="btn light-blue"for="btncheck5" >Vegetarian</label>
                                                        </div>
                                                        <div class="col-auto p-1">
                                                            <input type="checkbox" class="btn-check"id="btncheck6"name="Health" autocomplete="off">
                                                            <label id="check" class="btn light-blue" for="btncheck6">Fish Free</label>
                                                        </div>
                                                        <div class="col-auto p-1">
                                                            <input type="checkbox" class="btn-check" id="btncheck7" name="Health"autocomplete="off">
                                                            <label id="check" class="btn light-blue" for="btncheck7">Eggs Free</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 my-2 d-none d-sm-block">
                                                    <div class="row my-3">
                                                        <div class="col-auto">
                                                            <label >Fats per day</label>
                                                        </div>
                                                        <div class="col-auto">
                                                            <label  class="text-danger">(required)</label>
                                                        </div>  
                                                    </div>
                                                    <div class="row my-2">
                                                        <div class="col-auto">
                                                            <div class="input-group Fats">
                                                                <input type="number" class="form-control" name="Fats"required>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">grams</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row my-3">
                                                        <div class="col-auto">
                                                            <label >Carbohydrates per day</label>
                                                        </div>
                                                        <div class="col-auto">
                                                            <label  class="text-danger">(required)</label>
                                                        </div>  
                                                    </div>
                                                    <div class="row mt-2 ">
                                                        <div class="col-auto">
                                                            <div class="input-group Carbohydrates">
                                                                <input type="number" class="form-control" name="Carbohydrates"required>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">grams</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row my-3">
                                                        <div class="col-auto">
                                                            <label >Food to avoid</label>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2 ">
                                                        <div class="col-auto">
                                                            <div class="input-group Food">
                                                                <input type="text" class="form-control" name="cancelFood">
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                    }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
               
                <!-- iphone form -->
                <div  class="row p-2 d-block d-sm-none">
                    <form action="#" name="orderForm2" method="post" class="d-block d-sm-none">
                        <!-- iphone -->
                        <div class="row p-2 bg-light" >
                            <div class="row ">
                                <div class="col-auto">
                                    <?php
                                        if($user_type == "admin"){
                                            echo ' <span id="titleSize" class="text-dark">New User</span>';
                                        }
                                        else{
                                            echo ' <span id="titleSize" class="text-dark">New Dish</span>';
                                        }
                                    ?>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="grey" class="bi bi-book" viewBox="0 0 16 16">
                                        <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                    </svg>    
                                    <a href="#" class="text-grey " style="font-size: 10px; ">How-To</a>  
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-laptop" viewBox="0 0 16 16">
                                        <path d="M13.5 3a.5.5 0 0 1 .5.5V11H2V3.5a.5.5 0 0 1 .5-.5h11zm-11-1A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2h-11zM0 12.5h16a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5z"/>
                                    </svg>
                                    <a href="#" class="text-grey " style="font-size: 10px; ">Tutorial</a> 
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-1">
                                    <button  id="submit" type="submit" class="btn btn strong-blue" >Generate</button>
                                </div>
                            </div>
                        </div>
                        <!-- iphone -->
                        <?php
                            if ($user_type == "admin"){
                                echo    '
                                <div class="row p-2 my-2 bg-light">
                                    <div id="titleSize"class="my-3">User information</div>
                                    <div class="row d-block d-sm-none">
                                        <label >Enter user fullname
                                            <label class="text-danger">*</label>
                                        </label>
                                        <div class="input-group fullname">
                                            <input type="text" class="form-control" value="" name="fullName">
                                        </div>
                                    
                                        <div class="row my-3">
                                            <label >Enter user Email
                                                <label class="text-danger">*</label>
                                            </label>
                                            <div class="input-group E-mail">
                                                <input type="email" class="form-control" value="" name="mail">
                                            </div>
                                        </div>
                                        <div class="row my-3">
                                            <label >Enter user BMI
                                                <label class="text-danger">*</label>
                                            </label>
                                            <div class="input-group BMI">
                                                <input type="number" class="form-control" value="" step="0.1" min="1" name="BMI">
                                            </div>
                                        </div>
                                        <div class="row my-3">
                                            <label >Enter client Diet
                                                <label class="text-danger">*</label>
                                            </label>
                                            <div class="input-group Diet">
                                                <input type="text" class="form-control" value="" name="diet">
                                            </div>
                                        </div>
                                        <div class="row my-3">
                                            <label >Enter user age
                                                <label class="text-danger">*</label>
                                            </label>
                                            <div class="input-group Age">
                                                <input type="number" class="form-control" value="" min="1" name="age">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">years old</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row my-3">
                                            <label >Enter user weight
                                                <label class="text-danger">*</label>
                                            </label>
                                            <div class="input-group Weight">
                                                <input type="number" class="form-control" value="" min="1" name="weight">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">kg</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row my-3">
                                            <label >Enter user height
                                                <label class="text-danger">*</label>
                                            </label>
                                            <div class="input-group Height">
                                                <input type="number" class="form-control" value="" min="1" name="height">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">cm</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row my-3">
                                            <label >Is user pregnant
                                                <label class="text-danger">*</label>
                                            </label>
                                            <div class="col-auto">
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Yes
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row p-2 bg-light">
                                    <!-- iphone -->
                                    <div  class="row p-1 d-block d-sm-none">
                                        <div id="titleSize"class="my-3">Diet menu</div>
                                        <label >Choose a start date
                                            <label class="text-danger">*</label>
                                        </label>
                                        <div class="input-group date" id="datepicker">
                                            <input type="text" class="form-control" name="date">
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-white">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <label class="my-3" >Calories per day
                                            <label class="text-danger">*</label>
                                        </label>
                                        <div class="input-group Calories">
                                            <input type="number" class="form-control" name="Calories">
                                            <div class="input-group-append">
                                                <span class="input-group-text">kCal</span>
                                            </div>
                                        </div>
                                        <label class="my-3" >Protein per day
                                            <label class="text-danger">*</label>
                                        </label>
                                        <div class="input-group Protein">
                                            <input type="number" class="form-control" name="Protein">
                                            <div class="input-group-append">
                                                <span class="input-group-text">grams</span>
                                            </div>
                                        </div>
                                        <label class="my-3" >Fats per day
                                            <label class="text-danger">*</label>
                                        </label>
                                        <div class="input-group Fats">
                                            <input type="number" class="form-control" name="Fats">
                                            <div class="input-group-append">
                                                <span class="input-group-text">grams</span>
                                            </div>
                                        </div>
                                        <label class="my-3" >Carbohydrates per day
                                            <label class="text-danger">*</label>
                                        </label>
                                        <div class="input-group Carbohydrates">
                                            <input type="number" class="form-control" name="Carbohydrates">
                                            <div class="input-group-append">
                                                <span class="input-group-text">grams</span>
                                            </div>
                                        </div>
                                        <label class="my-3" >Food to avoid
                                            <label class="text-danger">*</label>
                                        </label>
                                        <div class="input-group Food">
                                            <input type="text" class="form-control" name="cancelFood">
                                        </div>
                                        <label class="my-3" >Health labels
                                            <label class="text-danger">*</label>
                                        </label>
                                        <div class="row-auto">
                                        
                                                <input type="checkbox" class="btn-check " id="btncheck1" name="Health"autocomplete="off">
                                                <label id="check" class="btn light-blue my-2" for="btncheck1">Peanuts Free</label>
                                            
                                                <input type="checkbox" class="btn-check" id="btncheck2"name="Health" autocomplete="off">
                                                <label id="check" class="btn light-blue my-2" for="btncheck2">Pork Free</label>
                                            
                                                <input type="checkbox" class="btn-check"id="btncheck3" name="Health" autocomplete="off">
                                                <label id="check" class="btn light-blue my-2"for="btncheck3" >Gluten Free</label>
                                            
                                                <input type="checkbox" class="btn-check" id="btncheck4" name="Health"autocomplete="off">
                                                <label id="check" class="btn light-blue my-2" for="btncheck4">Vegan</label>
                                            
                                                <input type="checkbox" class="btn-check"id="btncheck5"  name="Health"autocomplete="off">
                                                <label  id="check" class="btn light-blue my-2"for="btncheck5" >Vegetarian</label>
                                            
                                                <input type="checkbox" class="btn-check"id="btncheck6"name="Health" autocomplete="off">
                                                <label id="check" class="btn light-blue my-2" for="btncheck6">Fish Free</label>
                                            
                                                <input type="checkbox" class="btn-check" id="btncheck7" name="Health"autocomplete="off">
                                                <label id="check" class="btn light-blue my-2" for="btncheck7">Eggs Free</label>
                                            
                                            
                                        </div>
                                        <div class="container-fluid d-inline-block d-md-none sos">
                                            <a href="#"><img src="images/SOS.png"></a>
                                        </div>     
                                </div>'; 
                            }
                            else{
                                    echo '
                                    <div class="row  my-2 bg-light">
                                        <div class="col-5 my-2 ">
                                            <!-- name -->
                                            <div class="row my-2 ">
                                                <div class="col-auto">
                                                    <label >Enter food name</label>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="text-danger">(required)</label>
                                                </div>
                                                <div class="row my-2">
                                                    <div class="col-auto">
                                                        <div class="input-group fullname">
                                                            <input type="text" class="form-control"  name="dish_fullName2"required>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        <div class="row my-2">
                                            <div class="col-auto">
                                                <label >Food type</label>
                                            </div>
                                            <div class="col-auto">
                                                <label class="text-danger">(required)</label>
                                            </div>
                                            <div class="row my-2">
                                                <div class="col-auto">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="foodtype2" id="flexRadioDefault1" value="Italian">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Italian
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="foodtype2" id="flexRadioDefault2" checked value="Japanese">
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            Japanese
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="foodtype2" id="flexRadioDefault3" value="Mexican" >
                                                        <label class="form-check-label" for="flexRadioDefault3">
                                                            Mexican
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="foodtype2" id="flexRadioDefault4" value="Thai">
                                                        <label class="form-check-label" for="flexRadioDefault4">
                                                            Thai
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="foodtype2" id="flexRadioDefault5" value="American">
                                                        <label class="form-check-label" for="flexRadioDefault5">
                                                            American
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="foodtype2" id="flexRadioDefault6" value="Indian">
                                                        <label class="form-check-label" for="flexRadioDefault6">
                                                            Indian
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="foodtype2" id="flexRadioDefault7" value="Middle Eastern">
                                                        <label class="form-check-label" for="flexRadioDefault7">
                                                            Middle Eastern
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-6 my-2">
                                        <!-- Age -->
                                        <div class="row my-2">
                                            <div class="col-auto">
                                                <label >Enter food calories</label>
                                            </div>
                                            <div class="col-auto">
                                                <label class="text-danger">(required)</label>
                                            </div>
                                            <div class="row my-2">
                                                <div class="col-auto">
                                                    <div class="input-group Age">
                                                        <input type="number" class="form-control"  min="1" name="food_cal2"required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">kCal</span>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="row my-3">
                                                <div class="col-auto">
                                                    <label >Restaurant name</label>
                                                </div>
                                            </div>
                                            <div class="row mt-2 ">
                                                <div class="col-auto">
                                                    <div class="input-group restaurant_food">
                                                        <input type="text" class="form-control" name="restaurant_food2">
                                                    </div>
                                                </div> 
                                            </div>
                                            
                                        </div>
                                    </div>';
                                }
                                
                        ?>
                             
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!--Main layout-->
    <!-- MDB -->
    <script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="js/jsSmartFork.js"></script>
</body>
</html>