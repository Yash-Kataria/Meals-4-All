<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Meals-4-All Charity Form</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../Templates/Favicon/restaurant-cutlery-symbol-of-a-cross.png" type="image/x-icon">

    <!-- CSS Files -->
    <link rel="stylesheet" href="../Templates/Dashboard/assets/css/animate-3.7.0.css">
    <link rel="stylesheet" href="../Templates/Dashboard/assets/css/font-awesome-4.7.0.min.css">
    <link rel="stylesheet" href="../Templates/Dashboard/assets/css/bootstrap-4.1.3.min.css">
    <link rel="stylesheet" href="../Templates/Dashboard/assets/css/owl-carousel.min.css">
    <link rel="stylesheet" href="../Templates/Dashboard/assets/css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="../Templates/Dashboard/assets/css/style.css">

    <link href="../Templates/Registration/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../Templates/Registration/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="../Templates/Registration/https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../Templates/Registration/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../Templates/Registration/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <link href="../Templates/Registration/css/main.css" rel="stylesheet" media="all">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
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
            if(isset($_SESSION["CustomerId"]))
            {
                $CustomerId=$_SESSION["CustomerId"];
                
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
                    $result=$con->query("SELECT CustomerName from Customer where CustomerId='$CustomerId'");
                    if  ($result->num_rows!=0)
                    {
                        while($verify=$result->fetch_object())
                        {
                            $CustomerName=$verify->CustomerName;
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

    <!-- Charity starts -->
    <section class="food-area section-padding" style="background-position: center right;">
    <div class="container">
    <div class="row">
        <div class="col-md-12">

            <!-- Charity Details Form Start-->

            <div class="page-wrapper p-t-70 font-poppins">
                <div class="wrapper wrapper--w680">
                    <div class="card card-4">
                        <div class="card-body">
                            <span class="title">
                            <img src="../Templates/SVG/restaurant-cutlery-symbol-of-a-cross.svg" height="35px" alt="Main Logo">
                                &nbsp;Fill The Charity Details Form
                            </span>
                            <form method="POST" target="_self" enctype="multipart/form-data">
                                
                                <div class="row row-space">
                                    <div class="col-12">
                                        <label class="label">Way of Charity <span style="color:red;">*</span></label>
                                        <div class="rs-select2 js-select-simple select--no-search">

                                            <select name='wayofcharity'>
                                            <option disabled='disabled' selected='selected'>Choose option</option>
                                            <option value="Show">Show My Name</option>
                                            <option value="Annonymous">Annonymous</option> 
                                            </select>
                                            <div class='select-dropdown'></div>                                       
                                        </div>
                                    </div>
                                </div>    
                                <br>
                                <div class="row row-space">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <label class="label">Customer Name</label>
                                            <input class="input--style-4" type="text" disabled='disabled' name="customername"
                                            value="<?php
                                                    if(isset($_SESSION["CustomerId"]))
                                                    {
                                                        echo $CustomerName;   
                                                    }
                                            ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-space">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <label class="label">Total Charity Amount in &nbsp;<i class="fa fa-inr fa-1x" aria-hidden="true"></i> &nbsp;<span style="color:red;">*</span></label>
                                            <input class="input--style-4" type="text" name="amount"></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-space">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <label class="label">Description</label>
                                            <textarea class="input--style-4" name="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-t-15" style="text-align: center;">
                                    <input type="submit" class="btn btn--radius-2 btn--blue" name="btnsubmit" value="Donate Money.!">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Charity Details Form End-->
        </div>
    </div>
    </section>
    <!-- Charity End -->

    <!-- Footer Area Starts -->
    <footer class="footer-area">
        <div class="footer-widget section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-widget single-widget1">
                            <a href="AdminHomepage.php"><img src="../Templates/Dashboard/assets/images/logo/logo.jpeg" width="180px" height="60px" alt="Logo"></a>
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

    <!-- PHP Code For Add New Food Item -->

    <?php
    if(isset($_POST["btnsubmit"]))
    {
        $con=new mysqli("localhost","root","","meals-4-all");
        if(isset($con->connect_error))
        {
            die("<script LANGUAGE='JavaScript'>
            window. alert('Connection Not Established with the Database..!!');
            window. location. href='CustomerHomepage.php';
            </script>");
        }
        else
        { 
            if($_POST["wayofcharity"]=="")
            {
                die("<script LANGUAGE='JavaScript'>
                window. alert('Please Select a Mode of Charity..!!');
                window. location. href='Charity.php';
                </script>");
            }
            else if($_POST["amount"]=="" || !(preg_match('/^\d{0,8}(\.\d{1,4})?$/', $_POST["amount"])))
            {
                die("<script LANGUAGE='JavaScript'>
                window. alert('Please Enter Valid Charity Amount..!!\\n Example :- 100.50');
                window. location. href='Charity.php';
                </script>");
            }
            else
            {
                $CustomerId=$_SESSION["CustomerId"];

                if(strcasecmp($_POST["wayofcharity"],"Show")==0)
                {
                    $WayOfCharity=1;
                }
                else if(strcasecmp($_POST["wayofcharity"],"Annonymous")==0)
                {
                    $WayOfCharity=0;
                }
                $Amount=$_POST["amount"];
                if($_POST["description"]!="")
                {
                    $Description=$_POST["description"];    
                }
                else
                {
                    $Description="";
                }
                $result=$con->query("Insert into Charity(CustomerId,TotalAmount,Description,ShowName,CharityDate) "
                . "values('$CustomerId','$Amount','$Description','$WayOfCharity',CURRENT_TIMESTAMP)");
                
                if($result==true)
                {
                    echo ("<script LANGUAGE='JavaScript'>
                    window. alert('Your Charity Donation was Successfull..!!');
                    window. location. href='Charity.php';
                    </script>");
                }
                else
                {
                    echo ("<script LANGUAGE='JavaScript'>
                    window. alert('Your Charity Donation was NOT Successfull..!!');
                    window. location. href='Charity.php';
                    </script>");
                }    
            }
        }
        $con->close();
    }
?>

    <script src="../Templates/Registration/vendor/jquery/jquery.min.js"></script>
    <script src="../Templates/Registration/vendor/select2/select2.min.js"></script>
    <script src="../Templates/Registration/vendor/datepicker/moment.min.js"></script>
    <script src="../Templates/Registration/vendor/datepicker/daterangepicker.js"></script>
    <script src="../Templates/Registration/js/global.js"></script>


    <script src="../Templates/Dashboard/assets/js/vendor/jquery-2.2.4.min.js"></script>
	<script src="../Templates/Dashboard/assets/js/vendor/bootstrap-4.1.3.min.js"></script>
    <script src="../Templates/Dashboard/assets/js/vendor/wow.min.js"></script>
    <script src="../Templates/Dashboard/assets/js/vendor/owl-carousel.min.js"></script>
    <script src="../Templates/Dashboard/assets/js/vendor/jquery.datetimepicker.full.min.js"></script>
    <script src="../Templates/Dashboard/assets/js/vendor/jquery.nice-select.min.js"></script>
    <script src="../Templates/Dashboard/assets/js/main.js"></script>
</body>
</html>