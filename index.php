<?php 
	include "config.php"; 
    include "db.php";
	session_start(); 

	// check if the user tring to get from url.
	if(!isset($_SESSION["user_id"])){
		header('Location: ' . URL . 'login.php');
	}

 
    // get all data from DB
	if(isset($_SESSION["user_type"])){
		$user_type = $_SESSION["user_type"];
		if( $user_type == "admin"){
			$quaery = "SELECT * FROM tbl_205_nutritionist WHERE nutr_email ='".$_SESSION["user_email"]."' LIMIT 1";
			$result = mysqli_query($connection, $quaery);
			if(!$result) {
				die("DB query failed1.");
			}
			$row = mysqli_fetch_assoc($result);
			$nutr_id = $row["nutr_id"];
			$query  = "SELECT * FROM tbl_205_patients inner join tbl_205_nutritionist_patients on tbl_205_patients.patient_id = tbl_205_nutritionist_patients.patient_id where nutr_id = '$nutr_id'";
			$result = mysqli_query($connection, $query);
			if(!$result) {
				die("DB query failed2.");
			}

			if (isset($_POST["patient_delete"])){
				$patient_delete = $_POST["patient_delete"];
				// Construct the delete query with the email parameter
				$quaery3 = "SELECT * FROM tbl_205_patients WHERE patient_full_name = '$patient_delete' LIMIT 1";
				$result3 = mysqli_query($connection, $quaery3);
				if(!$result3) {
					die("DB query failed3.");
				}
				$deleteId = mysqli_fetch_assoc($result3);
				$deleteId = $deleteId["patient_id"];
				$query3 = "DELETE FROM tbl_205_nutritionist_patients WHERE patient_id = '$deleteId'";
				$result3 = mysqli_query($connection, $query3);
				$query3 = "DELETE FROM tbl_205_patients WHERE patient_full_name = '$patient_delete'";
				// Execute the delete query
				$result3 = mysqli_query($connection, $query3);
			}
			
			$curUserQuery = mysqli_query($connection, "SELECT * FROM tbl_205_nutritionist WHERE nutr_email ='" . $_SESSION["user_email"] . "' LIMIT 1");
			$curUser = mysqli_fetch_assoc($curUserQuery);
			$_SESSION["nutr_id"] = $nutr_id;
		}
		else{
			$query  = "SELECT * FROM tbl_205_food";
			$result = mysqli_query($connection, $query);
			if(!$result) {
				die("DB query failed.");
			}

			$menu_delete = isset($_POST["menu_delete"]) ? $_POST["menu_delete"] :"";
			// Construct the delete query with the email parameter
			$query4 = "DELETE FROM tbl_205_food WHERE food_name = '$menu_delete'";
			// Execute the delete query
			$result4 = mysqli_query($connection, $query4);

			$curUserQuery = mysqli_query($connection, "SELECT * FROM tbl_205_patients WHERE patient_email ='" . $_SESSION["user_email"] . "' LIMIT 1");
			$curUser = mysqli_fetch_assoc($curUserQuery);

		}
	}


	// iphone
    $result2 = mysqli_query($connection, $query);
    if(!$result2) {
        die("DB query failed.");
    }
	
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="images/fork.png" rel="icon">
	<title>SmartFork</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.css"rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=DM Sans">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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
								echo "<img src='".$curUser["nutr_img"]."' class='rounded-circle' height='35' alt='Avatar' loading='lazy' />";}
							else{
								if($curUser["patient_note_changed"] == 1){
                                    echo '<div class="notification"><img src="images/notification.png" class="rounded-circle" height="15" alt="Avatar" loading="lazy" /></div>';
                                }
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
			<div class="row p-1">
				<!-- Breadcrumb and search bar-->
				<div id="breadcrumb" class="d-flex justify-content-between my-1">
					<div class="col-2 my-2 d-none d-sm-block ">
						<?php
						if($user_type == "admin"){
						echo '<a href="index.php" class="fs-6  d-none d-md-inline-block d-lg-none text-black">Home/</a>
							<a href="index.php" class="fs-6 d-none d-md-inline-block d-lg-none selected">Users</a>
							<a href="index.php" class="d-none d-lg-inline-block text-black">Home/</a>
							<a href="index.php" class="d-none d-lg-inline-block selected">Users</a>';
						}else{
						echo '<a href="index.php" class="fs-6  d-none d-md-inline-block d-lg-none text-black">Home/</a>
							<a href="index.php" class="fs-6 d-none d-md-inline-block d-lg-none selected">Foods</a>
							<a href="index.php" class="d-none d-lg-inline-block text-black">Home/</a>
							<a href="index.php" class="d-none d-lg-inline-block selected">Foods</a>';
						}
						?>
					</div>
					<input class=" searchBox form-control mr-sm-2 my-2 my-sm-0 " type="search" placeholder="Search" aria-label="Search">
					<button class="searchBtn btn border my-2 my-sm-0 d-none d-lg-inline-block shadow-none submit" type="submit">Search</button>
                    <button class="searchBtn btn border my-2 my-sm-0 d-inline-block d-lg-none shadow-none submit" type="submit"><i class="fa fa-search"></i></button>
					<div class=" d-none d-md-block col-md-1"></div> 
                    <div class="col-auto d-flex ">
						<a href="#"><button type="button" class="btn searchBtn mt-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-trash-o "></i></button></a>
						<!-- Modal -->
						
						<?php
							if($user_type == "admin"){
								echo '<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h1 class="modal-title fs-5" id="staticBackdropLabel">Which patient you want to delete? </h1>
												</div>
												<form action="http://se.shenkar.ac.il/students/2022-2023/web1/dev_205/index.php" method="post">
													<div class="modal-body">
														<label >Enter patient full name</label>
														<input type="text" class="form-control"  name="patient_delete" required>
			
													</div>
													<div class="modal-footer">
														<button type="button" class="btn " data-bs-dismiss="modal">Close</button>
														<button   type="submit" class="submit btn btn-danger">Delete</button>
			
													</div>
												</form>
											</div>
										</div>
									</div>';
							}
							else{
								echo '<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h1 class="modal-title fs-5" id="staticBackdropLabel">Which menu you want to delete? </h1>
												</div>
												<form action="http://se.shenkar.ac.il/students/2022-2023/web1/dev_205/index.php" method="post">
													<div class="modal-body">
														<label >Enter menu full name</label>
														<input type="text" class="form-control"  name="menu_delete" required>
			
													</div>
													<div class="modal-footer">
														<button type="button" class="btn " data-bs-dismiss="modal">Close</button>
														<button   type="submit" class="submit btn btn-danger">Delete</button>
			
													</div>
												</form>
											</div>
										</div>
									</div>';
							}
						?>
						
                        
						<a href="newUser.php"  class="p-1"><button type="button" class="btn searchBtn"><i class="fa fa-plus"></i></button></a>		

						<div class="dropdown p-1">
							<?php
								if($user_type == "admin"){
									echo '
									<button	class="btn searchBtn dropdown-toggle"type="button"id="dropdownMenuButton"data-mdb-toggle="dropdown"aria-expanded="false">Diet sort</button>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="target">
									</ul>';
								}
								else{
									echo '
									<button	class="btn searchBtn dropdown-toggle"type="button"id="dropdownMenuButton"data-mdb-toggle="dropdown"aria-expanded="false">Type sort</button>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="target2">
									</ul>';
								}
							?>	
						</div>
                    </div>
				</div>
                <!-- Desktop main -->
				<div id="userList" class="container-fluid border rounded mt-4  d-none d-md-inline-block">
					<!-- name........ -->
					<?php
					if($_SESSION["user_type"] == "admin"){
					echo '<div class="row p-4 d-flex justify-content-around">
						<div class="col-3 ml-2 d-none d-sm-block">
							<span class="nav-link text-darker "><b>Name</b></span>
						</div>
						<div class="col-2 ml-2 d-none d-sm-block">
							<span class="nav-link text-darker"><b>Weight (kg)</b></span>
						</div>
						<div class="col-2 ml-2 d-none d-lg-block  ">
							<span class="nav-link text-darker"><b>Height (cm)</b></span>
						</div>
						<div class="col-2 ml-2 d-none d-lg-block">
							<span class="nav-link text-darker"><b>Age</b></span>
						</div>
						<div class="col-2 ml-2 d-none d-sm-block">
							<span class="nav-link text-darker"><b>BMI</b></span>
						</div>
						<div class="col-1 ml-2 d-none d-sm-block ">
							<span class="nav-link text-darker"><b>Diet</b></span>
						</div>
					</div>';
					
						while($row = mysqli_fetch_assoc($result)){
							$_bmi=$row["patient_bmi"];
							$img = $row["patient_img"];
							if(!$img) $img = "images/default-pic-list.png";
							echo '<div class="person">
									<a href="user.php?patient_id='. $row["patient_id"] .'" class="row p-3 dietCM d-flex justify-content-around">
									<div class="col-3 ml-2 ">
										<div class="d-flex align-items-center">   
											<div class="col-auto p-1">
												<img src="'.$img.'">
											</div>
										
											<div class="col-auto mx-2">
												<span class="nav-link text-darker ">' . $row["patient_full_name"] .'</span>
												<span class="text-grey">' . $row["patient_email"]. '</span>
											</div>
										</div>
									</div>
									<div class="col-2 ml-2 d-flex align-items-center">
										<span class="text-grey">'.$row["patient_weight"] .'</span>
									</div>
									<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
										<span class="text-grey">'.$row["patient_height"] .'</span>
									</div>
									<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
										<span class="text-grey">'.$row["patient_age"] .'</span>
									</div>';
							if($_bmi > 35 || $_bmi < 20 ){
								echo'<div class="col-2 ml-2 d-flex align-items-center">
										<img src="images/mdi_graph-line.png">
										<span class="strong-red ">'.$row["patient_bmi"] .'</span>
									</div>
									';
							}
							else if($_bmi < 35 && $_bmi > 25  ){
								echo'<div class="col-2 ml-2 d-flex align-items-center">
										<img src="images/graph orange.png">
										<span class="strong-orange ">'.$row["patient_bmi"] .'</span>
									</div>
									';								
							}
							else{
								echo'<div class="col-2 ml-2 d-flex align-items-center">
										<img src="images/green-grapgh.png">
										<span class="strong-green ">'.$row["patient_bmi"] .'</span>
									</div>';
									
							}
							echo '<div class="col-1 ml-2 d-flex align-items-center">
									<span class="text-grey diet_target">'.$row["patient_diet"] .'</span>
								</div>
							</a></div>';
						}
					}
					else {
						echo '<div class="row p-4 d-flex justify-content-around">
						<div class="col-3 ml-2 d-none d-sm-block">
							<span class="nav-link text-darker "><b>Name</b></span>
						</div>
						<div class="col-2 ml-2 d-none d-sm-block">
							<span class="nav-link text-darker"><b>Type</b></span>
						</div>
						<div class="col-2 ml-2 d-none d-lg-block  ">
							<span class="nav-link text-darker"><b>Calories</b></span>
						</div>
						<div class="col-2 ml-2 d-none d-lg-block">
							<span class="nav-link text-darker"><b>Date</b></span>
						</div>
						</div>';
						while($row = mysqli_fetch_assoc($result)){
							echo '<div class="person">
								<a href="user.php?food_id='. $row["food_id"] .'" class="row p-3  dietCM d-flex justify-content-around">
									<div class="col-3 ml-2 ">
										<div class="d-flex align-items-center">
											<div class="col-auto mx-2">
												<span class="nav-link text-darker ">' . $row["food_name"] .'</span>
											</div>
										</div>
									</div>
									<div class="col-2 ml-2 d-flex align-items-center">
										<span class="text-grey type_target">'.$row["food_type"] .'</span>
									</div>
									<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
										<span class="text-grey">'.$row["calories"] .'</span>
									</div>
									<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
										<span class="text-grey">'.$row["food_date"] .'</span>
									</div>
								</a>
								</div>';
						}
					}
					?>

				</div>
				<div class="g-0 container-fluid d-inline-block d-md-none">
                    <table class="table border">
					<?php
						if($user_type == "admin"){
							echo'<thead>
								<tr>
									<th scope="col"></th>
									<th scope="col">Name</th>
									<th scope="col">Diet</th>
									<th scope="col">BMI</th>
								</tr>
								</thead>
								<tbody>';
						
							while($row2 = mysqli_fetch_assoc($result2)){
										$_bmi=$row2["patient_bmi"];
										$img = $row2["patient_img"];
										if(!$img) $img = "images/default-pic-list.png";
										echo '
										
											<tr class="person" onclick="location.href=\'user.php?patient_id=' . $row2["patient_id"] . '\'">
													<td scope="row"><img src="'.$img.'"></td>
													<td>' . $row2["patient_full_name"] .'</td>
													<td class="diet_target">'.$row2["patient_diet"] .'</td>';
													if($_bmi > 35 || $_bmi < 20 ){
														echo'<td class="strong-red" >'.$row2["patient_bmi"] .'</td>';
													}
													else if($_bmi < 35 && $_bmi > 25  ){
														echo'<td class="strong-orange" >'.$row2["patient_bmi"] .'</td>';					
													}
													else{
														echo'<td class="strong-green" >'.$row2["patient_bmi"] .'</td>';
													}
										echo'
											</tr>
										';
								}
							}
							else {
								echo'<thead>
								<tr>
									<th scope="col">Name</th>
									<th scope="col">Type</th>
									<th scope="col">Calories</th>
								</tr>
								</thead>
								<tbody>';
								
									while($row2 = mysqli_fetch_assoc($result2)){
										echo '<tr class="person" onclick="location.href=\'#' . $row2["food_id"] . '\'">
													<td>' . $row2["food_name"] .'</td>
													<td class="type_target">'.$row2["food_type"] .'</td>
													<td  >'.$row2["calories"] .'</td>
											</tr>';
									}
							}
							?>
                        </tbody>
                      </table>
                </div>
				<div class="container-fluid d-inline-block d-md-none sos">
					<a href="#"><img src="images/SOS.png"></a>
				</div>
                <!-- Mobile main -->
			</div>
		</div>
	</main>
  	<!--Main layout-->

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
	<script src="js/jsSmartFork.js"></script>
</body>
</html>