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
        
        
            if(isset($_POST["patient_note_edit"]))
            {
                $note = $_POST["patient_note_edit"];
        
                
                $query3 = "UPDATE tbl_205_patients SET patient_note = '$note', patient_note_changed=1 WHERE patient_id = '$prodId' ";        
                
                $result3 = mysqli_query($connection, $query3);
                if(!$result3) {
                    die("DB query failed.");
                }
            
            }
            $curUserQuery = mysqli_query($connection, "SELECT * FROM tbl_205_nutritionist WHERE nutr_email ='" . $_SESSION["user_email"] . "' LIMIT 1");
			$curUser = mysqli_fetch_assoc($curUserQuery);
			$_SESSION["nutr_id"] = $nutr_id;
        }
        else{
            if(isset( $_GET["food_id"]))
            {
                $foodid = $_GET["food_id"];
                $query6  = "SELECT * FROM tbl_205_food where food_id=" . $foodid;
                
                    $result6 = mysqli_query($connection, $query6);
                    if($result6) {
                        $row = mysqli_fetch_assoc($result6); //there is only 1 item with id=X
                    }
                    else die("DB query failed.");
    
    
    
    
                    if(isset($_POST["food_rec"]))
                    {
                        $reaction = $_POST["food_rec"];
                
                        
                        $escaped_reaction = mysqli_real_escape_string($connection, $reaction);
                        $query5 = "UPDATE tbl_205_food SET food_reac = '$escaped_reaction' WHERE food_id = '$foodid' ";
    
                        $result5 = mysqli_query($connection, $query5);
                        if(!$result5) {
                            die("DB query failed.");
                        }
                    
                    }
                    $curUserQuery = mysqli_query($connection, "SELECT * FROM tbl_205_patients WHERE patient_email ='" . $_SESSION["user_email"] . "' LIMIT 1");
                    $curUser = mysqli_fetch_assoc($curUserQuery);
            }
            
        }
       
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
    <main>
		<div class="container pt-4">
            <div class="row p-2 ">
                <!-- bread -->
                <div class="col-4 my-2 d-none d-sm-block d-md-block d-flex">
                <?php
                    if($user_type == "admin"){
                        echo '<a href="index.php" class="fs-6  d-none d-md-inline-block d-lg-none text-black">Home/</a>
                            <a href="index.php" class="fs-6 d-none d-md-inline-block d-lg-none text-black">Users/</a>
                            <a href="#" class="fs-6 d-none d-md-inline-block d-lg-none selected">' . $row["patient_full_name"] .'</a>

                            <a href="index.php" class="fs-4 d-none d-lg-inline-block text-black">Home/</a>
                            <a href="index.php" class="fs-4 d-none d-lg-inline-block text-black">Users/</a>
                            <a href="#" class="fs-4 d-none d-lg-inline-block selected">' . $row["patient_full_name"] .'</a>';
                        }
                    else{
                        echo '<a href="index.php" class="fs-6  d-none d-md-inline-block d-lg-none text-black">Home/</a>
                            <a href="index.php" class="fs-6 d-none d-md-inline-block d-lg-none text-black">Foods/</a>
                            <a href="#" class="fs-6 d-none d-md-inline-block d-lg-none selected">' . $row["food_name"] .'</a>

                            <a href="index.php" class="fs-4 d-none d-lg-inline-block text-black">Home/</a>
                            <a href="index.php" class="fs-4 d-none d-lg-inline-block text-black">Foods/</a>
                            <a href="#" class="fs-4 d-none d-lg-inline-block selected">' . $row["food_name"] .'</a>';
                    }
                ?>
                </div>
            </div>
            <div class="row m-5">
                <!-- profile -->
                <div  class="row mb-4 bg-light">
                    <div class="col-3 my-2">
                        <?php
                        if($user_type == "admin"){
                            echo'<img id="pepperProfile" src="images/defult_pic_user.jpg">'; 
                        }
                        else{
                            echo'<img calss="d-none " src="images/food2.png">';
                        }
                        ?>
                            <!-- ipad -->
                        <div class="row  d-none d-md-block d-lg-none  ">
                            <?php
                             if($user_type == "admin"){
                                echo'<div class="col-1 m-3">
                                <button type="button" class="btnProfile btn light-blue">
                                    <a href="#" class="text-dark"  >Edit profile</a>
                                </button>
                            </div>
                            <div class="col-auto m-3">
                                <button type="button" class="btnProfile btn light-blue">
                                    <a href="#" class="text-dark" >Edit diet</a>
                                </button>
                            </div> ';   
                             }
                            ?>
                                                      
                        </div>
                    </div>
                    <!-- desktop and ipad -->
                    <?php
                    if($user_type == "admin"){
                        echo'
                        <div class="col-3 mt-3 d-none d-sm-block bg-light">
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
                        </div> ';
                       
                    }
                    else{
                       echo '
                       <div class="col-6 d-none d-sm-block"></div>
                        <div class="col-3 mt-3 d-none d-sm-block bg-light">
                            <div class="row">
                                <span class="fs-3 text-dark">' . $row["food_name"] .'</span>
                                <span class="mt-2 text-dark" style="font-size: 14px;">Calories : ' . $row["calories"]. '</span>
                                <div class="row mt-5"></div>
                                <span class="mt-3 text-dark">Added at: ' . $row["food_date"]. '</span>
                            </div>
                        </div>
                        <div class="row d-block d-sm-none">
                            <span class="fs-3 text-dark">' . $row["food_name"] .'</span>
                            <span class="mt-2 text-dark" style="font-size: 14px;">Calories : ' . $row["calories"]. '</span>
                            <div class="row mt-5"></div>
                            <span class="mt-3 text-dark">Added at: ' . $row["food_date"]. '</span>
                        </div>
                    
                    
                    
                    
                    
                    ';
                    }
                        
                    
                       
                    ?>
                    
                     <!-- iphone -->
                     <?php
                     if($user_type == "admin"){
                        echo'<div class="row d-block d-sm-none my-3">
                     <div class="row my-2">
                         <button type="button" class="btnProfile btn light-blue">
                             <a href="#" class="text-dark"  >Edit profile</a>
                         </button>
                     </div>
                     <div class="row">
                         <button type="button" class="btnProfile btn light-blue">
                             <a href="#" class="text-dark" >Edit diet</a>
                         </button>
                     </div>
                 </div>
                 <!-- desktop -->
                 <div class="col-1 d-none d-xl-block d-lg-block">
                     <div class="row mt-5"></div>
                     <div class="row mt-3">
                         <button type="button" class="btnProfile btn light-blue">
                             <a href="#" class="text-dark"  >Edit profile</a>
                         </button>
                         
                     </div>
                     <div class="row my-2 ">
                         <button type="button" class="btnProfile btn light-blue">
                             <a href="#" class="text-dark" >Edit diet</a>
                         </button>
                     </div>
                     
                 </div>';
                     }
                     
                     ?>
                     
                </div> 
                <!-- notes -->
                <div  class="row mt-5 mb-4 bg-light">
                    <div class="col mb-3">
                        <div class="row">
                            <div class="row">
                            <div class="col-11">
                                <?php
                                    if($user_type == "admin"){
                                        echo'<span class="fs-3 my-2 text-dark">The Last Note</span>'; 
                                    }
                                    else{
                                        echo'<span class="fs-3 my-2 text-dark">Reactions due to the dish</span>';
                                    }
                                ?>
                                    
                                </div>
                                <div class="col-1">
                                    <?php
                                        if($user_type == "admin"){
                                            echo' <button type="button" id="btn_note" class="btnProfile btn light-blue my-2 " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit your note </h1>
                                                    </div>
                                                    <form action="#" method="post">
                                                        <div class="modal-body">
                                                            <textarea type="text" class="form-control text-start" name="patient_note_edit" required>';?><?php
                                                                    $content = $row["patient_note"];
                                                                    $lines = explode("\n", $content);
                                                                    $formattedContent = implode("\n", array_map('trim', $lines));
                                                                    echo $formattedContent;
                                                                    ?><?php
                                                            echo'</textarea>
                                                        </div>
    
    
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button   type="submit" class="btn btn-success submit">Submit</button>
    
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>'; 
                                        }
                                        else{
                                            echo' <button type="button" id="btn_note" class="btnProfile btn light-blue my-2 " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit your note </h1>
                                                    </div>
                                                    <form action="#" method="post">
                                                        <div class="modal-body">
                                                            <textarea type="text" class="form-control text-start" name="food_rec" required>';?><?php
                                                                    $content1 = $row["food_reac"];
                                                                    $lines1 = explode("\n", $content1);
                                                                    $formattedContent1 = implode("\n", array_map('trim', $lines1));
                                                                    echo $formattedContent1;
                                                                    ?><?php
                                                            echo'</textarea>
                                                        </div>
    
    
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button   type="submit" class="btn btn-success">Submit</button>
    
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>'; 
                                        }
                                    ?>
                                   
                                </div>
                            </div>
                            <?php
                            if($user_type == "admin"){
                                echo '<span class="text-dark">' . $row["patient_note"]. '</span>';
                            }
                            else{
                                echo '<span class="text-dark">' . $row["food_reac"]. '</span>';
                            }
                                
                               
                                
                            ?>
                            
                        </div>
                    </div>
                </div>
                <?php
                 if($user_type == "admin"){
                    echo'
                    <div  class="row mb-4 bg-light">
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
                <div  class="row d-none d-xl-block d-lg-block d-md-block bg-light">
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
                </div>';
                 }
                ?>
                
            </div>
        </div>
    </main>
    <script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
    <script src="js/jsSmartFork.js"></script>
</body>
</html>