<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Meals-4-All New Food Item</title>

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
            if(!isset($_SESSION["AdminId"]) && !isset($_SESSION["EmailId"]))
            {
                die("<script LANGUAGE='JavaScript'>
                window. alert('Session is Expired..\\nPlease Login Again..!!');
                window. location. href='../Login.php';
                </script>");
            }
            if(isset($_GET["ItemID"]))
            {
                $ItemID=$_GET["ItemID"];
                
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
                    $result=$con->query("SELECT FoodItems.*, Cuisines.CuisineName FROM FoodItems,Cuisines where FoodItems.CuisineId =Cuisines.CuisineId and FoodItems.ItemId=$ItemID order by Cuisines.CuisineName");
                    if  ($result->num_rows!=0)
                    {
                        while($verify=$result->fetch_object())
                        {
                            $ItemName=$verify->ItemName;
                            $Description=$verify->Description;
                            $ItemPhoto=$verify->ItemPhoto;
                            $Price=$verify->Price;
                            $SelectedCuisineName=$verify->CuisineName;
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

    <!-- Food Area starts -->
    <section class="food-area section-padding" style="background-position: center right;">
    <div class="container">
    <div class="row">
        <div class="col-md-12">

            <!-- Add New Food Item Form Start-->

            <div class="page-wrapper p-t-70 font-poppins">
                <div class="wrapper wrapper--w680">
                    <div class="card card-4">
                        <div class="card-body">
                            <span class="title">
                            <img src="../Templates/SVG/restaurant-cutlery-symbol-of-a-cross.svg" height="35px" alt="Main Logo">
                                &nbsp;Add New Food Item
                            </span>
                            <form method="POST" target="_self" enctype="multipart/form-data">
                                
                                <div class="row row-space">
                                    <div class="col-12">
                                        <label class="label">Cuisine Type</label>
                                        <div class="rs-select2 js-select-simple select--no-search">

                                            <select name='cuisinetype'>
                                            <option disabled='disabled' selected='selected'>Choose option</option>
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
                                                    
                                                            if(isset($_GET["ItemID"]))
                                                            {
                                                                if(strcasecmp($SelectedCuisineName,$CuisineName)==0)
                                                                {
                                                                    echo "<option value='$CuisineName' selected>$CuisineName</option>";
                                                                }
                                                                else
                                                                {
                                                                    echo "<option value='$CuisineName'>$CuisineName</option>";
                                                                }
                                                            }
                                                            else
                                                            {
                                                                echo "<option value='$CuisineName'>$CuisineName</option>";
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
                                <br>
                                <div class="row row-space">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <label class="label">Food Item Name</label>
                                            <input class="input--style-4" type="text" name="itemname"
                                            value="<?php
                                                    if(isset($_GET["ItemID"]))
                                                    {
                                                        echo $ItemName;   
                                                    }
                                            ?>"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-space">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <label class="label">Price</label>
                                            <input class="input--style-4" type="text" name="price"
                                            value="<?php
                                                    if(isset($_GET["ItemID"]))
                                                    {
                                                        echo $Price;   
                                                    }
                                            ?>"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-space">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <label class="label">Description</label>
                                            <textarea class="input--style-4" name="description"><?php if(isset($_GET["ItemID"]))
                                                    {
                                                        echo $Description;   
                                                    }
                                            ?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-space">
                                    <div class="col-7">
                                        <div class="input-group">
                                        <label class="label">Food Item Photo</label>
                                            <input class="input--style-4" type="file" name="itemphoto" id="itemphoto"/>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="input-group">
                                            <img id="itemfileshow" style="height:150px; width:200px; border:2px solid black;"
                                            src="<?php
                                                    if(isset($_GET["ItemID"]))
                                                    {
                                                        echo "..\\Images\\FoodItem_Photo\\".$ItemPhoto;   
                                                    }
                                                ?>"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="p-t-15" style="text-align: center;">
                                    <input type="submit" class="btn btn--radius-2 btn--blue" name="btnsubmit" 
                                    value="<?php
                                            if(isset($_GET["ItemID"]))
                                            {
                                                echo "Update Details";   
                                            }
                                            else
                                            {
                                                echo "Submit Details";
                                            }
                                        ?>">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add New Food Item Form End-->
        </div>
    </div>
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

    <!-- PHP Code For Add New Food Item -->

    <?php
    if(isset($_POST["btnsubmit"]))
    {
        $con=new mysqli("localhost","root","","meals-4-all");
        if(isset($con->connect_error))
        {
            die("<script LANGUAGE='JavaScript'>
            window. alert('Connection Not Established with the Database..!!');
            window. location. href='AdminHomepage.php';
            </script>");
        }
        else
        { 
            $imgtype=array("image/png","image/gif","image/jpg","image/jpeg");
            if(!(in_array($_FILES["itemphoto"]["type"], $imgtype)))
            {
                die("<script LANGUAGE='JavaScript'>
                window. alert('Unsupported File Type Uploaded\\n\\nFile Should be .PNG, .GIF or .JPG');
                window. location. href='AddFoodItem.php';
                </script>");
            }
            else if($_FILES["itemphoto"]["size"]>=1000000)         //1 Mb=1000000 bytes
            {
                die("<script LANGUAGE='JavaScript'>
                window. alert('Unsupported File Size Uploaded\\n\\nMaximum Size 1 Mb');
                window. location. href='AddFoodItem.php';
                </script>");
            }
            else
            {
                $destination="..\\Images\\FoodItem_Photo\\";
                $check= move_uploaded_file($_FILES["itemphoto"]["tmp_name"], $destination.$_FILES["itemphoto"]["name"]);
                if($check==FALSE)
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('File NOT Uploaded');
                    window. location. href='AddFoodItem.php';
                    </script>");
                }
            }
            if($_POST["cuisinetype"]=="")
            {
                die("<script LANGUAGE='JavaScript'>
                window. alert('Please Select a Cuisine Type..!!');
                window. location. href='AddFoodItem.php';
                </script>");
            }
            else if($_POST["itemname"]=="")
            {
                die("<script LANGUAGE='JavaScript'>
                window. alert('Please Enter Valid Food Item Name..!!');
                window. location. href='AddFoodItem.php';
                </script>");
            }
            else if($_POST["price"]=="" || !(preg_match('/^\d{0,8}(\.\d{1,4})?$/', $_POST["price"])))
            {
                die("<script LANGUAGE='JavaScript'>
                window. alert('Please Enter Valid Price..!!\\n Example :- 100.50');
                window. location. href='AddFoodItem.php';
                </script>");
            }
            else if($_POST["description"]=="" && strlen($_POST["description"])>=200)
            {
                die("<script LANGUAGE='JavaScript'>
                window. alert('Please Enter a Valid Description and should be less than 200 words..!!');
                window. location. href='AddFoodItem.php';
                </script>");
            }
            else
            {
                $ItemName=$_POST["itemname"];
                $Price=$_POST["price"];
                $Foodphoto=$_FILES['itemphoto']['name'];
                $Description=$_POST["description"];
                $CuisineName=$_POST["cuisinetype"];
                $CuisineId="";
                $result=$con->query("Select CuisineId from Cuisines where CuisineName='$CuisineName'");
                if($result->num_rows!=0)
                {
                    while($verify=$result->fetch_object())
                    {
                        $CuisineId=$verify->CuisineId;
                    }
                }
                else
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Data NOT fetched from the Database\\n\\n'.$con->error.');
                    window. location. href='../Login.php';
                    </script>");
                }
                if(isset($_GET["ItemID"]))
                {
                    $ItemID=$_GET["ItemID"];
                    $result=$con->query("Update FoodItems set ItemName='$ItemName', Price='$Price',
                    Description='$Description',ItemPhoto='$Foodphoto',CuisineId='$CuisineId' where ItemId='$ItemID'");
                
                    if($result==true)
                    {
                        echo ("<script LANGUAGE='JavaScript'>
                        window. alert('Food Item Updated Successfully..!!');
                        window. location. href='Menu.php';
                        </script>");
                    }
                    else
                    {
                        die("<script LANGUAGE='JavaScript'>
                        window. alert('Food Item NOT Updated Successfully\\n\\n'.$con->error.');
                        window. location. href='AdminHomepage.php';
                        </script>");
                    }
                }
                else
                {
                    $result=$con->query("Insert into FoodItems(ItemName,Price,Description,ItemPhoto,CuisineId) "
                    . "values('$ItemName','$Price','$Description','$Foodphoto',$CuisineId)");
                    
                    if($result==true)
                    {
                        echo ("<script LANGUAGE='JavaScript'>
                        window. alert('New Food Item Added Successfully..!!');
                        window. location. href='Menu.php';
                        </script>");
                    }
                    else
                    {
                        die("<script LANGUAGE='JavaScript'>
                        window. alert('New Food Item NOT Added Successfully\\n\\n'.$con->error.');
                        window. location. href='AdminHomepage.php';
                        </script>");
                    }
                }       
            }
        }
        $con->close();
    }
?>

    <script type="text/javascript">
    function readURL(input) 
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#itemfileshow').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);

            }
        }
        $("#itemfile").change(function(){
            readURL(this);  
        });

    </script>

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