<?php
    session_start();
    if(!isset($_SESSION["AdminId"]) && !isset($_SESSION["EmailId"]))
    {
        die("<script LANGUAGE='JavaScript'>
        window. alert('Session is Expired..\\nPlease Login Again..!!');
        window. location. href='../Login.php';
        </script>");
    }
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
        $result=$con->query("Delete from fooditems where ItemId=$ItemID");
        if($result==true)
        {
            die("<script LANGUAGE='JavaScript'>
            window. location. href='Menu.php';
            </script>");
        }
        else
        {
            die("<script LANGUAGE='JavaScript'>
            window. alert('Data NOT Deleted from the Database\\n\\n'.$result->error.');
            window. location. href='Menu.php';
            </script>");
        }
    }
    $con->close();
?>
