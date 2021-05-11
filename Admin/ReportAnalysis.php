<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Meals-4-All Reports Analysis</title>

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

    <!-- Report Analysis Drop Down Starts -->
    <section class="text-center" style="margin-top: 12%;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="rs-select2 js-select-simple select--no-search" style="margin-left: 40%; width: 60%;">
                        <select id='reporttype' >
                            <option disabled='disabled' selected='selected'>Choose option</option>
                            <option value='1' <?php if(isset($_GET['Rpt']))
                                                {
                                                    if(strcasecmp($_GET['Rpt'],"1")==0)
                                                    {
                                                        echo "selected";
                                                    }   
                                                }?>>Current Year Charity Summary</option>
                            <option value='2' <?php if(isset($_GET['Rpt']))
                                                {
                                                    if(strcasecmp($_GET['Rpt'],"2")==0)
                                                    {
                                                        echo "selected";
                                                    }   
                                                }?>>Overall Charity Summary</option>
                            <option value='3' <?php if(isset($_GET['Rpt']))
                                                {
                                                    if(strcasecmp($_GET['Rpt'],"3")==0)
                                                    {
                                                        echo "selected";
                                                    }   
                                                }?>>Summary of Job Applicants</option>
                            <option value='4' <?php if(isset($_GET['Rpt']))
                                                {
                                                    if(strcasecmp($_GET['Rpt'],"4")==0)
                                                    {
                                                        echo "selected";
                                                    }   
                                                }?>>Total Number of Customers Registered Uptill Now</option>
                            <option value='5' <?php if(isset($_GET['Rpt']))
                                                {
                                                    if(strcasecmp($_GET['Rpt'],"5")==0)
                                                    {
                                                        echo "selected";
                                                    }   
                                                }?>>Individual Food Item Sales</option>                    
                            <!-- <option value='1'></option> -->
                        </select>
                        <div class='select-dropdown'></div>
                    </div>
                </div>
                <div class="col-lg-4" style="text-align: left;">
                    <a class='template-btn' style="display: inline-block;" href = 'javascript:;' onclick = "this.href='ReportAnalysis.php?Rpt=' + document.getElementById('reporttype').value">Get Report</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Report Analysis Drop Down End -->

    <!-- Manage Charity Starts -->
    <div class="table-container" style="margin-top: 2%;margin-bottom: 5%;">
        <div style="width: 1400px !important;">
            
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
                            if(isset($_GET['Rpt']))
                            {
                                $ReportNumber=$_GET['Rpt'];

                                if(strcasecmp($ReportNumber,"1")==0)
                                {
                                    $result=$con->query("Select Charity.CustomerId as CustomerId,CharityId,
                                    CustomerName,EmailId,PhoneNo,TotalAmount,
                                    DATE_FORMAT(Charity.CharityDate,'%Y') as CharityYear from Charity,Customer
                                     where Customer.CustomerId=Charity.CustomerId and 
                                     YEAR(Charity.CharityDate)=YEAR(CURRENT_TIMESTAMP)");
                                    
                                    if($result->num_rows!=0)
                                    {
                                        echo "<table>
                                                <thead>
                                                    <tr class='table100-head'>
                                                        <th>Charity Id</th>
                                                        <th>Customer Id</th>
                                                        <th>Customer Name</th>
                                                        <th>Email Id</th>
                                                        <th>Phone No</th>
                                                        <th>Total Amount</th>
                                                        <th>Charity Year</th>
                                                    </tr>
                                                </thead>
                                            <tbody>";
        
        
                                        while($verify=$result->fetch_object())
                                        {
                                            $CharityId=$verify->CharityId;
                                            $CustomerId=$verify->CustomerId;
                                            $CustomerName=$verify->CustomerName;
                                            $EmailId=$verify->EmailId;
                                            $PhoneNo=$verify->PhoneNo;
                                            $TotalAmount=$verify->TotalAmount;
                                            $CharityYear=$verify->CharityYear;
                                            
                                            echo "<tr>
                                                <td>$CharityId</td>
                                                <td>$CustomerId</td>
                                                <td>$CustomerName</td>
                                                <td>$EmailId</td>
                                                <td>$PhoneNo</td>
                                                <td>Rs. $TotalAmount</td>
                                                <td>$CharityYear</td>
                                            </tr>";
                                            
                                        }
                                        echo "</tbody>
                                        </table>";
                                    }
                                    else
                                    {
                                        echo "<h2 style='color:red;font-style:normal;margin-left:20%;'>No Records Found.</h2>";
                                    }
                                }
                                else if(strcasecmp($ReportNumber,"2")==0)
                                {
                                    $result=$con->query("Select Charity.CustomerId as CustomerId,CharityId,
                                    CustomerName,EmailId,PhoneNo,TotalAmount,
                                    DATE_FORMAT(Charity.CharityDate,'%Y') as CharityYear from Charity,Customer
                                     where Customer.CustomerId=Charity.CustomerId");
                                    
                                    if($result->num_rows!=0)
                                    {
                                        echo "<table>
                                                <thead>
                                                    <tr class='table100-head'>
                                                        <th>Charity Id</th>
                                                        <th>Customer Id</th>
                                                        <th>Customer Name</th>
                                                        <th>Email Id</th>
                                                        <th>Phone No</th>
                                                        <th>Total Amount</th>
                                                        <th>Charity Year</th>
                                                    </tr>
                                                </thead>
                                            <tbody>";
        
        
                                        while($verify=$result->fetch_object())
                                        {
                                            $CharityId=$verify->CharityId;
                                            $CustomerId=$verify->CustomerId;
                                            $CustomerName=$verify->CustomerName;
                                            $EmailId=$verify->EmailId;
                                            $PhoneNo=$verify->PhoneNo;
                                            $TotalAmount=$verify->TotalAmount;
                                            $CharityYear=$verify->CharityYear;
                                            
                                            echo "<tr>
                                                <td>$CharityId</td>
                                                <td>$CustomerId</td>
                                                <td>$CustomerName</td>
                                                <td>$EmailId</td>
                                                <td>$PhoneNo</td>
                                                <td>Rs. $TotalAmount</td>
                                                <td>$CharityYear</td>
                                            </tr>";
                                            
                                        }
                                        echo "</tbody>
                                        </table>";
                                    }
                                    else
                                    {
                                        echo "<h2 style='color:red;font-style:normal;margin-left:20%;'>No Records Found.</h2>";
                                    }
                                }
                                else if(strcasecmp($ReportNumber,"3")==0)
                                {
                                    $result=$con->query("Select * from JobApplicant");
                                    
                                    if($result->num_rows!=0)
                                    {
                                        echo "<table>
                                                <thead>
                                                    <tr class='table100-head'>
                                                        <th>Applicant Id</th>
                                                        <th>Applicant Name</th>
                                                        <th>Gender</th>
                                                        <th>Email Id</th>
                                                        <th>Phone No</th>
                                                        <th>Licence No</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                            <tbody>";
        
        
                                        while($verify=$result->fetch_object())
                                        {
                                            $ApplicantId=$verify->ApplicantId;
                                            $ApplicantName=$verify->ApplicantName;
                                            $Gender=$verify->Gender;
                                            $EmailId=$verify->EmailId;
                                            $PhoneNo=$verify->PhoneNo;
                                            $LicenceNo=$verify->LicenceNo;
                                            $Status=$verify->Status;
                                            
                                            echo "<tr>
                                                <td>$ApplicantId</td>
                                                <td>$ApplicantName</td>
                                                <td>$Gender</td>
                                                <td>$EmailId</td>
                                                <td>$PhoneNo</td>
                                                <td>$LicenceNo</td>";
                                            if(strcasecmp($Status,"Accepted")==0)
                                            {
                                                echo "<td style='color:green;'>$Status</td>";
                                            }
                                            else if(strcasecmp($Status,"Rejected")==0)
                                            {
                                                echo "<td style='color:red;'>$Status</td>";
                                            }
                                            else if(strcasecmp($Status,"Pending")==0)
                                            {
                                                echo "<td style='color:blue;'>$Status</td>";
                                            } 

                                            echo "</tr>";
                                            
                                        }
                                        echo "</tbody>
                                        </table>";
                                    }
                                    else
                                    {
                                        echo "<h2 style='color:red;font-style:normal;margin-left:20%;'>No Records Found.</h2>";
                                    }
                                }
                                else if(strcasecmp($ReportNumber,"4")==0)
                                {
                                    $result=$con->query("Select * from Customer");
                                    
                                    if($result->num_rows!=0)
                                    {
                                        echo "<table>
                                                <thead>
                                                    <tr class='table100-head'>
                                                        <th>Customer Id</th>
                                                        <th>Customer Name</th>
                                                        <th>Gender</th>
                                                        <th>Birth Date</th>
                                                        <th>Email Id</th>
                                                        <th>Phone No</th>
                                                        <th>Address</th>
                                                    </tr>
                                                </thead>
                                            <tbody>";
        
                                        $Counter=0;
                                        while($verify=$result->fetch_object())
                                        {
                                            $CustomerId=$verify->CustomerId;
                                            $CustomerName=$verify->CustomerName;
                                            $Gender=$verify->Gender;
                                            $Birthdate=$verify->Birthdate;
                                            $EmailId=$verify->EmailId;
                                            $PhoneNo=$verify->PhoneNo;
                                            $Address=$verify->Address;
                                            
                                            echo "<tr>
                                                <td>$CustomerId</td>
                                                <td>$CustomerName</td>
                                                <td>$Gender</td>
                                                <td>$Birthdate</td>
                                                <td>$EmailId</td>
                                                <td>$PhoneNo</td>
                                                <td>$Address</td>
                                            </tr>";
                                            $Counter++;
                                            
                                        }
                                        echo "</tbody>
                                        </table>";

                                        echo "<h2 style='color:red;text-align:center;margin-top:5%;'><span style='color:black;'>Total Customers Registered :</span> $Counter</h2>";
                                    }
                                    else
                                    {
                                        echo "<h2 style='color:red;font-style:normal;margin-left:20%;'>No Records Found.</h2>";
                                    }
                                }
                                else if(strcasecmp($ReportNumber,"5")==0)
                                {
                                    $result=$con->query("Select orderdetails.ItemId,fooditems.ItemName,
                                    fooditems.Price,count(Quantity) as Sales from orderdetails,fooditems where
                                     fooditems.ItemId=orderdetails.ItemId group by ItemId");
                                    
                                    if($result->num_rows!=0)
                                    {
                                        echo "<table>
                                                <thead>
                                                    <tr class='table100-head'>
                                                        <th>Item Id</th>
                                                        <th>Food Name</th>
                                                        <th>Price</th>
                                                        <th>Total Sales</th>
                                                    </tr>
                                                </thead>
                                            <tbody>";
        
                                        while($verify=$result->fetch_object())
                                        {
                                            $ItemId=$verify->ItemId;
                                            $ItemName=$verify->ItemName;
                                            $Price=$verify->Price;
                                            $Sales=$verify->Sales;
                                            
                                            echo "<tr>
                                                <td>$ItemId</td>
                                                <td>$ItemName</td>
                                                <td>Rs. $Price</td>
                                                <td>$Sales</td>
                                            </tr>";
                                        }
                                        echo "</tbody>
                                        </table>";
                                    }
                                    else
                                    {
                                        echo "<h2 style='color:red;font-style:normal;margin-left:20%;'>No Records Found.</h2>";
                                    }
                                }
                            }
                            else
                            {

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