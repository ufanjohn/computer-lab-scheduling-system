<?php
  include_once('includes/config.php');
  include('includes/indexconfig.php');
  //Coding For Signup
  if(isset($_POST['submit'])){
    //Getting Post Values
    //$fname = $_POST['fullname']; 	
    $firstname = $_POST['firstname'];    
    $surname = $_POST['surname'];
    $regno = $_POST['regno'];
    $email = $_POST['email'];	
    $username = $_POST['username'];
    $phone = $_POST['phone'];	
    $pass = $_POST['password'];
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    //Checking email id exist for not
    $result ="SELECT count(*) FROM tblusers WHERE email=?";
    $stmt = $mysqli->prepare($result);
    $stmt->bind_param('s',$email);$stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    //if email already exist
    if($count>0){
      echo "<script>alert('Email is already associated with another account. Please try with diffrent EmailId.');</script>";
    } 
    // If email does not exist
    else {
    $sql="INSERT into tblusers(firstname,surname,regno,email,username,phone,password)VALUES(?,?,?,?,?,?,?)";
    $stmti = $mysqli->prepare($sql);
    $stmti->bind_param('sssssss',$firstname,$surname,$regno,$email,$username,$phone,$pass);
    $stmti->execute();
    $stmti->close();

    $id = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tblusers ORDER BY id desc limit 1"));
    $id = $id['id'];
    $status = 1;

    mysqli_query($con, "INSERT INTO `observer`(`scheduler_id`, `observer_id`, `status`) VALUES ('$id','$id','$status')");
    echo "<script>alert('Successfully registered, please login to continue!');location = 'login.php';</script>";
    
    }
  }
?>
 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register | Uniuyo Schedule</title>
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
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3 needs-validation" method="post"  novalidate>
                  <div class="col-md-6">
                  <label for="firstname" class="form-label">Firstname</label>
                  <input type="text" class="form-control" id="firstname" name="firstname">
                  <div class="invalid-feedback">Please, enter your firstname!</div>
                </div>
                <div class="col-md-6">
                  <label for="surname" class="form-label">Surname</label>
                  <input type="surname" class="form-control" id="surname" name="surname">
                  <div class="invalid-feedback">Please, enter your surname!</div>
                </div>  
                <div class="col-12">
                  <label for="regno" class="form-label">Reg. No</label>
                  <input type="text" name="regno" class="form-control" id="regno" required>
                  <div class="invalid-feedback">Please, enter your registration number!</div>
                </div>

                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="email" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>
                    <div class="col-12">
                      <label for="phone" class="form-label">Phone</label>
                      <input type="phone" name="phone" class="form-control" id="phone" required>
                      <div class="invalid-feedback">Please enter your phone number!</div>
                    </div>

                    <div class="col-12">
                      <label for="username" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="username" required>
                        <div class="invalid-feedback">Please choose a username.</div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password">
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                    <div class="col-md-6">
                      <label for="confirmpassword" class="form-label">Confirm Password</label>
                      <input type="password" class="form-control" id="confirmpassword">
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <input class="btn btn-primary w-100" type="submit" name="submit" value="Create Account">
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
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