<?php
    session_start();
    if(!isset($_SESSION["AdminId"]) && !isset($_SESSION["EmailId"]))
    {
        die("<script LANGUAGE='JavaScript'>
        window. alert('Session is Expired..\\nPlease Login Again..!!');
        window. location. href='../Login.php';
        </script>");
    }

    $OrderId=$_GET["OId"];
    $Status=$_GET["St"];

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
        if(isset($_GET["OId"]) && isset($_GET["St"]))
        {
            $result=$con->query("Update Orders set OrderStatus='$Status' where OrderId='$OrderId'");
            if($result==true)
            {
                header("location:ManageOrders.php");
            }
            else
            {
                die("<script LANGUAGE='JavaScript'>
                window. alert('Data NOT Updated in the Database\\n\\n'.$result->error.');
                window. location. href='ManageOrders.php';
                </script>");
            }
        }
    }
    $con->close();
?>
