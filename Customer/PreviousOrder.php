<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Meals-4-All Previous Orders</title>

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

    <!-- Manage Charity Starts -->
    <div class="table-container" style="margin-top: 10%;margin-bottom: 5%;">
        <div style="width: 1200px !important;">
            
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
                            $CustomerId=$_SESSION["CustomerId"];
                            $result=$con->query("SELECT Orders.OrderId,FoodItems.ItemName,DATE_FORMAT(OrderTime,'%d %M %Y %h:%i:%s') as OrderTime,
                            OrderDetails.Quantity,OrderDetails.Amount FROM Orders, OrderDetails,FoodItems
                            where Orders.OrderId=OrderDetails.OrderId and FoodItems.ItemId = OrderDetails.ItemId
                            and OrderStatus='Completed' and CustomerId='$CustomerId' order by OrderTime desc");
                           
                            $FinalTotal=0;
                            
                            if($result->num_rows!=0)
                            {
                                echo "<table>
                                        <thead>
                                            <tr class='table100-head'>
                                                <th>Order Date</th>
                                                <th>Food Items</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total Amount</th>
                                        </thead>
                                    <tbody>";

                                $Counter="";
                                $NewItemName="";
                                $NewAmount="";
                                $NewQuantity="";
                                $FinalCount=0;

                                while($verify=$result->fetch_object())
                                {
                                    $OrderId=$verify->OrderId;
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
                                                <td>$OrderTime</td>
                                                <td>$NewItemName</td>
                                                <td>$NewQuantity</td>
                                                <td>$NewAmount</td>
                                                <td>Rs. $FinalTotal</td>
                                            </tr>";

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

    <script src="../Templates/Dashboard/assets/js/vendor/jquery-2.2.4.min.js"></script>
	<script src="../Templates/Dashboard/assets/js/vendor/bootstrap-4.1.3.min.js"></script>
    <script src="../Templates/Dashboard/assets/js/vendor/wow.min.js"></script>
    <script src="../Templates/Dashboard/assets/js/vendor/owl-carousel.min.js"></script>
    <script src="../Templates/Dashboard/assets/js/vendor/jquery.datetimepicker.full.min.js"></script>
    <script src="../Templates/Dashboard/assets/js/vendor/jquery.nice-select.min.js"></script>
    <script src="../Templates/Dashboard/assets/js/main.js"></script>
</body>
</html>