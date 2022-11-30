<?php
	error_reporting(0);
	session_start() ; 
	require 'vendor/phpmailer/phpmailer/src/Exception.php';
	require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
	require 'vendor/phpmailer/phpmailer/src/SMTP.php';
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require "vendor/autoload.php";
	$array=array();
	$debug=array();
	$output = '';
	$test=array('low','yow','pow');
	$array=array($_SESSION['name']);
	$debug = var_export($_SESSION['name'], true);
	$scholarship_program ='';
	$scholarship_program =trim($_POST['scholarship_program']);
	$str=varDumpToString($array);
	$data=simplify($str);
	$idno=$data[0];
	$name = $data[1];
	$mobileNo=$data[2];
	$mail= $data[3];
	$email = $data[3];$email1 = "hackfree.iskalar@gmail.com";
	$address=$data[4];
	$course=$data[5];
	$year=$data[6];
	$university=$data[7];
	if(! isset($_SESSION["name"])){
		//if user is not yet logged in, force him or her to go back to login.php
		header("location: index.php");
		exit;
	}else{
		if(isset($_POST['confirm'])){
				//$accpept=$data[8];
				$send1=toSave($idno,$name,$mobileNo,$email,$address,$course,$year,$university,$scholarship_program);
				$send2=toApplicant($name,$email);
				if($send1 && $send2){
					header("location:success.php");
					$_SESSION = array(); //empty the session array variable
					session_destroy();
					unset($_SESSION);
					exit;
				}else{
					header("location:scholarship-programs.php?failed to send application");
				}
		}
	}
		
	
	
	function toSave($idno,$name,$mobileNo,$email,$address,$course,$year,$university,$scholarship_program){
				$mail = new PHPMailer(true);
				$flag=false;
				try {
				  $mail->isSMTP();
				  $mail->Host = 'smtp.gmail.com';
				  $mail->SMTPAuth = true;
				  // Gmail ID which you want to use as SMTP server
				  $mail->Username = 'hackfree.iskalar@gmail.com';
				  // Gmail Password
				  $mail->Password = 'dkaxszymnpvvxvvm';
				  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				  $mail->Port = 587;

				  // Email ID from which you want to send the email
				  $mail->setFrom('hackfree.iskalar@gmail.com');
				  // Recipient Email ID where you want to receive emails
				  $mail->addAddress('ryanmark.dinglasa@gmail.com');

				  $mail->isHTML(true);
				  $mail->Subject = "Iskalar Application";
				  $mail->Body = "
							<h3>There is new application!
							<br>
							ID Number: $idno
							<br>
							Name: $name
							<br>
							Mobile Number: $mobileNo
							<br>
							Email: $email
							<br>
							Address: $address
							<br>
							Course: $course
							<br>
							Year: $year
							<br>
							University: $university
							<br>
							Terms&Condition: Agree
							<br>
							Scholarship Program: $scholarship_program
							<br>
							<br>
							Best Regards,
							<br>
							HackFree Team";
				  $mail->send();
				  $flag=true;
				} catch (Exception $e) {
					$flag= false;
				}
		return $flag;
	}

	function toApplicant($name,$email){
				$mail = new PHPMailer(true);
				$flag=false;
				try {
				  $mail->isSMTP();
				  $mail->Host = 'smtp.gmail.com';
				  $mail->SMTPAuth = true;
				  // Gmail ID which you want to use as SMTP server
				  $mail->Username = 'hackfree.iskalar@gmail.com';
				  // Gmail Password
				  $mail->Password = 'dkaxszymnpvvxvvm';
				  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				  $mail->Port = 587;

				  // Email ID from which you want to send the email
				  $mail->setFrom('hackfree.iskalar@gmail.com');
				  // Recipient Email ID where you want to receive emails
				  $mail->addAddress($email);

				  $mail->isHTML(true);
				  $mail->Subject = "Iskalar Application";
				  $mail->Body = "
							<br>
							<h3>Hi! $name
							<br>
							<br>
							Good Day!,
							<br>
							<br>
							<b>Thank You</b> for using Iskalar MVP for applying a government scholarship program, your application is much appreciated.
							Have a nice day!.
							<br><br>
							<br><br>
							Best Regards,
							<br>
							HackFree Team";
				  $mail->send();
				  $flag=true;
				} catch (Exception $e) {
					$flag= false;
				}
		return $flag;
	}
	 function varDumpToString($var) {
      ob_start();
      var_dump($var);
	  //applicant=array();
	  $point=array();
      $res = ob_get_clean();
      return $res;
	 }
	 function simplify($str){
		$array=array();
		$point=array();
		for($i=0;$i< strlen($str);$i++){
			if($str[$i]=='"'){
				array_push($point,$i);
			}
		}
		$a=0;$b=0;$add='';
		for($j=0;$j<count($point);$j+=2){
			$b=($point[$j+1]-$point[$j])-1;
			$a=($point[$j])+1;
			$add=substr($str,$a,$b);
			array_push($array,$add);
		}	
		return $array;
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
        <!-- Spinner Start 
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
                            <h1 class="text-white animated zoomIn">Scholarship Programs</h1>
                            <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a class="text-white" href="application.php">Application</a></li>
                                    <li class="breadcrumb-item text-white active" aria-current="page">Scholarship Programs</li>
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
                    <div class="center">
						<div class="wow fadeInUp" data-wow-delay="0.3s">
							<h2 >Select a scholarship program</h2>
							<p class="text-danger">* Please select a scholarship program.</p>
							  <!-- registration form -->
							<form method="POST" class="form-horizontal" action="scholarship-programs.php" name="schoalrship-form" id="schoalrship-form">
								<div class="modal" id="modal">
									<div class="confirm-box">
										<div class="btn-confirm">
												<input type="text" class="text-confirm" name="scholarship_program" id="scholarship_program" >
												<label>Select this scholarship program?</label>
												<button type="submit" name="confirm" class="btn  btn-primary" style="border:2px solid rgb(33,36,177);">Confirm</button>
												<button onclick="document.getElementById('modal').style.display='none';"type="button" class="btn btn-scholarship">Cancel</button>
											
										</div>
									</div>
								</div>
							<div class="scholarshp-selection center">
							<!-- SUGBU Scholarship -->	
								<div class="form-group">
									<div class="button-left">
										<button onclick="document.getElementById('modal').style.display='block';
										document.getElementById('scholarship_program').value = 'SUGBU SCHOLARSHIP';
										" value="sugbu-scholarship" type="button" name="sugbu"id="sugbu" class="btn  btn-scholarship">
										<img src="img/sugbu-scholarship.png" width="150" alt="SUGBU scholarship">
										<br><label>SUGBU</label>
										</button>
									</div>
								</div>
							<!-- CHED Scholarship -->	
								<div class="form-group">
									<div class="button-left">
										<button onclick="document.getElementById('modal').style.display='block';
										document.getElementById('scholarship_program').value = 'CHED SCHOLARSHIP';
										" value="ched-scholarship"type="button" name="apply" class="btn  btn-scholarship">
										<img src="img/ched-scholarship.png" width="150" alt="CHED scholarship">
										<br><label>CHED</label>
										</button>
									</div>
								</div>
							<!-- DOST Scholarship -->	
								<div class="form-group">
									<div class="button-left">
										<button onclick="document.getElementById('modal').style.display='block';
										document.getElementById('scholarship_program').value = 'DOST SCHOLARSHIP';
										"value="dost-scholarship" type="button" name="apply" class="btn  btn-scholarship">
										<img src="img/dost-scholarship.png" width="153" alt="DOST scholarship">
										<br><label>DOST</label>
										</button>
									</div>
								</div>
								
							<!-- GSIS Scholarship -->	
								<div class="form-group">
									<div class="button-left">
										<button onclick="document.getElementById('modal').style.display='block';
										document.getElementById('scholarship_program').value = 'GSIS SCHOLARSHIP';
										"value="gsis-scholarship" type="button" name="apply" class="btn  btn-scholarship">
										<img src="img/gsis-scholarship.png" width="150" alt="GSIS scholarship">
										<br><label>GSIS</label>
										</button>
									</div>
								</div>
							
							<!-- OWWA Scholarship -->	
								<div class="form-group">
									<div class="button-left">
										<button 
										onclick="document.getElementById('modal').style.display='block';
										document.getElementById('scholarship_program').value = 'OWWA SCHOLARSHIP';
										"value="owwa-scholarship" type="button" name="apply" class="btn  btn-scholarship">
										<img src="img/owwa-scholarship.png" width="153" alt="OWWA scholarship">
										<br><label>OWWA</label>
										</button>
									</div>
								</div>
								<div class="form-group">
									<div class="button-left">
										<label>
									
										</label>
									</div>
								</div>
						
							<!-- data -->
								<input type="hidden" name="scholarship" id="schoalrship">
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
	<script>
		function confirm(){
			document.getElementById('modal').style.display='none';
		}
		function close(){
			document.getElementById('modal').style.display='none';
		}
	</script>
</html>