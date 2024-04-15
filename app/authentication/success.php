<?php
include '../../config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>success</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
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



    #mainContainer::-webkit-scrollbar {
      width: 0;
      /* Remove scrollbar space */
      background: transparent;
      /* Optional: just make scrollbar invisible */
    }
  </style>


</head>

<body>

  <div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div>
      <div class="text-center">
        <i class='bx bx-check-circle text-center text-success' style="font-size: 104px;"></i>
      </div>

      <h1 class="text-center">Password Reset Successfully</h1>
      <h4 class="text-center">Open App to login</h4>
    </div>
  </div>



  <!-- MDB -->
  <script type="text/javascript" src="../assets/mdb/js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <script type="text/javascript"></script>
</body>

</html>