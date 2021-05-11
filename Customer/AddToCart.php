<?php
    session_start();
    if(!isset($_SESSION["CustomerId"]) && !isset($_SESSION["EmailId"]))
    {
        die("<script LANGUAGE='JavaScript'>
        window. alert('Session is Expired..\\nPlease Login Again..!!');
        window. location. href='../Login.php';
        </script>");
    }
    
    $CustomerId=$_GET["C"];
    $ItemId=$_GET["IId"];
    $Price=$_GET["P"];
    $ToDo=$_GET["ToDo"];
    $Quantity=$_GET["Qty"];

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
        if(isset($_GET["C"]) && isset($_GET["IId"]) && isset($_GET["P"]) && isset($_GET["ToDo"]) && isset($_GET["Qty"]))
        {   
            // 1= Add Quantity
            // 0= Subtract Quantity
            if($ToDo==1)
            {
                $Quantity++;
            }
            else if($ToDo==0)
            {
                if($Quantity != 0)
                {
                    $Quantity--;
                }
                if($Quantity == 0)
                {
                    // Delete Section

                    $Delete=$con->query("Delete from Cart where CustomerId=$CustomerId and ItemId=$ItemId");
                
                    if($Delete!=true)
                    {
                        die ("<script LANGUAGE='JavaScript'>
                        window. alert('Food item  NOT deleted from the Cart..!!');
                        window. location. href='Menu.php';
                        </script>");
                    }
                    else
                    {
                        die ("<script LANGUAGE='JavaScript'>
                        window. location. href='Menu.php';
                        </script>");
                    }
                }

            }

            $Price=$Price*$Quantity;

            $result=$con->query("Select * from Cart where CustomerId=$CustomerId and ItemId=$ItemId");
            if  ($result->num_rows!=0)
            {
                // Update Section
                $Update=$con->query("Update Cart set Quantity='$Quantity', TotalAmount='$Price' where CustomerId='$CustomerId' and ItemId='$ItemId'");
                
                if($Update!=true)
                {
                    die ("<script LANGUAGE='JavaScript'>
                    window. alert('Food item  NOT updated in the Cart..!!');
                    window. location. href='Menu.php';
                    </script>");
                }
                else
                {
                    die ("<script LANGUAGE='JavaScript'>
                    window. location. href='Menu.php';
                    </script>");  
                }
            }
            else
            {
                // Insert Section
                $Insert=$con->query("Insert into Cart(CustomerId,ItemId,Quantity,TotalAmount) "
                . "values('$CustomerId','$ItemId','$Quantity','$Price')");
                
                if($Insert!=true)
                {
                    die ("<script LANGUAGE='JavaScript'>
                    window. alert('Food item  NOT added to the Cart..!!');
                    window. location. href='Menu.php';
                    </script>");
                }
                else
                {
                    die ("<script LANGUAGE='JavaScript'>
                    window. location. href='Menu.php';
                    </script>");
                }
            }
        }
        else
        {
            die ("<script LANGUAGE='JavaScript'>
            window. location. href='Menu.php';
            </script>");
        }
    }
    $con->close();
?>
