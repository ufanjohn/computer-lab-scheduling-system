<?php
error_reporting(0);
$redirection = $_GET['redirect'];



if(isset($_POST['submit'])){
  session_start();

  $regno = $_POST['regno'];
  $username = $_POST['username'];
  $password = $_POST['password'];
 
  if ($regno&&$password){
	 $connect = mysqli_connect("localhost", "root", "", "uniuyosc")or die("couldn't connect to the database!");
	 $query = mysqli_query($connect, "SELECT * FROM tblusers WHERE regno='$regno'");
	 $numrows = mysqli_num_rows($query);
	 if($numrows!==0){
      while($row = mysqli_fetch_assoc($query)){
        $dbusername = $row['username'];
        $dbregno = $row['regno'];
        $dbpassword = $row['password'];
        $dbid = $row['id'];
        $email = $row['email'];
        $_SESSION['username'] = $dbusername;
        $_SESSION['regno'] = $dbregno;
        $_SESSION['email']= $email;
        $_SESSION['UID']= $row['id'];
      }

    //  ere
    
    
    // reee
		 
		 if ($regno==$dbregno&& password_verify($password, $dbpassword)){
      if(!$redirection){
        $redirection = 'user/index.php';
      } 
			  echo '<script type="text/javascript">
                      alert("Welcome User!");
                           </script>';
        header('location:'.$redirection);
			 $_SESSION['username'] = $username;
       $_SESSION['regno'] = $dbregno;
       $_SESSION['UID']= $dbid;
       
		 }else
			 echo '<script type="text/javascript">
                      alert("Wrong Password!");
                         location="register.php";
                           </script>';
	 }else
         die('<script type="text/javascript">
                      alert("User does not exist!");
                         location="register.php";
                           </script>');		 
	 }else 
	  die('<script type="text/javascript">
                      alert("Please enter a username and password!");
                         location="register.php";
                           </script>');

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login | Uniuyo Schedule</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">UniuyoSchedule</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your Reg. No. & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" method="post" novalidate>
                    <div class="col-12">
                      <label for="regno" class="form-label">Registration No.</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"></span>
                        <input type="text" name="regno" class="form-control" id="regno" required>
                        <div class="invalid-feedback">Please enter your registration number!</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <input class="btn btn-primary w-100" name="submit" type="submit" value="Submit">
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have an account? <a href="register.php">Create an account</a></p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>