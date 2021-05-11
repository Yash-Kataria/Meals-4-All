<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Meals-4-All Charity</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../Templates/Favicon/restaurant-cutlery-symbol-of-a-cross.png" type="image/x-icon">

    <!-- CSS Files -->
    <link rel="stylesheet" href="../Templates/Dashboard/assets/css/animate-3.7.0.css">
    <link rel="stylesheet" href="../Templates/Dashboard/assets/css/font-awesome-4.7.0.min.css">
    <link rel="stylesheet" href="../Templates/Dashboard/assets/css/bootstrap-4.1.3.min.css">
    <link rel="stylesheet" href="../Templates/Dashboard/assets/css/owl-carousel.min.css">
    <link rel="stylesheet" href="../Templates/Dashboard/assets/css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="../Templates/Dashboard/assets/css/style.css">
</head>
<body>
    <?php
            session_start();
            if(!isset($_SESSION["CustomerId"]) && !isset($_SESSION["EmailId"]))
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
                        <a href="CustomerHomepage.php"><img src="../Templates/Dashboard/assets/images/logo/logo.jpeg" width="180px" height="60px" alt="Logo"></a>
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
                            <li class="active"><a href="CustomerHomepage.php">home</a></li>
                            <li><a href="Menu.php">menu</a></li>
                            <li><a href="#">Order</a>
                                <ul class="sub-menu">
                                    <li><a href="Cart.php">My Cart</a></li>
                                    <li><a href="OrderPlaced.php">Order Placed</a></li>
                                    <li><a href="PreviousOrder.php">Previous Order History</a></li>
                                </ul>
                            </li>
                            <li><a href="Charity.php">Charity</a></li>
                            <li><a href="AboutUs.php">about</a></li>
                            <li><a href="ContactUs.php">contact</a></li>
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

    <!-- Banner Area Starts -->
    <section class="banner-area banner-area2 charity-bg text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="prime-color"><i>Charity</i></h1><br/>
                    <h4 class="pt-2"><i>“We make a living by what we get, but we make a life by what we give.” <br/><br/>― Winston Churchill</i></h4>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->

    <!--================Charity Options Area =================-->
    <section class="blog_categorie_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="categories_post">
                    <img src="../Templates/Dashboard/assets/images/donate.jpg" height="220px" width="100%"  alt="post">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="DonateMoney.php">
                                    <h5>Donate Money</h5>
                                    <div class="border_line"></div>
                                    <p>Help Someone In Need</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="categories_post">
                    <img src="../Templates/Dashboard/assets/images/yourcharity.jpg" height="220px" width="100%"  alt="post">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="PersonalCharity.php">
                                    <h5>Your Charity</h5>
                                    <div class="border_line"></div>
                                    <p>Check All Your Past Charity</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="categories_post">
                        <img src="../Templates/Dashboard/assets/images/needhelp.jpg" height="220px" width="100%"  alt="post">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a href="ContactUs.php">
                                    <h5>Need Help</h5>
                                    <div class="border_line"></div>
                                    <p>Contact Customer Support For Any Query</p>
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
                            $result=$con->query("Select Photo,CustomerName,EmailId,
                            TotalAmount,Description,ShowName,DATE_FORMAT(Charity.CharityDate,'%d/%m/%Y %h:%i:%s') as CharityDate from Charity,Customer where
                             Customer.CustomerId=Charity.CustomerId order by TotalAmount desc LIMIT 6");
                            if  ($result->num_rows!=0)
                            {
                                while($verify=$result->fetch_object())
                                {
                                    $ShowName=$verify->ShowName;
                                    if($ShowName==1)
                                    {
                                        $CustomerName=$verify->CustomerName;
                                        $EmailId=$verify->EmailId;
                                        $CustomerPhoto=$verify->Photo;
                                    }
                                    else if($ShowName==0)
                                    {
                                        $CustomerName="Annonymous Doner";
                                        $EmailId="";
                                        $CustomerPhoto="User.jpg";
                                    }

                                    $TotalAmount=$verify->TotalAmount;
                                    $Description=$verify->Description;
                                    $CharityDate=$verify->CharityDate;

                                    echo "<div class='col-md-6 col-sm-6 blog_item' style='border:0px solid black'>
                                    <div class='blog_post'>
                                            <div class='col-md-6 col-sm-6' style='display:table-cell;'>
                                                <br/>
                                                <img src='../Images/Customer_Photo/$CustomerPhoto' alt='Customer Photo' height='250px' width='100%' style='border-radius:5%;'>
                                            </div>
                                            <div class='col-md-6 col-sm-6' style='display:table-cell;'>
                                                <br/>
                                                <h3 style='color:black;'>$CustomerName</h3>
                                                <br/>
                                                <p style='color:black'>$EmailId</p>
                                                <p style='color:black;font-size:20px'><b>On : </b>$CharityDate</p>
                                            </div>
                                            <div class='col-md-12 col-sm-12'>
                                                <div class='blog_details'>
                                                    <h4 style='font-style:normal;'>A Total Donation of <b>Rs. $TotalAmount</b></h4>
                                                    <p>$Description</p>
                                                </div>                                        
                                            </div>
                                        </div>
                                    </div>";
                                }
                            }
                            else
                            {
                                die("<script LANGUAGE='JavaScript'>
                                window. alert('Data NOT fetched from the Database\\n\\n'.$con->error.');
                                window. location. href='../Login.php';
                                </script>");
                            }
                            $con->close();
                        }
                    ?>

                    <!-- Navigations -->
                    <div class="col-md-12">
                    
                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">
                                            <span class="fa fa-angle-left"></span>
                                        </span>
                                    </a>
                                </li>
                                <li class="page-item"><a href="#" class="page-link">01</a></li>
                                <li class="page-item active"><a href="#" class="page-link">02</a></li>
                                <li class="page-item"><a href="#" class="page-link">03</a></li>
                                <li class="page-item"><a href="#" class="page-link">04</a></li>
                                <li class="page-item"><a href="#" class="page-link">09</a></li>
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Next">
                                        <span aria-hidden="true">
                                            <span class="fa fa-angle-right"></span>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
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
