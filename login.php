<?php
include 'connection.php';
session_start();

if (isset($_SESSION['username'])) {
  header("Location: dashboard/pages/index.php");
} else {

  if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $hashPassword = md5($password);
    $password_err = $username_err = "";

    if (empty(trim($_POST['password'])) && empty(trim($_POST['username']))) {

      header("Location: login.php?error=Username and Password required");
      exit();
    } elseif (empty(trim($_POST['username']))) {

      $username_err = "Username cannot be blank";
      header("Location: login.php?error=Username required");
      exit();
    } elseif (empty(trim($_POST['password']))) {

      header("Location: login.php?error=Password required");
      exit();
    } else {

      $query = "SELECT * FROM admin WHERE Username= '{$username}' AND Password= '{$hashPassword}'";

      $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

      if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

          session_start();
          $_SESSION['username'] = $row['username'];
          header("Location: dashboard/pages");
          mysqli_close($conn);
        }
      } else {
        header("Location: login.php?error=Invalid Credential");
        exit();
      }
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

  <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
  <link rel="manifest" href="images/favicon/site.webmanifest">




  <title>login</title>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
</head>

<body>

  <section class="vh-100" style="background-color: #313131;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-8">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="images/login.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height: 600px;" />
              </div>
              <div class="col-md-6 col-lg-6 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                    <div class="d-flex align-items-center mb-3 pb-1">


                      <span class="h1 fw-bold mb-0">Feed-n-Joy</span>
                    </div>

                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your
                      account</h5>

                    <?php if (isset($_GET['error'])) {  ?>

                      <small class="text-danger"> *<?php echo $_GET['error'] ?> ! </small>

                    <?php } ?>

                    <div class="form-outline mb-4">
                      <input type="text" name="username" id="form2Example17" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example17">username</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" name="password" id="form2Example27" class="form-control form-control-lg" />
                      <label class="form-label" for="form2Example27">Password</label>
                    </div>

                    <div class="pt-1 mb-4">
                      <button type="submit" name="login" class="btn btn-lg btn-block text-light" style="background-color: #313131;" type="button">Login</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
</body>

</html>