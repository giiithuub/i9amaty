<?php   



if(!isset($_SESSION)){
    session_start();
}
include('../config/dbcon.php');

if(isset($_POST['admin_login_btn']))
{
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    $login_query = "SELECT * FROM admins WHERE email ='$email' AND password ='$password' ";
    $login_query_run = mysqli_query($con, $login_query);

    if(mysqli_num_rows($login_query_run) > 0)
    { 
        $_SESSION['auth'] = true;

        $admindata = mysqli_fetch_array($login_query_run);
        $adminid = $admindata['admin_id'];

        $_SESSION['admin_id'] = $adminid;
           
        // Set the cookies with admin information
        setcookie("admin_id", $adminid, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie("admin_auth", 'true', time() + (86400 * 30), "/"); // 86400 = 1 day

        $_SESSION['message'] = "Welcome Admin";
        header('Location: ../admin/index.php');
    }
    else
    {
        $_SESSION['message'] = 'Invalid email or password';
        header('Location: ../admin/login.php');
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    
 



    <!-- Google Font -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

   <!-- Font awesome -->
   <link rel="stylesheet" href="css/font-awesome.min.css">
     <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>



    <!-- ALERTFY jS -->
     <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
      <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css"
  rel="stylesheet"
/>

<head>
    <title>Admin Login</title>
    <style>
  .form-outline .form-label {
    pointer-events: none;
    transform: translateY(-140%);
  }

  .cascading-right {
    margin-right: -50px;
  }

  @media (max-width: 991.98px) {
    .cascading-right {
      margin-right: 0;
    }
  }
</style>
</head>
<body>
   <!-- Section: Design Block -->
<section class="text-center text-lg-start">
  <style>
    .cascading-right {
      margin-right: -50px;
    }

    @media (max-width: 991.98px) {
      .cascading-right {
        margin-right: 0;
      }
    }
  </style>

  <!-- Jumbotron -->
  <div class="container py-4">
    <div class="row g-0 align-items-center">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <div class="card cascading-right" style="
            background: hsla(0, 0%, 100%, 0.55);
            backdrop-filter: blur(30px);
            ">
          <div class="card-body p-5 shadow-5 text-center">
          <form method="post" action="login.php">
              <!-- 2 column grid layout with text inputs for the first and last names -->
              

              <!-- Email input -->
              <div class="form-outline mb-4 pb-3">
                <input type="email" id="form3Example3" class="form-control" name="email"/>
                <label class="form-label" for="form3Example3">Email address</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" id="form3Example4" class="form-control" name="password"/>
                <label class="form-label" for="form3Example4">Password</label>
              </div>

              

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4" name ="admin_login_btn">
                Login
              </button>

              <!-- Register buttons -->
              
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mb-5 mb-lg-0">
        <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" class="w-100 rounded-4 shadow-4"
          alt="" />
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->
</body>
</html>
