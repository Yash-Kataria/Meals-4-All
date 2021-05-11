<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Meals-4-All Current Orders</title>

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

    <style>
        .table-container tbody tr td
        {
            font-size: 17px;
            line-height: 30px;
        }
        .header-area 
        {
            position: absolute;
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

    <!-- Manage Charity Starts -->
    <div class="table-container" style="margin-top: 10%;margin-bottom: 5%;">
        <div style="width: 1500px !important;">
            
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
                            $result=$con->query("SELECT Customer.CustomerId,CustomerName,Orders.OrderId,Orders.OrderStatus,
                            FoodItems.ItemName,DATE_FORMAT(OrderTime,'%d %M %Y %h:%i:%s') as OrderTime,
                             OrderDetails.Quantity,OrderDetails.Amount FROM Orders, OrderDetails,FoodItems,
                             Customer where Orders.OrderId=OrderDetails.OrderId and 
                             FoodItems.ItemId = OrderDetails.ItemId and Customer.CustomerId=Orders.CustomerId
                              and OrderStatus In ('Pending','Accepted','Under Processing','Out For Delivery') order by OrderTime desc ");
                           
                            $FinalTotal=0;
                            
                            if($result->num_rows!=0)
                            {
                                echo "<table>
                                        <thead>
                                            <tr class='table100-head'>
                                                <th>Customer Name</th>
                                                <th>Order Date</th>
                                                <th>Food Items</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total Amount</th>
                                                <th style='width:100px !important;'>Status</th>
                                                <th style='width:80px !important;'></th>
                                        </thead>
                                    <tbody>";

                                $Counter=0;
                                $NewItemName="";
                                $NewAmount="";
                                $NewQuantity="";
                                $FinalCount=0;

                                while($verify=$result->fetch_object())
                                {
                                    $CustomerId=$verify->CustomerId;
                                    $CustomerName=$verify->CustomerName;
                                    $OrderId=$verify->OrderId;
                                    $OrderStatus=$verify->OrderStatus;
                                    $ItemName=$verify->ItemName;
                                    $Quantity=$verify->Quantity;
                                    $Amount=$verify->Amount;
                                    $OrderTime=$verify->OrderTime;

                                    $OrderCount=$con->query("Select Count(OrderId) as Count from OrderDetails where OrderId=$OrderId");
                                    
                                    if($OrderCount->num_rows!=0)
                                    {
                                        while($Cnt=$OrderCount->fetch_object())
                                        {
                                            $Count=(int)$Cnt->Count;
                                        }
                                    }
                                    if($FinalCount != $Count)
                                    {
                                        $NewItemName.=($ItemName."<br/>");
                                        $NewAmount.=("Rs. ".$Amount."<br/>");
                                        $NewQuantity.=("x ".$Quantity."<br/>");
                                        $FinalTotal+=$Amount; 
                                        
                                        $FinalCount++;
                                        if($FinalCount == $Count)
                                        {
                                            echo "<tr>
                                                <td style='width:250px !important;'>$CustomerId - $CustomerName</td>
                                                <td style='width:200px !important;'>$OrderTime</td>
                                                <td style='width:150px !important;'>$NewItemName</td>
                                                <td style='width:100px !important;'>$NewQuantity</td>
                                                <td style='width:100px !important;'>$NewAmount</td>
                                                <td style='width:100px !important;'>Rs. $FinalTotal</td>
                                                <td style='width:100px !important;'>
                                                    <div class='rs-select2 js-select-simple select--no-search'>
                                                        <select id='Status.$Counter'>";
                                                            
                                                            if(strcasecmp($OrderStatus,"Pending")==0)
                                                            {
                                                                echo "<option value='Pending' selected>Pending </option>";
                                                            }
                                                            else
                                                            {
                                                                echo "<option value='Pending'>Pending </option>";
                                                            }
                                                            if(strcasecmp($OrderStatus,"Accepted")==0)
                                                            {
                                                                echo "<option value='Accepted' selected>Accepted </option>";
                                                            }
                                                            else
                                                            {
                                                                echo "<option value='Accepted'>Accepted </option>";
                                                            }
                                                            if(strcasecmp($OrderStatus,"Under Processing")==0)
                                                            {
                                                                echo "<option value='Under Processing' selected>Under Processing </option>";
                                                            }
                                                            else
                                                            {
                                                                echo "<option value='Under Processing'>Under Processing </option>";
                                                            }
                                                            if(strcasecmp($OrderStatus,"Out For Delivery")==0)
                                                            {
                                                                echo "<option value='Out For Delivery' selected>Out For Delivery </option>";
                                                            }
                                                            else
                                                            {
                                                                echo "<option value='Out For Delivery'>Out For Delivery </option>";
                                                            }
                                                            if(strcasecmp($OrderStatus,"Completed")==0)
                                                            {
                                                                echo "<option value='Completed' selected>Completed </option>";
                                                            }
                                                            else
                                                            {
                                                                echo "<option value='Completed'>Completed </option>";
                                                            }

                                                        echo "</select>
                                                        <div class='select-dropdown'></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class='template-btn' onclick=\"javascript: this.href='OrderStatusUpdate.php?OId=$OrderId&St=' + document.getElementById('Status.$Counter').value;\">Update</a>
                                                </td>
                                            </tr>";
                                            //<script>document.getElementById('Status.$Counter').value=$OrderStatus;</script>
                                            $NewItemName="";
                                            $NewAmount="";
                                            $NewQuantity="";
                                            $FinalTotal=0;

                                            $FinalCount=0;
                                        }
                                    }
                                    else
                                    {
                                        $NewItemName="";
                                        $NewAmount="";
                                        $NewQuantity="";
                                        $FinalTotal=0;

                                        $FinalCount=0;                                        
                                    }

                                    $Counter++;
                                }
                                echo "</tbody>
                                </table>";
                            }
                            else
                            {
                                echo "<h2 style='color:red;font-style:normal;margin-left:20%;'>No Orders Have Been Placed Uptill Now.</h2>";
                            }
                            $con->close();
                        }
                    ?>
        </div>
    </div>                    
    <!-- Manage Charity Ends -->

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