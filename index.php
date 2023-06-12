<?php 
	include "config.php"; 
    include "db.php";
	session_start(); 

	// check if the user tring to get from url.
	if(!isset($_SESSION["user_id"])){
		header('Location: ' . URL . 'index.php');
	}


 
    // get all data from DB
    $query  = "SELECT * FROM tbl_205_patients";
    $result = mysqli_query($connection, $query);

    if(!$result) {
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
					<a href="#" class="list-group-item list-group-item-action py-2 ripple active">
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

	<!--Main layout-->
	<main>
		<div class="container pt-4">
			<div class="row p-1">
				<!-- Breadcrumb and search bar-->
				<form id="breadcrumb" class="d-flex justify-content-between my-1">
					<div class="col-2 my-2 d-none d-sm-block ">
						<a href="#" class="fs-6  d-none d-md-inline-block d-lg-none text-black">Home/</a>
						<a href="#" class="fs-6 d-none d-md-inline-block d-lg-none selected">Users</a>
						<a href="#" class="d-none d-lg-inline-block text-black">Home/</a>
						<a href="#" class="d-none d-lg-inline-block selected">Users</a>
					</div>
					<div class="col-1 d-none d-sm-block"></div>   
					<input class=" searchBox form-control mr-sm-2 my-2 my-sm-0 " type="search" placeholder="Search" aria-label="Search">
					<button class="searchBtn btn border my-2 my-sm-0 d-none d-lg-inline-block shadow-none" type="submit">Search</button>
                    <button class="searchBtn btn border my-2 my-sm-0 d-inline-block d-lg-none shadow-none" type="submit"><i class="fa fa-search"></i></button>
					<div class=" d-none d-md-block col-md-2"></div> 
                    <div class="col-auto d-flex ">
                        <a href="#" class="px-2"><i class="fa fa-trash-o"></i></a>
                        <a href="newUser.html" class="px-2"><i class="fa fa-plus" style="font-size:24px"></i></a>
						<ul class="navbar-nav ">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center px-1 d-inline-block d-lg-none" href="#"
									id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-down-alt" viewBox="0 0 16 16">
									<path d="M3.5 3.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 12.293V3.5zm4 .5a.5.5 0 0 1 0-1h1a.5.5 0 0 1 0 1h-1zm0 3a.5.5 0 0 1 0-1h3a.5.5 0 0 1 0 1h-3zm0 3a.5.5 0 0 1 0-1h5a.5.5 0 0 1 0 1h-5zM7 12.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5z"/>
									</svg>
								</a>
								<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
									<li>
									<a class="dropdown-item fs-6" href="#">Name</a>
									</li>
									<li>
									<a class="dropdown-item fs-6" href="#">Weight</a>
									</li>
									<li>
									<a class="dropdown-item fs-6" href="#">BMI</a>
									</li>
								</ul>
							</li>
						</ul>
						<div>
							<ul class="navbar-nav ">
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
										id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
										<button class="btn btn-outline-secondary dropdown-toggle d-none d-lg-inline-block " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-down-alt" viewBox="0 0 16 16">
												<path d="M3.5 3.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 12.293V3.5zm4 .5a.5.5 0 0 1 0-1h1a.5.5 0 0 1 0 1h-1zm0 3a.5.5 0 0 1 0-1h3a.5.5 0 0 1 0 1h-3zm0 3a.5.5 0 0 1 0-1h5a.5.5 0 0 1 0 1h-5zM7 12.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5z"/>
											</svg>
											sorting by 
										</button>
									</a>
									<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
										<li>
										<a class="dropdown-item fs-6" href="#">Name</a>
										</li>
										<li>
										<a class="dropdown-item fs-6" href="#">Weight</a>
										</li>
										<li>
										<a class="dropdown-item fs-6" href="#">BMI</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
                    </div>
				</form>
                <!-- Desktop main -->
				<div id="userList" class="container-fluid border rounded mt-4  d-none d-md-inline-block">
					<!-- name........ -->
					<div class="row p-4 d-flex justify-content-around">
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
					</div>
					<!-- pepper -->
					<a href="user.html?userId=1" class="row p-3 person dietCM d-flex justify-content-around">
						<div class="col-3 ml-2 ">
							<div class="d-flex align-items-center">   
								<div class="col-auto p-1">
									<img src="images/peper.png">
								</div>
							
								<div class="col-auto mx-2">
									<span class="nav-link text-darker ">Peper Ashley</span>
									<span class="text-grey">pashley@gmail.com</span>
								</div>
							</div>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center">
							<span class="text-grey">103</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
							<span class="text-grey">159</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
							<span class="text-grey">27</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center">
							<img src="images/mdi_graph-line.png">
							<span class="strong-red">41.3</span>
						</div>
						<div class="col-1 ml-2 d-flex align-items-center">
							<span class="text-grey">Custom made</span>
						</div>
					</a>
					<!-- Rafaella -->
					<a href="user.html?userId=2" class="row p-3 person dietCM d-flex justify-content-around">
						
						<div class="col-3 ml-2 ">
							<div class="d-flex align-items-center">   
								<div class="col-auto p-1">
									<img src="images/Rafaella.png">
								</div>
		
								<div class="col-auto mx-2">
									<span class="nav-link text-darker ">Rafaella Mendes</span>
									<span class="text-grey">RafaellaM@gmail.com</span>
								</div>
							</div>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center">
							<span class="text-grey">43</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
							<span class="text-grey">163</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
							<span class="text-grey">22</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center">
							<img src="images/mdi_graph-line.png">
							<span class="strong-red">16.4</span>
						</div>
						<div class="col-1 ml-2 d-flex align-items-center">
							<span class="text-grey">Custom made</span>
						</div>
					</a>
					<!-- Elizeu -->
					<a href="user.html?userId=3" class="row p-3 person dietCarn d-flex justify-content-around">
						
						<div class="col-3 ml-2 ">
							<div class="d-flex align-items-center">   
								<div class="col-auto p-1">
									<img src="images/Elizeu.png">
								</div>
								<div class="col-auto mx-2">
									<span class="nav-link text-darker">Elizeu Dias</span>
									<span class="text-grey">Elizeudias@gmail.com</span>
								</div>
							</div>
						   
						</div>
						<div class="col-2 ml-2 d-flex align-items-center">
							<span class="text-grey">80</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
							<span class="text-grey">171</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
							<span class="text-grey">34</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center">
							<img src="images/graph orange.png">
							<span class="strong-orange">27.4</span>
						</div>
						<div class="col-1 ml-2 d-flex align-items-center">
							<span class="text-grey">Carnivore</span>
						</div>
					</a>
					<!-- Moshe -->
					<a href="user.html?userId=4" class="row p-3 person dietLC d-flex justify-content-around">
						<div class="col-3 ml-2 ">
							<div class="d-flex align-items-center">   
								<div class="col-auto p-1">
									<img src="images/moshe.png">
								</div>
								<div class="col-auto mx-2">
									<span class="nav-link text-darker ">Moshe Rahamim</span>
									<span class="text-grey">Moshe123@gmail.com</span>
								</div>
							</div>
							
						</div>
						<div class="col-2 ml-2 d-flex align-items-center">
							<span class="text-grey">70</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
							<span class="text-grey">160</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
							<span class="text-grey">41</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center">
							<img src="images/graph orange.png">
							<span class="strong-orange">27</span>
						</div>
						<div class="col-1 ml-2 d-flex align-items-center">
							<span class="text-grey">Low-Carbs</span>
						</div>
					</a>
					<!-- Ziv -->
					<a href="user.html?userId=5" class="row p-3 person dietVG d-flex justify-content-around">
						<div class="col-3 ml-2 ">
							<div class="d-flex align-items-center">   
								<div class="col-auto p-1">
									<img src="images/ziv.png">
								</div>
								<div class="col-auto mx-2">
									<span class="nav-link text-darker">Ziv Itzhak</span>
									<span class="text-grey">zQueen@gmail.com</span>
								</div>
							</div>
							
						</div>
						<div class="col-2 ml-2 d-flex align-items-center">
							<span class="text-grey">90</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
							<span class="text-grey">155</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
							<span class="text-grey">36</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center">
							<img src="images/mdi_graph-line.png">
							<span class="strong-red">37.9</span>
						</div>
						<div class="col-1 ml-2 d-flex align-items-center">
							<span class="text-grey">Veganism</span>
						</div>
					</a>
					 <!-- Nir -->
					 <a href="user.html?userId=6" class="row p-3 person dietLC d-flex justify-content-around">
						<div class="col-3 ml-2 ">
							<div class="d-flex align-items-center">   
								<div class="col-auto p-1">
									<img src="images/nir.png">
								</div>
								<div class="col-auto mx-2">
									<span class="nav-link text-darker ">Nir Alves</span>
									<span class="text-grey">nnnira@gmail.com</span>
								</div>
							</div>
							
						</div>
						<div class="col-2 ml-2 d-flex align-items-center">
							<span class="text-grey">65</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
							<span class="text-grey">165</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
							<span class="text-grey">29</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center">
							<img src="images/green-grapgh.png">
							<span class="strong-green">23.9</span>
						</div>
						<div class="col-1 ml-2 d-flex align-items-center">
							<span class="text-grey">Low- Carbs</span>
						</div>
					</a>
					<!-- Own -->
					<a href="user.html?userId=7" class="row p-3 person dietCM d-flex justify-content-around">
						<div class="col-3 ml-2 ">
							<div class="d-flex align-items-center">   
								<div class="col-auto p-1">
									<img src="images/own.png">
								</div>
								<div class="col-auto mx-2">
									<span class="nav-link text-darker">Own Boateng</span>
									<span class="text-grey">Boateng@gmail.com</span>
								</div>
							</div>
							
						</div>
						<div class="col-2 ml-2 d-flex align-items-center">
							<span class="text-grey">92</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
							<span class="text-grey">180</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
							<span class="text-grey">52</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center">
							<img src="images/graph orange.png">
							<span class="strong-orange">28.4</span>
						</div>
						<div class="col-1 ml-2 d-flex align-items-center">
							<span class="text-grey">Custom-made</span>
						</div>
					</a>
					<!-- ian -->
					<a href="user.html?userId=8" class="row p-3 person dietCM d-flex justify-content-around">
						<div class="col-3 ml-2 ">
							<div class="d-flex align-items-center ">   
								<div class="col-auto p-1">
									<img src="images/ian.png">
								</div>
								<div class="col-auto mx-2">
									<span class="nav-link text-darker">Ian Dooley</span>
									<span class="text-grey">Ian.Dooley@gmail.com</span>
								</div>
							</div>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center">
							<span class="text-grey">70</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block">
							<span class="text-grey">162</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center d-none d-lg-block	">
							<span class="text-grey">19</span>
						</div>
						<div class="col-2 ml-2 d-flex align-items-center">
							<img src="images/graph orange.png">
							<span class="strong-orange">26.7</span>
						</div>
						<div class="col-1 ml-2 d-flex align-items-center">
							<span class="text-grey">Custom-made</span>
						</div>
					</a>
				</div>
                <!-- Desktop main -->

                <!-- Mobile main -->
                <div class="g-0 container-fluid d-inline-block d-md-none">
                    <table class="table border">
                        <thead>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col">Diet</th>
                            <th scope="col">BMI</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr onclick="location.href='user.html?userId=1';">
                            <a href="#">
                            <td scope="row"><img src="images/peper.png"></td>
                            <td>Pepper Ashley</td>
                            <td>Custom-made</td>
                            <td>41.3</td>
                            </a>
                          </tr>
                          <tr onclick="location.href='user.html?userId=2';">
                            <td scope="row"><img src="images/Rafaella.png"></td>
                            <td>Rafaella Mandes</td>
                            <td>Custom-made</td>
                            <td>16.4</td>
                          </tr>
                          <tr onclick="location.href='user.html?userId=3';">
                            <td scope="row"><img src="images/Elizeu.png"></td>
                            <td>Elzeu Dias</td>
                            <td>Carnivore</td>
                            <td>27.4</td>
                          </tr>
                          <tr onclick="location.href='user.html?userId=4';">
                            <td scope="row"><img src="images/moshe.png"></td>
                            <td>Moshe Rahamim</td>
                            <td>Low_Carbs</td>
                            <td>27</td>
                          </tr>
                          <tr onclick="location.href='user.html?userId=5';">
                            <td scope="row"><img src="images/ziv.png"></td>
                            <td>Ziv Itzhak</td>
                            <td>Veganism</td>
                            <td>37.9</td>
                          </tr>
                          <tr onclick="location.href='user.html?userId=6';">
                            <td scope="row"><img src="images/nir.png"></td>
                            <td>Nir Alves</td>
                            <td>Low_Carbs</td>
                            <td>23.9</td>
                          </tr>
                          <tr onclick="location.href='user.html?userId=7';">
                            <td scope="row"><img src="images/own.png"></td>
                            <td>Own Boateng</td>
                            <td>Custom-made</td>
                            <td>28.4</td>
                          </tr>
                          <tr onclick="location.href='user.html?userId=8';">
                            <td scope="row"><img src="images/ian.png"></td>
                            <td>Ian Dooley</td>
                            <td>Custom-made</td>
                            <td>26.7</td>
                          </tr>
						  <tr onclick="location.href='user.html?userId=9';">
                            <td scope="row"><img src="images/Elizeu.png"></td>
                            <td>Elzeu Dias</td>
                            <td>Carnivore</td>
                            <td>27.4</td>
                          </tr>
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
	<script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
	<script src="js/jsSmartFork.js"></script>
</body>
</html>