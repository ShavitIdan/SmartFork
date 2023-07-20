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
		$user_email = $_SESSION["user_email"];
        $query = "SELECT * FROM tbl_205_users WHERE id=".$_SESSION["user_id"]."";
        $resultUser = mysqli_query($connection , $query);
        if($user_type == "admin"){
            $query = "SELECT * FROM tbl_205_nutritionist WHERE nutr_email='$user_email'";
            $result = mysqli_query($connection , $query);
            $curUserQuery = mysqli_query($connection, "SELECT * FROM tbl_205_nutritionist WHERE nutr_email ='" . $_SESSION["user_email"] . "' LIMIT 1");
			$curUser = mysqli_fetch_assoc($curUserQuery);
        }
        else{
            // update note changed boolean
            $query = "UPDATE tbl_205_patients SET patient_note_changed=0 WHERE patient_email='$user_email'";
            $result = mysqli_query($connection , $query);
            $query = "SELECT * FROM tbl_205_patients WHERE patient_email='$user_email'";
            $result = mysqli_query($connection , $query);
            $curUserQuery = mysqli_query($connection, "SELECT * FROM tbl_205_patients WHERE patient_email ='" . $_SESSION["user_email"] . "' LIMIT 1");
			$curUser = mysqli_fetch_assoc($curUserQuery);
        }
        
    }
    $row = mysqli_fetch_assoc($result);
    $rowUser = mysqli_fetch_assoc($resultUser);

    // insert
    if(isset($_POST['fullname'])){
        if($user_type == "admin"){
            $insertQuery = "UPDATE tbl_205_nutritionist SET nutr_name='".$_POST['fullname']."', nutr_email='".$_POST['email']."' WHERE nutr_email='$user_email'";
            $insertResult = mysqli_query($connection , $insertQuery);
        }
        else{
            $insertQuery = "UPDATE tbl_205_patients SET patient_full_name='".$_POST['fullname']."', patient_email='".$_POST['email']."' WHERE patient_email='$user_email'";
            $insertResult = mysqli_query($connection , $insertQuery);
        }
        $insertQuery = "UPDATE tbl_205_users SET name_='".$_POST['fullname']."',email='".$_POST['email']."', address='".$_POST['address']."', phone='".$_POST['phone']."' WHERE email='$user_email'";
        $insertResult = mysqli_query($connection , $insertQuery);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="images/fork.png" rel="icon">
	<title>SmartFork User</title>
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
						<a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <?php
							if ($user_type == "admin"){
								echo "<img src='".$curUser["nutr_img"]."' class='rounded-circle' height='35' alt='Avatar' loading='lazy' />";}
							else{
								echo "<img src='".$curUser["patient_img"]."' class='rounded-circle' height='35' alt='Avatar' loading='lazy' />";}
							?>
						</a>
						<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
							<li>
							<a class="dropdown-item" href="#">My profile</a>
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
    <main>
		<div class="container pt-4">
            <div class="row p-2 ">
                <!-- bread -->
                <div class="col-4 my-2 d-none d-sm-block d-md-block d-flex">
                    <a href="index.php" class="fs-6  d-none d-md-inline-block d-lg-none text-black">Home/</a>
                    <a href="index.php" class="fs-6 d-none d-md-inline-block d-lg-none selected">Profile</a>
                    <a href="index.php" class="fs-4 d-none d-lg-inline-block text-black">Home/</a>
                    <a href="index.php" class="fs-4 d-none d-lg-inline-block selected">Profile</a>
                 </div>
            </div>
            <div class="row m-5">
                <!-- profile -->
                <div class="container-xl px-4 mt-4">
                <div class="row">
                    <div class="col-xl-4">
                        <!-- Profile picture card-->
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Profile Picture</div>
                                <div class="card-body text-center">
                                    <!-- Profile picture image-->
                                    <img class="img-account-profile rounded-circle mb-2" src="images/default-pic-list.png" alt="profile Pic">
                                    <!-- Profile picture help block-->
                                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                    <!-- Profile picture upload button-->
                                    <button class="btn btn-primary" type="button">Upload new image</button>
                                </div>
                            </div>
                            <?php
                            if($user_type != "admin"){
                                echo'<div class="card mb-4 mb-xl-0 mt-4">
                                    <div class="card-header">Notes</div>
                                    <div class="card-body">
                                    <div class="small font-italic text-muted mb-4">'.$row['patient_note'].'</div>
                                    </div>
                                </div>';
                            }
                            ?>
                        </div>
                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card mb-4">
                            <div class="card-header">Account Details</div>
                                <div class="card-body">
                                    <form action="#" name="orderForm" method="post"">
                                        <!-- Form Group (username)-->
                                    <?php
                                        if($user_type == "admin"){
                                            echo    '<div class="mb-3">
                                                    <label class="small mb-1" for="inputFullname">Full name</label>
                                                    <input class="form-control" id="inputFullname" type="text" placeholder="Enter your full name" name="fullname" value="'.$row['nutr_name'].'">
                                                    </div>';
                                        }
                                        else{
                                            echo    '<div class="mb-3">
                                                <label class="small mb-1" for="inputFullname">Full name</label>
                                                <input class="form-control" id="inputFullname" type="text" placeholder="Enter your full name" name="fullname" value="'.$row['patient_full_name'].'">
                                            </div>';
                                        }
                                        
                                    echo   '
                                            <!-- Form Row        -->
                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputPhone">Phone number</label>
                                                    <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" name="phone" value="'.$rowUser['phone'].'">
                                                </div>
                                                <!-- Form Group (location)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputAddress">Location</label>
                                                    <input class="form-control" id="inputAddress" type="text" placeholder="Enter your Address" name="address" value="'.$rowUser['address'].'">
                                                </div>
                                            </div>
                                            <!-- Form Group (email address)-->
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                                <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" name="email" value="'.$rowUser['email'].'">
                                            </div>
                                            
                                            <!-- Save changes button-->
                                            <button class="btn btn-primary" type="submit">Save changes</button>';
                                        
                                    ?>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
    <script src="js/jsSmartFork.js"></script>
</body>
</html>