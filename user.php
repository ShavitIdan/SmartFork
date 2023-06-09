<?php 
	include "config.php"; 
    include "db.php";
	session_start(); 

	// check if the user tring to get from url.
	if(!isset($_SESSION["user_id"])){
		header('Location: ' . URL . 'index.php');
	}

    $prodId = $_GET["patient_id"];
    $query  = "SELECT * FROM tbl_205_patients where patient_id=" . $prodId;

    $result = mysqli_query($connection, $query);
    if($result) {
        $row = mysqli_fetch_assoc($result); //there is only 1 item with id=X
    }
    else die("DB query failed.");



    
    $result2 = mysqli_query($connection, $query);

	

    if(!$result2) {
        die("DB query failed.");
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
					<a href="#" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
						<img src="images/Home.png"><span class="ms-3">Home</span>
					</a>
					<a href="#" class="list-group-item list-group-item-action py-2 ripple">
						<img src="images/Vector.png"><span class="ms-3">Analytics</span>
					</a>
					<a href="index.html" class="list-group-item list-group-item-action py-2 ripple active">
						<img src="images/Vector2.png"><span class="ms-3">Users</span>
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
				<a class="navbar-brand" id="logo" href="#"></a>
				<!-- Right links -->
				<ul class="navbar-nav ms-auto d-flex flex-row">
					<!-- Avatar -->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
							id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
							<img src="images/Yael pic.png" class="rounded-circle" height="35" alt="Avatar" loading="lazy" />
						</a>
						<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
							<li>
							<a class="dropdown-item" href="#">My profile</a>
							</li>
							<li>
							<a class="dropdown-item" href="#">Settings</a>
							</li>
							<li>
							<a class="dropdown-item" href="#">Logout</a>
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
                    <a href="index.php" class="fs-4 d-none d-lg-inline-block text-black">Home/</a>
                    <a href="index.php" class="fs-4 d-none d-lg-inline-block text-black">Users/</a>
                    <?php
                        echo '<a href="#" class="fs-4 d-none d-lg-inline-block selected">' . $row["patient_full_name"] .'</a>';
                    ?>
                    

                </div>
            </div>
            <div class="row m-5">
                <!-- profile -->
                <div id="white_parg" class="row mb-4">
                    <div class="col-3 my-2">
                        <img id="pepperProfile" src="images/Peper profile.png"> 
                            <!-- ipad -->
                        <div class="row  d-none d-md-block d-lg-none  ">
                            <div class="col-1 m-3">
                                <button id="btnProfile" type="button" class="btn light-blue">
                                    <a href="#" class="text-dark"  >Edit profile</a>
                                </button>
                            </div>
                            <div class="col-auto m-3">
                                <button id="btnProfile" type="button" class="btn light-blue">
                                    <a href="#" class="text-dark" >Edit diet</a>
                                </button>
                            </div>                              
                        </div>
                    </div>
                    <!-- desktop and ipad -->
                    <?php
                        echo'
                        <div class="col-3 mt-3 d-none d-sm-block">
                            <div class="row">
                                <span class="fs-3 text-dark">' . $row["patient_full_name"] .'</span>
                                <span class="mt-2 text-dark" style="font-size: 14px;">' . $row["patient_email"]. '</span>
                                <div class="row mt-5"></div>
                                <span class="mt-3 text-dark">Next appoinment: ' . $row["next_meet"]. '</span>
                            </div>
                        </div>
                        <!-- iphone -->
                        <div class="col-auto d-block d-sm-none m-1">
                            <span class="fs-3 text-dark">' . $row["patient_full_name"] .'</span>
                            <div class="row">
                                <span class="mt-2 text-dark" style="font-size: 14px;">' . $row["patient_email"]. '</span>
                            </div>
                        </div>
                        <!-- iphone -->
                        <div class="row d-block d-sm-none my-3">
                            <div class="row">
                                <span class="mt-3 text-dark">Next appoinment: ' . $row["next_meet"]. ' </span>
                            </div>
                        </div>
                        <!-- desktop and ipad -->
                        <div class="col-2 mt-3 d-none d-sm-block">
                            <div class="row">
                                <span class="fs-3 text-dark">Details</span>
                                <span class="mt-1 text-dark">Weight: ' . $row["patient_weight"]. '  kg</span>
                                <span class="mt-1 text-dark">Height: ' . $row["patient_height"]. ' cm</span>
                                <span class="mt-1 text-dark">Age: ' . $row["patient_age"]. '</span>
                                <span class="mt-1 text-dark">BMI: ' . $row["patient_bmi"]. '</span>
                            </div>
                        </div>
                        <!-- iphone -->
                        <div class="row d-block d-sm-none my-3">
                            <div class="row">
                                <span class="fs-3 text-dark">Details</span>
                                <span class="mt-1 text-dark">Weight: ' . $row["patient_weight"]. ' kg</span>
                                <span class="mt-1 text-dark">Height: ' . $row["patient_height"]. ' cm</span>
                                <span class="mt-1 text-dark">Age: ' . $row["patient_age"]. '</span>
                                <span class="mt-1 text-dark">BMI: ' . $row["patient_bmi"]. '</span>
                                <span class="mt-3 text-dark">Pregnant: ' . $row["patient_pregnant"]. '</span>
                                <span class="mt-1 text-dark">Sport: ' . $row["patient_sport_by_week"]. '</span>
                                <span class="mt-1 text-dark">Diet: ' . $row["patient_diet"]. '</span>
                                <span class="mt-1 text-dark">Started at: ' . $row["started_diet"]. '</span>
                                <div class="container-fluid d-inline-block d-md-none sos">
                                    <a href="#"><img src="images/SOS.png"></a>
                                </div> 
                            </div>
                        </div>
                        <!-- desktop and ipad -->
                        <div class="col-3 mt-5 d-none d-sm-block">
                            <div class="row">
                                <span class="mt-3 text-dark">Pregnant: ' . $row["patient_pregnant"]. '</span>
                                <span class="mt-1 text-dark">Sport: ' . $row["patient_sport_by_week"]. '</span>
                                <span class="mt-1 text-dark">Diet: ' . $row["patient_diet"]. '</span>
                                <span class="mt-1 text-dark">Started at: ' . $row["started_diet"]. '</span>
                            </div>
                        </div>
                       
                        
                    
                        ';
                    ?>
                    
                     <!-- iphone -->
                     <div class="row d-block d-sm-none my-3">
                            <div class="row my-2">
                                <button id="btnProfile" type="button" class="btn light-blue">
                                    <a href="#" class="text-dark"  >Edit profile</a>
                                </button>
                            </div>
                            <div class="row">
                                <button id="btnProfile" type="button" class="btn light-blue">
                                    <a href="#" class="text-dark" >Edit diet</a>
                                </button>
                            </div>
                        </div>
                        <!-- desktop -->
                        <div class="col-1 d-none d-xl-block d-lg-block">
                            <div class="row mt-5"></div>
                            <div class="row mt-3">
                                <button id="btnProfile" type="button" class="btn light-blue">
                                    <a href="#" class="text-dark"  >Edit profile</a>
                                </button>
                                
                            </div>
                            <div class="row my-2 ">
                                <button id="btnProfile" type="button" class="btn light-blue">
                                    <a href="#" class="text-dark" >Edit diet</a>
                                </button>
                            </div>
                            
                        </div>
                </div> 
                <!-- notes -->
                <div id="white_parg" class="row mt-5 mb-4">
                    <div class="col mb-3">
                        <div class="row">
                            <span class="fs-3 my-2 text-dark">Notes</span>
                            <?php
                                echo '<span class="text-dark">' . $row["patient_note"]. '</span>';
                            ?>
                            
                        </div>
                    </div>
                </div>
                <div id="white_parg" class="row mb-4">
                    <div class="col">
                        <div class="row">
                            <span class="fs-3 my-2 text-dark">Recent activities</span>
                        </div>
                        <div class="row">
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                                  </svg>
                            </div>
                            <div class="col-10">
                                <span>Fork detected an abnormality in the amount of fat consumption. 24 FEB 2023.</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="orange" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                                  </svg>
                            </div>
                            <div class="col-10">
                                <span>Fork turned off. 11 FEB 2023.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="white_parg" class="row d-none d-xl-block d-lg-block d-md-block">
                        <div class="col">
                            <div class="row">
                                <span id="titleSize" class="my-2 text-dark">Analytics</span>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <canvas id="pieChart"></canvas>
                                </div>
                                <div class="col-6">
                                    <canvas id="chart"></canvas>
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