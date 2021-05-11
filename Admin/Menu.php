<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Meals-4-All Menu</title>

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
    <link href="../Templates/Registration/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../Templates/Registration/css/main.css" rel="stylesheet" media="all">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <style>
        .template-btn 
        {
        color: #131230 !important;
        padding: 10px 24px !important;
        background: #f9f9ff;
        cursor: pointer;
        }
        .template-btn:hover {
        color: white!important;
        background: #131230;
        border: 1px solid transparent;
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

    <!-- Banner Area Starts -->
    <section class="banner-area banner-area2 menu-bg text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="prime-color">Our Menu</h1>
                    <h4 class="pt-2">A wide range of mouth-watering food items.</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->

    <!-- Food Area starts -->
<section class="food-area section-padding" style="background-image: none !important;padding-top: 80px;">
    <div class="container">
    <form method="POST" target="_self" enctype="multipart/form-data">
    <div class="row ">
            <div class="col-md-5">
                <div class="section-top">
    
                    <label class="label">Cuisine Type</label>
                    <div class="rs-select2 js-select-simple select--no-search">
                        <select name='cuisinetype' id="cuisinetype">
                        <option disabled='disabled' selected='selected'>Choose One</option>
                        <option value="All"
                        <?php
                                if(isset($_GET["C"]))
                                {
                                    if(strcasecmp($_GET["C"],"All")==0)
                                    {
                                        echo "selected";
                                    }
                                }?>>All Cuisines</option>
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
                                $result=$con->query("Select * from Cuisines");
                                if($result->num_rows!=0)
                                {
                                    while($verify=$result->fetch_object())
                                    {
                                        $CuisineName=$verify->CuisineName;
                                        $CuisineId=$verify->CuisineId;
                                        if(isset($_GET["C"]))
                                        {
                                            if($_GET["C"] == $CuisineId)
                                            {
                                                echo "<option value='$CuisineId' selected>$CuisineName</option>";      
                                            }
                                            else
                                            {
                                                echo "<option value='$CuisineId'>$CuisineName</option>";      
                                            }
                                        }
                                        else
                                        {
                                            echo "<option value='$CuisineId'>$CuisineName</option>";      
                                        }
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
                        </select>
                        <div class='select-dropdown'></div>                                       
                    </div>        
                </div>
            </div>
            <div class="col-md-5">
                <div class="section-top">
                <label class="label">Price Range</label>
                    <div class="rs-select2 js-select-simple select--no-search">
                        <select name='pricerange' >
                        <option disabled='disabled' selected='selected'>Choose One</option>
                        <option value="All"
                            <?php
                                if(isset($_GET["P"]))
                                {
                                    if($_GET["P"]==1)
                                    {
                                        echo "selected";
                                    }
                                }
                            ?>>All Price Range</option>
                        <option value="LowToHigh"
                            <?php
                                if(isset($_GET["P"]))
                                {
                                    if($_GET["P"]==2)
                                    {
                                        echo "selected";
                                    }
                                }
                            ?>>Low To High</option>

                        <option value="HighToLow"
                        <?php
                                if(isset($_GET["P"]))
                                {
                                    if($_GET["P"]==3)
                                    {
                                        echo "selected";
                                    }
                                }
                            ?>>High To Low</option>

                        <option value="Under100"
                        <?php
                                if(isset($_GET["P"]))
                                {
                                    if($_GET["P"]==4)
                                    {
                                        echo "selected";
                                    }
                                }
                            ?>>Under Rs. 100</option>

                        </select>
                        <div class='select-dropdown'></div>                                       
                    </div>       
                </div>
            </div>
            <div class="col-md-2">
                <div class="section-top" style="margin-top: 30px;">
                    <input type="submit" class="btn btn--radius-2 btn--blue" name="btnfilter" value="Apply">
                </div>
            </div>
        </div>
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
                    $Query="SELECT FoodItems.*, Cuisines.CuisineName FROM FoodItems,Cuisines where FoodItems.CuisineId =Cuisines.CuisineId order by Cuisines.CuisineName";
                    if(isset($_GET["P"]) && isset($_GET["C"]))
                    {
                        $Cid=$_GET["C"];
                        $Pid=$_GET["P"];
                        if($Pid==1)
                        {
                            if(strcasecmp($_GET["C"],"All")==0)
                            {
                                $Query="SELECT FoodItems.*, Cuisines.CuisineName FROM FoodItems,Cuisines where FoodItems.CuisineId =Cuisines.CuisineId order by Price";
                            }
                            else
                            {
                                $Query="SELECT FoodItems.*, Cuisines.CuisineName FROM FoodItems,Cuisines where FoodItems.CuisineId =Cuisines.CuisineId and FoodItems.CuisineId=$Cid order by Price";
                            }
                        }
                        if($Pid==2)
                        {
                            if(strcasecmp($_GET["C"],"All")==0)
                            {
                                $Query="SELECT FoodItems.*, Cuisines.CuisineName FROM FoodItems,Cuisines where FoodItems.CuisineId =Cuisines.CuisineId order by Price";
                            }
                            else
                            {
                                $Query="SELECT FoodItems.*, Cuisines.CuisineName FROM FoodItems,Cuisines where FoodItems.CuisineId =Cuisines.CuisineId and FoodItems.CuisineId=$Cid order by Price";
                            }
                        }
                        if($Pid==3)
                        {
                            if(strcasecmp($_GET["C"],"All")==0)
                            {
                                $Query="SELECT FoodItems.*, Cuisines.CuisineName FROM FoodItems,Cuisines where FoodItems.CuisineId =Cuisines.CuisineId order by Price desc";
                            }
                            else
                            {
                                $Query="SELECT FoodItems.*, Cuisines.CuisineName FROM FoodItems,Cuisines where FoodItems.CuisineId =Cuisines.CuisineId and FoodItems.CuisineId=$Cid order by Price desc";
                            }
                        }
                        if($Pid==4)
                        {
                            if(strcasecmp($_GET["C"],"All")==0)
                            {
                                $Query="SELECT FoodItems.*, Cuisines.CuisineName FROM FoodItems,Cuisines where FoodItems.CuisineId =Cuisines.CuisineId and Price <= 100 order by Price";
                            }
                            else
                            {
                                $Query="SELECT FoodItems.*, Cuisines.CuisineName FROM FoodItems,Cuisines where FoodItems.CuisineId =Cuisines.CuisineId and FoodItems.CuisineId=$Cid and Price <= 100 order by Price";
                            }
                        }
                    }
                    else if(isset($_GET["C"]))
                    {
                        $Cid=$_GET["C"];
                        if(strcasecmp($_GET["C"],"All")==0)
                        {
                            $Query="SELECT FoodItems.*, Cuisines.CuisineName FROM FoodItems,Cuisines where FoodItems.CuisineId =Cuisines.CuisineId order by Cuisines.CuisineName";
                        }
                        else
                        {
                            $Query="SELECT FoodItems.*, Cuisines.CuisineName FROM FoodItems,Cuisines where FoodItems.CuisineId =Cuisines.CuisineId and FoodItems.CuisineId=$Cid order by Cuisines.CuisineName";
                        }
                    }
                    else if(isset($_GET["P"]))
                    {
                        $Pid=$_GET["P"];
                        if($Pid==1)
                        {
                            $Query="SELECT FoodItems.*, Cuisines.CuisineName FROM FoodItems,Cuisines where FoodItems.CuisineId =Cuisines.CuisineId and FoodItems.CuisineId=$Cid order by Price";
                        }
                        if($Pid==2)
                        {
                            $Query="SELECT FoodItems.*, Cuisines.CuisineName FROM FoodItems,Cuisines where FoodItems.CuisineId =Cuisines.CuisineId and FoodItems.CuisineId=$Cid order by Price";
                        }
                        if($Pid==3)
                        {
                            $Query="SELECT FoodItems.*, Cuisines.CuisineName FROM FoodItems,Cuisines where FoodItems.CuisineId =Cuisines.CuisineId and FoodItems.CuisineId=$Cid order by Price desc";
                        }
                        if($Pid==4)
                        {
                            $Query="SELECT FoodItems.*, Cuisines.CuisineName FROM FoodItems,Cuisines where FoodItems.CuisineId =Cuisines.CuisineId and FoodItems.CuisineId=$Cid and Price <= 100 order by Price";
                        }
                    }
                    $result=$con->query($Query);
                    if  ($result->num_rows!=0)
                    {
                        while($verify=$result->fetch_object())
                        {
                            $ItemId=$verify->ItemId;
                            $ItemName=$verify->ItemName;
                            $Description=$verify->Description;
                            $ItemPhoto=$verify->ItemPhoto;
                            $Price=$verify->Price;
                            $CuisineName=$verify->CuisineName;

                            echo "<div class='col-md-4 col-sm-6'>
                                <div class='single-food' style='margin-bottom:30px !important;height:500px !important;overflow:hidden;'>
                                    <div class='food-img' style='border:none;'>
                                        <img src='../Images/FoodItem_Photo/$ItemPhoto' class='img-fluid' alt='Cuisine Photo' >
                                    </div>
                                    <div class='food-content'>
                                        <div class='d-flex justify-content-between'>
                                            <h3 style='font-size:30px !important;'>$ItemName</h3>
                                            <span class='style-change'>Rs. $Price</span>
                                        </div>
                                        <h5 style='font-size:17px !important;'>$CuisineName</h5>
                                        <p class='pt-3' style='height:5em;overflow:hidden;margin-bottom:0px;'>$Description</p>
                                        
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <a class='template-btn' href='AddFoodItem.php?ItemID=$ItemId'>Update</a>
                                        &nbsp;&nbsp;
                                        <a class='template-btn' onClick=\"javascript: return confirm('Are You Sure You Want To Delete the Food Item.?');
                                        \" href='DeleteFoodItem.php?ItemID=$ItemId'>Delete</a>
                                
                                    </div>
                                </div>
                            </div>";
                        }
                    }
                    else
                    {
                        echo "<h2 style='color:red;font-style:normal;margin-left:25%;'>No Food Item Found.</h2>";
                    }
                    $con->close();
                }
            ?>
        </div>
    </div>
    </form>
</section>
    <!-- Food Area End -->

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


    <!-- Filter Changed -->
    <?php
        if(isset($_POST["btnfilter"]))
        {
            if(isset($_POST["cuisinetype"]) && isset($_POST["pricerange"]))
            {
                $Cid=$_POST["cuisinetype"];
                if(strcasecmp($_POST["pricerange"],"All")==0)
                {
                    $Pid=1;
                }
                if(strcasecmp($_POST["pricerange"],"LowToHigh")==0)
                {
                    $Pid=2;
                }
                else if(strcasecmp($_POST["pricerange"],"HighToLow")==0)
                {
                    $Pid=3;
                }
                else if(strcasecmp($_POST["pricerange"],"Under100")==0)
                {
                    $Pid=4;
                }
                echo("<script LANGUAGE='JavaScript'>
                    window. location. href='Menu.php?C=$Cid&P=$Pid';
                    </script>");
            }
            else if(isset($_POST["cuisinetype"]))
            {
                $Cid=$_POST["cuisinetype"];
                
                echo("<script LANGUAGE='JavaScript'>
                    window. location. href='Menu.php?C=$Cid';
                    </script>");
            }
            else if(isset($_POST["pricerange"]))
            {
                if(strcasecmp($_POST["pricerange"],"All")==0)
                {
                    $Pid=1;
                }
                if(strcasecmp($_POST["pricerange"],"LowToHigh")==0)
                {
                    $Pid=2;
                }
                else if(strcasecmp($_POST["pricerange"],"HighToLow")==0)
                {
                    $Pid=3;
                }
                else if(strcasecmp($_POST["pricerange"],"Under100")==0)
                {
                    $Pid=4;
                }
                echo("<script LANGUAGE='JavaScript'>
                    window. location. href='Menu.php?P=$Pid';
                    </script>");
            }
        }
    ?>
    
    <script src="../Templates/Registration/vendor/jquery/jquery.min.js"></script>
    <script src="../Templates/Registration/vendor/select2/select2.min.js"></script>
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