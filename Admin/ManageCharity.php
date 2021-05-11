<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Meals-4-All Manage Charity</title>

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
            font-size: 15px;
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
        <div style="width: 2000px;">
            
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
                            $result=$con->query("Select Charity.CustomerId as CustomerId,CharityId,CustomerName,EmailId,PhoneNo,
                            TotalAmount,Description,ShowName,DATE_FORMAT(Charity.CharityDate,'%Y-%m-%d') as CharityDate from Charity,Customer where
                             Customer.CustomerId=Charity.CustomerId");
                            if  ($result->num_rows!=0)
                            {
                                echo "<table>
                                        <thead>
                                            <tr class='table100-head'>
                                                <th>Customer Id</th>
                                                <th>Customer Name</th>
                                                <th>Email Id</th>
                                                <th>Amount Donated</th>
                                                <th>Description</th>
                                                <th>Date of Donation</th>
                                                <th>Mode of Charity</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                    <tbody>";

                                $Counter=0;
                                while($verify=$result->fetch_object())
                                {
                                    $CustomerId=$verify->CustomerId;
                                    $CharityId=$verify->CharityId;
                                    $ShowName=$verify->ShowName;
                                    if($ShowName==1)
                                    {
                                        $CustomerName=$verify->CustomerName;
                                        $EmailId=$verify->EmailId;
                                    }
                                    else if($ShowName==0)
                                    {
                                        $CustomerName="Annonymous Doner";
                                        $EmailId="Annonymous Doner";
                                    }
                                    $PhoneNo=$verify->PhoneNo;
                                    $TotalAmount=$verify->TotalAmount;
                                    $Description=$verify->Description;
                                    $CharityDate=$verify->CharityDate;
                                
                                    echo "<tr>
                                            <td>$CustomerId</td>
                                            <td>$CustomerName</td>
                                            <td>$EmailId</td>
                                            <td><input type='text' value='$TotalAmount' id='Amount.$Counter' style='width:80%;'></td>
                                            <td><textarea id='Description.$Counter'>$Description</textarea></td>
                                            <td><input type='date' id='CharityDate.$Counter' value='$CharityDate' style='width:100%;'></td>
                                            <td><input type='text' id='ShowName.$Counter' value='$ShowName' style='width:50%;'></td>
                                            <td>
                                                <a class='template-btn' href = 'javascript:;' onclick = \"this.href='CharityUpdateAndDelete.php?C=$CharityId&Amt=' + document.getElementById('Amount.$Counter').value + '&Desc=' + document.getElementById('Description.$Counter').value + '&Dt=' + document.getElementById('CharityDate.$Counter').value + '&Mode=' + document.getElementById('ShowName.$Counter').value\">Update</a>
                                            </td>
                                            <td>
                                                <a class='template-btn' onclick=\"javascript: return confirm('Are You Sure You Want To Delete the Donation.?');
                                            \" href='CharityUpdateAndDelete.php?C=$CharityId'>Delete</a>
                                            </td>
                                        </tr>";
                                    
                                    $Counter++;
                                }
                                echo "</tbody>
                                </table>";
                            }
                            else
                            {
                                echo "<h2 style='color:red;font-style:normal;margin-left:20%;'>No Job Applications Have Been Rejected</h2>";
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