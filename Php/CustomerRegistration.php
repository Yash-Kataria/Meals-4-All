<?php
    if(isset($_POST["btnsubmit"]))
    {
        $con=new mysqli("localhost","root","","meals-4-all");
        if(isset($con->connect_error))
        {
            die("<script LANGUAGE='JavaScript'>
            window. alert('Connection Not Established with the Database..!!');
            window. location. href='../CustomerRegistration.html';
            </script>");
        }
        else
        {            
            $EmailId=$_POST["emailid"];
            $result=$con->query("Select * from Customer where EmailId='$EmailId'");
            if($result->num_rows!=0)
            {
                die("<script LANGUAGE='JavaScript'>
                window. alert('You are already registered.!');
                window. location. href='../Login.php';
                </script>");
            }
            else
            {
                $imgtype=array("image/png","image/gif","image/jpg","image/jpeg");
                if(!(in_array($_FILES["photo"]["type"], $imgtype)))
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Unsupported File Type Uploaded\\n\\nFile Should be .PNG, .GIF or .JPG');
                    window. location. href='../CustomerRegistration.html';
                    </script>");
                }
                else if($_FILES["photo"]["size"]>=1000000)         //1 Mb=1000000 bytes
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Unsupported File Size Uploaded\\n\\nMaximum Size 1 Mb');
                    window. location. href='../CustomerRegistration.html';
                    </script>");
                }
                else
                {
                    // $destination="..//Images//Customer_Photo//";
                    $destination="..\\Images\\Customer_Photo\\";
                    $check= move_uploaded_file($_FILES["photo"]["tmp_name"], $destination.$_FILES["photo"]["name"]);
                    if($check==FALSE)
                    {
                        die("<script LANGUAGE='JavaScript'>
                        window. alert('File NOT Uploaded');
                        window. location. href='../CustomerRegistration.html';
                        </script>");
                    }
                }
                if($_POST["firstname"]=="")
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Enter Valid First Name..!!');
                    window. location. href='../CustomerRegistration.html';
                    </script>");
                }
                else if($_POST["lastname"]=="")
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Enter Valid Last Name..!!');
                    window. location. href='../CustomerRegistration.html';
                    </script>");
                }
                else if($_POST["gender"]=="")
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Enter Valid Gender..!!');
                    window. location. href='../CustomerRegistration.html';
                    </script>");
                }
                else if($_POST["birthdate"]=="")
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Enter Valid Birthdate..!!');
                    window. location. href='../CustomerRegistration.html';
                    </script>");
                }
                else if($_POST["emailid"]=="" || !(preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $_POST["emailid"])))
                {  
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Enter Valid Email Id..!!\\n Example :- abc@gmail.com');
                    window. location. href='../CustomerRegistration.html';
                    </script>");
                }
                else if($_POST["phoneno"]=="" || !(preg_match('/((\+*)((0[ -]+)*|(91 )*)(\d{12}+|\d{10}+))|\d{5}([- ]*)\d{6}/', $_POST["phoneno"])))
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Enter Valid Mobile Number..!!\\n Example :- +91 9876543210');
                    window. location. href='../CustomerRegistration.html';
                    </script>");
                }
                else if($_POST["address"]=="" && strlen($_POST["address"])>=200)
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Select a Valid Address and should be less than 200 words..!!');
                    window. location. href='../CustomerRegistration.html';
                    </script>");
                }
                else if($_POST["city"]=="")
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Select a Valid City');
                    window. location. href='../CustomerRegistration.html';
                    </script>");
                }
                else if($_POST["password"]=="" || !(preg_match('/^[A-Z][a-z]{1,}[^a-zA-Z0-9][0-9]{1,}$/', $_POST["password"])))
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Enter Valid Password..!!\\nFirst Letter Should Be Capital, One Special Character, and One Number..!!');
                    window. location. href='../CustomerRegistration.html';
                    </script>");
                }
                else if($_POST["membership"]=="")
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Enter Valid Membership..!!');
                    window. location. href='../CustomerRegistration.html';
                    </script>");
                }
                else
                {
                    $CustomerName=($_POST["firstname"]." ".$_POST["lastname"]);
                    $Gender=$_POST["gender"];
                    $Birthdate=$_POST["birthdate"];
                    $EmailId=$_POST["emailid"];
                    $PhoneNo="";
                    if(strlen($_POST["phoneno"])>10)
                    {
                        $PhoneNo=$_POST["phoneno"];
                    }
                    else
                    {
                        $PhoneNo="+91 ".$_POST["phoneno"];
                    }
                    $Photo=$_FILES['photo']['name'];
                    $Address=($_POST["address"].", ".$_POST["city"]);
                    $Password=$_POST["password"];
                    
                    $result=$con->query("Insert into Customer(CustomerName,Gender,Birthdate,EmailId,PhoneNo,Photo,Address,Password) "
                                        . "values('$CustomerName','$Gender','$Birthdate','$EmailId','$PhoneNo','$Photo','$Address','$Password')");
                    if($result==true)
                    {
                        echo ("<script LANGUAGE='JavaScript'>
                        window. alert('Registration Done Successfully..!!');
                        window. location. href='../Login.php';
                        </script>");
                        // echo "<script>alert('Registration Done Successfully..!!')</script>";
                        // header("location:Login.php");
                    }
                    else
                    {
                        die("<script LANGUAGE='JavaScript'>
                        window. alert('Data NOT Inserted Successfully\\n\\n'.$con->error.');
                        window. location. href='../CustomerRegistration.html';
                        </script>");
                    }            
                }
            }
        }
        $con->close();
    }
?>