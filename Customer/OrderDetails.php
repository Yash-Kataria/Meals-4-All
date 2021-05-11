<?php
    session_start();
    if(!isset($_SESSION["CustomerId"]) && !isset($_SESSION["EmailId"]))
    {
        die("<script LANGUAGE='JavaScript'>
        window. alert('Session is Expired..\\nPlease Login Again..!!');
        window. location. href='../Login.php';
        </script>");
    }

    $ToDo=$_GET["ToDo"];

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
        // Confirming Order
        if(strcasecmp($ToDo,"Confirm")==0)
        {
            if(isset($_GET["C"]))
            {
                $CustomerId=$_GET["C"];

                // Saving which order belongs to which customer into Order Table
                $Insert=$con->query("Insert into Orders (OrderTime,OrderStatus,CustomerId) "
                . "values(CURRENT_TIMESTAMP,'Pending','$CustomerId')");
                
                if($Insert!=true)
                {
                    die ("<script LANGUAGE='JavaScript'>
                    window. alert('Order Not Saved..!!');
                    window. location. href='Cart.php';
                    </script>");
                }
                else
                {
                    $OrderIdFetch=$con->query("SELECT OrderId FROM Orders order by OrderId DESC LIMIT 1");
                
                    if ($OrderIdFetch->num_rows!=0)
                    {
                        while($verify=$OrderIdFetch->fetch_object())
                        {
                            $OrderId=$verify->OrderId;
                        }

                        // Now saving details of the particular order

                        $FetchingCartDetails=$con->query("SELECT Cart.ItemId,FoodItems.ItemName,
                        FoodItems.Price,Cart.Quantity,Cart.TotalAmount FROM Cart,
                            FoodItems where Fooditems.ItemId=Cart.ItemId and
                            CustomerId='$CustomerId'");
                    
                        if ($FetchingCartDetails->num_rows!=0)
                        {
                            $Completed=0;
                            while($verify=$FetchingCartDetails->fetch_object())
                            {
                                $ItemId=$verify->ItemId;
                                $ItemName=$verify->ItemName;
                                $Price=$verify->Price;
                                $Quantity=$verify->Quantity;
                                $TotalAmount=$verify->TotalAmount;

                                $InsertOrderDetails=$con->query("Insert into OrderDetails (OrderId,ItemId,Quantity,Amount) "
                                . "values('$OrderId','$ItemId','$Quantity','$TotalAmount')");
                                
                                if($InsertOrderDetails!=true)
                                {
                                    die ("<script LANGUAGE='JavaScript'>
                                    window. alert('Order Details Not Saved..!!');
                                    window. location. href='Cart.php';
                                    </script>");
                                }
                                else
                                {
                                    // Finally Deleting Details From The Cart
                                    $Delete=$con->query("Delete from Cart where CustomerId=$CustomerId and ItemId=$ItemId");
                                    if($Delete!=true)
                                    {
                                        die ("<script LANGUAGE='JavaScript'>
                                        window. alert('Order NOT deleted from the Cart..!!');
                                        window. location. href='Cart.php';
                                        </script>");
                                    }
                                    else
                                    {
                                        $Completed++;
                                    }
                                }
                            }
                            // Completed
                            if($Completed!=0)
                            {
                                die ("<script LANGUAGE='JavaScript'>
                                window. location. href='Payment.php';
                                </script>");
                            }
                        }
                        else
                        {
                            die ("<script LANGUAGE='JavaScript'>
                            window. alert('Cart Details Not Fetched..!!');
                            window. location. href='Cart.php';
                            </script>");
                        }
                    }
                    else
                    {
                        die ("<script LANGUAGE='JavaScript'>
                        window. alert('Order ID Not Fetched..!!');
                        window. location. href='Cart.php';
                        </script>");
                    }
                }
            }
        }
        // Deleting Order
        else if(strcasecmp($ToDo,"Clear")==0)
        {
            if(isset($_GET["C"]))
            {
                $CustomerId=$_GET["C"];
                
                $Delete=$con->query("Delete from Cart where CustomerId=$CustomerId");
                if($Delete!=true)
                {
                    die ("<script LANGUAGE='JavaScript'>
                    window. alert('Order NOT deleted from the Cart..!!');
                    window. location. href='Cart.php';
                    </script>");
                }
                else
                {
                    die ("<script LANGUAGE='JavaScript'>
                    window. location. href='Cart.php';
                    </script>");
                }
            }
        }
    }
    $con->close();
?>
