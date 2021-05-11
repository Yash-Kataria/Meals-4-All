<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Meals-4-All Job Applicants</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../Templates/Favicon/restaurant-cutlery-symbol-of-a-cross.png" type="image/x-icon">

    <!-- CSS Files -->
    <link rel="stylesheet" href="../Templates/Dashboard/assets/css/animate-3.7.0.css">
    <link rel="stylesheet" href="../Templates/Dashboard/assets/css/font-awesome-4.7.0.min.css">
    <link rel="stylesheet" href="../Templates/Dashboard/assets/css/bootstrap-4.1.3.min.css">
    <link rel="stylesheet" href="../Templates/Dashboard/assets/css/owl-carousel.min.css">
    <link rel="stylesheet" href="../Templates/Dashboard/assets/css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="../Templates/Dashboard/assets/css/style.css">

    <style>
        .blog_details p
        {
            border:2px solid black;
            font-size: 20px;

        }
    </style>
</head>
<body>
    <?php
            session_start();
            if(!isset($_SESSION["AdminId"]) && !isset($_SESSION["EmailId"]))
            {
                die("<script LANGUAGE='JavaScript'>
                window. alert('Session is Expired..\\nPlease Login Again..!!');
                window. location. href='../Login.php';
                </script>");
            }
    ?>

    <button onclick="topFunction()" id="myBtn" title="Go to top">
    <i class="fa fa-chevron-up" aria-hidden="true"></i></button>

    <!-- Preloader Starts -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Preloader End -->

    <!-- Header Area Starts -->
	<header class="header-area" id="navbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo-area">
                        <a href="AdminHomepage.php"><img src="../Templates/Dashboard/assets/images/logo/logo.jpeg" width="180px" height="60px" alt="Logo"></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="custom-navbar">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>  
                    <div class="main-menu">
                        <ul>
                            <li class="active"><a href="AdminHomepage.php">Home</a></li>
                            <li><a href="#">Menu</a>
                                <ul class="sub-menu">
                                    <li><a href="AddFoodItem.php">Add New Food Item</a></li>
                                    <li><a href="Menu.php">Display Whole Menu</a></li>
                                </ul>
                            </li>
                            <li><a href="ManageCharity.php">Charity</a></li>
                            <li><a href="#">Orders</a>
                                <ul class="sub-menu">
                                    <li><a href="ManageOrders.php">Current Orders</a></li>
                                    <li><a href="ManagePreviousOrders.php">Previous Orders</a></li>
                                </ul>
                            </li>
                            <li><a href="ManageJobApplicants.php">Job Applicants</a></li>
                            <li><a href="ReportAnalysis.php">Reports</a></li>
                            <li><a href="">
                            <form>
                            <input type="submit" name="Logout" value="Logout" formmethod="post" formaction="#" >
                            </form>
                            </a></li>
                            <?php
                                if(isset($_POST["Logout"]))
                                {
                                    session_destroy();
                                    die("<script LANGUAGE='JavaScript'>
                                    window. location. href='../Login.php';
                                    </script>");
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->

    <!--================Charity Options Area =================-->
    <section class="blog_categorie_area" style="margin-top: 5%;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-6 mb-lg-0">
                    <div class="categories_post">
                    <img src="../Templates/Dashboard/assets/images/Approved.jpg" height="220px" width="100%"  alt="post">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="ListOfJobApplicants.php?St=1">
                                    <h5>Approved</h5>
                                    <div class="border_line"></div>
                                    <p>Approved Applicants List</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-6 mb-lg-0">
                    <div class="categories_post">
                    <img src="../Templates/Dashboard/assets/images/Rejected.jpg" height="220px" width="100%"  alt="post">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="ListOfJobApplicants.php?St=0">
                                    <h5>Rejected</h5>
                                    <div class="border_line"></div>
                                    <p>Rejected Applicants List</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Charity Options Area =================-->
    
    <!--================Charity Area =================-->
    <section class="blog_area">
        <div class="container">
            <div class="row">
                    <?php
                        $con=new mysqli("localhost","root","","meals-4-all");
                        if(isset($con->connect_error))
                        {
                            die("<script LANGUAGE='JavaScript'>
                            window. alert('Connection Not Established with the Database..!!');
                            window. location. href='../Login.php';
                            </script>");
                        }
                        else
                        {
                            $result=$con->query("SELECT * FROM Jobapplicant where Status='Pending' LIMIT 2");
                            if  ($result->num_rows!=0)
                            {
                                while($verify=$result->fetch_object())
                                {
                                    $ApplicantId=$verify->ApplicantId;
                                    $ApplicantName=$verify->ApplicantName;
                                    $Gender=$verify->Gender;
                                    $Birthdate=$verify->Birthdate;
                                    $EmailId=$verify->EmailId;
                                    $PhoneNo=$verify->PhoneNo;
                                    $Address=$verify->Address;
                                     $Photo=$verify->Photo;
                                    $LicencePhoto=$verify->LicencePhoto;
                                    $LicenceNo=$verify->LicenceNo;
                                
                                    echo "<div class='col-md-6 col-sm-6 blog_item'>
                                    <div class='blog_post' style='border:3px solid black;width:95% !important;margin-left:20px;border-radius:20px;'>
                                            <div class='col-md-5 col-sm-5' style='display:table-cell;'>
                                                <br/>
                                                <img src='../Images/Applicant_Photo/$Photo' alt='Applicant Photo' height='190px' width='200px' style='border-radius:10%;border:1px solid black;'>
                                            </div>
                                            <div class='col-md-7 col-sm-7' style='display:table-cell;'>
                                                <br/>
                                                <h3 style='color:black;font-size:32px !important;'>$ApplicantName</h3>
                                                <p style='color:black;font-size:20px;margin-top:25px !important;'>$EmailId</p>
                                                <p style='color:black;font-size:20px;margin-top:25px !important;'>$PhoneNo</p>
                                            </div>
                                            <div class='col-md-12 col-sm-12'>
                                                <div class='blog_details' style='text-align:center !important;'>
                                                    <p>Applicant Id : <span>$ApplicantId</span></p>
                                                    <p>Gender : <span>$Gender</span></p>
                                                    <p>Date of Birth : <span>$Birthdate</span></p>
                                                    <p>Address : <span>$Address</span></p>
                                                </div>                                        
                                            </div>
                                            <div class='col-md-7 col-sm-7' style='display:table-cell;'>
                                                <img src='../Images/Licence_Photo/$LicencePhoto' alt='Licence Photo' height='200px' width='300px'>
                                            </div>
                                            <div class='col-md-5 col-sm-5' style='display:table-cell;'>
                                                <p style='color:black;font-size:18px !important;'>Licence Number</p>
                                                <p style='color:black;font-size:20px !important;font-weight:bolder;'>$LicenceNo</p>
                                            </div>
                                            <div class='col-md-12 col-sm-12' style='text-align:center;margin:20px 0px 20px 0px;'>
                                                <a class='template-btn' onClick=\"javascript: return confirm('Are You Sure You Want To Accept the Job Application.?');
                                                \" href='JobApplicationStatus.php?Aid=$ApplicantId&S=1'>Accept</a>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <a class='template-btn' onClick=\"javascript: return confirm('Are You Sure You Want To Reject the Job Application.?');
                                                \" href='JobApplicationStatus.php?Aid=$ApplicantId&S=0'>Reject</a>
                                            </div>
                                        </div>
                                    </div>";
                                }
                            }
                            else
                            {
                                echo "<h2 style='color:red;font-style:normal;margin-left:25%;margin-bottom:10%;'>No Job Applications Found</h2>";
                            }
                            $con->close();
                        }
                    ?>
            </div>
        </div>
    </section>
    <!--================Charity Area =================-->

    <!-- Footer Area Starts -->
    <footer class="footer-area">
        <div class="footer-widget section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-widget single-widget1">
                            <a href="CustomerHomepage.php"><img src="../Templates/Dashboard/assets/images/logo/logo.jpeg" width="180px" height="60px" alt="Logo"></a>
                            <p class="mt-3">Fullfill your appetite with delicious food from different cuisines.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-widget single-widget2 my-5 my-md-0">
                            <h5 class="mb-4">contact us</h5>
                            <div class="d-flex">
                                <div class="into-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="info-text">
                                    <p>301 Balaji Nagar, S.G. Paliya, Bengaluru, Karnataka, India</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="into-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="info-text">
                                    <p>+91 9876543210</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="into-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="info-text">
                                    <p>meals4all@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding-left: 100px;">
                        <div class="single-widget single-widget3" >
                            <h5 class="mb-4">Follow Us</h5>
                            <h2>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </h2><br/>
                            <h2>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                &nbsp;&nbsp;&nbsp;
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->

    <script src="../Templates/Dashboard/assets/js/vendor/jquery-2.2.4.min.js"></script>
	<script src="../Templates/Dashboard/assets/js/vendor/bootstrap-4.1.3.min.js"></script>
    <script src="../Templates/Dashboard/assets/js/vendor/wow.min.js"></script>
    <script src="../Templates/Dashboard/assets/js/vendor/owl-carousel.min.js"></script>
    <script src="../Templates/Dashboard/assets/js/vendor/jquery.datetimepicker.full.min.js"></script>
    <script src="../Templates/Dashboard/assets/js/vendor/jquery.nice-select.min.js"></script>
    <script src="../Templates/Dashboard/assets/js/main.js"></script>
</body>
</html>
