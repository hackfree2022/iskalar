<?php
	error_reporting(0);
		$idnoErr=$nameErr = $emailErr = $mobileNoErr = $courseErr = $yearErr= $addressErr = $universityErr = $acceptErr='';
		$idno=$name = $email = $mobileNo = $course = $year = $address = $university ='' ;
		$accept;
		$applicant_data=array();
		$message='';
		$message=trim($_POST['message']);
		$array_name=array();
		$array_name=array('hello','dark','my','old','firend');
    if ($_SERVER["REQUEST_METHOD"] == "POST" &&isset($_POST['apply'])){
		//check idno 
		$idno = validate($_POST['idno']);
        if (empty($idno)){
            $idnoErr = 'idno is required!';
        }else if(!preg_match("/^[0-9]*$/",$idno)){
			$idnoErr = 'only numbers are allowed!';
		}
		//check name 
		$name = validate($_POST['name']);
        if (empty($name)){
            $nameErr = 'name is required!';
        }else if(!preg_match("/^[a-zA-Z ]*$/",$name)){
			$nameErr = 'only letters and white space allowed!';
		}
		
		$mobileNo = validate($_POST['mobileNo']);
		if (empty($mobileNo)){
            $mobileNoErr = 'mobile no. is required!';
        }else{
		//accept 09532288400 || 9532288400 
            $mobileNo = validate($_POST['mobileNo']);
            //check if $mobileNo format is correct
            if (!preg_match("/^[0-9]*$/",$mobileNo)){
                $mobileNoErr = 'only numbers are allowed!';
            }
			if(strLen($mobileNo)<=11 && $mobileNo[0] !=0) {
				$mobileNoErr = 'mobile number format is incorrect, it should start with 09';
			}
			if(strLen($mobileNo)==10 && $mobileNo[0] !=9 ){
				$mobileNoErr = 'err1 format is incorrect!';
			}
			
			if(strLen($mobileNo)<11) {
				$mobileNoErr = 'mobile number format is incorrect, it should be 11 numbers';
			}
        }
		
		//check email
		$email = validate($_POST['email']);
		 if (empty($email)){
            $emailErr = 'email is required!';
        }else{
            //check if the email format is correct
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $emailErr = 'email format is not correct!';
            }
        }
		//check address
		$address = validate($_POST['address']);
		if (empty($address)){
			
            $addressErr = 'address is required!';
        }else{
            //check if name format is correct
            if (!preg_match("/^[a-zA-Z 0-9]*$/",$address)){
                $addressErr = 'only letters, numbers and white space allowed!';
            }
        }
		//check course
		$course = validate($_POST['course']);
		if (empty($course)){
            $courseErr = 'course is required!';
        }else{
            //check if name format is correct
            if (!preg_match("/^[a-zA-Z ]*$/",$course)){
                $courseErr = 'only letters and white space allowed!';
            }
        }
		
		//check University
		$university = validate($_POST['university']);
		if (empty($university)){
            $universityErr = 'university/school is required!';
        }else{
           
            //check if name format is correct
            if (!preg_match("/^[a-zA-Z ]*$/",$university)){
                $universityErr = 'only letters and white space allowed!';
            }
        }
		
		//check Year
		$year = validate($_POST['year']);
		if (empty($year)){
            $yearErr = 'year is required!';
        }else{
            //check if name format is correct
            if (!preg_match("/^[0-9]*$/",$year)){
                $yearErr = 'only numbers are allowed!';
            }
        }
        //check accept  
		$accept = $_POST['accept'];
		if (empty($accept)) {
           $acceptErr = 'you must accept the terms and conditions!';
        }
		
		//redirect
		if(empty($acceptErr)&&empty($idnoErr)&& empty($nameErr)  && empty($mobileNoErr)&& empty($emailErr)&& empty($courseErr)&& empty($universityErr) && empty($yearErr)&& empty($addressErr)){
			session_start() ; 
			$accept="accept";
			$arr = [$idno,$name,$mobileNo,$email,$address,$course,$year,$university,$accpept]; 
			$_SESSION['name'] = $arr ;
			header("location: scholarship-programs.php");
		}
    }

  function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Isklar Application</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class=" navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="index.php" class="navbar-brand p-0">
                    <img src="img/logo.png" alt="Logo"> 
                </a>
            </nav>

            <div class="container-xxl py-5 bg-primary hero-header mb-5">
                <div class="container my-5 py-5 px-lg-5">
                    <div class="row g-5 py-5">
                        <div class="col-12 text-center">
                            <h1 class="text-white animated zoomIn">Application</h1>
                            <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
                                    <li class="breadcrumb-item text-white active" aria-current="page">Application</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container px-lg-5">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
						
						<div class="wow fadeInUp" data-wow-delay="0.3s">
							
							<h2 >Application form</h2>
							<p class="text-danger">* Required field</p>
							  <!-- application form -->
							<form method="POST" class="form-horizontal" action="application.php">
								<!-- idno field -->
								<div class="form-group">
									<label class="control-label col-lg-2" for="idno"><span class="text-danger">*</span> ID Number:</label>
									<div class="col-12">
										<input type="number" class="form-control" id="idno" placeholder="Enter university/school ID number " name="idno" value="<?=$idno;?>" required>
									</div>
									<?="<p class='text-danger'>$idnoErr</p>";?>
								</div>
								 <!-- name field -->
								<div class="form-group">
									<label class="control-label col-lg-2" for="name"><span class="text-danger">*</span> Name:</label>
									<div class="col-12">
										<input type="text" class="form-control" id="name" placeholder="Enter name (Firstname, Middlename, Lastname)" name="name" value="<?=$name;?>" required>
									</div>
									<?="<p class='text-danger'>$nameErr</p>";?>
								</div>
								
							<!-- mobileNo field -->
								<div class="form-group">
									<label class="control-label col-lg-2" for="mobileNo"><span class="text-danger">*</span>Mobile No.:</label>
									<div class="col-12">
										<input type="number" class="form-control" id="mobileNo" placeholder="(+63) " name="mobileNo" value="<?=$mobileNo;?>" required>
									</div>
									<?="<p class='text-danger'>$mobileNoErr</p>";?>
								</div>
							  
							  <!-- email field -->
								<div class="form-group">
									<label class="control-label col-lg-2" for="email"><span class="text-danger">*</span> Email:</label>
									<div class="col-12">
										<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?=$email;?>" required>
									</div>
									<?="<div class='text-danger'>$emailErr</div>";?>
								</div>
								<br>
								<!-- Address field -->
								<div class="form-group">
									<label class="control-label col-lg-2" for="address"><span class="text-danger">*</span> Address:</label>
									<div class="col-12">
										<input type="text" class="form-control" id="address" placeholder="Enter address." name="address" value="<?=$address;?>" required>
									</div>
									<?="<p class='text-danger'>$addressErr</p>";?>
								</div>
								<!-- Course field -->
								<div class="form-group">
									<label class="control-label col-lg-2" for="course"><span class="text-danger">*</span> Course:</label>
									<div class="col-12">
										<input type="text" class="form-control" id="course" placeholder="Enter course." name="course" value="<?=$course;?>" required>
									</div>
									<?="<p class='text-danger'>$courseErr</p>";?>
								</div>
								
								<!-- Year/Level field -->
								<div class="form-group">
									<label class="control-label col-lg-2" for="year"><span class="text-danger">*</span> Year/Level:</label>
									<div class="col-12">
										<input type="number" class="form-control" id="year" placeholder="Enter year/level " name="year" value="<?=$year;?>" required>
									</div>
									<?="<p class='text-danger'>$yearErr</p>";?>
								</div>
								
								<!-- University/School field -->
								<div class="form-group">
									<label class="control-label col-lg-2" for="university"><span class="text-danger">*</span> University/School:</label>
									<div class="col-12">
										<input type="text" class="form-control" id="university" placeholder="Enter university/school intended to enroll" name="university" value="<?=$university;?>" required>
									</div>
									<?="<p class='text-danger'>$universityErr</p>";?>
								</div>
								
							  
							 <!-- acceptence field -->
								<div class="form-group">
									<div class="col-lg-offset-2 col-lg-4">
										<div class="form-check">
											<label class="form-check-label">
												<input class="form-check-input" type="radio" name="accept" value="accept" > <span class="text-danger">*</span> I accept the terms & conditions.
											</label>
										</div>
									</div>
									<?="<p class='text-danger'>$acceptErr</p>";?>
								</div>
								
							<!-- data 
								
								-->
								
								<INPUT TYPE="hidden" NAME="array_name" id="array_name"VALUE="<?= base64_encode(serialize($array_name)); ?>">
							  
							 <!-- submit and reset button field -->
								<div class="form-group">
									<div class="col-lg-offset-2 col-lg-4">
										<button type="submit" name="apply" class="btn  btn-primary">Submit</button>
										<button type="reset" class="btn btn-default">Reset</button>
									</div>
								</div>
								
							</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
        

        <!-- Footer Start -->
        <div class="container-fluid bg text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row g-2">
                    <div class="center">
                        <h5 class="text-white mb-4">Get In Touch</h5>
                        <p><i class="fa fa-map-marker-alt me-3"></i>Sanciangko Street, Cebu City, Philippines</p>
                        <p><i class="fa fa-phone-alt me-3"></i>+63 976 301 3546</p>
                        <p><i class="fa fa-envelope me-3"></i>hackfree.iskalar@gmail.com</p>
                        <div  class="d-flex pt-2">
							<div class="d-flex" style="margin:auto;">
								<a class="btn btn-outline-light btn-social"  href="https://www.facebook.com/profile.php?id=100087945312545"><i class="fab fa-facebook-f"></i></a>
								<a class="btn btn-outline-light btn-social"  href="https://www.instagram.com/markie.yan"><i class="fab fa-instagram"></i></a>
							</div>
						</div>
                    </div>
                </div>
            </div>
            <div class="container px-lg-5">
                <div class="copyright">
                    <div class="row">
                        <div class="center">
                            &copy; 2022 Iskalar | HackFree Team
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
		
    </div><!-- Container End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>