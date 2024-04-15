<?php


session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../../login.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

  <link rel="apple-touch-icon" sizes="180x180" href="../../images/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../images/favicon/favicon-16x16.png">
  <link rel="manifest" href="../../images/favicon/site.webmanifest">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Verify</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->

  <?php

  include "../include/dashboard_header.php";

  ?>

  <!-- End Header -->


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item active">verify ngos</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">


            <!-- Reports -->
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Reports <span>/Today</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <div class="card">
                    <div class="row">
                      <div>

                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="card gray_bg">
                                <div class="card-body ">
                                  <h5 class="card-title light mb-4 "></h5>


                                  <?php

                                  // $query = "SELECT * FROM login WHERE Status='Inactive'";
                                  // $result = mysqli_query($conn, $query) or die("query fail");

                                  // if (mysqli_num_rows($result) > 0) {
                                  include "../../connection.php";

                                  $query = "SELECT * FROM accounts JOIN ngo ON accounts.accountNo=ngo.accountNo WHERE adminCheck='0' and accountType='ngo'";
                                  $result = mysqli_query($conn, $query) or die("query fail");
                                  $index = 1;
                                  if (mysqli_num_rows($result) > 0) {


                                  ?>

                                    <div class="table-responsive">

                                      <table id="EditTable" class="table v-middle" style="margin-top: 30px;">
                                        <thead class="thead-light">
                                          <tr>
                                            <th scope="col">#ID</th>
                                            <th scope="col">Account No</th>
                                            <th scope="col">NGO Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Ngo Type</th>

                                            <th scope="col">Verify </th>
                                            <th scope="col">Reject </th>

                                          </tr>
                                        </thead>
                                        <tbody class="dark_bg">

                                          <?php

                                          while ($row = mysqli_fetch_assoc($result)) {

                                          ?>
                                            <tr>
                                              <th class="light" scope="row"><?php echo $index ?></th>

                                              <td class="light"><?php echo $row['accountNo']; ?></td>

                                              <td class="light"><?php echo $row['ngoName']; ?></td>

                                              <td class="light"><?php echo $row['email']; ?></td>

                                              <td class="light"><?php echo $row['ngoType']; ?></td>



                                              <td class="light">
                                                <form action="code.php
                                                " method="post">
                                                  <input type="text" name="email" value="<?php echo $row['email']; ?>" hidden>
                                                  <button type="submit" value="<?php echo $row['accountNo']; ?>" name="VerifyAc" id="vbtn<?php echo $row['accountNo']; ?>" class="btn btn-success verify_data"><i class='bx bx-user-check'></i> Verify</button>
                                                </form>

                                              </td>
                                              <td class="light">
                                                <form action="code.php
                                                " method="post">
                                                  <input type="text" name="email" value="<?php echo $row['email']; ?>" hidden>
                                                  <button type="submit" value="<?php echo $row['accountNo']; ?>" name="RejectAc" id="rbtn<?php echo $row['accountNo']; ?>" class="btn btn-danger reject_data"><i class='bx bx-user-x'></i> Reject</button>
                                                </form>
                                              </td>
                                            </tr>

                                          <?php
                                            $index++;
                                          }
                                        } else {

                                          ?>
                                          <h1 class="light" style="text-align: center;">No Account for Verification</h1>

                                        <?php
                                        }
                                        ?>

                                        </tbody>
                                      </table>

                                    </div>

                                    <!-- Search Table -->


                                </div>
                              </div>

                            </div>


                          </div>


                        </div>

                      </div>


                    </div>
                  </div>
                </div>

              </div>

            </div>
          </div><!-- End Reports -->




        </div>
      </div><!-- End Left side columns -->



      </div>
    </section>

  </main><!-- End #main -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

  <script>
    var element = document.getElementById("verify-ngo-link");
    element.classList.remove("collapsed");
  </script>

</body>

</html>