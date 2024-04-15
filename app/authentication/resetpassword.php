<?php

include "../../connection.php";

// Starting Session
session_start();
$error = "";
// Checking Already user login or not 
if (isset($_SESSION['resetpass'])) {
  $username = $_SESSION['resetpass'];


  if (isset($_POST['submitBtn'])) {

    $password = $_POST['NewPassword'];
    $confirmpass = $_POST['ConfirmPassword'];

    if (!empty($password)) {
      if (!empty($confirmpass)) {

        if (preg_match_all('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/m', $password)) {
          if ($password == $confirmpass) {

            $password = md5($password);
            $query = "UPDATE accounts SET password='{$password}' WHERE username='{$username}'";
            $result = mysqli_query($conn, $query) or die("query fail!") and exit();
            session_start();
            session_unset();
            session_destroy();
            header("Location: success.php");
          } else {
            $error = "Please Enter Same password";
          }
        } else {
          $error = "password not strong";
        }
      } else {
        $error = "Please confirm password";
      }
    } else {
      $error = "Please Enter New password";
    }
  }
} else {
  header("Location: ../404.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Forgot Password</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="../assets/mdb/css/mdb.min.css" />
  <link rel="stylesheet" href="../assets/css/colors.css" />
  <style>
    .form-control:focus~.form-notch div {
      border-color: var(--primary-color) !important;
    }

    .form-control:focus~.form-label {
      color: var(--primary-color) !important;
    }

    body {
      background-color: var(--primary-color) !important;
      outline: none;
    }



    .bg-round-card {
      background-color: var(--white-200) !important;
      border-radius: 40px;
    }

    .rounded-card {
      border-radius: 40px 40px 0px 0px;
      background-color: #ffffff;
    }

    .icon {
      font-size: 18px;
      /* color: var(--primary-color); */
    }

    .insta {
      color: #f70388;
    }

    #mainContainer::-webkit-scrollbar {
      width: 0;
      /* Remove scrollbar space */
      background: transparent;
      /* Optional: just make scrollbar invisible */
    }
  </style>


</head>

<body>
  <!-- Start your project here -->


  <?php

  if (isset($_GET['email']) == 1) {
  ?>

    <div id="EmailPrompt" style="background-color: #00000094;" class="crab position-absolute">
      <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div>
          <div class="d-flex justify-content-center">
            <lottie-player src="https://assets1.lottiefiles.com/private_files/lf30_pw5a608o.json" background="transparent" speed="1" style="width: 200px; height: 200px;" loop autoplay></lottie-player>
          </div>
          <h5 class="text-center text-light">Reset mail sent</h5>
          <p class="text-center text-light">Account reset link send on your email, please check your email</p>
          <div style="margin: 24px;">
            <a href="index.php" class="btn bg-primary text-light btn-block" style="border-radius: 25px; height: 50px; font-size:18px">Go to login</a>
          </div>
        </div>
        <!-- <div class="spinner-grow text-success" role="status">
        <span class="visually-hidden">Loading...</span>
      </div> -->
      </div>
    </div>

  <?php

  } else { ?>

    <div id="mainContainer" class="container-fluid">
      <div class="row">

        <div class="col-12 mt-2 p-2 ml-4">
          <a href="index.php">
            <i class="fa-solid fa-arrow-left text-light" style="font-size: 24px;"></i>
          </a>
        </div>

        <div class="col-12 mb-4">
          <div class="text-center">
            <img src="../assets/img/resetnew.svg" style="max-width: 70%;" alt="Phone image">
          </div>
        </div>


        <section class="p-0">
          <div class="col-12 p-0">
            <div class="pt-4 bg-round-card ">
              <h5 class="text-center">Forgot Password</h5>
              <div class="card rounded-card login-from mt-4">
                <div class="card-body">

                  <p class="text-danger"><?php echo $error; ?></p>

                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                      <input type="Password" id="NewPassword" name="NewPassword" class="form-control form-control-lg" />
                      <label class="form-label" for="NewPassword">New password</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                      <input type="Password" id="ConfirmPassword" name="ConfirmPassword" class="form-control form-control-lg" />
                      <label class="form-label" for="ConfirmPassword">confirm password</label>
                    </div>

                    <!-- Submit button -->
                    <div style="margin: 24px;">
                      <button class="btn bg-primary  text-light btn-block" style="border-radius: 25px; height: 50px;" name="submitBtn">submit</button>

                    </div>
                  </form>
                </div>

              </div>
            </div>
          </div>
        </section>

      </div>



    </div>
    <!-- End your project here -->
  <?php } ?>
  <!-- MDB -->
  <script type="text/javascript" src="../assets/mdb/js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <script type="text/javascript"></script>
</body>

</html>