<?php
    session_start();
    if(!isset($_SESSION["AdminId"]) && !isset($_SESSION["EmailId"]))
    {
        die("<script LANGUAGE='JavaScript'>
        window. alert('Session is Expired..\\nPlease Login Again..!!');
        window. location. href='../Login.php';
        </script>");
    }

    $CharityId=$_GET["C"];
    $Amount=$_GET["Amt"];
    $Description=$_GET["Desc"];
    $CharityDate=$_GET["Dt"];
    $Mode=$_GET["Mode"];

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
        if(isset($_GET["C"]) && isset($_GET["Amt"]) && isset($_GET["Desc"]) && isset($_GET["Dt"]) && isset($_GET["Mode"]))
        {
            date_default_timezone_set('Asia/Kolkata');
            $date = DateTime::createFromFormat('Y-m-d', $CharityDate);
            $CharityDate= $date->format('Y-m-d H:i:s');

            $result=$con->query("Update Charity set TotalAmount=$Amount,Description='$Description',ShowName=$Mode,CharityDate='$CharityDate' where CharityId=$CharityId");
            if($result==true)
            {
                header("location:ManageCharity.php");
            }
            else
            {
                die("<script LANGUAGE='JavaScript'>
                window. alert('Data NOT Updated in the Database\\n\\n'.$result->error.');
                window. location. href='ManageCharity.php';
                </script>");
            }
        }
        else if(isset($_GET["C"]))
        {
            $result=$con->query("Delete from Charity where CharityId=$CharityId");
            if($result==true)
            {
                header("location:ManageCharity.php");
            }
            else
            {
                die("<script LANGUAGE='JavaScript'>
                window. alert('Data NOT Deleted from the Database\\n\\n'.$result->error.');
                window. location. href='ManageCharity.php';
                </script>");
            }
        }
    }
    $con->close();
?>
