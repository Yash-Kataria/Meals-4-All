<?php
    session_start();
    if(!isset($_SESSION["AdminId"]) && !isset($_SESSION["EmailId"]))
    {
        die("<script LANGUAGE='JavaScript'>
        window. alert('Session is Expired..\\nPlease Login Again..!!');
        window. location. href='../Login.php';
        </script>");
    }
    $ApplicantId=$_GET["Aid"];
    $Status=$_GET["S"];
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
        $Query="";
        if($Status==1)
        {
            $Query="Update JobApplicant set Status='Accepted' where ApplicantId=$ApplicantId";
        }
        else if($Status==0)
        {
            $Query="Update JobApplicant set Status='Rejected' where ApplicantId=$ApplicantId";
        }
        $result=$con->query($Query);
        if($result==true)
        {
            header("location:ManageJobApplicants.php");
        }
        else
        {
            die("<script LANGUAGE='JavaScript'>
            window. alert('Data NOT Deleted from the Database\\n\\n'.$result->error.');
            window. location. href='ManageJobApplicants.php';
            </script>");
        }
    }
    $con->close();
?>
